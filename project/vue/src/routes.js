import home from './components/home.vue'
import product from './components/product.vue'

const routes = [
  {path: '/', component: home, name: 'home'},
  {path: '/products/:url', component: product, name: 'product'}
]

export default routes
