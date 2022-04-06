<script setup>
import { reactive } from 'vue';
import {Input} from '@/src/components/input';

const state = reactive({r: 0, g: 0, b: 0});

const nonReactiveState = {r: 0, g: 0, b: 0};
</script>
<template>
  <h4 class="text-bold text-xl mb-1">Reactive</h4>
  <div class="flex flex-wrap gap-4">
    <div>
      <Input v-model="state.r" min="0" max="255" type="number" label="Red" />
      <Input v-model="state.g" min="0" max="255" type="number" label="Green" />
      <Input v-model="state.b" min="0" max="255" type="number" label="Blue" />
    </div>
    <div>
      <div class="w-52 h-52" :style="{'background-color': `rgb(${state.r}, ${state.g}, ${state.b})`}"></div>
    </div>
  </div>
  <h4 class="text-bold text-xl my-1">Not Reactive</h4>
  <div class="flex flex-wrap gap-4">
    <div>
      <Input v-model="nonReactiveState.r" min="0" max="255" type="number" label="Red" />
      <Input v-model="nonReactiveState.g" min="0" max="255" type="number" label="Green" />
      <Input v-model="nonReactiveState.b" min="0" max="255" type="number" label="Blue" />
    </div>
    <div>
      <div class="w-52 h-52" :style="{'background-color': `rgb(${nonReactiveState.r}, ${nonReactiveState.g}, ${nonReactiveState.b})`}"></div>
    </div>
  </div>
  <p class="mt-2">Note: Coba ubah nilai-nilai Not Reactive, lalu ubah nilai-nilai Reactive dan lihat hasilnya</p>
</template>