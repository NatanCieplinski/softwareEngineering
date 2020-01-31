const axios = require('axios').default;

export default {
    state: {
        reservations: []
    },
    mutations: { 
        SET_RESERVATIONS: (state, reservations) => (state.reservations = reservations),
    },
    actions: {
        async getReservations({commit}, data){
            axios.get('api/prenotazioni/utente/25').then(function(response){
                commit('SET_RESERVATIONS', response.data);
            });
        }
    },
    getters: { 
        GET_RESERVATIONS: (state) => state.reservations
    }
}