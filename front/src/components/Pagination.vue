<template>
  <nav class="flex justify-center space-x-1 mt-4 select-none">
    <button
      v-for="page in visiblePages"
      :key="page"
      :class="{
        'bg-blue-600 text-white font-semibold': page === currentPage,
        'hover:bg-gray-100': page !== currentPage,
      }"
      class="px-3 py-1 border rounded"
      @click="goToPage(page)"
    >
      {{ page }}
    </button>
  </nav>
</template>
<script lang="ts" setup>
import { computed } from 'vue'
import store from '@/store'

const currentPage = computed(() => store.state.products.page ?? 1)
const totalPages = computed(() => store.state.products.totalPages ?? 1)
const maxVisible = 9

function goToPage(page: number) {
  if (page >= 1 && page <= totalPages.value && page !== currentPage.value) {
    store.commit('products/setPage', page)
    store.dispatch('products/fetchProducts')
  }
}

const visiblePages = computed(() => {
  const total = totalPages.value
  const current = currentPage.value
  const max = maxVisible

  if (total <= max) {
    return Array.from({ length: total }, (_, i) => i + 1)
  }

  const half = Math.floor(max / 2)
  let start = current - half
  let end = current + half

  if (start < 1) {
    start = 1
    end = max
  }

  if (end > total) {
    end = total
    start = total - max + 1
  }

  if (end - start + 1 > max) {
    end = start + max - 1
  }

  const pages = []
  for (let i = start; i <= end; i++) {
    pages.push(i)
  }
  return pages
})
</script>
