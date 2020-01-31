const axios = require('axios').default;

export default {
    state: {
        reservations: []
    },
    mutations: { 
        SET_RESERVATIONS: (state, reservations) => (state.reservations = reservations),
    },
    actions: {
        async getReservations({commit}, id){
            axios.get('api/prenotazioni/utente/'+id).then(function(response){
                console.log(response.data)
                commit('SET_RESERVATIONS', response.data);
            });
        },
        async deleteReservation({commit, state}, id){
            axios.delete('api/prenotazioni/'+id).then(function(response){
                var newReservations = state.reservations;
                for( var i = newReservations.length-1; i--;){
                    if ( newReservations[i].id == id) newReservations.splice(i, 1);
                }
                commit('SET_RESERVATIONS', newReservations);
            });
        }
    },
    getters: { 
        GET_RESERVATIONS: (state) => state.reservations
    }
}