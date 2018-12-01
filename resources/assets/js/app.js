
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

Vue.component('charsheet', require('./components/charsheet.vue'));
Vue.component('form-checkbox', require('./components/form/checkbox.vue'));
Vue.component('draft', require('./components/draft.vue'));
Vue.component('form-input', require('./components/form/input.vue'));
Vue.component('form-select', require('./components/form/select.vue'));
Vue.component('form-textarea', require('./components/form/textarea.vue'));
Vue.component('spell', require('./components/spell.vue'));
Vue.component('spells', require('./components/spells.vue'));
Vue.component('spell-name', require('./components/spells/name.vue'));

const app = new Vue({
    el: '#app'
});
