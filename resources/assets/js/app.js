
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap.js');

import Vue from 'vue';
import store from './store'
import router from './routes'
import CelendarEvents from './page/calendar-events.vue'

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('calendar-event-form', CelendarEvents);

const app = new Vue({
    el: '#events',
    store,
    router
});
