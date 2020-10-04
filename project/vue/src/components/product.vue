<template>
    <div class="container">
        <section class="jumbotron text-center">
            <div class="container mb-4">
                <h1>{{ product.name }}</h1>
                <p class="lead text-muted">
                    {{ product.ref }}
                </p>
            </div>
        </section>
        <div class="row separator"></div>
        <div class="row">
            <div class="col mt-2">
                <img :src="product.image">
            </div>
            <div class="col text-justify p-2">
                <p>{{ product.description }}</p>
                <div class="price text-right">
                    <span class="">{{ product.price}} &euro;</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
  // Tarea 6: Enlazar con la API la página de producto.

  // Importamos el servicio ya creado para realizar la conexion
  import productsService from '../services/products'
  export default {
    data () {
      return {
        product: {}
      }
    },
    mounted () {
      const url = this.$route.params.url
      // En este caso, la funcion getByURL solo toma un parametro, la url del producto
      let payload = url
      let self = this
      return productsService.getByURL(payload)
        .then(res => {
          self.product = res.product
        })
        .catch(err => {
          console.error(err)
        })
    }
  }
</script>

<style>
    .jumbotron {
        padding-top: 3rem;
        padding-bottom: 3rem;
        margin-bottom: 0;
        background-color: #fff;
    }
    @media (min-width: 768px) {
        .jumbotron {
            padding-top: 6rem;
            padding-bottom: 6rem;
        }
    }

    .jumbotron p:last-child {
        margin-bottom: 0;
    }

    .jumbotron h1 {
        font-weight: 300;
    }

    .jumbotron .container {
        max-width: 40rem;
    }
    .separator {
        background-color: #ddd;
        padding: 1rem;
    }
    .price {
        font-size: 1.2rem;
        color: #0a001f;
    }
</style>