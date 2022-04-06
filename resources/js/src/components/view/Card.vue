<script setup></script>
<template>
  <div class="card">
    <slot name="title"></slot>
    <div class="p-4">
      <slot name="body"></slot>
    </div>
    <slot name="footer"></slot>
  </div>
</template>
<style scoped lang="scss">
.card{
  @apply border shadow-lg inline-block rounded;
}
</style>