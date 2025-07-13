<template>
  <div
    class="bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden"
  >
    <img
      :alt="product.title"
      :src="product.imageUrl"
      class="w-full h-48 object-cover"
    />

    <div class="p-4">
      <h3 class="text-lg font-semibold text-gray-800 line-clamp-2">
        {{ product.title }}
      </h3>

      <div class="flex justify-between items-center">
        <p class="text-indigo-600 font-bold text-base mt-1">{{ product.price }} ₴</p>
        <button
          class="mt-2 px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded hover:bg-blue-700 transition cursor-pointer"
          @click="addToCart"
        >
          Add to cart
        </button>
      </div>
    </div>
  </div>
</template>

<script lang="ts" setup>
import store from '@/store'

const props = defineProps<{
  product: {
    id: number
    title: string
    imageUrl: string
    price: number
  }
}>()

function addToCart() {
  store.commit('cart/addItem', {
    id: props.product.id,
    title: props.product.title,
    price: props.product.price,
    quantity: 1,
    imageUrl: props.product.imageUrl,
  })
}
</script>
