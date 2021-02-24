/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import VueDraggableResizable from 'vue-draggable-resizable';
import 'vue-draggable-resizable/dist/VueDraggableResizable.css';
import Vuex from 'vuex';
import firebase from 'firebase';
//import VueFire from 'vuefire';

require('./bootstrap');


window.Vue = require('vue').default;
Vue.component('vue-draggable-resizable', VueDraggableResizable);
Vue.use(Vuex);
//Vue.use(VueFire);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

require("firebase/firestore");

var firebaseConfig = {
    apiKey: "AIzaSyDA509a0KenvzXN_I-O6R_lib31PBO5mJA",
    authDomain: "modela-bd43e.firebaseapp.com",
    databaseURL: "https://modela-bd43e-default-rtdb.firebaseio.com",
    projectId: "modela-bd43e",
    storageBucket: "modela-bd43e.appspot.com",
    messagingSenderId: "560753544386",
    appId: "1:560753544386:web:31c7e560b3bb0a2b1b3f5b"
};
// Initialize Firebase
firebase.initializeApp(firebaseConfig);
var db = firebase.firestore();
window.db = db;

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
