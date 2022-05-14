<script setup>
import axios from 'axios';
import { ref } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import postValidation from '@/validators/post';
import { pick } from 'lodash';
import { useToast } from 'vue-toast-notification';
import IconChevronLeft from '~icons/material-symbols/chevron-left';

const route = useRoute();
const router = useRouter();
const toast = useToast();
const post = ref(null);
const form = ref();
const invalidFeedbacks = ref({});

axios.get(`posts/${route.params.post}`)
  .then((res) => {
    post.value = pick(res.data, ['id', 'title', 'slug', 'content', 'image']);
  });

function handleSubmit(data){
  invalidFeedbacks.value = {};

  postValidation(data)
    .then(() => {
      axios.put(`/posts/${post.value.id}`, data)
        .then((res) => {
          toast.success('Post berhasil diubah. Klik untuk melihat post', {
            duration: 3000,
            onClick: () => {
              router.push({name: 'post', params: {post: post.value.id, slug: data.slug}});
            }
          });
        })
        .catch((err) => {
          console.dir(err);
          invalidFeedbacks.value = err.response.data.messages;
        });
    })
    .catch((err) => {
      invalidFeedbacks.value = err;
    });
}
</script>
<template>
  <div class="flex justify-center w-full mb-36">
    <div class="px-3 w-full lg:w-7/12 xl:w-3/5">
      <section class="mb-3 font-bold text-xl flex gap-2 items-center">
        <button class="text-2xl hover:text-blue-500 transition" @click="router.back()">
          <IconChevronLeft /></button>
          <h1>Edit Post</h1>
      </section>
      <hr />
      <PostForm :form-data="post" @submit="handleSubmit" :skeleton="post === null" :invalid-feedbacks="invalidFeedbacks" ref="form" />
    </div>
  </div>
</template>