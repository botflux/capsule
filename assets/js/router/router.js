import Vue from 'vue'
import VueRouter from 'vue-router'


import Dashboard from '../views/Dashboard'
import AccountSettings from '../views/AccountSettings'

Vue.use(VueRouter)

const router = new VueRouter({
  routes: [
    {
      path: '/',
      name: 'dashboard',
      component: Dashboard
    },
    {
      path: '/account',
      name: 'account',
      component: AccountSettings
    }
  ]
})

export default router
