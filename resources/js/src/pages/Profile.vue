<script setup>
import {useUser} from '@/stores/user';
import IconUserCircle from '~icons/ph/user-circle';
import IconBaselineAlternateEmail from '~icons/ic/baseline-alternate-email';
import { onBeforeMount } from 'vue';
import { useRouter } from 'vue-router';

const user = useUser();
const router = useRouter();

onBeforeMount(() => {
  if(user.id === null){
    router.replace('/');
  }
});
</script>
<template>
  <section>
    <h1 class="text-3xl font-bold">My Profile</h1>
    <div class="my-3 flex flex-col gap-2">
      <div class="flex items-center gap-3 text-lg">
        <IconUserCircle class="text-2xl" />
        <div>{{ user.username }}</div></div>
      <div class="flex items-center gap-3 text-lg">
        <IconBaselineAlternateEmail class="text-2xl" />
        <div>{{ user.email }}</div>
      </div>
    </div>
  </section>
  <hr class="my-2" />
  <section>
    <h3 class="text-xl font-bold">My Posts</h3>
    <ProfilePosts />
  </section>
</template>