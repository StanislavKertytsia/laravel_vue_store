<template>
  <AuthLayout @submit.prevent="submitHandler">
    <template #title> Sign up a new account</template>
    <template #form-items>
      <div>
        <p
          v-if="resError"
          class="text-center text-red-500 text-l mt-1 ml-1 font-medium"
        >
          {{ resError }}
        </p>
      </div>
      <div>
        <label
          for="name"
          class="block text-sm/6 font-medium text-gray-900"
          >Name</label
        >
        <div class="mt-2">
          <input
            v-model="formData.name"
            type="text"
            name="name"
            id="name"
            required
            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
          />
        </div>
        <div>
          <p
            v-if="validationErrors.name"
            class="text-red-500 text-sm mt-1 ml-1 font-medium"
          >
            {{ validationErrors.name }}
          </p>
        </div>
      </div>
      <div>
        <label
          for="lastName"
          class="block text-sm/6 font-medium text-gray-900"
          >Last Name</label
        >
        <div class="mt-2">
          <input
            v-model="formData.lastName"
            type="text"
            name="lastName"
            id="lastName"
            required
            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
          />
        </div>
        <div>
          <p
            v-if="validationErrors.lastName"
            class="text-red-500 text-sm mt-1 ml-1 font-medium"
          >
            {{ validationErrors.lastName }}
          </p>
        </div>
      </div>
      <div>
        <label
          for="email"
          class="block text-sm/6 font-medium text-gray-900"
          >Email</label
        >
        <div class="mt-2">
          <input
            v-model="formData.email"
            type="email"
            name="email"
            id="email"
            required
            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
          />
        </div>
        <div>
          <p
            v-if="validationErrors.email"
            class="text-red-500 text-sm mt-1 ml-1 font-medium"
          >
            {{ validationErrors.email }}
          </p>
        </div>
      </div>
      <div>
        <label
          for="phone"
          class="block text-sm/6 font-medium text-gray-900"
          >Phone</label
        >
        <div class="mt-2">
          <input
            v-model="formData.phone"
            type="tel"
            name="phone"
            id="phone"
            required
            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
          />
        </div>
        <div>
          <p
            v-if="validationErrors.phone"
            class="text-red-500 text-sm mt-1 ml-1 font-medium"
          >
            {{ validationErrors.phone }}
          </p>
        </div>
      </div>
      <div>
        <label
          for="password"
          class="block text-sm/6 font-medium text-gray-900"
          >Password</label
        >
        <div class="mt-2">
          <input
            v-model="formData.password"
            type="password"
            name="password"
            id="password"
            required
            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
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
      <div>
        <label
          for="repeatPassword"
          class="block text-sm/6 font-medium text-gray-900"
          >Repeat password</label
        >
        <div class="mt-2">
          <input
            v-model="formData.repeatPassword"
            type="password"
            name="repeatPassword"
            id="repeatPassword"
            required
            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
          />
        </div>
        <div>
          <p
            v-if="validationErrors.repeatPassword"
            class="text-red-500 text-sm mt-1 ml-1 font-medium"
          >
            {{ validationErrors.repeatPassword }}
          </p>
        </div>
      </div>
    </template>
    <template #submit-btn>Sign up</template>
    <template #subform-text>
      <p class="mt-10 text-center text-sm/6 text-gray-500">
        Already have an account?
        <router-link
          to="/login"
          class="font-semibold text-indigo-600 hover:text-indigo-500"
        >
          Sign in
        </router-link>
      </p>
    </template>
  </AuthLayout>
</template>

<script setup lang="ts">
import AuthLayout from '@/layouts/AuthLayout.vue'
import { reactive, ref } from 'vue'
import { useValidation } from '@/composables/useValidation.ts'
import { authRequest } from '@/api/authRequest'
import { useRouter } from 'vue-router'

const router = useRouter()
const formData = reactive({
  name: '',
  lastName: '',
  email: '',
  phone: '',
  password: '',
  repeatPassword: '',
})

const resError = ref('')

const { validationErrors, validate } = useValidation(formData, {
  name: { required: true },
  lastName: { required: true },
  email: { required: true },
  phone: { required: true },
  password: { required: true },
  repeatPassword: { required: true },
})

async function submitHandler() {
  if (!validate()) return
  if (formData.password !== formData.repeatPassword) {
    return (validationErrors.repeatPassword = 'Passwords do not match')
  }
  const data = await authRequest('signup', {
    name: formData.name,
    lastName: formData.lastName,
    email: formData.email,
    phone: formData.phone,
    password: formData.password,
  })
  if (!data) resError.value = 'User already exists!'
  router.push({ name: 'home' })
}
</script>
