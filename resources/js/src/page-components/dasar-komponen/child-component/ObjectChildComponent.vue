<script setup>
import {ref, watch} from 'vue';
import Button from '@/src/components/input/Button.vue';

const props = defineProps({
  data: Object
});

const emit = defineEmits(['change']);

const data = ref(props.data);

function handleChange(){
  // props.data = {
  //   framework: "Laravel",
  //   language: "PHP"
  // }

  // props.data.framework = "Laravel";
  // props.data.language = "PHP";

  emit('change', {framework: 'Vue', language: 'JavaScript', test: {foo: "baz"}});
}

watch(props.data, () => {console.log("Object Changed")});
</script>
<template>
  <div>
    <Button @click="handleChange">Change Data</Button>
  </div>
</template>