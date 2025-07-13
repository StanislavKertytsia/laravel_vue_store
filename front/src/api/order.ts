import axiosClient from '@/lib/axios.ts'

export async function createOrder(payload) {
  try {
    console.log(payload)
    const response = await axiosClient.post('/order', payload)
    return response.data
  } catch (error) {
    throw error
  }
}
