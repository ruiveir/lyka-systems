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
/******/ 	return __webpack_require__(__webpack_require__.s = 31);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/documentos/add.js":
/*!****************************************!*\
  !*** ./resources/js/documentos/add.js ***!
  \****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  $(".needs-validation").on('submit', function (event) {
    if (event.currentTarget.checkValidity() === false) {
      event.preventDefault();
      event.stopPropagation();
    } else {
      $("#cancelBtn").removeAttr("onclick");
      button = "<button class='btn btn-primary' type='submit' disabled><span class='spinner-border spinner-border-sm' role='status' aria-hidden='true' style='position:relative; bottom:4px; right:3px;'></span>A fazer o registo...</button>";
      $("#groupBtn").append(button);
      $("#submitbtn").remove();
    }

    $(".needs-validation").addClass("was-validated");
  });
  var clones = $('#clonar').clone();
  $('#clonar').remove();

  function addCampo(closest) {
    var _this = this;

    var num = parseInt(closest.find('.num').first().text());
    var clone = clones.clone();
    closest.find('.num').first().text(num + 1);
    clone.attr('id', 'documento-campo' + num);
    $('#label1', clone).text("Nome do campo n.º" + num);
    $('#label1', clone).attr('for', 'nome-campo' + num);
    $('#input1', clone).attr('name', 'nome-campo' + num);
    $('#input1', clone).attr('id', 'nome-campo' + num);
    $('#label2', clone).text("Valor do campo n.º" + num);
    $('#label2', clone).attr('for', 'valor-campo' + num);
    $('#input2', clone).attr('name', 'valor-campo' + num);
    $('#input2', clone).attr('id', 'valor-campo' + num);
    $('#button', clone).on('click', function (event) {
      event.preventDefault();
      $('#nome-campo' + num).val(null);
      $('#valor-campo' + num).val(null);
      $("#nome-campo" + num).attr("required", false);
      $("#valor-campo" + num).attr("required", false);
      _this;
      $(event.currentTarget).closest("#documento-campo" + num).css("display", "none");
    });
    $('#button', clone).attr('id', 'javascript-button');
    $('#a_button', clone).text('Remover campo n.º' + num);
    closest.find('.list-clones').first().append(clone);
  } //Preview do Passporte+++++++++++++++


  $('#passport_preview_file').on('click', function (event) {
    event.preventDefault();
    $('#img_doc').trigger('click');
  });
  $('#doc_preview').on('click', function (event) {
    event.preventDefault();
    $('#img_doc').trigger('click');
  });

  function readPassaPortImgURL(input) {
    if (input.files && input.files[0]) {
      var iddocumento = new FileReader();

      iddocumento.onload = function () {
        iddocumento.fileName = img_doc.name;
        $('#name_doc_file').text(input.files[0].name);
      };

      iddocumento.readAsDataURL(input.files[0]);
    }
  }

  $("#img_doc").on('change', function (event) {
    readPassaPortImgURL(event.currentTarget);
    $('#passport_preview_file').hide();
    $('#doc_preview').show();
  });
});

/***/ }),

/***/ 31:
/*!**********************************************!*\
  !*** multi ./resources/js/documentos/add.js ***!
  \**********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/vagrant/code/resources/js/documentos/add.js */"./resources/js/documentos/add.js");


/***/ })

/******/ });