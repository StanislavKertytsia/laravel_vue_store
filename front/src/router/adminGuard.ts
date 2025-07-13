import store from '@/store'
import router from '@/router/index.ts'

router.beforeEach(async (to, from, next) => {
  const requiresAdmin = to.meta.requiresAdmin

  if (requiresAdmin && !store.getters['auth/isUserLoaded']) {
    await store.dispatch('auth/fetchUser')
  }

  const isAdmin = store.getters['auth/isAdmin']

  if (requiresAdmin && !isAdmin) {
    return next({ name: 'home' })
  }

  return next()
})
