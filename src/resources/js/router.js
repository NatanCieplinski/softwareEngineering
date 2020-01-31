import Vue from 'vue';
import VueRouter from 'vue-router';

import PrenotaComponent from './components/Prenota';
import LoginComponent from './components/Login';
import PrenotazioniComponent from './components/Prenotazioni';
import PageNotFoundComponent from './components/PageNotFound';

Vue.use(VueRouter);

export default new VueRouter({
    routes: [
        { path: '/', component: PrenotaComponent},
        { path: '/prenotazioni', component: PrenotazioniComponent},
        { path: '/login', component: LoginComponent},
        { path: '*', component: PageNotFoundComponent }
    ],
    mode: 'history'
});
