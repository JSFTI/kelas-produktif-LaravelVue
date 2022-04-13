<script setup>
import {Button, Input} from '@/src/components/input';
import { isReactive, onMounted, onUpdated, ref, watch } from 'vue';

const props = defineProps({
  data: Array
});

const emit = defineEmits(['change'])

const data = ref(props.data.join(';'));
const arrData = ref(props.data);

function handleSort(){
  arrData.value.sort();
  emit('change', arrData.value);
}

onUpdated(() => {
  arrData.value = props.data;
  data.value = props.data.join(';');
});

</script>
<template>
  <div>
    <pre>{{ props.data }}</pre>
    <small class="block"></small>
    <Button @click="handleSort">Sort</Button>
    {{ arrData }}
    <Input v-model="data" @input="emit('change', $event.target.value.split(';'))" />
  </div>
</template>