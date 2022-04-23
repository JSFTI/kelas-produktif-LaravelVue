<script setup>
import PostForm from '../page-components/posts/PostForm.vue';
import { reactive } from 'vue';

const state = reactive({form: {
  'title': "",
  'image': null,
  'content': ""
}});

</script>
<template>
  <div class="flex justify-center w-full">
    <div class="px-3 w-full lg:w-7/12 xl:w-3/5">
      <h1 class="text-xl font-semibold">Buat Post Baru</h1>
      <PostForm :form-data="state.form" />
    </div>
  </div>
</template>