<script setup>
import IconReadme from '~icons/gg/readme';
import Card from '@/src/components/view/Card.vue';
import Button from '@/src/components/input/Button.vue';
import { isEmpty } from 'lodash';

const props = defineProps({
  post: Object
});
</script>
<template>
  <Card class="w-96" v-if="isEmpty(post)">
    <template v-slot:title>
      {{ post.title }}
    </template>
    <div class="relative">
      <img :src="post.image" />
      <router-link :to="{name: 'post', params: {post: post.id}}">
        <Button type="button" class="read-button" iconed>
          <template v-slot:icon>
            <IconReadme />
          </template>
        </Button>
      </router-link>
    </div>
    <p class="m-4 mt-8">{{ post.content.length > 100 ? post.content.substring(0, 100) + '...' : post.content }}</p>
  </Card>
  <Card class="w-96" v-else>
    <template v-slot:title>
      <Skeletor width="250" height="20" />
    </template>
    <div class="relative">
      <Skeletor width="384" height="200" />
    </div>
    <p class="m-4 mt-8 flex flex-col gap-2">
      <Skeletor width="100%" height="20" />
      <Skeletor width="100%" height="20" />
      <Skeletor width="75%" height="20" />
    </p>
  </Card>
</template>
<style scoped lang="scss">
.read-button{
  transform: translateY(-50%);
  right: 25px;
  @apply absolute bg-white;
}
</style>