// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'

import MintUI from 'mint-ui'
import 'mint-ui/lib/style.css'
import 'vue-awesome/icons/commenting'
import 'vue-awesome/icons/commenting-o'
import 'vue-awesome/icons/heart'
import 'vue-awesome/icons/heart-o'
import 'vue-awesome/icons/thumbs-up'
import 'vue-awesome/icons/thumbs-o-up'
import 'vue-awesome/icons/thumbs-down'
import 'vue-awesome/icons/thumbs-o-down'
import 'vue-awesome/icons/edit'

Vue.use(MintUI)

import Icon from 'vue-awesome/components/Icon'
Vue.component('icon', Icon)

Vue.config.productionTip = false

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  components: { App },
  template: '<App/>'
})
