import store from '@/store'
import router from '@/router'

export async function useInitAuth() {
  const token = localStorage.getItem('token')

  if (!token) {
    router.push({ name: 'login' })
    return
  }
  await store.dispatch('auth/fetchUser', token)
}
