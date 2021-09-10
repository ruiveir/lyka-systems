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
/******/ 	return __webpack_require__(__webpack_require__.s = 40);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/library.js":
/*!*********************************!*\
  !*** ./resources/js/library.js ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  var _this = this;

  /* OPÇÃO DE APAGAR */
  var formToSubmit; //Variavel para indicar o forumulário a submeter

  $(".form_file_id").on('submit', function (e) {
    e.preventDefault();
    formToSubmit = _this;
    $("#deletefile_name").text($(_this).attr("data"));
    return false;
  }); //click sim na modal

  $(".btn_submit").on('click', function () {
    formToSubmit.submit();
  });
  /* Verificação inicial: Existe Ficheiro? */

  /* SE EXISTE */

  if ($("#file_name").val() != '') {
    $("#div_nofile").hide();
    $("#add_file").hide();
    $("#replace_file").show();
    $("#div_propriedades").show();
    /* SE NÃO EXISTE */
  } else {
    $("#div_nofile").show();
    $("#add_file").show();
    $("#replace_file").hide();
    $("#div_propriedades").hide();
  }
  /* Clique no file input */


  $('#add_file , #replace_file').on('click', function (e) {
    e.preventDefault();
    $('#ficheiro').trigger('click');
  });
  /* Lê o ficheiro */

  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
        $("#add_file").hide();
        $("#replace_file").show();
        $("#div_nofile").hide();
        $("#div_propriedades").show();
        var str = input.files[0].name;
        str = str.split('.').slice(0, -1).join('.');
        /* remove a extensão nome do ficheiro*/

        str = str.replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '-');
        /* remove caracteres especiais do nome*/

        str = str.substring(0, 15);
        /* limita o nome a 15 caracteres */

        $('#file_name').val(str);
        $('#aux_file_name').text(input.files[0].name);
        $('#aux_file_name').val(input.files[0].name);
        $('#info_fileType').text(input.files[0].type);
        $('#tipo').val(input.files[0].type);
        $('#info_fileSize').text(formatBytes(input.files[0].size));
        $('#tamanho').val(formatBytes(input.files[0].size));
        $('#descricao').focus();
        $('#file_frame').removeClass("border-danger");
        $('#warning-file').hide();
      };

      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#ficheiro").on('change', function () {
    readURL(_this);
  });
  /* Converte Tamanho de ficheiro */

  function formatBytes(bytes) {
    var decimals = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 2;
    if (bytes === 0) return '0 Bytes';
    var k = 1024;
    var dm = decimals < 0 ? 0 : decimals;
    var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
    var i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
  }
  /* Formata a data de modificação do ficheiro */


  function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();
    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;
    return [day, month, year].join(' / ');
  }
  /* VALIDAÇÃO DO FORMULÁRIO */


  (function () {
    'use strict';

    window.addEventListener('load', function () {
      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.getElementsByClassName('needs-validation'); // Loop over them and prevent submission

      var validation = Array.prototype.filter.call(forms, function (form) {
        form.addEventListener('submit', function (event) {
          /* mostrar div de espera */
          $("#wait_screen").show();

          if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();

            if ($('#aux_file_name').val() == "") {
              $("#wait_screen").hide();
              $('#file_frame').addClass("border-danger");
              $('#warning-file').show();
              return;
            }
            /* É obrigatório ter uma descrição */


            if ($("#descricao").val() == "") {
              $("#wait_screen").hide();
              $("#descricao").addClass("is-invalid");
              $("#descricao").addClass(":invalid");
              $('#descricao').focus();
              return;
            }
          }

          form.classList.add('was-validated');
        }, false);
      });
    }, false);
  })();
});

/***/ }),

/***/ 40:
/*!***************************************!*\
  !*** multi ./resources/js/library.js ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/vagrant/code/resources/js/library.js */"./resources/js/library.js");


/***/ })

/******/ });