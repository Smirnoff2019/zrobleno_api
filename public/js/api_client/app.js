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

/***/ "./resources/js/api/Ajax.js":
/*!**********************************!*\
  !*** ./resources/js/api/Ajax.js ***!
  \**********************************/
/*! no static exports found */
/***/ (function(module, exports) {

(function ($) {
  function post($name, $data) {
    var uri = '/api/v1/' + $name;
    var domain = 'http://api2.zrobleno.com.ua';
    var url = domain + uri;
    $.post(url, $data).done(function (res) {
      console.log(uri, res);
    });
  }

  function login() {
    post('login', {
      email: 'admin@zrobleno.com',
      password: 'password'
    });
  }

  function register() {
    post('register', {
      phone: '+380998007795',
      email: 't_user_12@gmail.com',
      password: 'password'
    });
  } // login();

})(jQuery);

/***/ }),

/***/ "./resources/js/api/CopyInBufer.js":
/*!*****************************************!*\
  !*** ./resources/js/api/CopyInBufer.js ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

(function ($) {
  function copytext(value) {
    var $tmp = $("<textarea>");
    $("body").append($tmp);
    $tmp.val(value).select();
    document.execCommand("copy");
    $tmp.remove();
    copiedNotif();
  }

  function copiedNotif() {
    toastr.success(null, 'Скопировано в буфер обмена!');
  }

  $('[data-copyinbufer]').click(function (event) {
    var value = $(this).data('copyinbufer');
    copytext(value);
  });
  $('[data-copyinbuferfrom]').click(function (event) {
    var $elem = $($(this).data('copyinbuferfrom'));
    var value = $elem.text();
    copytext(value);
  });
  $('[data-copyinbufertext]').click(function (event) {
    var value = $(this).text();
    copytext(value);
  });
  $('.copy-code-btn').click(function (event) {
    var value = $(this).parent().find('code').text().trim();
    copytext(value);
  });
})(jQuery);

/***/ }),

/***/ "./resources/js/api/Menu.js":
/*!**********************************!*\
  !*** ./resources/js/api/Menu.js ***!
  \**********************************/
/*! no static exports found */
/***/ (function(module, exports) {

(function ($) {
  function curentURL() {
    return window.location.href;
  }

  ;
  $('nav a[href="#"], nav a[href=""]').click(function (e) {
    e.preventDefault();
  });
  $('.menu-section-folder').each(function (key, item) {
    var $item = $(item);
    var $activeLink = $item.find('.menu-page-item a.active');
    var isActiveFolder = $activeLink.length > 0;
    var $folderLinks = $item.find('.menu-page-item a');
    menuCurentLinkManger($folderLinks);

    if (!isActiveFolder) {
      $item.removeClass('active').find('ul').hide();
    } else {
      $item.addClass('active').find('>a').addClass('active');
    }
  });
  $('.menu-section-folder > a').click(function () {
    var $folder = $(this).parent();
    var $folderContent = $folder.find('>ul');
    var $folderLinks = $folderContent.find('.menu-page-item > a');
    folder($folder, $folderContent).toggle();
    menuCurentLinkManger($folderLinks);
  });
  $('.menu-page-item > a').click(function () {
    var $folder = $(this).closest('.menu-section-folder');
    var $folderContent = $folder.find('>ul');
    var $folderLinks = $folderContent.find('.menu-page-item > a');
    menuCurentLinkManger($folderLinks);
  });

  function folder($folder, $folderContent) {
    var $animationDuration = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 200;
    return {
      folder: $folder,
      folderContent: $folderContent,
      animationDuration: $animationDuration,
      open: function open() {
        $folderContent.slideDown(this.animationDuration);
        $folder.addClass('active');
      },
      close: function close() {
        $folderContent.slideUp(this.animationDuration);
        $folder.removeClass('active');
      },
      toggle: function toggle() {
        $folderContent.slideToggle(this.animationDuration);
        $folder.toggleClass('active');
      }
    };
  }

  function menuCurentLinkManger($links) {
    $(document).ready(function () {
      $links.each(function (key, linkElem) {
        var $link = $(linkElem);
        var $href = $link.attr('href');
        var isCurent = curentURL() === $href;
        lastUrl = curentURL();

        if (!isCurent) {
          $link.removeClass('active');
        } else {
          $link.addClass('active');
        }
      });
    });
  }

  function menuCurentLinkObserver() {
    $(document).ready(function () {
      $('#sidebarMenu .menu-page-item a').each(function (key, linkElem) {
        var $link = $(linkElem);
        var $href = $link.attr('href');
        var isCurent = curentURL() === $href;
        console.log('curentURL()', curentURL());
        lastUrl = curentURL();

        if (!isCurent) {
          $link.removeClass('active');
        } else {
          $link.addClass('active');
        }
      });
    });
  }
})(jQuery);

/***/ }),

/***/ "./resources/js/api/Toast.js":
/*!***********************************!*\
  !*** ./resources/js/api/Toast.js ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports) {

(function ($) {
  toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": function onclick(event) {
      var $elem = $(event.target);
      var $closeBtn = $elem.closest('.toast').find(".".concat(this.closeClass));
      $closeBtn.click();
    },
    "showDuration": "100",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "500",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  };
})(jQuery);

/***/ }),

/***/ "./resources/js/apiClient.js":
/*!***********************************!*\
  !*** ./resources/js/apiClient.js ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! ./api/Toast */ "./resources/js/api/Toast.js");

__webpack_require__(/*! ./api/CopyInBufer */ "./resources/js/api/CopyInBufer.js");

__webpack_require__(/*! ./api/Ajax */ "./resources/js/api/Ajax.js");

__webpack_require__(/*! ./api/Menu */ "./resources/js/api/Menu.js");

/***/ }),

/***/ 1:
/*!*****************************************!*\
  !*** multi ./resources/js/apiClient.js ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\OpenServer\Projects\zrobleno\api\resources\js\apiClient.js */"./resources/js/apiClient.js");


/***/ })

/******/ });