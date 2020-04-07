(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["/js/report"],{

/***/ "./resources/js/report.js":
/*!********************************!*\
  !*** ./resources/js/report.js ***!
  \********************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  window.Echo["private"]("report-channel." + userId).listen('ReportFormed', function (e) {
    alert(e.reports);
  });
});

/***/ }),

/***/ 2:
/*!**************************************!*\
  !*** multi ./resources/js/report.js ***!
  \**************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /var/www/skillbox_laravel/resources/js/report.js */"./resources/js/report.js");


/***/ })

},[[2,"/js/manifest"]]]);