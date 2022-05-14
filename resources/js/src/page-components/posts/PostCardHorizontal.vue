<script setup>
import { ref } from 'vue';

defineProps({
  skeleton: Boolean,
  post: Object
});

const imageLoading = ref(true);

</script>
<template>
  <Card v-if="!skeleton" no-title>
    <div class="flex">
      <div style="width: 192px">
        <img :src="post.image" @load="imageLoading = false" :class="[imageLoading ? 'w-0 h-0' : 'w-full']" />
        <Skeletor width="192" height="100" v-if="imageLoading" />
      </div>
      <div class="m-3 w-5/12 font-semibold text-lg">
        {{ post.title }}
      </div>
      <div class="flex gap-3 self-end ml-auto m-3">
        <slot name="buttons">

        </slot>
      </div>
    </div>
  </Card>
  <Card class="w-full" no-title v-if="skeleton">
    <div class="flex">
      <div>
        <Skeletor width="192" height="100" />
      </div>
      <div class="m-3 w-5/12">
        <Skeletor width="100%" height="25" />
      </div>
      <div class="flex gap-3 self-end ml-auto m-3">
        <slot name="buttons">

        </slot>
      </div>
    </div>
  </Card>
</template>