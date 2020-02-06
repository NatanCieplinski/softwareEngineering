import Vue from 'vue';
import axios from 'axios';

export default {
    state: {
        access_token: localStorage.getItem('token') || '',
        user: { id: localStorage.getItem('user') || ''},
    },
    mutations: { 
        SET_USER: (state, user) => (state.user = user),
        AUTH_SUCCESS(state, token, user){
            Vue.set(state, 'access_token',token)
            Vue.set(state, 'user', user)
        },
    },
    actions: {
        login({commit}, user){
            return new Promise((resolve, reject) => {
                axios.post('api/utenti/login', user).then(resp => {
                    const token = resp.data.access_token
                    const user = resp.data.user
                    localStorage.setItem('token', token)
                    localStorage.setItem('user', user.id)
                    Vue.set(axios.defaults.headers.common, 'Authorization', 'Bearer '+token)
                    commit('AUTH_SUCCESS', token, user)
                    resolve(resp)
                }).catch(err => {
                    localStorage.removeItem('token')
                    reject(err)
                })
            })
        },
    },
    getters: { 
        GET_TOKEN: (state) => state.access_token,
        GET_USER: (state) => state.user,
        IS_LOGGED: state => !!state.access_token,
    }
}