<script setup>
import {Button, Input} from '@/src/components/input';
import { ref, watch } from 'vue';

const props = defineProps({
  data: String
});

const emit = defineEmits(['change']);

watch(() => props.data, () => {console.log("Native Changed");})

</script>
<template>
  <div>
    <Input v-model="data" @input="emit('change', $event.target.value)" />
  </div>
</template>