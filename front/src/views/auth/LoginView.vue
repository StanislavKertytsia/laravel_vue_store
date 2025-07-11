<template>
  <AuthLayout @submit.prevent="submitHandler">
    <template #title> Sign in to your account</template>
    <template #form-items>
      <div
        v-if="errors.request"
        class="text-center text-red-500 text-sm mt-1 ml-1 font-medium"
      >
        {{ errors.request }}
      </div>
      <div>
        <label
          for="login"
          class="block text-sm/6 font-medium text-gray-900"
          >Login</label
        >
        <div class="mt-2">
          <input
            v-model="formData.login"
            placeholder="Email or Phone"
            type="text"
            name="login"
            id="login"
            required
            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
          />
        </div>
        <div>
          <p
            v-if="errors.login"
            class="text-red-500 text-sm mt-1 ml-1 font-medium"
          >
            {{ errors.login }}
          </p>
        </div>
      </div>

      <div>
        <label
          for="password"
          class="block text-sm/6 font-medium text-gray-900"
          >Password
        </label>
        <div class="mt-2">
          <input
            v-model="formData.password"
            placeholder="*******"
            type="password"
            name="password"
            id="password"
            required
            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
          />
        </div>
        <div>
          <p
            v-if="errors.password"
            class="text-red-500 text-sm mt-1 ml-1 font-medium"
          >
            {{ errors.password }}
          </p>
        </div>
      </div>
    </template>
    <template #submit-btn>Sign in</template>
    <template #subform-text>
      <p class="mt-10 text-center text-sm/6 text-gray-500">
        Don't have an account yet?
        <router-link
          to="/signup"
          class="font-semibold text-indigo-600 hover:text-indigo-500"
        >
          Sign up
        </router-link>
      </p>
    </template>
  </AuthLayout>
</template>

<script setup lang="ts">
import AuthLayout from '@/layouts/AuthLayout.vue'
import { reactive } from 'vue'
import { useValidation } from '@/composables/useValidation.ts'
import { authRequest } from '@/api/auth.ts'

const formData = reactive({
  login: '',
  password: '',
})

const { errors, validate } = useValidation(formData, {
  login: { required: true },
  password: { required: true },
  request: {},
})

async function submitHandler() {
  if (!validate()) return
  const data = await authRequest('login', {
    login: formData.login,
    password: formData.password,
  })
  if (data.error) errors.request = data.error
}
</script>
