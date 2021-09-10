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
/******/ 	return __webpack_require__(__webpack_require__.s = 22);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/clients/search.js":
/*!****************************************!*\
  !*** ./resources/js/clients/search.js ***!
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
      },
      "pageLength": 50
    }
  }); // Modal for DELETE

  $('#deleteModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var modal = $(this);
    modal.find("form").attr('action', '/estudantes/' + button.data('slug'));
  });
  /* Variavel para permitir/negar pesquisa */

  var pesquisaOk = 1;
  /*  console.log('Inicial: '+pesquisaOk); */

  /* Inicialmente, esconde todos os DIV's dentro do div "searchfields", exepto "divPaisOrigem" */

  $('#searchfields div:not(#divPaisOrigem)').hide();
  /* Quando os dados da pesquisa são alterados */

  $('#searchfields :input').on('change', function () {
    if (pesquisaOk == 1) {
      pesquisaOk++;
    }
    /* console.log('searchFields: '+pesquisaOk); */

  });
  /* Quando os Campos da pesquisa são alterados */

  $('#search_options').on('change', function () {
    /* Pais de origem */
    if ($('#search_options').val() == "País de origem") {
      $('#searchfields div:not(#divPaisOrigem)').hide();
      $("#divPaisOrigem").show();
    }
    /* Cidade de origem */


    if ($('#search_options').val() == "Cidade de origem") {
      $('#searchfields div:not(#divCidade)').hide();
      $("#divCidade").show();
    }
    /* Instituição de origem */


    if ($('#search_options').val() == "Instituição de origem") {
      $('#searchfields div:not(#divInstituicaoOrigem)').hide();
      $("#divInstituicaoOrigem").show();
    }
    /* Agente */


    if ($('#search_options').val() == "Agente") {
      $('#searchfields div:not(#divAgents)').hide();
      $("#divAgents").show();
    }
    /* Universidade */


    if ($('#search_options').val() == "Universidade") {
      $('#searchfields div:not(#divUniversidades)').hide();
      $("#divUniversidades").show();
    }
    /* Nível de estudos */


    if ($('#search_options').val() == "Nível de estudos") {
      $('#searchfields div:not(#divNivelEstudos)').hide();
      $("#divNivelEstudos").show();
    }
    /* Estado de cliente */


    if ($('#search_options').val() == "Estado de cliente") {
      $('#searchfields div:not(#divEstadoCliente)').hide();
      $("#divEstadoCliente").show();
    }

    pesquisaOk = 1;
    /* console.log('Campos: '+pesquisaOk); */
  });
  /* Opções de campos visiveis na ListeningStateChangedEvent( checkbox) */

  var $chk = $("#grpChkBox input:checkbox");
  var $tbl = $("#dataTable");
  var $tblhead = $("#dataTable th");
  $chk.on('click', function (event) {
    var colToHide = $tblhead.filter("." + $(event.currentTarget).attr("name"));
    var index = $(colToHide).index();
    $tbl.find('tr :nth-child(' + (index + 1) + ')').not(".btn-outline-danger, .btn-outline-warning, .btn-outline-primary").toggle();
  });
  /* Verifica se os campos de pesquisa foram modificados. Se sim, permite a pesquisa */

  $("#searchForm").on('submit', function (event) {
    if (pesquisaOk >= 2) {
      /* mostrar div de espera */
      $("#wait_screen").show();
      return;
    }

    event.preventDefault();
  });
});

/***/ }),

/***/ 22:
/*!**********************************************!*\
  !*** multi ./resources/js/clients/search.js ***!
  \**********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/vagrant/code/resources/js/clients/search.js */"./resources/js/clients/search.js");


/***/ })

/******/ });