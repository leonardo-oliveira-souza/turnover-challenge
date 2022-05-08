require('./bootstrap');

import Vue from 'vue';

window.Vue = Vue;

Vue.component('side-bar', require('./components/SideBar.vue').default);
Vue.component('balance', require('./components/client/Balance.vue').default);
Vue.component('expenses', require('./components/client/Expenses.vue').default);
Vue.component('incomes', require('./components/client/Incomes.vue').default);
Vue.component('checks', require('./components/client/Checks.vue').default);
Vue.component('transaction-list', require('./components/client/TransactionList.vue').default);
Vue.component('check-list', require('./components/client/CheckList.vue').default);

Vue.component('check-control', require('./components/admin/CheckControl.vue').default);
Vue.component('check-detail', require('./components/admin/CheckDetail.vue').default);

new Vue({
    el: '#app',
});