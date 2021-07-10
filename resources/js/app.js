require('./bootstrap');
import Vue from 'vue'
window.Vue = require('vue');
import Vuex from 'vuex';


import App from './App.vue';
import VueAxios from 'vue-axios';
import VueRouter from 'vue-router';
import axios from 'axios';



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */





Vue.use(VueAxios, axios);

window.axios = require('axios');


