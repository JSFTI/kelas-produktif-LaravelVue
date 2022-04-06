<script setup>
import { ref } from 'vue';
import {Input, Button} from '@/src/components/input';

const names = ref([]);
const nameInput = ref("");
const deleteInput = ref("");

function addName(){
  names.value.push(nameInput.value);
  nameInput.value = "";
}

function deleteName(){
  names.value.splice(names.value.indexOf(deleteInput.value), 1);
  deleteInput.value = "";
}
</script>
<template>
  <div class="flex gap-4">
    <Input v-model="nameInput" />
    <Button @click="addName">Add Name</Button>
  </div>
  <div class="flex gap-4">
    <Input v-model="deleteInput" />
    <Button @click="deleteName">Delete Name</Button>
  </div>
  {{ names }}
</template>