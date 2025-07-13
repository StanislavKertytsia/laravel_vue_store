<template>
  <main-layout>
    <template #body>
      <div class="px-4 py-6">
        <div class="flex gap-6">
          <aside class="w-64 mt-15">
            <div class="sticky top-6">
              <Filters />
            </div>
          </aside>

          <main class="flex-1 flex flex-col">
            <div class="flex justify-end items-center mb-4">
              <Sorts />
            </div>

            <div
              class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 flex-grow relative min-h-[200px]"
            >
              <div
                v-if="loading"
                class="absolute inset-0 flex items-center justify-center z-10 bg-white/80"
              >
                >
                <Loader />
              </div>
              <template v-else>
                <div
                  v-for="product in products"
                  :key="product.id"
                  class="border rounded-lg p-4 shadow-sm bg-white"
                >
                  <Product
                    :key="product.id"
                    :product="product"
                  />
                </div>
              </template>
            </div>
          </main>
        </div>
        <Pagination />
      </div>
    </template>
  </main-layout>
</template>

<script lang="ts" setup>
import { computed, onMounted } from 'vue'
import MainLayout from '@/layouts/MainLayout.vue'
import Pagination from '@/components/Pagination.vue'
import Product from '@/components/Product.vue'
import Filters from '@/components/Filters.vue'
import Sorts from '@/components/Sorts.vue'
import store from '@/store'
import Loader from '@/components/Loader.vue'

const products = computed(() => store.state.products.products ?? [])
const loading = computed(() => store.state.products.loading)
onMounted(() => {
  store.dispatch('products/fetchProducts')
})
</script>
