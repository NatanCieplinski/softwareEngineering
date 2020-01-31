import Vue from 'vue';
import router from './router.js';
import store from './store.js';

require('./bootstrap');

Vue.component('navbar-component', require('./components/Navbar.vue').default);

const app = new Vue({
    el: '#app',
    router,
    store
});
