<script setup>
import { Navbar } from '@/src/partials'
import { useUser } from '@/stores/user';
import axios from 'axios';
import { ref } from 'vue';

const user = useUser();
const credsProcessed = ref(false);
const overlay = ref(null);

axios.get('/sanctum/csrf-cookie');

document.body.classList.add('no-scroll');

user.getLogin()
  .finally(() => {
    document.body.classList.remove('no-scroll');
    overlay.value.classList.add('disappearing__overlay');
    credsProcessed.value = true;
    setTimeout(() => {
      overlay.value.classList.add('hidden');
    }, 200);
  });
</script>
<template>
  <div class="__overlay" ref="overlay"></div>
  <Navbar />
  <div class="pt-20 container mx-auto" v-if="credsProcessed">
    <router-view></router-view>
  </div>
</template>
<style lang="scss">
@import '~vue-toast-notification/dist/theme-sugar.css';
@import '~vue-skeletor/dist/vue-skeletor.css';
@import '~styles/custom.scss';

.__overlay{
  position: absolute;
  top: 0;
  left: 0;
  width: 100vw;
  max-width: 100%;
  height: 100vh;
  background-color: lightgray;
  z-index: 10000;
  opacity: 1;
  transition: 200ms opacity linear;
}

.__overlay.disappearing__overlay{
  opacity: 0;
}
</style>