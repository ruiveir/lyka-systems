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
/******/ 	return __webpack_require__(__webpack_require__.s = 41);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/listagens/list.js":
/*!****************************************!*\
  !*** ./resources/js/listagens/list.js ***!
  \****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  $('#table').DataTable({
    "language": {
      "sEmptyTable": "Não foi encontrado nenhum registo",
      "sLoadingRecords": "A carregar...",
      "sProcessing": "A processar...",
      "sLengthMenu": "Mostrar _MENU_ registos",
      "sZeroRecords": "Não foram encontrados resultados",
      "sInfo": "Mostrando _END_ de _TOTAL_ registos",
      "sInfoEmpty": "Mostrando de 0 de 0 registos",
      "sInfoFiltered": "(filtrado de _MAX_ registos no total)",
      "sInfoPostFix": "",
      "sSearch": "Procurar:",
      "sUrl": "",
      "oPaginate": {
        "sFirst": "Primeiro",
        "sPrevious": "Anterior",
        "sNext": "Seguinte",
        "sLast": "Último"
      },
      "oAria": {
        "sSortAscending": ": Ordenar colunas de forma ascendente",
        "sSortDescending": ": Ordenar colunas de forma descendente"
      }
    }
  });
  var clone = $('#clonar').clone();
  $('#clonar').remove();
  var clonecity = $('#clonecity').clone();
  $('#clonecity').remove();
});

function GetCountries() {
  GetList();
  $('.butCity').children('option:not(:first)').remove();
  var pais = null;

  if ($('#pais').val() != "null") {
    pais = $('#pais').val();
  }

  if (pais) {
    $('.butCity').attr("readonly", false);
    var link = '/../api/listagem/cidades/' + pais;
    $.ajax({
      method: "GET",
      url: link
    }).done(function (response) {
      if (response != null) {
        for (i = 0; i < response.results.length; i++) {
          var CloneCidade = clonecity.clone();
          $(CloneCidade).text(response.results[i]);
          $(CloneCidade).attr(response.results[i]);
          $('.butCity').append(CloneCidade);
        }
      }
    });
  } else {
    $('.butCity').attr("readonly", true);
  }
}

function GetList() {
  $('#table-body').html("");
  var lista = null;

  if ($('#pais').val() != "null") {
    lista = "pais-" + $('#pais').val();
  } else {
    lista = "pais-null";
  }

  if ($('#cidade').val() != "null") {
    lista += "_cidade-" + $('#cidade').val();
  } else {
    lista += "_cidade-null";
  }

  if ($('#agente').val() != "null") {
    lista += "_agente-" + $('#agente').val();
  } else {
    lista += "_agente-null";
  }

  if ($('#subagente').val() != "null") {
    lista += "_subagente-" + $('#subagente').val();
  } else {
    lista += "_subagente-null";
  }

  if ($('#universidade').val() != "null") {
    lista += "_universidade-" + $('#universidade').val();
  } else {
    lista += "_universidade-null";
  }

  if ($('#curso').val() != "null") {
    lista += "_curso-" + $('#curso').val();
  } else {
    lista += "_curso-null";
  }

  if ($('#institutoOrigem').val() != "null") {
    lista += "_institutoOrigem-" + $('#institutoOrigem').val();
  } else {
    lista += "_institutoOrigem-null";
  }

  if ($('#atividade').val() != "null") {
    lista += "_atividade-" + $('#atividade').val();
  } else {
    lista += "_atividade-null";
  }

  var link = '/../api/listagem/' + lista;
  $.ajax({
    method: "GET",
    url: link
  }).done(function (response) {
    if (response != null) {
      for (i = 0; i < response.results.length; i++) {
        var resultClone = clone.clone();
        $('.routa-show', resultClone).attr('href', "clientes/" + response.results[i].slug);
        $('.routa-show', resultClone).text(response.results[i].nome + " " + response.results[i].apelido);
        $('.numPassaporte', resultClone).text(response.results[i].numPassaporte);
        $('.paisNaturalidade', resultClone).text(response.results[i].paisNaturalidade);

        if (response.results[i].estado == "Inativo") {
          $('.span-estado', resultClone).text('Inativo');
          $('.span-estado', resultClone).attr('class', 'span-estado text-danger');
        } else {
          if (response.results[i].estado == "Ativo") {
            $('.span-estado', resultClone).text('Ativo');
            $('.span-estado', resultClone).attr('class', 'span-estado text-success');
          } else {
            $('.span-estado', resultClone).text('Proponente');
            $('.span-estado', resultClone).attr('class', 'span-estado text-info');
          }
        }

        $('.butao-show', resultClone).attr('href', "clientes/" + response.results[i].slug);
        $('#table-body').append(resultClone);
      }
    }
  });
}

/***/ }),

/***/ 41:
/*!**********************************************!*\
  !*** multi ./resources/js/listagens/list.js ***!
  \**********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/vagrant/code/resources/js/listagens/list.js */"./resources/js/listagens/list.js");


/***/ })

/******/ });