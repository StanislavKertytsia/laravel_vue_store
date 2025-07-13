import type { endpointType, ILoginPayload, ISignupPayload } from '../interfaces/auth.ts'
import axiosClient from '@/lib/axios.ts'

export async function auth(endpoint: endpointType, payload: ILoginPayload | ISignupPayload) {
  try {
    const { data } = await axiosClient.post(`/${endpoint}`, payload)
    if (data.token) {
      localStorage.setItem('token', data.token)
    }
    return data
  } catch {
    return
  }
}
