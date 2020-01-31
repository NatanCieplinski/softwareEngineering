const axios = require('axios').default;

export default {
    state: {
        access_token: "",
        user: '',
    },
    mutations: { 
        SET_TOKEN: (state, token) => (state.access_token = token),
        SET_USER: (state, user) => (state.user = user),
    },
    actions: {
        async requestToken({commit}, data){
            axios.post('api/utenti/login', {
                email: data.email,
                password: data.password,
            }).then(function(response){
                commit('SET_TOKEN', response.data.access_token);
                commit('SET_USER', response.data.user);

                axios.defaults.headers.common = {
                    'Accept': 'application/json',
                    'Authorization': `Bearer ${response.data.access_token}`
                }
            });
        },
    },
    getters: { 
        GET_TOKEN: (state) => state.access_token,
        GET_USER: (state) => state.user,
    }
}