const axios = require('axios').default;

export default {
    state: {
        desks: []
    },
    mutations: { 
        SET_DESKS: (state, desks) => (state.desks = desks),
    },
    actions: {
        async testBanchi({commit}, data){
            axios.get('api/banchi/aula/1').then(function(response){
                console.log(response);
            });
        }
    },
    getters: { 
        GET_DESKS: (state) => state.desks
    }
}