<script setup>
import PostCard from '@/src/page-components/posts/PostCard.vue';
import { computed } from '@vue/reactivity';
import axios from 'axios';
import { reactive } from 'vue';
import Button from '../components/input/Button.vue';

const state = reactive({});

axios.get('/api/posts')
  .then((res) => {
    console.log(res.data);
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

</script>
<template>
  <div class="flex flex-col items-center gap-5">
    <router-link :to="{name: 'post-create'}">
      <Button type="button">
        Buat Post Baru
      </Button>
    </router-link>
    <PostCard v-for="(post, i) in posts"
      v-if="posts !== null"
      :post="post ?? {}"
      :key="post?.id ?? i + 'skeleton'"
    />
    <div v-else class="text-center">
      Belum ada post.
    </div>
  </div>
</template>