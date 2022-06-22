require('./bootstrap');

import  "bootstrap/dist/css/bootstrap.min.css"
import {createApp} from 'vue'
import Vuex from 'vuex'

import App from './layout/App.vue'
import axios from 'axios'
import router from './router'
import store from './store/store'

const app = createApp(App)
app.config.globalProperties.$axios = axios;
window.axios.defaults.withCredentials = true;

app.use(router)
app.use(Vuex)
app.use(store)
app.mount('#app')



import "bootstrap/dist/js/bootstrap.js"