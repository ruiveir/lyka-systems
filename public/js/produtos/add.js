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
/******/ 	return __webpack_require__(__webpack_require__.s = 71);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/produtos/add.js":
/*!**************************************!*\
  !*** ./resources/js/produtos/add.js ***!
  \**************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var clones = $('#clonar').clone();
$('.fornecedor').html('');
$(function () {
  $(".needs-validation").on('submit', function (event) {
    if (event.currentTarget.checkValidity() === false) {
      event.preventDefault();
      event.stopPropagation();
    } else {
      $("#cancelBtn").removeAttr("onclick");
      button = "<button class='btn btn-primary' type='submit' disabled><span class='spinner-border spinner-border-sm' role='status' aria-hidden='true' style='position:relative; bottom:4px; right:3px;'></span>A enviar...</button>";
      $("#groupBtn").append(button);
      $("#submitbtn").remove();
    }

    $(".needs-validation").addClass("was-validated");
  });
});

function addFornecedor(idFase, closest) {
  var numF = parseInt(closest.find('.numF').first().text());
  var clone = clones.clone();
  var sup = "<sup class='text-danger small'>&#10033;</sup>";
  closest.find('.numF').first().text(numF + 1);
  clone.attr('id', 'div-fornecedor' + numF + '-fase' + idFase);
  $('#label1', clone).text("Fornecedor #" + numF);
  $('#label1', clone).append(" " + sup);
  $('#label1', clone).attr('for', 'fornecedor' + numF + '-fase' + idFase);
  $('select', clone).attr('id', 'fornecedor' + numF + '-fase' + idFase);
  $('select', clone).attr('name', 'fornecedor' + numF + '-fase' + idFase);
  $('#label2', clone).attr('for', 'valor-fornecedor' + numF + '-fase' + idFase);
  $('#valor-fornecedor-fase', clone).attr('name', 'valor-fornecedor' + numF + '-fase' + idFase);
  $('#valor-fornecedor-fase', clone).attr('id', 'valor-fornecedor' + numF + '-fase' + idFase);
  $('#label3', clone).text('Data de vencimento (Fornecedor #' + numF + ")");
  $('#label3', clone).attr('for', 'data-fornecedor' + numF + '-fase' + idFase);
  $('#data-fornecedor-fase', clone).attr('name', 'data-fornecedor' + numF + '-fase' + idFase);
  $('#data-fornecedor-fase', clone).attr('id', 'data-fornecedor' + numF + '-fase' + idFase);
  $('#button', clone).attr('onclick', 'removerFornecedor(' + numF + ',' + idFase + ',$(this).closest("#div-fornecedor' + numF + '-fase' + idFase + '"))');
  $('#a_button', clone).text('Remover fornecedor #' + numF);
  closest.find('.fornecedor').first().append(clone);
}

function removerFornecedor(numF, idFase, fornecedor) {
  $('#fornecedor' + numF + '-fase' + idFase).val($('#fornecedor' + numF + '-fase' + idFase + ' > option:first').val());
  $("#fornecedor" + numF + "-fase" + idFase).attr("required", false);
  $("#valor-fornecedor" + numF + "-fase" + idFase).attr("required", false);
  fornecedor.css("display", "none");
}

/***/ }),

/***/ 71:
/*!********************************************!*\
  !*** multi ./resources/js/produtos/add.js ***!
  \********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/vagrant/code/resources/js/produtos/add.js */"./resources/js/produtos/add.js");


/***/ })

/******/ });