require('./bootstrap');

import Vue from 'vue';

window.Vue = Vue;

Vue.component('side-bar', require('./components/SideBar.vue').default);
Vue.component('balance', require('./components/client/Balance.vue').default);
Vue.component('expenses', require('./components/client/Expenses.vue').default);
Vue.component('transaction-list', require('./components/client/TransactionList.vue').default);

new Vue({
    el: '#app',
});