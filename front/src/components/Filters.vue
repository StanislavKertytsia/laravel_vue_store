<template>
  <div class="space-y-4">
    <div>
      <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
      <select
        v-model="filters.category"
        class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
      >
        <option value="">All categories</option>
        <option
          v-for="category in categories"
          :key="category"
          :value="category"
        >
          {{ category }}
        </option>
      </select>
    </div>

    <div>
      <label class="block text-sm font-medium text-gray-700 mb-1">Price from</label>
      <input
        v-model.number="filters.priceFrom"
        class="w-full border border-gray-300 rounded px-3 py-2 text-sm appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500"
        min="0"
        placeholder="Min price"
        type="number"
      />
    </div>

    <div>
      <label class="block text-sm font-medium text-gray-700 mb-1">Price to</label>
      <input
        v-model.number="filters.priceTo"
        class="w-full border border-gray-300 rounded px-3 py-2 text-sm appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500"
        min="0"
        placeholder="Max price"
        type="number"
      />
    </div>

    <button
      class="w-full mt-2 px-4 py-2 bg-blue-600 text-white text-sm rounded hover:bg-blue-700 transition"
      @click="applyFilters"
    >
      Apply filters
    </button>
  </div>
</template>

<script lang="ts" setup>
import { ref } from 'vue'
import store from '@/store'
import router from '@/router'
import { useRoute } from 'vue-router'

const filters = ref({
  category: '',
  priceFrom: null,
  priceTo: null,
})

const route = useRoute()
const categories = ['Backpacks', 'Accessories', 'Clothing']

function buildFilters() {
  const f = []
  if (filters.value.category) {
    f.push({ column: 'category', operator: '=', value: filters.value.category })
  }
  if (filters.value.priceFrom !== null && filters.value.priceFrom !== '') {
    f.push({ column: 'price', operator: '>=', value: filters.value.priceFrom })
  }
  if (filters.value.priceTo !== null && filters.value.priceTo !== '') {
    f.push({ column: 'price', operator: '<=', value: filters.value.priceTo })
  }
  return f
}

function applyFilters() {
  correctPriceFilters()
  updateQueryParams()
  store.commit('products/setFilters', buildFilters())
  store.commit('products/setPage', 1)
  store.dispatch('products/fetchProducts')
}

function correctPriceFilters() {
  if (
    filters.value.priceFrom !== null &&
    filters.value.priceTo !== null &&
    filters.value.priceFrom > filters.value.priceTo
  ) {
    filters.value.priceFrom = filters.value.priceTo
  }
}

function updateQueryParams() {
  const newQuery: Record<string, string | number> = {}

  for (const [key, value] of Object.entries(filters.value)) {
    if (value !== null && value !== '') {
      newQuery[key] = value
    }
  }

  router.replace({ query: newQuery })
}
</script>
<style scoped>
input[type='number']::-webkit-inner-spin-button,
input[type='number']::-webkit-outer-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

input[type='number'] {
  -moz-appearance: textfield;
}
</style>
