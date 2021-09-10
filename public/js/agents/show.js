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
/******/ 	return __webpack_require__(__webpack_require__.s = 7);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/agents/show.js":
/*!*************************************!*\
  !*** ./resources/js/agents/show.js ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var _this = this;

function strtrunc(str, max, add) {
  add = add || '...';
  return typeof str === 'string' && str.length > max ? str.substring(0, max) + add : str;
}

;
$(function () {
  $('#tableClientes').DataTable({
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
    "order": [1, 'asc']
  });
  $('#tableSubagentes').DataTable({
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
    "order": [0, 'asc']
  });
  $('#tableFinancas').DataTable({
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
  var options = [{
    "option": document.getElementById("subagentes-type-tab")
  }, {
    "option": document.getElementById("clients-tab")
  }, {
    "option": document.getElementById("documents-tab")
  }, {
    "option": document.getElementById("contacts-tab")
  }, {
    "option": document.getElementById("financas-tab")
  }];
  $("#subagentes-type-tab, #clients-tab, #documents-tab, #contacts-tab, #financas-tab").on('click', function (event) {
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
  $("#infoPrint").on('change', function () {
    $("#formPrintModal").removeClass("was-validated");
    value = $("#infoPrint").find(":selected").val();

    switch (value) {
      case "cobrancas":
        $(".custom-inputs").remove();
        input = "<div class='mt-3 custom-inputs'><label for='name'>Nome do estudante <sup class='text-danger small'>&#10033;</sup></label><select type='text' class='form-control custom-select' id='name' name='name' required></select><div class='invalid-feedback'>Oops, parece que algo não está bem...</div></div><div class='mt-3 custom-inputs'><label for='produto'>Produto <sup class='text-danger small'>&#10033;</sup></label><select type='text' class='form-control custom-select' id='produto' name='produto' required></select><div class='invalid-feedback'>Oops, parece que algo não está bem...</div></div>";
        $("#div-with-select").after(input);
        optionsNameSelected = "<option disabled selected hidden>Escolha um estudante...</option>";
        $("#name").append(optionsNameSelected);
        optionsProdutosSelected = "<option disabled selected hidden>Escolha um produto...</option>";
        $("#produto").append(optionsProdutosSelected);
        cloneCliente = $(".clients-options").clone().appendTo("#name");
        cloneCliente.removeAttr("hidden disabled");
        break;

      case "pagamentos":
        $(".custom-inputs").remove();
        input = "<div class='mt-3 custom-inputs'><label for='name'>Nome do estudante <sup class='text-danger small'>&#10033;</sup></label><select type='text' class='form-control custom-select' id='name' name='name' required></select><div class='invalid-feedback'>Oops, parece que algo não está bem...</div></div><div class='mt-3 custom-inputs'><label for='surname'>Produto <sup class='text-danger small'>&#10033;</sup></label><select type='text' class='form-control custom-select' id='produto' name='produto' required></select><div class='invalid-feedback'>Oops, parece que algo não está bem...</div></div>";
        $("#div-with-select").after(input);
        optionsNameSelected = "<option disabled selected hidden>Escolha um estudante...</option>";
        $("#name").append(optionsNameSelected);
        optionsProdutosSelected = "<option disabled selected hidden>Escolha um produto...</option>";
        $("#produto").append(optionsProdutosSelected);
        cloneCliente = $(".clients-options").clone().appendTo("#name");
        cloneCliente.removeAttr("hidden disabled");
        break;

      case "todos":
        $(".custom-inputs").remove();
        input = "<div class='mt-3 custom-inputs'><label for='name'>Nome do estudante <sup class='text-danger small'>&#10033;</sup></label><select type='text' class='form-control custom-select' id='name' name='name' required></select><div class='invalid-feedback'>Oops, parece que algo não está bem...</div></div><div class='mt-3 custom-inputs'><label for='surname'>Produto <sup class='text-danger small'>&#10033;</sup></label><select type='text' class='form-control custom-select' id='produto' name='produto' required></select><div class='invalid-feedback'>Oops, parece que algo não está bem...</div></div>";
        $("#div-with-select").after(input);
        optionsNameSelected = "<option disabled selected hidden>Escolha um estudante...</option>";
        $("#name").append(optionsNameSelected);
        optionsProdutosSelected = "<option disabled selected hidden>Escolha um produto...</option>";
        $("#produto").append(optionsProdutosSelected);
        cloneCliente = $(".clients-options").clone().appendTo("#name");
        cloneCliente.removeAttr("hidden disabled");
        break;

      default:
        $(".custom-inputs").remove();
        break;
    }

    $("#name").on('change', function () {
      select = $("#produto");
      info = {
        user: $("#name").find(":selected").val()
      };
      $.ajax({
        type: "post",
        url: "/agentes/procura-produto/" + agentId,
        context: _this,
        data: info,
        success: function success(data) {
          var htmlOptions = [];

          if (data.length) {
            for (item in data) {
              html = '<option value="' + data[item].idProduto + '">' + data[item].descricao + '</option>';
              htmlOptions[htmlOptions.length] = html;
            }

            selectedOption = "<option disabled selected hidden>Escolha um produto...</option>";
            select.empty().append(htmlOptions.join('')).prepend(selectedOption);
          } else {
            selectedOption = "<option disabled selected hidden>Escolha um produto...</option>";
            select.empty().prepend(selectedOption);
          }
        },
        error: function error() {
          alert("NOK");
        }
      });
    });
  });
  /**/

  $('#printModal').on('show.bs.modal', function (event) {
    $("#formPrintModal").removeClass("was-validated");
    $("#infoPrint").prepend("<option disabled selected hidden>Escolha uma informação...</option>");
    $(".custom-inputs").remove();
    var button = $(event.relatedTarget);
    var modal = $(this);
    modal.find("form").attr('action', '/agentes/imprimir-ficha-financeiro/' + button.data('slug'));
  });
});

/***/ }),

/***/ 7:
/*!*******************************************!*\
  !*** multi ./resources/js/agents/show.js ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/vagrant/code/resources/js/agents/show.js */"./resources/js/agents/show.js");


/***/ })

/******/ });