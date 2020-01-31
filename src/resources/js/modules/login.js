const axios = require('axios').default;

export default {
    state: {
        access_token: "",
    },
    mutations: { 
        SET_TOKEN: (state, token) => (state.access_token = token),
    },
    actions: {
        async requestToken({commit}, data){
            axios.post('api/utenti/login', {
                email: data.email,
                password: data.password,
            }).then(function(response){
                commit('SET_TOKEN', response.data.access_token);

                axios.defaults.headers.common = {
                    'Accept': 'application/json',
                    'Authorization': `Bearer ${response.data.access_token}`
                }
            });
        },
    },
    getters: { 
        GET_TOKEN: (state) => state.access_token
    }
}