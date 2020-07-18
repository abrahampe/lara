/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import BootstrapVue from 'bootstrap-vue' //Importing



window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//support vuex
/* import Vuex from 'vuex'
Vue.use(Vuex)
import storeData from "./store/index"

const store = new Vuex.Store(
    storeData
) */

Vue.use(BootstrapVue); // Telling Vue to use this in whole application
import VueFontAwesomePicker from "vfa-picker";
Vue.use(VueFontAwesomePicker);

import Vuetify from 'vuetify';
Vue.use(Vuetify);

import store from './store/store';

Vue.component('example-component', require('./components/molecules/ExampleComponent.vue').default);
Vue.component('pg-settings', require('./components/screens/PgSettings.vue').default);

import VueInternationalization from 'vue-i18n';
import Locale from './vue-i18n-locales.generated';

Vue.use(VueInternationalization);
const lang = localStorage.getItem('locale') || 'pt';

const i18n = new VueInternationalization({
    locale: lang,
    messages: Locale
});


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
 
const app = new Vue({
    el: '#app',
    vuetify: new Vuetify(),
    i18n, 
    store,
});

