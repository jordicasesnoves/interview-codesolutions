<template>
    <main role="main">
        <div class="album py-5 bg-light">
            <div class="container">
                <div v-if="totalProducts">
                  <b-pagination
                    v-model="currentPage"
                    :total-rows="totalProducts"
                    :per-page="perPage"
                    aria-controls="my-table"
                  ></b-pagination>
              <p class="mt-3">Current Page: {{ currentPage }}</p>
                  <div class="row">
                    <div v-for="product in products" :key="product.id" class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                            <img v-lazy="product.image" class="lazyload card-img-top" :alt="product.name">
                            <div class="card-body">
                                <h5 class="card-title">{{ product.name }}</h5>
                                <p class="card-text">
                                    {{ product.description | truncateText  }}
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                      <router-link :to="{ name: 'product', params: { url: product.url }}" class="btn btn-sm btn-outline-secondary">
                                        Ver
                                      </router-link>
                                    </div>
                                    <small class="text-muted">{{ product.price }}&euro;</small>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
                  
                </div>
                <div v-else class="row">
                    <div class="col-md-4">
                        <p>Carga la BBDD con los productos</p>
                    </div>
                </div>
            </div>
        </div>

    </main>
</template>

<script>
  import productsService from '../services/products'

  export default {
    data () {
      return {
        currentPage: 1,
        perPage: 3
      }
    },
    // Cuando cambia la pagina, buscamos los productos de esa pagina en la BBDD
    watch: {
      currentPage: function (value) {
        let payload = {
          l: this.perPage,
          p: this.currentPage
        }

        let self = this
        return productsService.search(payload)
          .then(res => {
            self.$store.commit('setProducts', res.products)
          })
          .catch(err => {
            console.error(err)
          })
      }
    },
    // Cuando se monta el componente Home,
    // guardamos tanto los productos de la pagina inicial, como el total de productos
    async mounted () {
      let payload = {
        l: this.perPage,
        p: this.currentPage
      }

      let self = this
      let p1 = await productsService.search(payload)
        .then(res => {
          self.$store.commit('setProducts', res.products)
        })
        .catch(err => {
          console.error(err)
        })
      let p2 = await productsService.getTotalProducts()
        .then(res => {
          self.$store.commit('setTotalProducts', res.products)
        })
        .catch(err => {
          console.error(err)
        })
      return Promise.all([p1, p2])
    },
    filters: {
      // Tarea 4: Crear un filtro para limitar a 90 caracteres
      truncateText: (value) => {
        let maxCharacters = 90
        if (!value) return ''
        if (value.length <= maxCharacters) {
          return value
        } else {
          return value.substring(0, maxCharacters) + '...'
        }
      }
    },
    computed: {
      products () {
        return this.$store.getters.products
      },
      // Calcular el numero total de productos
      totalProducts () {
        return this.$store.getters.totalProducts
      }
    }
  }
</script>

<style>

</style>