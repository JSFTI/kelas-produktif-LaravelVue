<script setup>
defineProps({
  modelValue: String,
  value: String,
  label: String,
  name: String,
  id: String
});
</script>
<template>
  <div class="flex gap-3">
    <input type="radio" :name="name" :id="id" :checked="value === modelValue" @change="$emit('update:modelValue', value)"  />
    <label :for="id">{{ label }}</label>
  </div>
</template>