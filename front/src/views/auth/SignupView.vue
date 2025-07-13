<template>
  <auth-layout @submit.prevent="submitHandler">
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
          class="block text-sm/6 font-medium text-gray-900"
          for="name"
          >Name</label
        >
        <div class="mt-2">
          <input
            id="name"
            v-model="formData.name"
            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
            name="name"
            required
            type="text"
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
          class="block text-sm/6 font-medium text-gray-900"
          for="lastName"
          >Last Name</label
        >
        <div class="mt-2">
          <input
            id="lastName"
            v-model="formData.lastName"
            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
            name="lastName"
            required
            type="text"
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
          class="block text-sm/6 font-medium text-gray-900"
          for="email"
          >Email</label
        >
        <div class="mt-2">
          <input
            id="email"
            v-model="formData.email"
            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
            name="email"
            required
            type="email"
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
          class="block text-sm/6 font-medium text-gray-900"
          for="phone"
          >Phone</label
        >
        <div class="mt-2">
          <input
            id="phone"
            v-model="formData.phone"
            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
            name="phone"
            required
            type="tel"
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
          class="block text-sm/6 font-medium text-gray-900"
          for="password"
          >Password</label
        >
        <div class="mt-2">
          <input
            id="password"
            v-model="formData.password"
            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
            name="password"
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
      <div>
        <label
          class="block text-sm/6 font-medium text-gray-900"
          for="repeatPassword"
          >Repeat password</label
        >
        <div class="mt-2">
          <input
            id="repeatPassword"
            v-model="formData.repeatPassword"
            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
            name="repeatPassword"
            required
            type="password"
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
          class="font-semibold text-indigo-600 hover:text-indigo-500"
          to="/login"
        >
          Sign in
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
  const data = await auth('signup', {
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
