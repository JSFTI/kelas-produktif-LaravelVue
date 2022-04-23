<script setup>
import { ref, defineEmits, defineProps } from 'vue';
import IconBaselineImage from '~icons/ic/baseline-image';
import Button from './Button.vue';

const image = ref(null);

const props = defineProps({
  image: String,
  id: String
});

const emit = defineEmits(['change']);
</script>
<template>
  <div>
    <div class="w-full h-full grid place-items-center rounded border-dashed border-black border-2">
      <template v-if="image === null">
        <div class="grid place-items-center">
          <IconBaselineImage class="text-8xl" />
          <Button type="label" :for="id">Tambahkan Foto</Button>
        </div>
      </template>
      <template v-else>
        <img class="w-full h-full" :src="image" />
      </template>
      <input type="file" :id="id" class="absolute invisible h-0 w-0" />
    </div>
  </div>
</template>