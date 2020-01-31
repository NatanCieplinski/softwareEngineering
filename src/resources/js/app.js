import Vue from 'vue';
import router from './router.js';

import AppComponent from './components/App';

require('./bootstrap');

const app = new Vue({
    el: '#app',
    components: {
        AppComponent
    },
    router,
    data: {
        message: 'Hello Vue!'
    }
});
