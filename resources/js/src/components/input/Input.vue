<script setup>
import { ref, watch } from 'vue';

const props = defineProps({
  modelValue: String,
  min: Number,
  max: Number,
  label: String,
  name: String,
  type: String,
  id: String
});
console.log(props.modelValue);

const value = ref(props.modelValue);

watch(() => props.modelValue, () => {value.value = props.modelValue});

</script>
<template>
  <div class="input-group">
    <label class="block mb-2" :for="id" v-if="label">{{ label }}:</label>
    <input :type="type" :id="id" :name="name" v-model="value" :min="min" :max="max"
      @input="$emit('update:modelValue', $event.target.value)"
    />
  </div>
</template>
<style scoped lang="scss">
input{
  width: inherit;
  @apply border px-3 py-2 focus:border-blue-500 outline-none transition;
}
</style>