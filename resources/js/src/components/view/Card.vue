<script setup></script>
<template>
  <div class="card">
    <div class="title">
      <slot name="title"></slot>
    </div>
    <div>
      <slot></slot>
    </div>
    <slot name="footer"></slot>
  </div>
</template>
<style scoped lang="scss">
.card{
  @apply border shadow-lg inline-block rounded;

  .title{
    @apply text-lg font-bold m-3;
  }
}
</style>