<template>
  <main class="main" role="main" id="#app">
    <bi-header></bi-header>
    <transition name="fade" mode="out-in">
      <router-view class="view"></router-view>
    </transition>
    <bi-footer/>
  </main>
</template>

<script>
  import 'bootstrap/dist/css/bootstrap.css'
  import 'bootstrap-vue/dist/bootstrap-vue.css'

  import BiHeader from './components/layout/Header.vue'
  import BiFooter from './components/layout/Footer.vue'

  import { mapState, mapMutations } from 'vuex'

  export default {
    name: 'app',
    methods: {
      ...mapMutations(['resetErrors'])
    },
    computed: {
      ...mapState(['errors']),
      errorMessage () {
        return this.errors.message
      }
    },
    watch: {
      errorMessage (newValue, oldValue) {
        if (newValue.length > 0) {
          this.$iziToast.error({
            title: 'Error',
            message: this.$store.state.errors.message
          })
        }
        this.resetErrors()
      }
    },
    components: { BiHeader, BiFooter }
  }
</script>

<style>

</style>
