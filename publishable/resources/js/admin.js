
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Dropzone = require('dropzone');
Dropzone.autoDiscover = false;

Dropzone.prototype.defaultOptions.headers = {
    'X-CSRF-TOKEN': window.Laravel.csrfToken
};

window.Vue = require('vue');

// FontAwesome
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
//window.library = require('./admin/icons');
window.library = require('./admin/all-icons');

Vue.component('font-awesome-icon', FontAwesomeIcon);

// Buefy
import Buefy from 'buefy';
Vue.use(Buefy, {
   defaultIconPack: 'fas',
   defaultContainerElement: '#app',
   defaultIconComponent: 'font-awesome-icon'
});

// CKEditor
import CKEditor from '@ckeditor/ckeditor5-vue';
Vue.use( CKEditor );

// import Buefy from "buefy";
// import "@fortawesome/fontawesome-free/css/all.css";
// import "@fortawesome/fontawesome-free/css/fontawesome.css";
// Vue.use(Buefy, {
//     defaultIconPack: "fas"
// });

// CKEditor 5
window.ClassicEditor = require('@ckeditor/ckeditor5-build-classic');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('upload-image', require('./admin/components/UploadImage.vue').default);
Vue.component('date-time', require('./admin/components/DateTime.vue').default);
Vue.component('upload-images', require('./admin/components/UploadImages.vue').default);
Vue.component('classic-ckeditor', require('./admin/components/ClassicCKEditor.vue').default);
Vue.component('confirm-delete-link', require('./admin/components/ConfirmDeleteLink.vue').default);

const app = new Vue({
    el: '#app',

    data: {
        contentType: null,
        locale: 'en',
    },

    components: {
        FontAwesomeIcon
    }

});

// For using in scripts


Window.app = app;