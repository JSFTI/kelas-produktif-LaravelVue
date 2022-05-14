<script setup>
import { useUser } from '@/stores/user';
import axios from 'axios';
import { ref, watch } from 'vue';

const user = useUser();
const posts = ref(null);
const page = ref(1);
const isLastPage = ref(true);

axios.get(`posts?writer=${user.id}&page=${page.value}`)
  .then((res) => {
    posts.value = res.data.posts;
  });

function handleVisible(isVisible){
  if(isVisible){
    page.value++;
  }
}

function handleDelete(post){
  axios.delete(`posts/${post}`)
    .then(() => {
      const postIndex = posts.value.map(x => x.id).indexOf(post);
      console.log(postIndex);
      posts.value.splice(postIndex, 1);
    });
}

watch(() => page.value, () => {
  axios.get(`posts?writer=${user.id}&page=${page.value}`)
    .then((res) => {
      if(res.data.posts.length === 0){
        isLastPage.value = false;
      }
      posts.value.push(...res.data.posts);
    });
});
</script>
<template>
  <div class="flex flex-col gap-4 my-3">
    <template v-if="posts !== null">
      <PostCardHorizontal v-for="post in posts" :post="post">
        <template v-slot:buttons>
          <router-link :to="{name: 'post', params: {post: post.id, slug: post.slug}}">
            <Button class="btn">
              View
            </Button>
          </router-link>
          <router-link :to="{name: 'post-edit', params: {post: post.id}}">
            <Button class="btn btn-warning">
              Edit
            </Button>
          </router-link>
          <Button class="btn btn-danger" @click="handleDelete(post.id)">
            Delete
          </Button>
        </template>
      </PostCardHorizontal>
    </template>
    <template v-else>
      <PostCardHorizontal v-for="i in 10" skeleton>
        <template v-slot:buttons>
          <Skeletor width="75" height="30" />
          <Skeletor width="75" height="30" />
          <Skeletor width="75" height="30" />
        </template>
      </PostCardHorizontal>
    </template>
    <PostCardHorizontal skeleton v-if="isLastPage">
      <template v-slot:buttons>
        <Skeletor width="75" height="30" />
        <Skeletor width="75" height="30" />
        <Skeletor width="75" height="30" />
      </template>
    </PostCardHorizontal>
    <div v-observe-visibility="handleVisible"></div>
  </div>
</template>