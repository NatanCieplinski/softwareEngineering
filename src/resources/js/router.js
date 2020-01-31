import Vue from 'vue';
import VueRouter from 'vue-router';
import AppComponent from './components/App';

Vue.use(VueRouter);

export default new VueRouter({
    routes: [
        { path: '/', component: AppComponent}
    ],
    mode: 'history'
});
