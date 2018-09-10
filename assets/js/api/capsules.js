import VueResource from 'vue-resource'
import Vue from 'vue'

Vue.use(VueResource)

const obj = {
  getCapsules (cb, start, end, sort) {
    Vue.http.get(`/capsule?start=${start}&end=${end}&order=${sort}`).then(response => {
      response.json().then(data => {
        console.log(JSON.parse(data))
        cb(JSON.parse(data).capsules)
      }, error => {
        console.log('getAllCapsules:json:error', error)
      })
    }, response => {
      console.log('getAllCapsules:request:error', response)
    })
  }
}

export default obj