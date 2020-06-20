import Vue from 'vue';
import axios from 'axios';
import router from './router';


window.Vue = Vue;
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.withCredentials = true;
window.axios.defaults.baseURL = process.env.APP_URL;

Vue.component('admin-index', require('./components/admin/Index').default);
Vue.component('category-list', require('./components/admin/categories/List.vue').default);

const app = new Vue({
    el: '#app',
    router,
});
