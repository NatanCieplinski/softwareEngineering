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
        async reserveSeat({commit}, data){
            axios.post('api/prenotazioni/new', {
                posto: data.seat_id,
                user_id: data.user_id,
                desk_id: data.desk_id,
            }).then(function(response){

            });
        },
    },
    getters: { 
        GET_DESKS: (state) => state.desks
    }
}