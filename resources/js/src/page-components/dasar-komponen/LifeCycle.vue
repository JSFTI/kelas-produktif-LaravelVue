<script setup>
import { onBeforeMount, onBeforeUnmount, onBeforeUpdate, onMounted, onUnmounted, onUpdated, ref } from 'vue';
import Button from '@/src/components/input/Button.vue';

const sleep = ms => new Promise(r => setTimeout(r, ms));

function handleClick(){
  console.log(`Document is clicked ${Math.random()}`);
}

document.addEventListener('click', handleClick);

onBeforeMount(async () => {
  console.log("Component preparing to mount");
});

onMounted(() => {
  console.log("Component mounted");
});

onUpdated(() => {
  console.log("Component updated");
});

onBeforeUpdate(() => {
  console.log("Component preparing to update");
})

onBeforeUnmount(() => {
  console.log("Component preparing to unmount");
});

onUnmounted(() => {
  console.log("Component unmounted");
  document.removeEventListener('click', handleClick);
});

const foo = ref(0);

function handleChange(){
  foo.value++;
  console.log(foo.value);
}

</script>
<template>
  <div class="text-2xl text-center">Buka Browser Console Untuk Melihat Efek Lifecycle</div>
  <div class="text-center">
    <Button @click="handleChange">Trigger Update</Button>
    {{ foo }}
  </div>
</template>