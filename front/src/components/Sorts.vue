<template>
  <div class="mb-4">
    <select
      v-model="sort"
      class="border p-2 rounded"
      @change="applySort"
    >
      <option value="price_asc">from cheap to expensive</option>
      <option value="price_desc">from expensive to cheap</option>
      <option value="created_at_desc">from newer to older</option>
      <option value="created_at_asc">from older to newer</option>
    </select>
  </div>
</template>

<script lang="ts" setup>
import store from '@/store'
import { ref } from 'vue'

const sort = ref('created_at_desc')

function buildSort() {
  const sortValue = sort.value || ''
  const lastUnderscore = sortValue.lastIndexOf('_')
  const column = sortValue.substring(0, lastUnderscore)
  const direction = sortValue.substring(lastUnderscore + 1)

  return { column, direction }
}

function applySort() {
  store.commit('products/setSorts', [buildSort()])
  store.commit('products/setPage', 1)
  store.dispatch('products/fetchProducts')
}
</script>

<style scoped>
select {
  -webkit-appearance: none;
  appearance: none;
  background-image: none;
  padding-right: 1rem;
}
</style>
