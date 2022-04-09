<script setup>
import { reactive } from 'vue';
import { ComputedInChild, ComputedDependency } from './computed-value';
import Button from '@/src/components/input/Button.vue';

const data = reactive({
  name: "Jason Surya Faylim",
  number: 20.1,
  array: [100, 4, 3, 5, 1, 30]
});

function reArray(){
  const newArr = [];
  for(let i = 0; i < 7; i++){
    newArr.push(Math.floor(Math.random() * 100));
  }
  data.array = newArr;
}
</script>
<template>
  <div>
    <h2 class="text-2xl">Contoh Computed Value:</h2>
    <small>ComputedInChild.vue</small>
    <div>Parent Data:</div>
    <Button @click="reArray">Re-Array</Button>
    <pre>{{ data }}</pre>
    <ComputedInChild :data="data" />
  </div>
  <div class="mt-4">
    <h2 class="text-2xl">Contoh computed dependency:</h2>
    <small>ComputedDependency.vue</small>
    <ComputedDependency />
  </div>
</template>