<script setup>
import {
  ReactivityRef,
  ReactivityRefArray,
  ReactivityReactiveForm,
  ReactivityDOM,
  NestedReactivity
} from './reactivity';
</script>
<template>
  <div class="my-4">
    <h1 class="text-2xl">Contoh reactivity dalam form dengan reactive():</h1>
    <small class="block mb-4">ReactivityReactiveForm.vue</small>
    <ReactivityReactiveForm />
  </div>
  <hr />
  <div class="my-4">
    <h1 class="text-2xl">Reactivity Merender Kembali (Refresh) Tampilan:</h1>
    <small class="block mb-4">ReactivityDOM.vue</small>
    <ReactivityDOM />
  </div>
  <hr />
  <div class="my-4">
    <h1 class="text-2xl">Nested Reactivity:</h1>
    <small class="block mb-4">NestedReactivity.vue</small>
    <NestedReactivity />
  </div>
  <hr />
  <div class="my-4">
    <h1 class="text-2xl">Contoh reactivity dengan ref():</h1>
    <small class="block mb-4">ReactivityRef.vue</small>
    <ReactivityRef />
  </div>
  <hr />
  <div class="my-4">
    <h1 class="text-2xl">Contoh reactivity dengan ref() array:</h1>
    <small class="block mb-4">ReactivityRefArray.vue</small>
    <ReactivityRefArray />
  </div>
  <hr />
  <p class="mb-20">
    Bacaaan Tambahan:
    <a href="https://stackoverflow.com/questions/61452458/ref-vs-reactive-in-vue-3">
      Ref vs reactive
    </a>
  </p>
</template>
