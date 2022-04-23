<script setup>
import { Navbar } from '@/src/partials'
</script>
<template>
  <Navbar />
  <div class="pt-20 container mx-auto">
    <router-view></router-view>
  </div>
</template>
<style lang="scss">
@import '~vue-skeletor/dist/vue-skeletor.css';
@import '~styles/custom.scss';
</style>