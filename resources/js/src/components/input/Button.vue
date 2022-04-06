<script setup>
defineProps({
  'type': String,
  'iconed': Boolean,
  'active': Boolean
});
</script>
<template>
  <button :type="type" :class="['btn', iconed ? 'btn-icon' : '', active ? 'active' : '']">
    <slot name="icon"></slot>
    <slot></slot>
  </button>
</template>
<style scoped lang="scss">
.btn{

  @apply border py-2 px-3 rounded;

  &.btn-icon{
    @apply rounded-full;
  }

  &.active{
    @apply shadow-lg bg-blue-500 text-white;
  }
}
</style>