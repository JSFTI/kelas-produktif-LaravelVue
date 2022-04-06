<script setup>
defineProps({
  modelValue: String,
  options: Array,
  label: String,
  name: String,
  id: String
});
</script>
<template>
  <div>
    <label class="block mb-2" :for="id">{{ label }}</label>
    <select :value="modelValue" @change="$emit('update:modelValue', $event.target.value)" :id="id" :name="name">
      <option v-for="option in options" :value="option.value" :key="option.value">
        {{ option.option }}
      </option>
    </select>
  </div>
</template>
<style scoped lang="scss">
select{
  @apply border px-3 py-2 focus:border-blue-500 outline-none transition bg-white;
}
</style>