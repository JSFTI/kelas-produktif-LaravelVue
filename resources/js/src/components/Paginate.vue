<script setup>
import IconChevronLeft from '~icons/material-symbols/chevron-left';
import IconChevronRight from '~icons/material-symbols/chevron-right';

defineProps({
  currentPage: Number,
  totalPages: Number,
});

const emit = defineEmits(['changePage']);
</script>
<template>
  <div class="flex gap-3 justify-center text-lg">
    <template v-if="totalPages <= 4">
      <button v-for="page in +totalPages" :disabled="currentPage == page"
        class="disabled:text-gray-400 hover:text-blue-400"
        @click="$emit('changePage', page)">
        {{ page }}
      </button>
    </template>
    <template v-else>
      <button type="button" class="hover:text-blue-400" v-if="currentPage != 1"
        @click="$emit('changePage', currentPage - 1)">
        <IconChevronLeft />
      </button>
      <button type="button" :disabled="currentPage == 1"
        class="disabled:text-gray-400 hover:text-blue-400"
        @click="$emit('changePage', 1)">
        1
      </button>
      <div v-if="currentPage >= 3">...</div>
      <button type="button" v-if="currentPage <= 2"
        class="disabled:text-gray-400 hover:text-blue-400"
        :disabled="currentPage == 2"
        @click="$emit('changePage', 2)">
        2
      </button>
      <button type="button" class="disabled:text-gray-400 hover:text-blue-400"
        disabled v-if="currentPage > 2 && currentPage < totalPages - 1">
        {{ currentPage }}
      </button>
      <button type="button" v-if="currentPage >= totalPages - 1"
        class="disabled:text-gray-400 hover:text-blue-400"
        :disabled="totalPages - 1 == currentPage"
        @click="$emit('changePage', totalPages - 1)">
        {{ totalPages - 1 }}
      </button>
      <div v-if="currentPage < totalPages - 1">...</div>
      <button type="button" :disabled="currentPage == totalPages" v-if="totalPages > 4"
        class="disabled:text-gray-400 hover:text-blue-400"
        @click="$emit('changePage', totalPages)">
        {{ totalPages }}
      </button>
      <button type="button" class="hover:text-blue-400" v-if="currentPage != totalPages"
        @click="$emit('changePage', currentPage + 1)">
        <IconChevronRight />
      </button>
    </template>
  </div>
</template>