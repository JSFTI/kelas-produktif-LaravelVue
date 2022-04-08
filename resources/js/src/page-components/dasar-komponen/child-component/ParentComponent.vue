<script setup>
import { ref, reactive, onUpdated } from 'vue';
import NativeChildComponent from './NativeChildComponent.vue';
import ArrayChildComponent from './ArrayChildComponent.vue';
import ObjectChildComponent from './ObjectChildComponent.vue';

const nativeData = ref("Hello World");
const arrayData = ref(["a", "d", "c", "e", "f"]);
const objectData = ref({
  framework: "Vue",
  language: "JavaScript"
});

function handleNativeChange(data){
  nativeData.value = data;
}

function handleArrayChange(data){
  arrayData.value = data; 
}

function handleObjectChange(data){
  objectData.value = data;
}

</script>
<template>
  <div>
    <span>Parent Native Data:</span>
    <pre>{{ nativeData }}</pre>
  </div>
  <div>
    <span>Native Child Component:</span>
    <NativeChildComponent :data="nativeData" @change="handleNativeChange" />
  </div>
  <div class="mt-5">
    <span>Parent Array Data:</span>
    <pre>{{ arrayData }}</pre>
  </div>
  <div>
    <span>Array Child Component:</span>
    <ArrayChildComponent :data="arrayData" @change="handleArrayChange" />
  </div>
  <div class="mt-5">
    <span>Parent Object Data:</span>
    <pre>{{ objectData }}</pre>
  </div>
  <div>
    <span>Object Child Component:</span>
    <ObjectChildComponent :data="objectData" @change="handleObjectChange" />
  </div>
</template>