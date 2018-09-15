import Vue from 'vue'
import App from './App.vue'
import VueTruncateFilter from 'vue-truncate-filter'
import router from './router/router'
//import './material/material'
import store from './store'
import '../css/app.scss'

Vue.use(VueTruncateFilter)

new Vue({
  el: '#app',
  router,
  store,
  http: {
    root: 'http://localhost:8000'
  },
  components: {App},
  template: '<App/>'
})