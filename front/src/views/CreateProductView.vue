<template>
  <main-layout>
    <template #body>
      <div class="max-w-xl mx-auto bg-white shadow p-6 rounded mt-10">
        <h1 class="text-2xl font-bold mb-4">Create Product</h1>

        <form
          class="space-y-4"
          enctype="multipart/form-data"
          novalidate
          @submit.prevent="submitForm"
        >
          <div>
            <label class="block text-sm font-medium text-gray-700">Title</label>
            <input
              v-model="form.title"
              class="w-full border border-gray-300 rounded px-3 py-2"
              required
              type="text"
            />
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700">Description</label>
            <textarea
              v-model="form.description"
              class="w-full border border-gray-300 rounded px-3 py-2 resize-none"
              required
              rows="4"
            />
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700">Price</label>
            <input
              v-model.number="form.price"
              class="w-full border border-gray-300 rounded px-3 py-2"
              min="0"
              required
              type="number"
            />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Stock</label>
            <input
              v-model.number="form.stock"
              class="w-full border border-gray-300 rounded px-3 py-2"
              min="0"
              required
              type="number"
            />
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700">Category</label>
            <select
              v-model="form.category"
              class="w-full border border-gray-300 rounded px-3 py-2"
              required
            >
              <option
                disabled
                value=""
              >
                Select category
              </option>
              <option
                v-for="cat in categories"
                :key="cat"
                :value="cat"
              >
                {{ cat }}
              </option>
            </select>
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700">Image</label>
            <input
              accept="image/*"
              class="w-full text-sm text-gray-600"
              type="file"
              @change="handleFileUpload"
            />
            <div
              v-if="imagePreview"
              class="mt-2"
            >
              <img
                :src="imagePreview"
                alt="Preview"
                class="h-40 object-cover rounded"
              />
            </div>
          </div>

          <button
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition"
            type="submit"
          >
            Create
          </button>
        </form>
      </div>
    </template>
  </main-layout>
</template>

<script lang="ts" setup>
import { reactive, ref } from 'vue'
import { useRouter } from 'vue-router'
import MainLayout from '@/layouts/MainLayout.vue'
import axiosClient from '@/lib/axios.ts'

const router = useRouter()

const form = reactive({
  title: '',
  description: '',
  price: null as number | null,
  stock: null as number | null,
  category: '',
  image: null as File | null,
})

const imagePreview = ref<string | null>(null)
const categories = ['Backpacks', 'Accessories', 'Clothing']

function handleFileUpload(event: Event) {
  const target = event.target as HTMLInputElement
  const file = target.files?.[0]
  if (file) {
    form.image = file
    const reader = new FileReader()
    reader.onload = () => {
      imagePreview.value = reader.result as string
    }
    reader.readAsDataURL(file)
  }
}

async function submitForm() {
  const formData = new FormData()
  formData.append('title', form.title)
  formData.append('description', form.description)
  formData.append('price', String(form.price ?? 0))
  formData.append('stock', String(form.stock ?? 0))
  formData.append('category', form.category)
  formData.append('image', form.image)
  // const payload = {
  //   title: form.title,
  //   description: form.description,
  //   price: form.price ?? 0,
  //   stock: form.stock ?? 0,
  //   // category: form.category, // если нужно
  //   image: 'test',
  // }
  try {
    const res = await axiosClient.post('/product', formData, {
      headers: { 'Content-Type': 'multipart/form-data' },
    })

    router.push({ name: 'home' })
  } catch (error) {
    console.error('Failed to create product:', error)
  }
}
</script>
<style scoped>
input[type='number']::-webkit-inner-spin-button,
input[type='number']::-webkit-outer-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

input[type='number'] {
  -moz-appearance: textfield;
}
</style>
