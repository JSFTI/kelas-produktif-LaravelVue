<script setup>
import { reactive, ref } from 'vue';
import Button from '@/src/components/input/Button.vue';

const count = ref(0);

function handleCount(){
  count.value = count.value + 1;
}
</script>
<template>
  <div>
    <Button @click="handleCount()">Click Me!</Button>
    <div class="mt-2">Clicked {{ count }} time{{ count > 1 ? "s" : "" }}</div>
  </div>
</template>