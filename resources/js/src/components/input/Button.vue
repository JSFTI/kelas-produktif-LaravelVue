<script setup>
defineProps({
  'type': String,
  'iconed': Boolean,
  'active': Boolean,
  'for': String
});
</script>
<template>
  <label v-if="type === 'label'" :for="for" :class="['btn cursor-pointer', iconed ? 'btn-icon' : '', active ? 'active' : '']">
    <slot name="icon"></slot>
    <slot></slot>
  </label>
  <button v-else :type="type" :class="['btn', iconed ? 'btn-icon' : '', active ? 'active' : '']">
    <slot name="icon"></slot>
    <slot></slot>
  </button>
</template>
<style scoped lang="scss">
.btn{

  @apply border py-2 px-3 rounded;

  &.btn-icon{
    @apply rounded-full h-14 w-14 grid place-items-center text-xl;
  }

  &.active{
    @apply shadow-lg bg-blue-500 text-white;
  }
}
</style>