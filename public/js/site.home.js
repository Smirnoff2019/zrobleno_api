/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/site.home.js":
/*!***********************************!*\
  !*** ./resources/js/site.home.js ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports) {

(function ($) {
  window.owlCarouselInit = function () {
    var $ = jQuery;
    $(document).ready(function () {
      var owl = $('#section-1 .owl-carousel');
      owl.on('initialized.owl.carousel', function (event) {
        initSliderControllsScopes();
      });
      owl.owlCarousel({
        items: 1,
        loop: true,
        // margin:10,
        video: true,
        // lazyLoad:true,
        center: true,
        // responsive:{
        // 480:{
        //     items:2
        // },
        // 600:{
        //     items:4
        // }
        // },
        nav: false,
        dots: true,
        navContainer: '#section-1 .slider-controls .navs',
        dotsContainer: '#section-1 .slider-controls .dots',
        navText: ["<i class=\"icon-arrow-left\"></i>", "<i class=\"icon-arrow-right\"></i>"] // dotsEach: true,

      });
      initSliderControllsScopes();
      owl.on('changed.owl.carousel', function (event) {
        initSliderControllsScopes();
      });
    });

    function initSliderControllsScopes() {
      var count = $('.slider-controls .dots button').length;
      console.log('count', count);
      var index = $('.slider-controls .dots button.active').index();
      console.log('index', index);
      $('.slider-controls .scopes .total').text(+count < 10 ? "0".concat(count) : count);
      $('.slider-controls .scopes .current').text(++index < 10 ? "0".concat(index) : index);
    }
  };

  window.owlCarouselInit();
})(jQuery);

/***/ }),

/***/ 1:
/*!*****************************************!*\
  !*** multi ./resources/js/site.home.js ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\OpenServer\Projects\zrobleno\api\resources\js\site.home.js */"./resources/js/site.home.js");


/***/ })

/******/ });