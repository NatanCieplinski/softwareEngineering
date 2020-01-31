import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

import login from './modules/login.js';
import prenota from './modules/prenota.js';

export default new Vuex.Store({
    modules: {
        login,
        prenota
    },
    state: {  },
    mutations: {  },
    actions: {  },
    getters: { }
}); 