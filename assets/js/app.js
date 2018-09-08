import Vue from 'vue'
import App from './App.vue'
import VueTruncateFilter from 'vue-truncate-filter'
import VueResource from 'vue-resource'
import router from './router/router'
import './material/material'

import '../css/app.scss'

Vue.use(VueTruncateFilter)
Vue.use(VueResource)

new Vue({
  el: '#app',
  router,
  http: {
    root: 'http://localhost:8000'
  },
  components: {App},
  template: '<App/>'
})