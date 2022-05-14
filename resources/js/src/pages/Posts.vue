<script setup>
import PostCard from '@/src/page-components/posts/PostCard.vue';
import { computed } from '@vue/reactivity';
import axios from 'axios';
import { reactive, watch } from 'vue';
import Button from '../components/input/Button.vue';
import { useUser } from '@/stores/user';
import { useRoute, useRouter } from 'vue-router';

const state = reactive({});
const user = useUser();
const router = useRouter();
const route = useRoute();

axios.get(`/posts${(route.query.page ? `?page=${route.query.page}` : '')}`)
  .then((res) => {
    Object.assign(state, res.data);
  });

const posts = computed(() => {
  if(state.posts){
    if(state.posts.length === 0){
      return null;
    }
    return state.posts;
  }
  return Array.from({length: 10}, (_) => null);
});

watch(() => route.query.page,() => {
  axios.get(`/posts${(route.query.page ? `?page=${route.query.page}` : '')}`)
  .then((res) => {
    Object.assign(state, res.data);
  });
});

</script>
<template>
  <div class="flex flex-col items-center gap-5 mb-52">
    <router-link :to="{name: 'post-create'}" v-if="user.id">
      <Button type="button">
        Buat Post Baru
      </Button>
    </router-link>
    <PostCard v-for="(post, i) in posts"
      v-if="posts !== null"
      :post="post || {}"
      :key="post?.id ?? i + 'skeleton'"
    />
    <div v-else class="text-center">
      Belum ada post.
    </div>
    <Paginate v-if="posts !== null" :current-page="state.current_page" :total-pages="state.total_pages"
      @change-page="(page) => router.push({query: {page: page}})" />
  </div>
</template>