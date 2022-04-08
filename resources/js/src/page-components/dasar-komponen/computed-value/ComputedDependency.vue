<script setup>
import { computed, reactive } from 'vue';
import Input from '@/src/components/input/Input.vue';

const state = reactive({
  foo: 'bar',
  foe: 'baz'
});

const computeFoo = computed(() => {
  console.log("top" + " " + state.foo);
  return state.foo + " bat" + state.foe;
});
const computeFoe = computed(() => {
  console.log("bottom" + " " + state.foe);
  return state.foe + " mat";
});

</script>
<template>
  <div>
    <Input v-model="state.foo" />
    <Input v-model="state.foe" />
  </div>
  <div>
    <div>Compute Foo: {{computeFoo}}</div>
    <div>Compute Foe: {{computeFoe}}</div>
  </div>
</template>