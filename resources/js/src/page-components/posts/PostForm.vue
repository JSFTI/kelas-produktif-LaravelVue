<script setup>
import { reactive, defineProps, watch } from 'vue';
import Button from '@/src/components/input/Button.vue';
import Input from '@/src/components/input/Input.vue';
import { VueEditor } from 'vue3-editor';
import Image from '@/src/components/input/Image.vue';

const props = defineProps({
  formData: Object
});

const form = reactive(props.formData);

watch(() => props.formData, () => {
  Object.assign(form, props.formData);
}, {deep: true});

function handleSubmit(e){
  e.preventDefault();
  console.log(form);
}
</script>
<template>
  <form @submit="handleSubmit">
    <Input label="Judul" class="my-5" v-model="form.title" />
    <Image class="w-full h-96 mb-5" id="foto" />
    <VueEditor v-model="form.content" class="mb-5"></VueEditor>
    <Button type="submit">Tambah Post</Button>
  </form>
</template>