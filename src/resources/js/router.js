import Vue from 'vue';
import VueRouter from 'vue-router';
import store from './store.js';

import PrenotaComponent from './components/Prenota';
import LoginComponent from './components/Login';
import PrenotazioniComponent from './components/Prenotazioni';
import PageNotFoundComponent from './components/PageNotFound';

Vue.use(VueRouter);

var router = new VueRouter({
    routes: [
        { path: '/', component: PrenotaComponent, meta: { requiresAuth: true } },
        { path: '/prenotazioni', component: PrenotazioniComponent, meta: { requiresAuth: true } },
        { path: '/login', component: LoginComponent},
        { path: '*', component: PageNotFoundComponent }
    ],
    mode: 'history'
});

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (!store.getters["IS_LOGGED"]) next('/login')
        else next()
    }else{ next() }
});

export default router;
