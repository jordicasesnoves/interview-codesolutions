<template>
    <header>
        <div class="navbar navbar-dark bg-dark shadow-sm">
            <div class="container d-flex justify-content-between">
                <router-link to="/" class="navbar-brand d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor"
                         stroke-linecap="round" stroke-linejoin="round" stroke-width="2" aria-hidden="true" class="mr-2"
                         viewBox="0 0 24 24" focusable="false">
                        <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/>
                        <circle cx="12" cy="13" r="4"/>
                    </svg>
                    <strong>Entrevista - CodeSolutions</strong>
                </router-link>
                <!-- Al utilizar v-on:keyup estamos haciendo que se ejecute una consulta cada vez que 
                    le damos a una tecla (en este caso Enter)
                 -->
                <input type="text" v-model="query" @keyup.enter="searchProducts" placeholder="Buscar..." class="">
            </div>
        </div>
    </header>
</template>

<script>
  // Tarea 7: Crear un buscador
  import productsService from '../../services/products'

  export default {
    data () {
      return {
        query: ''
      }
    },
    methods: {
      searchProducts () {
        let payload = this.query
        let self = this
        return productsService.searchProduct(payload)
          .then(res => {
            // Usar vuex para enviar los productos encontrados a la store
            self.$store.commit('setProducts', res.products)
          })
          .catch(err => {
            console.error(err)
          })
      }
    }
  }
</script>

<style>

</style>

