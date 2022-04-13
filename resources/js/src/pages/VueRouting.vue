<script setup>
import { useRoute, useRouter } from 'vue-router';
import Button from '../components/input/Button.vue';

const route = useRoute();
const router = useRouter();

function handleChangeRoute(){
  router.push({name: 'vue-router-nest', query: {'foo': 'bar'}});
}

</script>
<template>
  <section class="mt-10 mx-2 md:mx-32 lg:mx-48 xl:mx-96">
    <h1 class="text-2xl">Main Routing Page</h1>
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit possimus natus, earum soluta adipisci cum animi inventore tempora enim. Iusto, eum placeat officia vitae quaerat cupiditate ipsa amet quod tempore.
    <div v-if="route.query">{{ route.query }}</div>
    <Button @click="handleChangeRoute">Nest</Button>
    <router-link class="block" :to="{name: 'vue-router-nest', query: {'foo': 'bar'}}">
      Nest
    </router-link>
    <router-view></router-view>
  </section>
</template>