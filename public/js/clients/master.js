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
/******/ 	return __webpack_require__(__webpack_require__.s = 21);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/clients/master.js":
/*!****************************************!*\
  !*** ./resources/js/clients/master.js ***!
  \****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  /* Definir passaportPaisEmi */
  var str_passaportPaisEmi = $("#hidden_passaportPaisEmi").val();
  $('#passaportPaisEmi').val(str_passaportPaisEmi); //Preview da fotografia++++++++++++++++++

  $('#preview').on('click', function (event) {
    event.preventDefault();
    $('#fotografia').trigger('click');
  });

  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function () {
        $('#preview').attr('src', e.target.result);
      };

      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#fotografia").on('change', function (event) {
    readURL(event.currentTarget);
  }); //Preview do DOCUMENTO DE IDENTIFICAÇÃO+++++++++++++++

  $('#doc_id_preview_file').on('click', function (event) {
    event.preventDefault();
    $('#img_docOficial').trigger('click');
  });
  $('#doc_id_preview').on('click', function (event) {
    event.preventDefault();
    $('#img_docOficial').trigger('click');
  });

  function readDocImgURL(input) {
    if (input.files && input.files[0]) {
      var iddocumento = new FileReader();

      iddocumento.onload = function () {
        iddocumento.fileName = img_docOficial.name;
        $('#name_doc_id_file').text(input.files[0].name);
      };

      iddocumento.readAsDataURL(input.files[0]);
    }
  }

  $("#img_docOficial").on('change', function (event) {
    readDocImgURL(event.currentTarget);
    $('#doc_id_preview_file').hide();
    $('#doc_id_preview').show();
  }); //Preview do Passporte+++++++++++++++

  $('#passport_preview_file').on('click', function (event) {
    event.preventDefault();
    $('#img_Passaporte').trigger('click');
  });
  $('#passporte_preview').on('click', function (event) {
    event.preventDefault();
    $('#img_Passaporte').trigger('click');
  });

  function readPassaPortImgURL(input) {
    if (input.files && input.files[0]) {
      var iddocumento = new FileReader();

      iddocumento.onload = function () {
        iddocumento.fileName = img_Passaporte.name;
        $('#name_passaporte_file').text(input.files[0].name);
      };

      iddocumento.readAsDataURL(input.files[0]);
    }
  }

  $("#img_Passaporte").on('change', function (event) {
    readPassaPortImgURL(event.currentTarget);
    $('#passport_preview_file').hide();
    $('#passporte_preview').show();
  });

  if ($('#editavel').length) {
    if ($('#editavel').val().length <= 1) {
      $('#editavel').val("1");
    }
  }
  /* OPÇÃO DE APAGAR */


  var formToSubmit;
  $(".form_client_id").on('submit', function (event) {
    event.preventDefault();
    formToSubmit = event.currentTarget;
    $("#student_name").text($(event.currentTarget).attr("data"));
    return false;
  }); //click sim na modal

  $(".btn_submit").on('click', function () {
    formToSubmit.submit();
  });
  /* VALIDAÇÃO DE INPUTS */

  if ($('#nome').length) {
    /* Apenas letras:  .lettersOnly();  */
    $("#nome").lettersOnly();
    $("#apelido").lettersOnly();
    $("#cidadeInstituicaoOrigem").lettersOnly();
    $("#nomePai").lettersOnly();
    $("#nomeMae").lettersOnly();
    $("#localEmissaoPP").lettersOnly();
    /* Apenas numeros:  .numbersOnly();  */

    $("#telefone1").numbersOnly();
    $("#telefone2").numbersOnly();
    $("#telefonePai").numbersOnly();
    $("#telefoneMae").numbersOnly();
    /*$("#num_docOficial").numbersOnly();
    $("#numPassaporte").numbersOnly();
    $("#IBAN").numbersOnly(); */

    $("#NIF").numbersOnly();
  }
  /* Quando um input é modificado remove a validação do bootstrap */


  $("input, select").on('change', function (event) {
    $(event.currentTarget).removeClass("is-invalid");
  });
  $('#form_client').on('submit', function () {
    $("#wait_screen").show();
    var validated = true;
    /* Campo do nome */

    if ($("#nome").val() == "") {
      $("#wait_screen").hide();
      $("#nome").addClass("is-invalid");
      $("#pessoal-tab").addClass("border-danger");
      $("#pessoal-tab").css("color", "#e74a3b");
      $("#warning_msg").show();
      validated = false;
    } else {
      /* $("#pessoal-tab").removeClass("border-danger text-danger"); */
      $("#nome").removeClass("is-invalid");
    }
    /* Campo do apelido */


    if ($("#apelido").val() == "") {
      $("#wait_screen").hide();
      $("#apelido").addClass("is-invalid");
      $("#pessoal-tab").addClass("border-danger");
      $("#pessoal-tab").css("color", "#e74a3b");
      $("#warning_msg").show();
      validated = false;
    } else {
      /* $("#pessoal-tab").removeClass("border-danger text-danger"); */
      $("#apelido").removeClass("is-invalid");
    }
    /* Campo do genero */


    if ($("#genero").val() == "") {
      $("#wait_screen").hide();
      $("#genero").addClass("is-invalid");
      $("#pessoal-tab").css("color", "#e74a3b");
      $("#pessoal-tab").addClass("border-danger");
      $("#warning_msg").show();
      validated = false;
    } else {
      /* $("#pessoal-tab").removeClass("border-danger text-danger"); */
      $("#genero").removeClass("is-invalid");
    }
    /* Campo do paisNaturalidade */


    if ($("#paisNaturalidade").val() == "") {
      $("#wait_screen").hide();
      $("#paisNaturalidade").addClass("is-invalid");
      $("#pessoal-tab").addClass("border-danger");
      $("#pessoal-tab").css("color", "#e74a3b");
      $("#warning_msg").show();
      validated = false;
    } else {
      /* $("#pessoal-tab").removeClass("border-danger text-danger"); */
      $("#paisNaturalidade").removeClass("is-invalid");
    }

    if ($("#nome").val() != "" && $("#apelido").val() != "" && $("#paisNaturalidade").val() != "" && $("#genero").val() != "") {
      $("#pessoal-tab").removeClass("border-danger text-danger");
    }

    if (validated == true) {
      return true;
    } else {
      $("#wait_screen").hide();
      window.scrollTo(0, 0);
      return false;
    }
  });
});

/***/ }),

/***/ 21:
/*!**********************************************!*\
  !*** multi ./resources/js/clients/master.js ***!
  \**********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/vagrant/code/resources/js/clients/master.js */"./resources/js/clients/master.js");


/***/ })

/******/ });