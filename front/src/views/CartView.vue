<template>
  <main-layout>
    <template #body>
      <div class="max-w-2xl mx-auto mt-10 p-4 bg-white rounded shadow">
        <h2 class="text-2xl font-bold mb-4">🛒 Your Cart</h2>
        <div v-if="items.length > 0">
          <div v-for="item in items">
            <CartItem
              :key="item.id"
              :item="item"
            />
          </div>
          <div class="flex justify-between items-center mt-2">
            <div>Total price: {{ totalPrice }} ₴</div>
            <button
              :disabled="hasOutOfStock"
              class="px-4 py-2 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700 disabled:cursor-not-allowed disabled:opacity-50 transition"
              @click="goToCheckout"
            >
              Checkout
            </button>
          </div>
        </div>
        <div v-else>Your cart is empty</div>
      </div>
    </template>
  </main-layout>
</template>
<script lang="ts" setup>
import { computed } from 'vue'
import MainLayout from '@/layouts/MainLayout.vue'
import store from '@/store'
import CartItem from '@/components/CartItem.vue'
import router from '@/router'

const items = computed(() => store.state.cart.items)
const hasOutOfStock = computed(() => items.value.some((item) => item.quantity === 0))

const totalPrice = computed(() => store.getters['cart/totalPrice'])

function goToCheckout() {
  if (!hasOutOfStock.value) {
    router.push({ name: 'create-order' })
  }
}
</script>
