<template>
  <li class="py-2 flex justify-between items-center border-b border-gray-200">
    <div>
      <img
        :alt="item.title"
        :src="item.imageUrl"
        class="w-16 h-16 object-cover rounded"
      />
      <p class="font-semibold">{{ item.title }}</p>
      <p class="text-gray-600">{{ item.price }} ₴ × {{ item.quantity }}</p>
    </div>

    <div
      v-if="item.quantity >= 1"
      class="flex items-center space-x-2"
    >
      <button
        :disabled="item.quantity <= 1"
        aria-label="Decrease quantity"
        class="px-2 py-1 bg-gray-200 rounded hover:bg-gray-300"
        @click="decrease"
      >
        -
      </button>

      <span>{{ item.quantity }}</span>

      <button
        aria-label="Increase quantity"
        class="px-2 py-1 bg-gray-200 rounded hover:bg-gray-300"
        @click="increase"
      >
        +
      </button>

      <button
        aria-label="Remove item"
        class="ml-4 text-red-600 hover:text-red-800"
        title="Remove"
        @click="remove"
      >
        &times;
      </button>
    </div>
    <div
      v-else
      class="text-red-600 text-lg"
    >
      out of stock

      <button
        aria-label="Remove item"
        class="ml-4 text-red-600 hover:text-red-800"
        title="Remove"
        @click="remove"
      >
        &times;
      </button>
    </div>
  </li>
</template>

<script lang="ts" setup>
import { defineProps } from 'vue'
import store from '@/store'
import type { CartItem } from '@/store/modules/cart.ts'

const props = defineProps<{
  item: CartItem
}>()

function increase() {
  store.commit('cart/updateQuantity', {
    id: props.item.id,
    quantity: props.item.quantity + 1,
  })
}

function decrease() {
  if (props.item.quantity > 1) {
    store.commit('cart/updateQuantity', {
      id: props.item.id,
      quantity: props.item.quantity - 1,
    })
  }
}

function remove() {
  store.commit('cart/removeItem', props.item.id)
}
</script>
