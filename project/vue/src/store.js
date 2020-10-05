import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const store = new Vuex.Store({
  state: {
    products: [],
    totalProducts: 0,
    pending: false,
    errors: {
      message: '',
      dismissCountDown: 0
    }
  },
  getters: {
    products: state => {
      return state.products
    },
    totalProducts: state => {
      return state.totalProducts
    }
  },
  mutations: {
    setProducts (state, payload) {
      state.products = payload
    },
    setTotalProducts (state, payload) {
      state.totalProducts = payload
    },
    setError (state, payload) {
      state.errors.message = payload.message || 'Error'
      state.errors.dismissCountDown = payload.count || 5
    },
    resetErrors (state) {
      state.errors.message = ''
      state.errors.dismissCountDown = 0
    }
  },
  modules: {

  },
  plugins: [
  ]
})

export default store
