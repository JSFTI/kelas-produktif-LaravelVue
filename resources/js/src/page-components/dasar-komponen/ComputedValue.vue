<script setup>
import { reactive } from 'vue';
import { ComputedInChild, ComputedDependency } from './computed-value';

const data = reactive({
  name: "Jason Surya Faylim",
  number: 20.1,
  array: [100, 4, 3, 5, 1, 30]
});
</script>
<template>
  <div>
    <h2 class="text-2xl">Contoh Computed Value:</h2>
    <small>ComputedInChild.vue</small>
    <div>Parent Data:</div>
    <pre>{{ data }}</pre>
    <ComputedInChild :data="data" />
  </div>
  <div class="mt-4">
    <h2 class="text-2xl">Contoh computed dependency:</h2>
    <small>ComputedDependency.vue</small>
    <ComputedDependency />
  </div>
</template>