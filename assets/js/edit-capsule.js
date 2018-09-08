import Vue from 'vue'
import VueMaterial from 'vue-material'
import EditCapsule from './EditCapsule'

import 'vue-material/dist/vue-material.min.css'
import 'vue-material/dist/theme/default.css'
//import '../css/edit-capsule.scss'

Vue.use(VueMaterial)

new Vue({
  el: '#app',
  render: h => h(EditCapsule)
})