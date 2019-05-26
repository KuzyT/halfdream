
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

// FontAwesome
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
window.library = require('./icons');

// Buefy
// import Buefy from 'buefy';
// Vue.use(Buefy, {
//     defaultIconPack: 'fas',
//     defaultContainerElement: '#app'
// });

// Special for Bulma
require('./bulma');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('gallery', require('./components/Gallery.vue').default);

const app = new Vue({
    el: '#app',

    components: {
        FontAwesomeIcon
    },

});
