<script setup>
import { Navbar } from '@/src/partials'
</script>
<template>
  <Navbar />
  <div class="pt-20">
    <router-view></router-view>
  </div>
</template>
<style lang="scss">
@import '~styles/custom.scss';
</style>