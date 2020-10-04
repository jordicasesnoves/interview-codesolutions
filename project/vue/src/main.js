import Vue from 'vue'
import VueRouter from 'vue-router'
import App from './App.vue'
import routes from './routes'
import store from './store'
import { BootstrapVue } from 'bootstrap-vue'
import VueLazyload from 'vue-lazyload'

Vue.use(VueRouter)
Vue.use(BootstrapVue)
Vue.use(VueLazyload)

const router = new VueRouter({
  mode: 'history',
  routes
})

new Vue({
  el: '#app',
  render: h => h(App),
  router,
  store
})
