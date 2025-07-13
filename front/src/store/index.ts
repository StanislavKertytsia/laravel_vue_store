import { createStore } from 'vuex'
import { auth, type IAuthState } from '@/store/modules/auth.ts'
import { cart } from '@/store/modules/cart.ts'
import { products } from '@/store/modules/products.ts'

export interface RootState {
  auth: IAuthState
  cart: any
  products: any
}

export const store = createStore<RootState>({
  modules: {
    auth,
    cart,
    products,
  },
})

export default store
