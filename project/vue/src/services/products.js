import axios from 'axios'
import configService from './config'
import qs from 'qs'

const productsSetService = {}

const http = axios.create({
  baseURL: configService.apiURL,
  headers: configService.headers
})

const baseService = '/products'

productsSetService.search = function (payload) {
  let params = {
    search: payload.q,
    limit: payload.l || 20,
    page: payload.p || 1
  }

  return http.get(baseService, {
    params,
    paramsSerializer: function (params) {
      return qs.stringify(params, {encode: false})
    }
  })
    .then(res => res.data)
}

productsSetService.getByURL = function (url) {
  return http.get(baseService + '/view/' + url)
    .then(res => res.data)
}

// Tarea 7: Crear un buscador
productsSetService.searchProduct = function (query) {
  return http.get(baseService + '/search/' + query)
    .then(res => res.data)
}

export default productsSetService
