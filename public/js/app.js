(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["/js/app"],{

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

eval("__webpack_require__(/*! ./bootstrap */ \"./resources/js/bootstrap.js\");\n\n__webpack_require__(/*! ./custom */ \"./resources/js/custom.js\");//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvYXBwLmpzPzZkNDAiXSwibmFtZXMiOlsicmVxdWlyZSJdLCJtYXBwaW5ncyI6IkFBQUFBLG1CQUFPLENBQUMsZ0RBQUQsQ0FBUDs7QUFDQUEsbUJBQU8sQ0FBQywwQ0FBRCxDQUFQIiwiZmlsZSI6Ii4vcmVzb3VyY2VzL2pzL2FwcC5qcy5qcyIsInNvdXJjZXNDb250ZW50IjpbInJlcXVpcmUoJy4vYm9vdHN0cmFwJyk7XG5yZXF1aXJlKCcuL2N1c3RvbScpO1xuIl0sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./resources/js/app.js\n");

/***/ }),

/***/ "./resources/js/bootstrap.js":
/*!***********************************!*\
  !*** ./resources/js/bootstrap.js ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

eval("window._ = __webpack_require__(/*! lodash */ \"./node_modules/lodash/lodash.js\");\n/**\n * We'll load jQuery and the Bootstrap jQuery plugin which provides support\n * for JavaScript based Bootstrap features such as modals and tabs. This\n * code may be modified to fit the specific needs of your application.\n */\n\ntry {\n  window.Popper = __webpack_require__(/*! popper.js */ \"./node_modules/popper.js/dist/esm/popper.js\")[\"default\"];\n  window.$ = window.jQuery = __webpack_require__(/*! jquery */ \"./node_modules/jquery/dist/jquery.js\");\n\n  __webpack_require__(/*! bootstrap */ \"./node_modules/bootstrap/dist/js/bootstrap.js\");\n} catch (e) {}\n/**\n * We'll load the axios HTTP library which allows us to easily issue requests\n * to our Laravel back-end. This library automatically handles sending the\n * CSRF token as a header based on the value of the \"XSRF\" token cookie.\n */\n\n\nwindow.axios = __webpack_require__(/*! axios */ \"./node_modules/axios/index.js\");\nwindow.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';\n/**\n * Echo exposes an expressive API for subscribing to channels and listening\n * for events that are broadcast by Laravel. Echo and event broadcasting\n * allows your team to easily build robust real-time web applications.\n */\n// import Echo from 'laravel-echo';\n// window.Pusher = require('pusher-js');\n// window.Echo = new Echo({\n//     broadcaster: 'pusher',\n//     key: process.env.MIX_PUSHER_APP_KEY,\n//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,\n//     forceTLS: true\n// });//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvYm9vdHN0cmFwLmpzP2Y1NjgiXSwibmFtZXMiOlsid2luZG93IiwiXyIsInJlcXVpcmUiLCJQb3BwZXIiLCIkIiwialF1ZXJ5IiwiZSIsImF4aW9zIiwiZGVmYXVsdHMiLCJoZWFkZXJzIiwiY29tbW9uIl0sIm1hcHBpbmdzIjoiQUFBQUEsTUFBTSxDQUFDQyxDQUFQLEdBQVdDLG1CQUFPLENBQUMsK0NBQUQsQ0FBbEI7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQUVBLElBQUk7QUFDQUYsUUFBTSxDQUFDRyxNQUFQLEdBQWdCRCxtQkFBTyxDQUFDLDhEQUFELENBQVAsV0FBaEI7QUFDQUYsUUFBTSxDQUFDSSxDQUFQLEdBQVdKLE1BQU0sQ0FBQ0ssTUFBUCxHQUFnQkgsbUJBQU8sQ0FBQyxvREFBRCxDQUFsQzs7QUFFQUEscUJBQU8sQ0FBQyxnRUFBRCxDQUFQO0FBQ0gsQ0FMRCxDQUtFLE9BQU9JLENBQVAsRUFBVSxDQUFFO0FBRWQ7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7O0FBRUFOLE1BQU0sQ0FBQ08sS0FBUCxHQUFlTCxtQkFBTyxDQUFDLDRDQUFELENBQXRCO0FBRUFGLE1BQU0sQ0FBQ08sS0FBUCxDQUFhQyxRQUFiLENBQXNCQyxPQUF0QixDQUE4QkMsTUFBOUIsQ0FBcUMsa0JBQXJDLElBQTJELGdCQUEzRDtBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFFQTtBQUVBO0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBIiwiZmlsZSI6Ii4vcmVzb3VyY2VzL2pzL2Jvb3RzdHJhcC5qcy5qcyIsInNvdXJjZXNDb250ZW50IjpbIndpbmRvdy5fID0gcmVxdWlyZSgnbG9kYXNoJyk7XG5cbi8qKlxuICogV2UnbGwgbG9hZCBqUXVlcnkgYW5kIHRoZSBCb290c3RyYXAgalF1ZXJ5IHBsdWdpbiB3aGljaCBwcm92aWRlcyBzdXBwb3J0XG4gKiBmb3IgSmF2YVNjcmlwdCBiYXNlZCBCb290c3RyYXAgZmVhdHVyZXMgc3VjaCBhcyBtb2RhbHMgYW5kIHRhYnMuIFRoaXNcbiAqIGNvZGUgbWF5IGJlIG1vZGlmaWVkIHRvIGZpdCB0aGUgc3BlY2lmaWMgbmVlZHMgb2YgeW91ciBhcHBsaWNhdGlvbi5cbiAqL1xuXG50cnkge1xuICAgIHdpbmRvdy5Qb3BwZXIgPSByZXF1aXJlKCdwb3BwZXIuanMnKS5kZWZhdWx0O1xuICAgIHdpbmRvdy4kID0gd2luZG93LmpRdWVyeSA9IHJlcXVpcmUoJ2pxdWVyeScpO1xuXG4gICAgcmVxdWlyZSgnYm9vdHN0cmFwJyk7XG59IGNhdGNoIChlKSB7fVxuXG4vKipcbiAqIFdlJ2xsIGxvYWQgdGhlIGF4aW9zIEhUVFAgbGlicmFyeSB3aGljaCBhbGxvd3MgdXMgdG8gZWFzaWx5IGlzc3VlIHJlcXVlc3RzXG4gKiB0byBvdXIgTGFyYXZlbCBiYWNrLWVuZC4gVGhpcyBsaWJyYXJ5IGF1dG9tYXRpY2FsbHkgaGFuZGxlcyBzZW5kaW5nIHRoZVxuICogQ1NSRiB0b2tlbiBhcyBhIGhlYWRlciBiYXNlZCBvbiB0aGUgdmFsdWUgb2YgdGhlIFwiWFNSRlwiIHRva2VuIGNvb2tpZS5cbiAqL1xuXG53aW5kb3cuYXhpb3MgPSByZXF1aXJlKCdheGlvcycpO1xuXG53aW5kb3cuYXhpb3MuZGVmYXVsdHMuaGVhZGVycy5jb21tb25bJ1gtUmVxdWVzdGVkLVdpdGgnXSA9ICdYTUxIdHRwUmVxdWVzdCc7XG5cbi8qKlxuICogRWNobyBleHBvc2VzIGFuIGV4cHJlc3NpdmUgQVBJIGZvciBzdWJzY3JpYmluZyB0byBjaGFubmVscyBhbmQgbGlzdGVuaW5nXG4gKiBmb3IgZXZlbnRzIHRoYXQgYXJlIGJyb2FkY2FzdCBieSBMYXJhdmVsLiBFY2hvIGFuZCBldmVudCBicm9hZGNhc3RpbmdcbiAqIGFsbG93cyB5b3VyIHRlYW0gdG8gZWFzaWx5IGJ1aWxkIHJvYnVzdCByZWFsLXRpbWUgd2ViIGFwcGxpY2F0aW9ucy5cbiAqL1xuXG4vLyBpbXBvcnQgRWNobyBmcm9tICdsYXJhdmVsLWVjaG8nO1xuXG4vLyB3aW5kb3cuUHVzaGVyID0gcmVxdWlyZSgncHVzaGVyLWpzJyk7XG5cbi8vIHdpbmRvdy5FY2hvID0gbmV3IEVjaG8oe1xuLy8gICAgIGJyb2FkY2FzdGVyOiAncHVzaGVyJyxcbi8vICAgICBrZXk6IHByb2Nlc3MuZW52Lk1JWF9QVVNIRVJfQVBQX0tFWSxcbi8vICAgICBjbHVzdGVyOiBwcm9jZXNzLmVudi5NSVhfUFVTSEVSX0FQUF9DTFVTVEVSLFxuLy8gICAgIGZvcmNlVExTOiB0cnVlXG4vLyB9KTtcbiJdLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./resources/js/bootstrap.js\n");

/***/ }),

/***/ "./resources/js/custom.js":
/*!********************************!*\
  !*** ./resources/js/custom.js ***!
  \********************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("/* Bootstrap dropdown on hover */\n$(\".dropdown-menu\").css('margin-top', 0);\n$(\".dropdown\").mouseover(function () {\n  $(this).addClass('show').attr('aria-expanded', \"true\");\n  $(this).find('.dropdown-menu').addClass('show');\n}).mouseout(function () {\n  $(this).removeClass('show').attr('aria-expanded', \"false\");\n  $(this).find('.dropdown-menu').removeClass('show');\n});\n/* Header on scroll */\n\n$(window).scroll(function () {\n  var scroll = $(window).scrollTop(); //>=, not <=\n\n  if (scroll >= 500) {\n    //clearHeader, not clearheader - caps H\n    $(\".site-header\").addClass(\"stickyHeader\");\n  } else {\n    $(\".site-header\").removeClass(\"stickyHeader\");\n  }\n}); //missing );//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvY3VzdG9tLmpzP2IxZDIiXSwibmFtZXMiOlsiJCIsImNzcyIsIm1vdXNlb3ZlciIsImFkZENsYXNzIiwiYXR0ciIsImZpbmQiLCJtb3VzZW91dCIsInJlbW92ZUNsYXNzIiwid2luZG93Iiwic2Nyb2xsIiwic2Nyb2xsVG9wIl0sIm1hcHBpbmdzIjoiQUFDRTtBQUNBQSxDQUFDLENBQUMsZ0JBQUQsQ0FBRCxDQUFvQkMsR0FBcEIsQ0FBd0IsWUFBeEIsRUFBc0MsQ0FBdEM7QUFDQUQsQ0FBQyxDQUFDLFdBQUQsQ0FBRCxDQUNDRSxTQURELENBQ1csWUFBWTtBQUNyQkYsR0FBQyxDQUFDLElBQUQsQ0FBRCxDQUFRRyxRQUFSLENBQWlCLE1BQWpCLEVBQXlCQyxJQUF6QixDQUE4QixlQUE5QixFQUErQyxNQUEvQztBQUNBSixHQUFDLENBQUMsSUFBRCxDQUFELENBQVFLLElBQVIsQ0FBYSxnQkFBYixFQUErQkYsUUFBL0IsQ0FBd0MsTUFBeEM7QUFDRCxDQUpELEVBS0NHLFFBTEQsQ0FLVSxZQUFZO0FBQ3BCTixHQUFDLENBQUMsSUFBRCxDQUFELENBQVFPLFdBQVIsQ0FBb0IsTUFBcEIsRUFBNEJILElBQTVCLENBQWlDLGVBQWpDLEVBQWtELE9BQWxEO0FBQ0FKLEdBQUMsQ0FBQyxJQUFELENBQUQsQ0FBUUssSUFBUixDQUFhLGdCQUFiLEVBQStCRSxXQUEvQixDQUEyQyxNQUEzQztBQUNELENBUkQ7QUFVRjs7QUFDRVAsQ0FBQyxDQUFDUSxNQUFELENBQUQsQ0FBVUMsTUFBVixDQUFpQixZQUFXO0FBQzFCLE1BQUlBLE1BQU0sR0FBR1QsQ0FBQyxDQUFDUSxNQUFELENBQUQsQ0FBVUUsU0FBVixFQUFiLENBRDBCLENBRXpCOztBQUNELE1BQUlELE1BQU0sSUFBSSxHQUFkLEVBQW1CO0FBQ2Y7QUFDQVQsS0FBQyxDQUFDLGNBQUQsQ0FBRCxDQUFrQkcsUUFBbEIsQ0FBMkIsY0FBM0I7QUFDSCxHQUhELE1BSUk7QUFDRkgsS0FBQyxDQUFDLGNBQUQsQ0FBRCxDQUFrQk8sV0FBbEIsQ0FBOEIsY0FBOUI7QUFDRDtBQUNKLENBVkMsRSxDQVVFIiwiZmlsZSI6Ii4vcmVzb3VyY2VzL2pzL2N1c3RvbS5qcy5qcyIsInNvdXJjZXNDb250ZW50IjpbIlxuICAvKiBCb290c3RyYXAgZHJvcGRvd24gb24gaG92ZXIgKi9cbiAgJChcIi5kcm9wZG93bi1tZW51XCIpLmNzcygnbWFyZ2luLXRvcCcsIDApO1xuICAkKFwiLmRyb3Bkb3duXCIpXG4gIC5tb3VzZW92ZXIoZnVuY3Rpb24gKCkge1xuICAgICQodGhpcykuYWRkQ2xhc3MoJ3Nob3cnKS5hdHRyKCdhcmlhLWV4cGFuZGVkJywgXCJ0cnVlXCIpO1xuICAgICQodGhpcykuZmluZCgnLmRyb3Bkb3duLW1lbnUnKS5hZGRDbGFzcygnc2hvdycpO1xuICB9KVxuICAubW91c2VvdXQoZnVuY3Rpb24gKCkge1xuICAgICQodGhpcykucmVtb3ZlQ2xhc3MoJ3Nob3cnKS5hdHRyKCdhcmlhLWV4cGFuZGVkJywgXCJmYWxzZVwiKTtcbiAgICAkKHRoaXMpLmZpbmQoJy5kcm9wZG93bi1tZW51JykucmVtb3ZlQ2xhc3MoJ3Nob3cnKTtcbiAgfSk7XG5cbi8qIEhlYWRlciBvbiBzY3JvbGwgKi9cbiAgJCh3aW5kb3cpLnNjcm9sbChmdW5jdGlvbigpIHsgICAgXG4gICAgdmFyIHNjcm9sbCA9ICQod2luZG93KS5zY3JvbGxUb3AoKTtcbiAgICAgLy8+PSwgbm90IDw9XG4gICAgaWYgKHNjcm9sbCA+PSA1MDApIHtcbiAgICAgICAgLy9jbGVhckhlYWRlciwgbm90IGNsZWFyaGVhZGVyIC0gY2FwcyBIXG4gICAgICAgICQoXCIuc2l0ZS1oZWFkZXJcIikuYWRkQ2xhc3MoXCJzdGlja3lIZWFkZXJcIik7XG4gICAgfVxuICAgIGVsc2V7XG4gICAgICAkKFwiLnNpdGUtaGVhZGVyXCIpLnJlbW92ZUNsYXNzKFwic3RpY2t5SGVhZGVyXCIpO1xuICAgIH1cbn0pOyAvL21pc3NpbmcgKTsiXSwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./resources/js/custom.js\n");

/***/ }),

/***/ "./resources/sass/app.scss":
/*!*********************************!*\
  !*** ./resources/sass/app.scss ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("// removed by extract-text-webpack-plugin//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvc2Fzcy9hcHAuc2Nzcz8wZTE1Il0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQUFBIiwiZmlsZSI6Ii4vcmVzb3VyY2VzL3Nhc3MvYXBwLnNjc3MuanMiLCJzb3VyY2VzQ29udGVudCI6WyIvLyByZW1vdmVkIGJ5IGV4dHJhY3QtdGV4dC13ZWJwYWNrLXBsdWdpbiJdLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./resources/sass/app.scss\n");

/***/ }),

/***/ 0:
/*!*************************************************************!*\
  !*** multi ./resources/js/app.js ./resources/sass/app.scss ***!
  \*************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! /Users/paige.priyanka/Documents/Projects/peggywebb-westriveracademy-laravel/resources/js/app.js */"./resources/js/app.js");
module.exports = __webpack_require__(/*! /Users/paige.priyanka/Documents/Projects/peggywebb-westriveracademy-laravel/resources/sass/app.scss */"./resources/sass/app.scss");


/***/ })

},[[0,"/js/manifest","/js/vendor"]]]);