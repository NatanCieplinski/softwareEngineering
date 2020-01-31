const axios = require('axios').default;

export default {
    state: {
        desks: []
    },
    mutations: { 
        SET_DESKS: (state, desks) => (state.desks = desks),
    },
    actions: {
        async getDesks({commit}, data){
            axios.get('api/banchi/aula/1').then(function(response){
                commit('SET_DESKS', response.data);
            });
        },
        async getDesktypes({commit}, data){
            axios.get('api/tipibanco/aula/1').then(function(response){
                commit('SET_DESKS', response.data);
            });
        }
    },
    getters: { 
        GET_DESKS: (state) => state.desks
    }
}