<script setup>
import { ref } from 'vue';
import { Input, Button, Radio } from '@/src/components/input';

const data = ref([{val: 'a'}, {val: 'b'}, {val: 'c'}, {val: 'd'}]);
const newEntry = ref("");
const warna = ref("hijau");

function handleSort(){
  data.value = data.value.map(x => x.val).sort().map(x => ({val: x}));
}

function handleAdd(){
  data.value.push({val: newEntry.value});
  newEntry.value = "";
}
</script>
<template>
  <div>
    <h1>Contoh list rendering:</h1>
    <Button @click="handleSort">Sort</Button>
    <div v-for="(d, i) in data" :key="i">
      {{ d.val }}
      <Input v-model="d.val" />
    </div>
    <div><Input v-model="newEntry" /><Button @click="handleAdd">Add New Entry</Button></div>
  </div>
  <div class="mt-10">
    <h1>Contoh Conditional Rendering</h1>
    <Radio label="merah" value="merah" v-model="warna" name="warna-merah" id="warna-merah" />
    <Radio label="biru" value="biru" v-model="warna" name="warna-biru" id="warna-biru" />
    <Radio label="hijau" value="hijau" v-model="warna" name="warna-hijau" id="warna-hijau" />
    <div v-if="warna === 'merah'" class="bg-red-800 h-10 w-10"></div>
    <div v-else-if="warna === 'biru'" class="bg-blue-800 h-10 w-10"></div>
    <div v-else class="bg-green-800 h-10 w-10"></div>
  </div>
</template>