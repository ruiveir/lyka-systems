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
/******/ 	return __webpack_require__(__webpack_require__.s = 23);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/clients/show.js":
/*!**************************************!*\
  !*** ./resources/js/clients/show.js ***!
  \**************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// Truncate a string
function strtrunc(str, max, add) {
  add = add || '...';
  return typeof str === 'string' && str.length > max ? str.substring(0, max) + add : str;
}

;
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
    },
    "order": [[5, 'desc'], [4, 'asc']],
    "columnDefs": [{
      "targets": 4,
      "type": "date-eu"
    }, {
      'targets': [1, 2],
      'render': function render(data, type, full, meta) {
        if (type === 'display') {
          data = strtrunc(data, 12);
        }

        return data;
      }
    }]
  });
  $('#tableObs').DataTable({
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
  var options = [{
    "option": document.getElementById("produtos-tab")
  }, {
    "option": document.getElementById("documentation-tab")
  }, {
    "option": document.getElementById("academicos-tab")
  }, {
    "option": document.getElementById("contacts-tab")
  }, {
    "option": document.getElementById("financas-tab")
  }, {
    "option": document.getElementById("observations-tab")
  }];
  $("#produtos-tab, #documentation-tab, #academicos-tab, #contacts-tab, #financas-tab, #observations-tab").on('click', function (event) {
    for (var i = 0; i < options.length; i++) {
      if (event.currentTarget.id === options[i].option.id) {
        $(event.currentTarget).removeClass("bg-white").addClass("bg-primary text-white");
      } else {
        $(options[i].option).removeClass("bg-primary text-white").addClass("bg-white");
      }
    }
  });
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
  $('#printModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var modal = $(this);
    modal.find("form").attr('action', '/clientes/imprimir-ficha-financeiro/' + button.data('slug'));
  });
  $('#deleteObs').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var modal = $(this);
    modal.find("form").attr('action', '/clientes/observacoes-pessoais/' + button.data('slugobs') + '/' + button.data('slugcliente') + '/apagar');
  });
  $('#editObs').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var modal = $(this);
    modal.find("#titulo").val(button.data("titulo"));
    modal.find("#texto").val(button.data("texto"));
    modal.find("form").attr('action', '/clientes/observacoes-pessoais/' + button.data('slugobs') + '/' + button.data('slugcliente') + '/editar');
  });
  $("#submitPrint").on('click', function () {
    $('#printModal').modal('hide');
  });
});

/***/ }),

/***/ 23:
/*!********************************************!*\
  !*** multi ./resources/js/clients/show.js ***!
  \********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/vagrant/code/resources/js/clients/show.js */"./resources/js/clients/show.js");


/***/ })

/******/ });