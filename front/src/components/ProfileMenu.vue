<template>
  <div
    ref="menuRef"
    class="relative"
  >
    <button
      class="flex items-center gap-2 px-3 py-1 border rounded hover:bg-gray-200"
      @click="toggleMenu"
    >
      <span>{{ user?.name || 'Profile' }}</span>
      <svg
        class="w-5 h-5"
        fill="currentColor"
        viewBox="0 0 24 24"
        xmlns="http://www.w3.org/2000/svg"
      >
        <path
          d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4
       v2h16v-2c0-2.66-5.33-4-8-4z"
        />
      </svg>
    </button>

    <div
      v-if="menuOpen"
      class="absolute right-0 mt-2 w-48 bg-white border rounded shadow z-50"
    >
      <router-link
        v-if="user?.roles.includes('admin')"
        :to="{ name: 'create-product' }"
        class="block px-4 py-2 text-sm hover:bg-gray-100"
      >
        Create Product
      </router-link>

      <button
        class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100"
        @click="logout"
      >
        Logout
      </button>
    </div>
  </div>
</template>

<script lang="ts" setup>
import { computed, onMounted, onUnmounted, ref } from 'vue'
import store from '@/store'
import router from '@/router'

const user = computed(() => store.state.auth.user)
const menuOpen = ref(false)
const menuRef = ref<HTMLElement | null>(null)

function toggleMenu() {
  menuOpen.value = !menuOpen.value
}

function logout() {
  store.commit('auth/clearState')
  router.push('/login')
}

function handleClickOutside(event: MouseEvent) {
  if (menuRef.value && !menuRef.value.contains(event.target as Node)) {
    menuOpen.value = false
  }
}

onMounted(() => document.addEventListener('click', handleClickOutside))
onUnmounted(() => document.removeEventListener('click', handleClickOutside))
</script>
