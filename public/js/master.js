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
/******/ 	return __webpack_require__(__webpack_require__.s = 42);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./node_modules/bs-custom-file-input/dist/bs-custom-file-input.js":
/*!************************************************************************!*\
  !*** ./node_modules/bs-custom-file-input/dist/bs-custom-file-input.js ***!
  \************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/*!
 * bsCustomFileInput v1.3.4 (https://github.com/Johann-S/bs-custom-file-input)
 * Copyright 2018 - 2020 Johann-S <johann.servoire@gmail.com>
 * Licensed under MIT (https://github.com/Johann-S/bs-custom-file-input/blob/master/LICENSE)
 */
(function (global, factory) {
   true ? module.exports = factory() :
  undefined;
}(this, (function () { 'use strict';

  var Selector = {
    CUSTOMFILE: '.custom-file input[type="file"]',
    CUSTOMFILELABEL: '.custom-file-label',
    FORM: 'form',
    INPUT: 'input'
  };

  var textNodeType = 3;

  var getDefaultText = function getDefaultText(input) {
    var defaultText = '';
    var label = input.parentNode.querySelector(Selector.CUSTOMFILELABEL);

    if (label) {
      defaultText = label.textContent;
    }

    return defaultText;
  };

  var findFirstChildNode = function findFirstChildNode(element) {
    if (element.childNodes.length > 0) {
      var childNodes = [].slice.call(element.childNodes);

      for (var i = 0; i < childNodes.length; i++) {
        var node = childNodes[i];

        if (node.nodeType !== textNodeType) {
          return node;
        }
      }
    }

    return element;
  };

  var restoreDefaultText = function restoreDefaultText(input) {
    var defaultText = input.bsCustomFileInput.defaultText;
    var label = input.parentNode.querySelector(Selector.CUSTOMFILELABEL);

    if (label) {
      var element = findFirstChildNode(label);
      element.textContent = defaultText;
    }
  };

  var fileApi = !!window.File;
  var FAKE_PATH = 'fakepath';
  var FAKE_PATH_SEPARATOR = '\\';

  var getSelectedFiles = function getSelectedFiles(input) {
    if (input.hasAttribute('multiple') && fileApi) {
      return [].slice.call(input.files).map(function (file) {
        return file.name;
      }).join(', ');
    }

    if (input.value.indexOf(FAKE_PATH) !== -1) {
      var splittedValue = input.value.split(FAKE_PATH_SEPARATOR);
      return splittedValue[splittedValue.length - 1];
    }

    return input.value;
  };

  function handleInputChange() {
    var label = this.parentNode.querySelector(Selector.CUSTOMFILELABEL);

    if (label) {
      var element = findFirstChildNode(label);
      var inputValue = getSelectedFiles(this);

      if (inputValue.length) {
        element.textContent = inputValue;
      } else {
        restoreDefaultText(this);
      }
    }
  }

  function handleFormReset() {
    var customFileList = [].slice.call(this.querySelectorAll(Selector.INPUT)).filter(function (input) {
      return !!input.bsCustomFileInput;
    });

    for (var i = 0, len = customFileList.length; i < len; i++) {
      restoreDefaultText(customFileList[i]);
    }
  }

  var customProperty = 'bsCustomFileInput';
  var Event = {
    FORMRESET: 'reset',
    INPUTCHANGE: 'change'
  };
  var bsCustomFileInput = {
    init: function init(inputSelector, formSelector) {
      if (inputSelector === void 0) {
        inputSelector = Selector.CUSTOMFILE;
      }

      if (formSelector === void 0) {
        formSelector = Selector.FORM;
      }

      var customFileInputList = [].slice.call(document.querySelectorAll(inputSelector));
      var formList = [].slice.call(document.querySelectorAll(formSelector));

      for (var i = 0, len = customFileInputList.length; i < len; i++) {
        var input = customFileInputList[i];
        Object.defineProperty(input, customProperty, {
          value: {
            defaultText: getDefaultText(input)
          },
          writable: true
        });
        handleInputChange.call(input);
        input.addEventListener(Event.INPUTCHANGE, handleInputChange);
      }

      for (var _i = 0, _len = formList.length; _i < _len; _i++) {
        formList[_i].addEventListener(Event.FORMRESET, handleFormReset);

        Object.defineProperty(formList[_i], customProperty, {
          value: true,
          writable: true
        });
      }
    },
    destroy: function destroy() {
      var formList = [].slice.call(document.querySelectorAll(Selector.FORM)).filter(function (form) {
        return !!form.bsCustomFileInput;
      });
      var customFileInputList = [].slice.call(document.querySelectorAll(Selector.INPUT)).filter(function (input) {
        return !!input.bsCustomFileInput;
      });

      for (var i = 0, len = customFileInputList.length; i < len; i++) {
        var input = customFileInputList[i];
        restoreDefaultText(input);
        input[customProperty] = undefined;
        input.removeEventListener(Event.INPUTCHANGE, handleInputChange);
      }

      for (var _i2 = 0, _len2 = formList.length; _i2 < _len2; _i2++) {
        formList[_i2].removeEventListener(Event.FORMRESET, handleFormReset);

        formList[_i2][customProperty] = undefined;
      }
    }
  };

  return bsCustomFileInput;

})));
//# sourceMappingURL=bs-custom-file-input.js.map


/***/ }),

/***/ "./resources/js/master.js":
/*!********************************!*\
  !*** ./resources/js/master.js ***!
  \********************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var bsCustomFileInput = __webpack_require__(/*! bs-custom-file-input */ "./node_modules/bs-custom-file-input/dist/bs-custom-file-input.js");

$(function () {
  bsCustomFileInput.init();
  var table = $('#table-contactos').DataTable({
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
    searching: false,
    paging: false
  });
  $("#procurar-contactos").on('click', function (event) {
    event.preventDefault();
    $(".custom-inputs").remove();
    $('#div-table-contactos').addClass("d-none");
    $("#form-contact").removeClass("was-validated");
    $('#modalContacts').modal('show');
    $("#user-type").prepend("<option disabled hidden selected>Escolher tipo de utilizador</option>");
  });
  $("#user-type").on('change', function () {
    $("#form-contact").removeClass("was-validated");
    value = $("#user-type").find(":selected").val();

    switch (value) {
      case "clientes":
        $(".custom-inputs").remove();
        input = "<div class='col-md-4 custom-inputs'><label for='name'>Nome do cliente <sup class='text-danger small'>&#10033;</sup></label><input type='text' class='form-control' id='name' name='name' placeholder='Inserir um nome...' required><div class='invalid-feedback'>Oops, parece que algo não está bem...</div></div><div class='col-md-4 custom-inputs'><label for='surname'>Apelido do cliente</label><input type='text' class='form-control' id='surname' name='surname' placeholder='Inserir um apelido...'></div>";
        $("#contactos-form-row").append(input);
        break;

      case "agentes":
        $(".custom-inputs").remove();
        input = "<div class='col-md-4 custom-inputs'><label for='name'>Nome do agente <sup class='text-danger small'>&#10033;</sup></label><input type='text' class='form-control' id='name' name='name' placeholder='Inserir um nome...' required><div class='invalid-feedback'>Oops, parece que algo não está bem...</div></div><div class='col-md-4 custom-inputs'><label for='surname'>Apelido do agente</label><input type='text' class='form-control' id='surname' name='surname' placeholder='Inserir um apelido...'></div>";
        $("#contactos-form-row").append(input);
        break;

      case "universidades":
        $(".custom-inputs").remove();
        input = "<div class='col-md-8 custom-inputs'><label for='name'>Nome da universidade <sup class='text-danger small'>&#10033;</sup></label><input type='text' class='form-control' id='name' name='name' placeholder='Inserir um nome...' required><div class='invalid-feedback'>Oops, parece que algo não está bem...</div></div>";
        $("#contactos-form-row").append(input);
        break;

      case "fornecedores":
        $(".custom-inputs").remove();
        input = "<div class='col-md-8 custom-inputs'><label for='name'>Nome do fornecedor <sup class='text-danger small'>&#10033;</sup></label><input type='text' class='form-control' id='name' name='name' placeholder='Inserir um nome...' required><div class='invalid-feedback'>Oops, parece que algo não está bem...</div></div>";
        $("#contactos-form-row").append(input);
        break;

      default:
        $(".custom-inputs").remove();
        break;
    }
  });
  $('#form-contact').on('submit', function (event) {
    if (event.currentTarget.checkValidity() === false) {
      event.preventDefault();
      event.stopPropagation();
    } else {
      event.preventDefault();
      button = "<button class='btn btn-primary' type='submit' disabled id='spin-button'><span class='spinner-border spinner-border-sm' role='status' aria-hidden='true' style='position:relative; bottom:4px; right:3px;'></span>A procurar contacto...</button>";
      $("#groupBtn").append(button);
      $("#submitbtn").addClass("d-none");
      info = {
        user: $("#user-type").find(":selected").val(),
        name: $("#name").val(),
        surname: $("#surname").val()
      };
      $.ajax({
        type: "post",
        url: "/procurar-contacto",
        context: event.currentTarget,
        data: info,
        success: function success(data) {
          $("#submitbtn").removeClass("d-none");
          $("#spin-button").remove();
          table.clear().draw();
          user = $("#user-type").find(":selected").val();

          switch (user) {
            case 'clientes':
              for (var i = 0; i < data.length; i++) {
                table.row.add([data[i].nome + ' ' + data[i].apelido, data[i].email, data[i].telefone1]).draw();
                $('#div-table-contactos').removeClass("d-none");
              }

              break;

            case 'agentes':
              for (var i = 0; i < data.length; i++) {
                table.row.add([data[i].nome + ' ' + data[i].apelido, data[i].email, data[i].telefone1]).draw();
                $('#div-table-contactos').removeClass("d-none");
              }

              break;

            case 'universidades':
              for (var i = 0; i < data.length; i++) {
                table.row.add([data[i].nome, data[i].email, data[i].telefone]).draw();
                $('#div-table-contactos').removeClass("d-none");
              }

              break;

            case 'fornecedores':
              for (var i = 0; i < data.length; i++) {
                table.row.add([data[i].nome, "N/A", data[i].contacto]).draw();
                $('#div-table-contactos').removeClass("d-none");
              }

              break;
          }
        },
        error: function error(_error) {
          if (_error.status == 404) {
            $("#submitbtn").removeClass("d-none");
            $("#spin-button").remove();
            table.clear().draw();
            $('#div-table-contactos').removeClass("d-none");
          }
        }
      });
    }

    $("#form-contact").addClass("was-validated");
  });

  if (document.referrer.indexOf(window.location.host) != -1) {
    $("#previousButton").removeClass("bg-gray-400");
    $("#previousButton").addClass("bg-gray-600");
  }

  $("#previousButton").on('click', function (event) {
    if (document.referrer.indexOf(window.location.host) != -1) {
      history.go(-1);
    } else {
      event.preventDefault();
      return false;
    }
  });
  $("#forwardButton").on('click', function () {
    window.history.forward();
  });
});

/***/ }),

/***/ 42:
/*!**************************************!*\
  !*** multi ./resources/js/master.js ***!
  \**************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/vagrant/code/resources/js/master.js */"./resources/js/master.js");


/***/ })

/******/ });