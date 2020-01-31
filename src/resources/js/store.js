import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

import login from './modules/login.js';
import prenota from './modules/prenota.js';
import prenotazioni from './modules/prenotazioni.js';

export default new Vuex.Store({
    modules: {
        login,
        prenota,
        prenotazioni
    },
    state: {  },
    mutations: {  },
    actions: {  },
    getters: { }
}); 