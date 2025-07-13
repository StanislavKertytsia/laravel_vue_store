export interface CartItem {
  id: string
  title: string
  price: number
  quantity: number
  imageUrl: string
}

export interface CartState {
  items: CartItem[]
}

export const cart = {
  namespaced: true,

  state: (): CartState => ({
    items: JSON.parse(localStorage.getItem('cartItems') || '[]'),
  }),

  mutations: {
    addItem(state: CartState, item: CartItem) {
      const existing = state.items.find((i) => i.id === item.id)
      if (existing) {
        existing.quantity += item.quantity
      } else {
        console.log(item)
        state.items.push({ ...item })
      }
      localStorage.setItem('cartItems', JSON.stringify(state.items))
    },

    removeItem(state: CartState, id: number) {
      state.items = state.items.filter((item) => item.id !== id)
      localStorage.setItem('cartItems', JSON.stringify(state.items))
    },

    updateQuantity(state: CartState, { id, quantity }: { id: number; quantity: number }) {
      const item = state.items.find((i) => i.id === id)
      if (item) item.quantity = quantity
      localStorage.setItem('cartItems', JSON.stringify(state.items))
    },

    clearCart(state: CartState) {
      state.items = []
      localStorage.removeItem('cartItems')
    },
  },
  getters: {
    totalItems(state) {
      return state.items.reduce((acc, i) => acc + i.quantity, 0)
    },
    totalPrice(state) {
      const price = state.items.reduce((acc, i) => acc + i.price * i.quantity, 0)
      return Number(price.toFixed(2))
    },
  },
}
