/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./custom');
window.Vue = require('vue');
Vue.use(require('vue-moment'));


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))


Vue.component('enroll-student', require('./components/EnrollStudent.vue').default);
Vue.component('edit-enroll', require('./components/EditEnrollStudent.vue').default);
Vue.component('billing-shipping', require('./components/address.vue').default);
Vue.component('get-cart', require('./components/Cart.vue').default);
Vue.component('english-course', require('./components/EnglishCourse.vue').default);
Vue.component('social-studies', require('./components/SocialStudiesCourse.vue').default);
Vue.component('maths-course', require('./components/Maths.vue').default);
Vue.component('science-course', require('./components/ScienceCourse.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
