<script setup>
defineProps({
  'type': String,
  'iconed': Boolean,
  'active': Boolean,
  'htmlFor': String,
  'disabled': Boolean
});
</script>
<template>
  <label v-if="type === 'label'" :for="htmlFor" :class="['btn cursor-pointer', iconed ? 'btn-icon' : '', active ? 'active' : '']">
    <slot name="icon"></slot>
    <slot></slot>
  </label>
  <button :disabled="disabled" v-else :type="type"
    :class="['btn', iconed ? 'btn-icon' : '', active ? 'active' : '']"
  >
    <slot name="icon"></slot>
    <slot></slot>
  </button>
</template>
<style scoped lang="scss">
@import '~styles/theme';

.btn{
  border: 2px solid lightgrey;
  @apply py-2 px-3 rounded hover:bg-gray-100 transition text-black;

  &.btn-icon{
    @apply rounded-full h-14 w-14 grid place-items-center text-xl;
  }

  &.active{
    @apply shadow-lg bg-blue-500 text-white;
  }

  &.btn-primary{
    background-color: $primaryColour;
    color: white;
    border-color: $primaryColour;
    transition: 150ms;

    &:hover{
      color: $primaryColour;
      background-color: white;
    }
  }

  &.btn-danger{
    background-color: $dangerColour;
    color: white;
    border-color: $dangerColour;
    transition: 150ms;

    &:hover{
      color: $dangerColour;
      background-color: white;
    }
  }

  &.btn-warning{
    background-color: $warningColour;
    color: white;
    border-color: $warningColour;
    transition: 150ms;

    &:hover{
      color: $warningColour;
      background-color: white;
    }
  }

  &.btn-danger-outline{
    color: $dangerColour;
    border-color: $dangerColour;
    background-color: white;

    &:hover{
      color: white;
      background-color: $dangerColour;
    }
  }

  &.btn-warning-outline{
    color: $warningColour;
    border-color: $warningColour;
    background-color: white;

    &:hover{
      color: white;
      background-color: $warningColour;
    }
  }
}
</style>