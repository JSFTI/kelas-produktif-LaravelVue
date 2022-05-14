<script setup>
import { watch, ref } from 'vue';
import IconBaselineImage from '~icons/ic/baseline-image';
import imageValidator from '@/validators/image';
import TrashCan from '~icons/mdi/trash-can';
import Button from './Button.vue';

const props = defineProps({
  image: String,
  id: String,
  defaultImage: String,
  invalidFeedback: String
});

const image = ref(null);
const invalidFeedback = ref(props.invalidFeedback ?? null);

async function transformImageValue(){
  if(typeof props.image === 'string'){
    image.value = props.image;
  } else if(props.image instanceof File) {
    image.value = await processImage(props.image);
  } else {
    image.value = null;
  }
}

watch(() => props.image, () => {
  transformImageValue();
}, {deep: true});

watch(() => props.invalidFeedback, () => {
  invalidFeedback.value = props.invalidFeedback;
});

transformImageValue();

const emit = defineEmits(['change']);

function processImage(file){
  return new Promise((resolve, reject) => {
    const reader = new FileReader();
    reader.onloadend = (e) => {
      resolve(e.target.result);
    };
    reader.readAsDataURL(file);
  });
}

function handleChange(e){
  const imageFile = e.target.files[0] ?? null;
  imageValidator(imageFile).then(() => {
    invalidFeedback.value = null;
    emit('change', imageFile);
  }).catch((err) => {
    invalidFeedback.value = err;
  });
}

function handleDelete(){
  emit('change', null)
}
</script>
<template>
  <div>
    <div class="image-input-container" :class="{'is-invalid': invalidFeedback}">
      <template v-if="image === null">
        <div class="grid place-items-center">
          <IconBaselineImage class="text-8xl" />
          <Button type="label" :htmlFor="id">Tambahkan Foto</Button>
        </div>
      </template>
      <template v-else>
        <Button iconed type="button" class="absolute right-3 top-3 btn-danger-outline" @click="handleDelete">
          <template v-slot:icon>
            <TrashCan />
          </template>
        </Button>
        <img class="w-full h-full object-contain" :src="image" />
      </template>
      <input type="file" :id="id" class="absolute invisible h-0 w-0" @change="handleChange"
        accept="image/*"
      />
    </div>
    <div class="invalid-feedback mt-3">
      {{invalidFeedback}}
    </div>
  </div>
</template>
<style scoped lang="scss">
@import '~styles/theme.scss';

.image-input-container{
  @apply w-full h-full grid place-items-center relative rounded border-dashed border-black border-2;

  &.is-invalid{
    border-color: $dangerColour;
  }

  &.is-invalid + .invalid-feedback{
    display: block;
  }
}

.invalid-feedback{
  display: none;
  color: $dangerColour;
}
</style>