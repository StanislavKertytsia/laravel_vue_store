<template>
  <AuthLayout>
    <template #title> Sign up a new account</template>
    <template #form-items>
      <div>
        <label for="name" class="block text-sm/6 font-medium text-gray-900">Name</label>
        <div class="mt-2">
          <input type="text" name="name" id="name" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
        </div>
      </div>
      <div>
        <label for="lastName" class="block text-sm/6 font-medium text-gray-900">Last Name</label>
        <div class="mt-2">
          <input type="text" name="lastName" id="lastName" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
        </div>
      </div>
      <div>
        <label for="email" class="block text-sm/6 font-medium text-gray-900">Email address</label>
        <div class="mt-2">
          <input type="email" name="email" id="email" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
        </div>
      </div>
      <div>
        <label for="phone" class="block text-sm/6 font-medium text-gray-900">Phone</label>
        <div class="mt-2">
          <input type="number" name="phone" id="phone" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
        </div>
      </div>
      <div>
          <label for="password" class="block text-sm/6 font-medium text-gray-900">Password</label>
        <div class="mt-2">
          <input type="password" name="password" id="password" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
        </div>
      </div>
      <div>
        <label for="repeatPassword" class="block text-sm/6 font-medium text-gray-900">Repeat password</label>
        <div class="mt-2">
          <input type="password" name="repeatPassword" id="repeatPassword" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
        </div>
      </div>
    </template>
    <template #submit-btn>Sign up</template>
    <template #subform-text>
      <p class="mt-10 text-center text-sm/6 text-gray-500">
      Already have an account?
        <a href="LoginView.vue" class="font-semibold text-indigo-600 hover:text-indigo-500"> Login
        </a>
      </p>
    </template>
  </AuthLayout>
</template>

<script setup lang="ts">

import AuthLayout from "@/layouts/AuthLayout.vue";
</script>

<style scoped>

</style>
