<script setup>
import { ref, reactive, defineProps, watch } from 'vue';
import Button from '@/src/components/input/Button.vue';
import Input from '@/src/components/input/Input.vue';
import { VueEditor } from 'vue3-editor';
import axios from 'axios';

const props = defineProps({
  formData: Object,
  invalidFeedbacks: Object,
  skeleton: Boolean
});

const form = reactive(props.formData ?? {
  'title': "",
  'slug': "",
  'image': null,
  'content': ""
});

const emit = defineEmits(['submit']);

defineExpose({
  reset
});

watch(() => props.formData, () => {
  Object.assign(form, props.formData);
}, {deep: true});

function handleSubmit(){
  emit('submit', {...form});
}

function reset(){
  Object.assign(form, {
    'title': "",
    'slug': "",
    'image': null,
    'content': ""
  });
}

function handleCoverChange(image){
  if(image === null){
    axios.delete(`/posts/images/${form.image.split('/').pop()}`)
      .then((res) => {
        form.image = null;
      })
      .catch((err) => {
        if(err.response.status === 404){
          form.image = null;
        }
      });
  } else {
    const formData = new FormData();
    formData.append('image', image);
    axios.post('/posts/images', formData).then((res) => {
      form.image = res.data.image_url;
    });
  }
}
</script>
<template>
  <form @submit.prevent="handleSubmit" v-if="!skeleton">
    <Input label="Judul" name="title" v-model="form.title" :invalidFeedback="invalidFeedbacks?.title" />
    <Input label="Slug" name="slug" v-model="form.slug" :invalidFeedback="invalidFeedbacks?.slug" placeholder="Judul pada url (contoh-slug-judul-post)" />
    <ImageInput class="w-full h-96 mb-10" :image="form.image" id="foto" @change="handleCoverChange" :invalidFeedback="invalidFeedbacks?.image" />
    <VueEditor v-model="form.content" :class="{'editor-is-invalid': invalidFeedbacks?.content}"></VueEditor>
    <div class="color-danger" v-if="invalidFeedbacks?.content">
      {{ invalidFeedbacks?.content }}
    </div>
    <Button class="mt-5" type="submit">Submit</Button>
  </form>
  <div class="flex flex-col gap-7" v-else>
    <Skeletor height="30" width="100%" />
    <Skeletor height="30" width="100%" />
    <Skeletor height="384" width="100%" />
    <Skeletor height="500" width="100%" />
  </div>
</template>
<style scoped lang="scss">
@import '~styles/theme';

.editor-is-invalid{
  border: 1px solid $dangerColour;
}
</style>