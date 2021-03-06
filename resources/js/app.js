require('./bootstrap');
var moment = require('moment');
// require('moment-precise-range-plugin');
import 'moment-precise-range-plugin';
import Vue from 'vue'

import Echo from "laravel-echo"


window.io = require('socket.io-client');

window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ':6001'
});


import VueRouter from 'vue-router'
Vue.use(VueRouter);

import FlashMessage from '@smartweb/vue-flash-message';
Vue.use(FlashMessage);

import VueLazyload from 'vue-lazyload'
Vue.use(VueLazyload);


import VueMoment from 'vue-moment'
Vue.use(VueMoment);

import VueConfirmDialog from 'vue-confirm-dialog'
Vue.use(VueConfirmDialog);


window.Vue = require('vue');
Vue.component('pagination', require('laravel-vue-pagination'));
Vue.component('vue-confirm-dialog', VueConfirmDialog.default);
// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('add-tenant', require('./tenant/Tenants.vue').default);

import Dashbord from './Version/Dashbord.vue';

//tenntsddddd
import Tenants  from './tenant/Tenants.vue';
import editTenant  from './tenant/Editenant.vue';
import  newTenant from './tenant/newTenant.vue';
import  showtenant from './tenant/Showtenant.vue';
//GGSTION DES BIEN
import  Bien from './house/Bien.vue';
import  newBien from './house/Newbien.vue';
import  editbien from './house/Editbien.vue';
import  showbien from './house/Showbien.vue';

import  immeuble from './immeubles/Immeuble.vue';

//GESTION DE LOCATION//
import  rent from './rentale/rental.vue';
import  newrent from './rentale/Newrent.vue';
import  editrent from './rentale/Editrent.vue';
import  showrent from './rentale/Showrent.vue';

//gestion des facture //
import  payment from './payment/Payment.vue';
import  new_payment from './payment/NewPayment.vue';
import  edit_payment from './payment/EditPayment.vue';
import  show_payment from './payment/ShowPayment.vue';
//gstion des e liieux
import  etatlieux from './state/State.vue';
import  newstate from './state/NewState.vue';
//gzestion des users
import user from './user/User';





const routes = [

    //Gestion ds user

    {
        path:"/profil",
        component:user
    },

    //Gestion des etats de lieux
    {
      path:"/state",
        component:etatlieux
    },

    {
      path:"/new_state",
        component:newstate
    },
//dasbord/////
    {
        path: "/",
        component: Dashbord
    },

    //gestions des utilisateurs
    {
        path: "/tenants",
        component: Tenants
    },

    {
        path:"/new-tenant",
        component: newTenant
    },

    {
        path:'/edit/:id',
        component: editTenant,
        name: 'edit'
    },

    {
        path:'/show_tenant/:id',
        component: showtenant,
        name: 'showtenant'
    },

    //GESTION des bien

    {
        path:"/bien",
        component: Bien
    },

    {
        path:"/newBien",
        component:newBien
    },

    {
        path:'/edit_bien/:id',
        component: editbien,
        name: 'editbien'
    },

    {
        path:'/show_bien/:id',
        component: showbien,
        name: 'showbien'
    },

    {
        path:'/immeubles',
        component: immeuble,
    },



    //gestion des location//

    {
        path:"/rent",
        component: rent
    },

    {
        path:"/newRent",
        component:newrent
    },

    {
        path:'/edit_rent/:id',
        component: editrent,
        name: 'editrent'
    },

    {
        path:'/show_rent/:id',
        component: showrent,
        name: 'showrent'
    },

    //gestioon des facture

    {
        path:"/payment",
        component: payment
    },

    {
        path:"/newpayment",
        component: new_payment
    },

    {
        path:'/show_payment/:id',
        component: show_payment,
        name: 'show_payment'
    },

    {
        path:'/edit_payment/:id',
        component: edit_payment,
        name: 'edit_payment'
    },

];


const router = new VueRouter({routes});
const app = new Vue({
    el: '#app',
    router : router
});
