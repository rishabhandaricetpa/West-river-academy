import Vue from 'vue';
import jQuery from 'jquery';
window.$ = window.jQuery = jQuery;
import axios from 'axios';
window.axios = axios;
window.axios.defaults.withCredentials = true;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Selective bootstrap.js build
import 'bootstrap/js/dist/util';
import 'bootstrap/js/dist/alert';
import 'bootstrap/js/dist/dropdown';
import 'bootstrap/js/dist/collapse';
//import 'bootstrap/js/dist/tab';
import 'bootstrap/js/dist/modal';
import Datepicker from 'vuejs-datepicker';

import Ziggy from 'ziggy-js';
// route() helper is available everywhere
window.route = Ziggy;
// Exposing route() helper method to vue templates
Vue.mixin({
  methods: {
    route: Ziggy
  }
});
import 'bootstrap/js/dist/tooltip';

$('[data-toggle="tooltip"]').tooltip();
