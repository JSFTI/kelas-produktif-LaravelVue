<script setup>
import axios from 'axios';
import { ref } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import IconChevronLeft from '~icons/material-symbols/chevron-left';

const route = useRoute();
const router = useRouter();

const post = ref(null);
axios.get(`/posts/${route.params.post}`)
  .then((res) => {
    post.value = res.data;
  });
</script>
<template>
  <div class="flex justify-center mx-3 lg:mx-0" v-if="post">
    <article class="w-full lg:w-7/12">
      <section class="mb-3 font-bold text-xl flex gap-2 items-center">
        <button class="text-2xl hover:text-blue-500 transition" @click="router.back()">
          <IconChevronLeft /></button>
        <h1>{{ post.title }}</h1>
      </section>
      <hr class="border-black" />
      <section class="my-3">
        <img :src="post.image" />
      </section>
      <section class="my-3 __post-content" v-html="post.content"></section>
    </article>
  </div>
</template>
<style lang="scss">
.__post-content{
  p{
    @apply my-4 text-justify;
  }
}
</style>