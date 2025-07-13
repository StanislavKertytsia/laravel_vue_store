import type { Module } from 'vuex'
import axiosClient from '@/lib/axios.ts'

export interface IAuthState {
  user: any | null
  token: string | null
  loading: boolean
}

export const auth: Module<IAuthState, unknown> = {
  namespaced: true,

  state: (): IAuthState => ({
    user: null,
    token: null,
    loading: false,
  }),

  mutations: {
    setUser(state: IAuthState, user: any) {
      state.user = user
    },
    setToken(state: IAuthState, token: string) {
      state.token = token
    },
    setLoading(state, loading: boolean) {
      state.loading = loading
    },
    clearState(state: IAuthState) {
      state.user = null
      state.token = null
      localStorage.removeItem('token')
      localStorage.removeItem('cartItems')
    },
  },

  actions: {
    fetchUser({ commit }, token: string) {
      commit('setLoading', true)
      axiosClient
        .get('/user')

        .then(({ data }) => {
          commit('setUser', data)
          commit('setToken', token)
        })

        .catch(() => {
          commit('clearState')
          localStorage.removeItem('token')
        })

        .finally(() => commit('setLoading', false))
    },
  },

  getters: {
    isAuthenticated(state: IAuthState): boolean {
      return !!state.token && !!state.user
    },
    userFullName(state: IAuthState): string {
      return state.user ? `${state.user.name} ${state.user.last_name}` : ''
    },
    isAdmin(state: IAuthState): boolean {
      return state.user ? state.user.roles.includes('admin') : false
    },
    isLoading(state: IAuthState): boolean {
      return state.loading
    },
  },
}
