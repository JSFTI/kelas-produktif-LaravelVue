<script setup>
import { Card } from '@/src/components/view';

const topics = [
  {
    imgSrc: "/img/laravel-logo.svg",
    title: "Laravel 9",
    subtitle: "Framework back-end berbahasa PHP"
  },{
    imgSrc: "/img/vuejs-logo.svg",
    title: "Vue 3",
    subtitle: "Framework front-end web"
  }
];

document.title = "Kelas Produktif HIMATIF";
</script>
<template>
  <header class="text-center mt-5">
    <h1 class="font-bold text-3xl">Selamat Datang di Kelas Produktif</h1>
    <small>Pemateri: Jason Surya Faylim (191402062)</small>
    <div class="mt-4 text-2xl">Topik Belajar</div>
    <section class="flex justify-center gap-5 flex-wrap mt-3">
      <Card v-for="topic in topics" class="w-52">
        <template v-slot:body>
          <div class="w-44 h-44 grid items-center mb-4">
            <img :src="topic.imgSrc" />
          </div>
          <hr />
          <h4 class="text-xl font-bold mb-2">{{ topic.title }}</h4>
          <div>{{ topic.subtitle }}</div>
        </template>
      </Card>
    </section>
  </header>
</template>
<style scoped lang="scss">

</style>