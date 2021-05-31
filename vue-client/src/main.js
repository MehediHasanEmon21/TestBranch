// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'

import "./assets/dist/css/adminlte.min.css"
import "./assets/plugins/fontawesome-free/css/all.min.css"
import "./assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css"

window.axios = require('axios');
axios.defaults.baseURL = 'http://test.mh-emon.com/api/';

import library from './helper/library.js'






Vue.config.productionTip = false

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  components: { App },
  template: '<App/>'
})
