import CapsuleAPI from '../../api/capsules'
import MutationTypes from '../types/mutation-types'

const state = {
  all: [],
  sort: 'name'
}

const getters = {

}

const actions = {
  addCapsules ({commit, state}, options) {
    CapsuleAPI.getCapsules(capsules => {
      commit(MutationTypes.ADD_CAPSULES, capsules)
    }, state.all.length, state.all.length + options.amount, state.sort)
  },
  changeSort({commit, dispatch}, options) {
    commit(MutationTypes.SET_SORT, options.sort)
    commit(MutationTypes.CLEAN_CAPSULES)
    dispatch('addCapsules', options)
  }
}

const mutations = {
  [MutationTypes.ADD_CAPSULES] (state, capsules) {
    state.all = [...state.all, ...capsules]
  },
  [MutationTypes.SET_SORT] (state, newSort) {
    state.sort = newSort
  },
  [MutationTypes.CLEAN_CAPSULES] (state) {
    state.all = state.all.filter(c => c.id < 0)
  }
}

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}