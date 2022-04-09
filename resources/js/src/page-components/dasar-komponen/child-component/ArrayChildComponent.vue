<script setup>
import {Button, Input} from '@/src/components/input';
import { onMounted, onUpdated, ref, watch } from 'vue';

const props = defineProps({
  data: Array
});

const emit = defineEmits(['change'])

const data = ref(props.data.join(';'));
const arrData = ref(props.data);

function handleSort(){
  arrData.value.sort();
  data.value = arrData.value.join(';');
  emit('change', arrData.value);
}

</script>
<template>
  <div>
    <small class="block"></small>
    <Button @click="handleSort">Sort</Button>
    {{ arrData }}
    <Input :modelValue="data" @update:modelValue="(v) => modelValue = v" @input="emit('change', $event.target.value.split(';'))" />
  </div>
</template>