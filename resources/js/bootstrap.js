import jQuery from 'jquery';
// Exposing jQuery to window object
window.$ = window.jQuery = jQuery;

import axios from 'axios';

window.axios = axios;
window.axios.defaults.withCredentials = true;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Selective bootstrap.js build
// import 'bootstrap/js/dist/util';
// import 'bootstrap/js/dist/alert';
import 'bootstrap/js/dist/dropdown';
import 'bootstrap/js/dist/collapse';
//import 'bootstrap/js/dist/tab';
// import 'bootstrap/js/dist/modal';
