/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('charsheet', require('./components/charsheet.vue'));
Vue.component('f-input', require('./components/input.vue'));
Vue.component('f-select', require('./components/select.vue'));
Vue.component('f-checkbox', require('./components/checkbox.vue'));
Vue.component('spell', require('./components/spell.vue'));
const app = new Vue({
    el: '#app'
});
