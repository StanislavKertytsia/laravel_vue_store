<template>
  <header class="flex items-center justify-between px-6 py-4 bg-white shadow-md">
    <div class="flex items-center gap-2">
      <span
        class="text-xl font-bold text-gray-800 cursor-pointer"
        @click="router.push({ name: 'home' })"
        >MyStore</span
      >
    </div>
    <div class="flex items-center gap-6">
      <button
        class="text-gray-600 hover:text-indigo-600 relative"
        @click="router.push({ name: 'cart' })"
      >
        <svg
          class="h-6 w-6"
          fill="none"
          stroke="currentColor"
          viewBox="0 0 24 24"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.5 6H19M7 13L5.4 5M16 21a1 1 0 100-2 1 1 0 000 2zm-8 0a1 1 0 100-2 1 1 0 000 2z"
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
          />
        </svg>
        <span
          v-if="cartCount > 0"
          class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center"
        >
          {{ cartCount }}
        </span>
      </button>

      <ProfileMenu />
    </div>
  </header>
</template>

<script lang="ts" setup>
import { computed } from 'vue'
import store from '@/store'
import router from '@/router'
import ProfileMenu from '@/components/ProfileMenu.vue'

const user = computed(() => store.getters['auth/userFullName'])

const cartCount = computed(() => store.getters['cart/totalItems'])
</script>
