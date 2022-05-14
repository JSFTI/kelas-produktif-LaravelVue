<script setup>
import axios from 'axios';
import { onBeforeMount, ref, watch } from 'vue';
import PostForm from '../page-components/posts/PostForm.vue';
import postValidation from '@/validators/post'
import { useToast } from 'vue-toast-notification';
import { useRouter } from 'vue-router';
import { useUser } from '@/stores/user';
import IconChevronLeft from '~icons/material-symbols/chevron-left';

const invalidFeedbacks = ref({});
const router = useRouter();
const toast = useToast();
const user = useUser();
const form = ref();

user.$subscribe((_, state) => {
  if(state.id === null){
    router.replace('/');
  }
});

onBeforeMount(() => {
  if(user.id === null){
    router.replace('/');
  }
});

function handleSubmit(data){
  invalidFeedbacks.value = {};

  postValidation(data)
    .then(() => {
      axios.post('/posts', data)
        .then((res) => {
          toast.success('Post berhasil ditambahkan. Klik untuk melihat post', {
            duration: 3000,
            onClick: () => {
              router.push({name: 'post', params: {post: res.data.id, slug: res.data.slug}});
            }
          });
          form.value.reset();
        })
        .catch((err) => {
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
          <h1>Buat Post Baru</h1>
      </section>
      <PostForm @submit="handleSubmit" :invalid-feedbacks="invalidFeedbacks" ref="form" />
    </div>
  </div>
</template>