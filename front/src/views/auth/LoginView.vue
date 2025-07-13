<template>
  <auth-layout @submit.prevent="submitHandler">
    <template #title> Sign in to your account</template>
    <template #form-items>
      <div
        v-if="resError"
        class="text-center text-red-500 text-lg mt-1 ml-1 font-medium"
      >
        {{ resError }}
      </div>
      <div>
        <label
          class="block text-sm/6 font-medium text-gray-900"
          for="login"
          >Login</label
        >
        <div class="mt-2">
          <input
            id="login"
            v-model="formData.login"
            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
            name="login"
            placeholder="Email or Phone"
            required
            type="text"
          />
        </div>
        <div>
          <p
            v-if="validationErrors.login"
            class="text-red-500 text-sm mt-1 ml-1 font-medium"
          >
            {{ validationErrors.login }}
          </p>
        </div>
      </div>

      <div>
        <label
          class="block text-sm/6 font-medium text-gray-900"
          for="password"
          >Password
        </label>
        <div class="mt-2">
          <input
            id="password"
            v-model="formData.password"
            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
            name="password"
            placeholder="*******"
            required
            type="password"
          />
        </div>
        <div>
          <p
            v-if="validationErrors.password"
            class="text-red-500 text-sm mt-1 ml-1 font-medium"
          >
            {{ validationErrors.password }}
          </p>
        </div>
      </div>
    </template>
    <template #submit-btn>Sign in</template>
    <template #subform-text>
      <p class="mt-10 text-center text-sm/6 text-gray-500">
        Don't have an account yet?
        <router-link
          class="font-semibold text-indigo-600 hover:text-indigo-500"
          to="/signup"
        >
          Sign up
        </router-link>
      </p>
    </template>
  </auth-layout>
</template>

<script lang="ts" setup>
import AuthLayout from '@/layouts/AuthLayout.vue'
import { reactive, ref } from 'vue'
import { useValidation } from '@/composables/useValidation.ts'
import { auth } from '@/api/auth.ts'
import router from '@/router'
import store from '@/store'

const formData = reactive({
  login: '',
  password: '',
})

const { validationErrors, validate } = useValidation(formData, {
  login: { required: true },
  password: { required: true },
  request: {},
})

const resError = ref('')

async function submitHandler() {
  if (!validate()) return
  const data = await auth('login', {
    login: formData.login,
    password: formData.password,
  })
  if (!data) {
    return (resError.value = 'Invalid Credentials')
  }
  store.commit('auth/setUser', data.user)
  store.commit('auth/setToken', data.token)

  router.push({ name: 'home' })
}
</script>
