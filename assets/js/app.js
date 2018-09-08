import Vue from 'vue'
import App from './App.vue'
import router from './router/router'
import './material/material'

import '../css/app.scss'

new Vue({
  el: '#app',
  router,
  components: {App},
  template: '<App/>'
})