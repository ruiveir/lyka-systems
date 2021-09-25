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
/******/ 	return __webpack_require__(__webpack_require__.s = 72);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/produtos/edit.js":
/*!***************************************!*\
  !*** ./resources/js/produtos/edit.js ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var utils = __webpack_require__(/*! ../utils.js */ "./resources/js/utils.js");

$(function () {
  $("#formulario-produto").css("display", "none");
  $("#formulario-fases").css("display", "none");
  $(".needs-validation").on('submit', function (event) {
    if (event.target.checkValidity() === false) {
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
  $('#add-fase-button').on('click', onAddNewFase);
  $('#myTabContent').on('click', '.fornecedor-add-button', onAddFornecedor);
  $('#myTabContent').on('click', '.fornecedor-del-button', onRemoverFornecedor);
  $('#cancel-button').on('click', function () {
    return window.history.back();
  });
});

function onAddNewFase(event) {
  numFase++;
  var newTab = utils.template('#template-fase-tab', {
    numFase: numFase
  });
  var newTabContent = utils.template('#template-fase', {
    numFase: numFase
  });
  $('#myTab').append(newTab);
  $('#myTabContent').append(newTabContent);
} //addFornecedor({{$num}},$(this).closest('.list-fornecedores'));


function onAddFornecedor(event) {
  numFornecedor++;
  var numFase = $(event.currentTarget).closest('.tab-pane').data('num');
  console.log(numFase, numFornecedor);
  var content = utils.template('#template-fornecedor', {
    numFase: numFase,
    numFornecedor: numFornecedor
  });
  $('.fornecedor:visible').append(content);
} //removerFornecedor({{$numF}},{{$fase->idFase}},$(this).closest('#div-fornecedor{{$numF}}-fase{{$fase->idFase}}'));


function onRemoverFornecedor(event) {
  var numF = 1;
  var idFase = 1;
  var fornecedor = 1;
  $('#fornecedor' + numF + '-fase' + idFase).val($('#fornecedor' + numF + '-fase' + idFase + ' > option:first').val());
  $("#fornecedor" + numF + "-fase" + idFase).attr("required", false);
  $("#valor-fornecedor" + numF + "-fase" + idFase).attr("required", false);
  fornecedor.css("display", "none");
}

function AlteraInputSubAgente(input) {
  var valueInput = input.val();

  if (valueInput) {
    $(".valor-responsabilidade-subagente").css("display", "block");
    $(".valor-responsabilidade-subagente").find(input).first().attr("required", true);
  } else {
    $(".valor-responsabilidade-subagente").css("display", "none");
    $(".valor-responsabilidade-subagente").find(input).first().attr("required", false);
  }
}

function adicionaValorSubAgente(valorAgente, formulario, valorTotal) {
  var inputAgente = formulario.find('.valor-pagar-agente').first();
  var inputSubAgente = formulario.find('.valor-pagar-subagente').first();
  var valorSubAgente = parseFloat(inputSubAgente.text());
  var novoValorAgente = valorTotal - valorSubAgente;

  if (novoValorAgente == 0) {
    inputAgente.text(0);
    inputSubAgente.text(valorAgente);
  } else {
    if (novoValorAgente < 0) {
      inputAgente.text(0);
      inputSubAgente.text(valorTotal);
    } else {
      inputAgente.text(novoValorAgente);
    }
  }
}

/***/ }),

/***/ "./resources/js/utils.js":
/*!*******************************!*\
  !*** ./resources/js/utils.js ***!
  \*******************************/
/*! no static exports found */
/***/ (function(module, exports) {

exports.template = function (queryString, parameters) {
  var template = $(queryString).html();

  for (var _i = 0, _Object$keys = Object.keys(parameters); _i < _Object$keys.length; _i++) {
    var key = _Object$keys[_i];
    template = template.replace(new RegExp('\\$\\{' + key + '\\}', 'g'), parameters[key]);
  }

  return $(template);
};

/***/ }),

/***/ 72:
/*!*********************************************!*\
  !*** multi ./resources/js/produtos/edit.js ***!
  \*********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/vagrant/code/resources/js/produtos/edit.js */"./resources/js/produtos/edit.js");


/***/ })

/******/ });