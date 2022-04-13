<script setup>
import { reactive, ref, watch } from 'vue';
import Input from '@/src/components/input/Input.vue';

const name = ref("Jason");
const obj = reactive({
  foo: "bar",
  baz: "fii",
});

const arrayStuff = reactive([
  1, 2
]);

watch(name, () => {
  console.log(name.value);
});

watch(obj, () => {
  console.log(JSON.parse(JSON.stringify(obj)));
});

watch(() => obj.foo, () => {
  console.log(obj.foo);
});

watch(arrayStuff, () => {console.log("Changed");});

arrayStuff.push("test");
arrayStuff[1] = 100;
console.log(arrayStuff);

</script>
<template>
  <h1 class="text-xl">Buka console browser untuk melihat cara kerja watch</h1>
  <Input v-model="name" />
  <br />
  <Input v-model="obj.foo" />
  <Input v-model="obj.baz" />
</template>