<script setup>
import { computed } from 'vue';
import { cloneDeep } from 'lodash';

const props = defineProps({
  data: Object
});

const initials = computed(() => props.data.name.split(' ').map(x => x[0]).join(''));
const fixedNumber = computed(() => props.data.number.toFixed(4));
const sortedArray = computed(() => {
  const clonedArray = cloneDeep(props.data.array);
  return clonedArray.sort((a, b) => a - b);
});
</script>
<template>
  <div>
    Computed values in children
  </div>
  <div>
    Name: {{ initials }}
  </div>
  <div>
    Number: {{ fixedNumber }}
  </div>
  <div>
    Sorted Array: {{ sortedArray }}
  </div>
</template>