import type { Module } from 'vuex'
import axiosClient from '@/lib/axios.ts'

export const products: Module = {
  namespaced: true,

  state: {
    products: [],
    page: 1,
    perPage: 12,
    totalPages: 1,
    filters: [],
    sorts: [],
    loading: false,
  },
  mutations: {
    setProducts(state, payload) {
      state.products = payload
    },
    setPage(state, payload) {
      state.page = payload
    },
    setTotalPages(state, payload) {
      state.totalPages = payload
    },
    setFilters(state, payload) {
      state.filters = payload
    },
    setSorts(state, payload) {
      state.sorts = payload
    },
    setLoading(state, payload) {
      state.loading = payload
    },
  },
  actions: {
    fetchProducts({ commit, state }) {
      const serverUrl = 'http://127.0.0.1:9000/storage/'
      commit('setLoading', true)
      const params = {
        per_page: state.perPage,
        page: state.page,
        filters: state.filters,
        sorts: state.sorts,
      }
      axiosClient
        .get('/product', {
          params,
        })
        .then(({ data }) => {
          const filteredProducts = data.data
            .filter((product) => product.stock > 0)
            .map((product) => ({
              ...product,
              imageUrl: product.image
                ? product.image.startsWith('http')
                  ? product.image
                  : serverUrl + product.image
                : null,
            }))
          commit('setProducts', filteredProducts)
          commit('setTotalPages', data.meta.last_page)
        })
        .finally(() => commit('setLoading', false))
    },
  },
  getters: {},
}
