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
/******/ 	return __webpack_require__(__webpack_require__.s = 8);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/auth/activate-account.js":
/*!***********************************************!*\
  !*** ./resources/js/auth/activate-account.js ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  $("#code").on('change', function () {
    $("#code").removeClass("is-invalid");
  }); // Auth Key Form

  $('#form').on('submit', function (event) {
    event.preventDefault();
    info = {
      code: $("#code").val()
    };
    $.ajax({
      type: "post",
      url: '/ativacao-conta/' + targetUserId + '/confirmar-chave',
      context: event.currentTarget,
      data: info,
      success: function success(data) {
        $("#form").addClass("was-validated");
        $("#form").remove();
        $("#title > p").text("Insira uma password que contenha, pelo menos, 8 caracteres, uma letra maiúscula, uma minúscula e um número.");
        $("#passform").css("display", "block");
      },
      error: function error() {
        $("#code").addClass("is-invalid");
      }
    });
  });
  $("#password").on('change', function () {
    regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/;

    if (!regex.test($("#password").val())) {
      $("#password").removeClass("is-valid");
      $("#password").addClass("is-invalid");
    } else {
      $("#password").removeClass("is-invalid");
      $("#password").addClass("is-valid");
    }

    if ($("#password").val() == "") {
      $("#password").removeClass("is-invalid is-valid");
    }
  });
  $("#passwordconf").on('change', function () {
    if ($("#passwordconf").val() == $("#password").val()) {
      $("#passwordconf").removeClass("is-invalid");
      $("#passwordconf").addClass("is-valid");
    } else {
      $("#passwordconf").removeClass("is-valid");
      $("#passwordconf").addClass("is-invalid");
    }

    if ($("#passwordconf").val() == "") {
      $("#passwordconf").removeClass("is-invalid is-valid");
    }
  }); // Password change form

  $('#passform').on('submit', function (event) {
    event.preventDefault();
    info = {
      password: $("#password").val(),
      passwordconf: $("#passwordconf").val()
    };

    if (info["password"] != info["passwordconf"]) {
      $("#passwordconf").addClass("is-invalid");
    } else {
      $("#passform").addClass("was-validated");
      $.ajax({
        type: "PUT",
        url: '/ativacao-conta/' + targetUserId + '/confirmar-password',
        context: event.currentTarget,
        data: info,
        success: function success(data) {
          $("#infoModal").modal("show");
        },
        error: function error() {
          console.log("ERROR");
        }
      });
    }
  });
});

/***/ }),

/***/ 8:
/*!*****************************************************!*\
  !*** multi ./resources/js/auth/activate-account.js ***!
  \*****************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/vagrant/code/resources/js/auth/activate-account.js */"./resources/js/auth/activate-account.js");


/***/ })

/******/ });