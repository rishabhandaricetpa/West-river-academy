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
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! jquery */ \"./node_modules/jquery/dist/jquery.js\");\n/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(jquery__WEBPACK_IMPORTED_MODULE_0__);\n/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! axios */ \"./node_modules/axios/index.js\");\n/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(axios__WEBPACK_IMPORTED_MODULE_1__);\n/* harmony import */ var bootstrap_js_dist_util__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! bootstrap/js/dist/util */ \"./node_modules/bootstrap/js/dist/util.js\");\n/* harmony import */ var bootstrap_js_dist_util__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(bootstrap_js_dist_util__WEBPACK_IMPORTED_MODULE_2__);\n/* harmony import */ var bootstrap_js_dist_alert__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! bootstrap/js/dist/alert */ \"./node_modules/bootstrap/js/dist/alert.js\");\n/* harmony import */ var bootstrap_js_dist_alert__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(bootstrap_js_dist_alert__WEBPACK_IMPORTED_MODULE_3__);\n/* harmony import */ var bootstrap_js_dist_dropdown__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! bootstrap/js/dist/dropdown */ \"./node_modules/bootstrap/js/dist/dropdown.js\");\n/* harmony import */ var bootstrap_js_dist_dropdown__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(bootstrap_js_dist_dropdown__WEBPACK_IMPORTED_MODULE_4__);\n/* harmony import */ var bootstrap_js_dist_collapse__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! bootstrap/js/dist/collapse */ \"./node_modules/bootstrap/js/dist/collapse.js\");\n/* harmony import */ var bootstrap_js_dist_collapse__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(bootstrap_js_dist_collapse__WEBPACK_IMPORTED_MODULE_5__);\n/* harmony import */ var bootstrap_js_dist_modal__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! bootstrap/js/dist/modal */ \"./node_modules/bootstrap/js/dist/modal.js\");\n/* harmony import */ var bootstrap_js_dist_modal__WEBPACK_IMPORTED_MODULE_6___default = /*#__PURE__*/__webpack_require__.n(bootstrap_js_dist_modal__WEBPACK_IMPORTED_MODULE_6__);\n // Exposing jQuery to window object\n\nwindow.$ = window.jQuery = jquery__WEBPACK_IMPORTED_MODULE_0___default.a;\n\nwindow.axios = axios__WEBPACK_IMPORTED_MODULE_1___default.a;\nwindow.axios.defaults.withCredentials = true;\nwindow.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'; // Selective bootstrap.js build\n\n\n\n\n //import 'bootstrap/js/dist/tab';\n\n//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvYm9vdHN0cmFwLmpzP2Y1NjgiXSwibmFtZXMiOlsid2luZG93IiwiJCIsImpRdWVyeSIsImF4aW9zIiwiZGVmYXVsdHMiLCJ3aXRoQ3JlZGVudGlhbHMiLCJoZWFkZXJzIiwiY29tbW9uIl0sIm1hcHBpbmdzIjoiQUFBQTtBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQUE7Q0FDQTs7QUFDQUEsTUFBTSxDQUFDQyxDQUFQLEdBQVdELE1BQU0sQ0FBQ0UsTUFBUCxHQUFnQkEsNkNBQTNCO0FBRUE7QUFFQUYsTUFBTSxDQUFDRyxLQUFQLEdBQWVBLDRDQUFmO0FBQ0FILE1BQU0sQ0FBQ0csS0FBUCxDQUFhQyxRQUFiLENBQXNCQyxlQUF0QixHQUF3QyxJQUF4QztBQUNBTCxNQUFNLENBQUNHLEtBQVAsQ0FBYUMsUUFBYixDQUFzQkUsT0FBdEIsQ0FBOEJDLE1BQTlCLENBQXFDLGtCQUFyQyxJQUEyRCxnQkFBM0QsQyxDQUVBOztBQUNBO0FBQ0E7QUFDQTtDQUVBIiwiZmlsZSI6Ii4vcmVzb3VyY2VzL2pzL2Jvb3RzdHJhcC5qcy5qcyIsInNvdXJjZXNDb250ZW50IjpbImltcG9ydCBqUXVlcnkgZnJvbSAnanF1ZXJ5Jztcbi8vIEV4cG9zaW5nIGpRdWVyeSB0byB3aW5kb3cgb2JqZWN0XG53aW5kb3cuJCA9IHdpbmRvdy5qUXVlcnkgPSBqUXVlcnk7XG5cbmltcG9ydCBheGlvcyBmcm9tICdheGlvcyc7XG5cbndpbmRvdy5heGlvcyA9IGF4aW9zO1xud2luZG93LmF4aW9zLmRlZmF1bHRzLndpdGhDcmVkZW50aWFscyA9IHRydWU7XG53aW5kb3cuYXhpb3MuZGVmYXVsdHMuaGVhZGVycy5jb21tb25bJ1gtUmVxdWVzdGVkLVdpdGgnXSA9ICdYTUxIdHRwUmVxdWVzdCc7XG5cbi8vIFNlbGVjdGl2ZSBib290c3RyYXAuanMgYnVpbGRcbmltcG9ydCAnYm9vdHN0cmFwL2pzL2Rpc3QvdXRpbCc7XG5pbXBvcnQgJ2Jvb3RzdHJhcC9qcy9kaXN0L2FsZXJ0JztcbmltcG9ydCAnYm9vdHN0cmFwL2pzL2Rpc3QvZHJvcGRvd24nO1xuaW1wb3J0ICdib290c3RyYXAvanMvZGlzdC9jb2xsYXBzZSc7XG4vL2ltcG9ydCAnYm9vdHN0cmFwL2pzL2Rpc3QvdGFiJztcbmltcG9ydCAnYm9vdHN0cmFwL2pzL2Rpc3QvbW9kYWwnO1xuIl0sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./resources/js/bootstrap.js\n");

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

__webpack_require__(/*! /Users/rebeccarisha/projects/peggywebb-westriveracademy-laravel/resources/js/app.js */"./resources/js/app.js");
module.exports = __webpack_require__(/*! /Users/rebeccarisha/projects/peggywebb-westriveracademy-laravel/resources/sass/app.scss */"./resources/sass/app.scss");


/***/ })

},[[0,"/js/manifest","/js/vendor"]]]);