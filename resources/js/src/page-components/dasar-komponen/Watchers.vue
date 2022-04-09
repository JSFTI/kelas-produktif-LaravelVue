<script setup>
import { reactive, ref, watch } from 'vue';
import Input from '@/src/components/input/Input.vue';

const name = ref("Jason");
const obj = reactive({
  foo: "bar",
  baz: "fii"
});

watch(name, () => {
  console.log(name.value);
});

watch(obj, () => {
  console.log(JSON.parse(JSON.stringify(obj)));
});

watch(() => obj.foo, () => {
  console.log(obj.foo);
});
</script>
<template>
  <h1 class="text-xl">Buka console browser untuk melihat cara kerja watch</h1>
  <Input v-model="name" />
  <br />
  <Input v-model="obj.foo" />
  <Input v-model="obj.baz" />
</template>