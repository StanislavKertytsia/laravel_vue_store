<template>
  <main-layout>
    <template #body>
      <div class="max-w-3xl mx-auto p-6 bg-white rounded shadow mt-10">
        <h1 class="text-3xl font-bold mb-6 text-center">Create Order</h1>

        <section class="mb-8">
          <h2 class="text-xl font-semibold mb-3 border-b border-gray-300 pb-2">User Info</h2>
          <p><span class="font-semibold">Name:</span> {{ user.name }}</p>
          <p><span class="font-semibold">Email:</span> {{ user.email }}</p>
        </section>

        <section class="mb-8">
          <h2 class="text-xl font-semibold mb-3 border-b border-gray-300 pb-2">Delivery Details</h2>

          <label class="block mb-4">
            <span class="font-semibold mb-1 block">City</span>
            <select
              v-model="city"
              class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
              <option
                disabled
                value=""
              >
                Select city
              </option>
              <option>Kyiv</option>
              <option>Kharkiv</option>
              <option>Odessa</option>
              <option>Lviv</option>
            </select>
          </label>

          <label class="block mb-4">
            <span class="font-semibold mb-1 block">Delivery Method</span>
            <select
              v-model="delivery"
              class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
              <option
                disabled
                value=""
              >
                Select delivery
              </option>
              <option>Nova Poshta</option>
              <option>Ukrposhta</option>
            </select>
          </label>
        </section>

        <section class="mb-8">
          <h2 class="text-xl font-semibold mb-3 border-b border-gray-300 pb-2">Order Items</h2>
          <ul class="divide-y divide-gray-200">
            <li
              v-for="item in cart"
              :key="item.id"
              class="py-3 flex justify-between items-center"
            >
              <div>
                <img
                  :alt="item.title"
                  :src="item.imageUrl"
                  class="w-16 h-16 object-cover rounded"
                />
                <p class="font-medium">{{ item.title }}</p>
                <p class="text-sm text-gray-600">Quantity: {{ item.quantity }}</p>
              </div>
              <div class="font-semibold">{{ (item.price * item.quantity).toFixed(2) }} ₴</div>
            </li>
          </ul>
        </section>

        <section class="mb-8 text-right text-2xl font-bold">
          Total: {{ total.toFixed(2) }} ₴
        </section>

        <div class="flex gap-4">
          <button
            :disabled="loading || !canSubmit"
            class="flex-1 py-3 bg-green-600 text-white font-semibold rounded hover:bg-green-700 transition disabled:opacity-50 disabled:cursor-not-allowed"
            @click="submitOrder"
          >
            Place Order
          </button>

          <button
            class="flex-1 py-3 bg-gray-300 text-gray-800 font-semibold rounded hover:bg-gray-400 transition"
            @click="editOrder"
          >
            Edit Order
          </button>
        </div>

        <p
          v-if="error"
          class="mt-4 text-red-600 font-semibold text-center"
        >
          {{ error }}
        </p>
      </div>
    </template>
  </main-layout>
</template>

<script setup>
import { computed, ref } from 'vue'
import { useStore } from 'vuex'
import { useRouter } from 'vue-router'
import MainLayout from '@/layouts/MainLayout.vue'
import { createOrder } from '@/api/order.js'

const store = useStore()
const router = useRouter()

const loading = ref(false)
const error = ref(null)

const user = computed(() => store.state.auth.user)
const cart = computed(() => store.state.cart.items)
const total = computed(() => cart.value.reduce((sum, item) => sum + item.price * item.quantity, 0))

const city = ref('')
const delivery = ref('')

const canSubmit = computed(() => {
  return city.value !== '' && delivery.value !== '' && cart.value.length > 0
})

async function submitOrder() {
  // error.value = null
  // loading.value = true

  try {
    const payload = {
      city: city.value,
      delivery: delivery.value,
      products: cart.value.map((item) => ({
        id: item.id,
        quantity: item.quantity,
      })),
    }
    await createOrder(payload)
    router.push({ name: 'home' })
  } catch (e) {
    error.value = e.response.data.message || 'Failed to place order.'
  } finally {
    // loading.value = false
  }
}

function editOrder() {
  router.push({ name: 'cart' })
}
</script>
