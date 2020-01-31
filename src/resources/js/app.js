import Vue from 'vue';
import router from './router.js';
import store from './store.js';
import Axios from 'axios'

require('./bootstrap');

Vue.prototype.$http = Axios;
const token = localStorage.getItem('token')
if (token) {
    Vue.prototype.$http.defaults.headers.common['Authorization'] = 'Bearer '+token;
}

Vue.component('navbar-component', require('./components/Navbar.vue').default);

const app = new Vue({
    el: '#app',
    router,
    store
});
