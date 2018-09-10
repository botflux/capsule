import Vue from 'vue'
import Vuex from 'vuex'
import capsules from './modules/capsules'

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    capsules
  }
})