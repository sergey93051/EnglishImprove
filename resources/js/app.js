require('./bootstrap');
const CreateEmitter = require('tiny-emitter');


import  "bootstrap/dist/css/bootstrap.min.css"
import {createApp} from 'vue'
import Vuex from 'vuex'
import App from './layout/App.vue'
import axios from 'axios'
import router from './router'
import store from './store/store'


const app = createApp(App)
app.config.globalProperties.$axios = axios;
app.config.globalProperties.$emitter = new CreateEmitter();
window.axios.defaults.withCredentials = true;

app.use(router)
app.use(Vuex)
app.use(store)
app.mount('#app')



import "bootstrap/dist/js/bootstrap.js"