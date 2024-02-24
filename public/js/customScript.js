(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["/js/customScript"],{

/***/ "./resources/js/customScript.js":
/*!**************************************!*\
  !*** ./resources/js/customScript.js ***!
  \**************************************/
/*! no static exports found */
/***/ (function(module, exports) {

/**
 * Created by M.Barabanova on 02.01.2018.
 */
$(function () {
  $('.datepicker').datepicker({
    language: 'ru',
    format: 'dd.mm.yyyy',
    autoclose: true
  });
  $(document).ajaxStart(function () {
    ajaxLoaderShow();
  }).ajaxStop(function () {
    ajaxLoaderHide();
  });
  $('.navbar-toggler').click(function () {
    $($(this).data('target')).toggle();
  });
  $('.dropdown-menu a.dropdown-toggle-no-arrow').on('click', function (e) {
    if (!$(this).next().hasClass('show')) {
      $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
    }

    var $subMenu = $(this).next(".dropdown-menu");
    $subMenu.toggleClass('show');
    $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function (e) {
      $('.dropdown-submenu .show').removeClass("show");
    });
    return false;
  });
});

window.ajaxLoaderShow = function () {
  $("#ajax-loader").show();
};

window.ajaxLoaderHide = function () {
  $("#ajax-loader").hide();
};

window.activeTab = function (tabName) {
  $('.subMenu .navbar-nav li[data-menutag="' + tabName + '"]').addClass('active');
};

/***/ }),

/***/ 2:
/*!********************************************!*\
  !*** multi ./resources/js/customScript.js ***!
  \********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! D:\Projects\MyProjects\iLicense\resources\js\customScript.js */"./resources/js/customScript.js");


/***/ })

},[[2,"/js/manifest"]]]);
