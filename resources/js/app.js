require('./bootstrap');

import Vue from 'vue';

window.Vue = Vue;

Vue.component('side-bar', require('./components/SideBar.vue').default);
Vue.component('balance', require('./components/Balance.vue').default);

new Vue({
    el: '#app',
});