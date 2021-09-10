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
/******/ 	return __webpack_require__(__webpack_require__.s = 48);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/old/agent.js":
/*!***********************************!*\
  !*** ./resources/js/old/agent.js ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports) {

var _this = this;

$(function () {
  /* Definir pais */
  var str_pais = $("#hidden_pais").val();
  $('#pais').val(str_pais);
  /* Definiçao inicial: É exeçao ? */

  if ($('#exepcao').val() == 1) {
    $('#checkbox_exepcao').prop('checked', true);
  } else {
    $('#checkbox_exepcao').prop('checked', false);
  }
  /* mudança de estado */


  $('#checkbox_exepcao').on('change', function () {
    $('#exepcao').val($(_this).is(":checked") ? 1 : 0);
  }); //Preview da fotografia

  /*         $('#search_btn').on('click', function (e) {
              e.preventDefault();
              $('#fotografia').trigger('click');
          }); */

  $('#preview').on('click', function (e) {
    e.preventDefault();
    $('#fotografia').trigger('click');
  });

  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
        $('#preview').attr('src', e.target.result);
      };

      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#fotografia").on('change', function () {
    readURL(_this);
  }); //Documento de identificação

  $('#doc_preview_file').on('click', function (e) {
    e.preventDefault();
    $('#img_doc').trigger('click');
  });
  $('#doc_preview').on('click', function (e) {
    e.preventDefault();
    $('#img_doc').trigger('click');
  });

  function readDocURL(input) {
    if (input.files && input.files[0]) {
      var documento = new FileReader();

      documento.onload = function (e) {
        $('#name_id_file').text(input.files[0].name);
      };

      documento.readAsDataURL(input.files[0]);
    }
  }

  $("#img_doc").on('change', function () {
    readDocURL(_this);
    $('#doc_preview_file').hide();
    $('#doc_preview').show();
  });
  /* OPÇÃO DE APAGAR */

  var formToSubmit; //Variavel para indicar o forumulário a submeter

  $(".form_agent_id").on('submit', function (e) {
    e.preventDefault();
    formToSubmit = _this;
    $("#agent_name").text($(_this).attr("data"));
    return false;
  }); //click sim na modal

  $(".btn_submit").click(function (e) {
    formToSubmit.submit();
  });
  /* VALIDAÇÃO DE INPUTS */

  if ($('#nome').length) {
    /* Apenas letras:  .lettersOnly();  */
    $("#nome").lettersOnly();
    $("#apelido").lettersOnly();
    /* Apenas numeros:  .numbersOnly();  */

    $("#telefone1").numbersOnly();
    $("#telefone2").numbersOnly();
    $("#NIF").numbersOnly();
  }
  /* Verificação inicial */


  if ($("#aux_idAgenteAssociado").val() != "") {
    $("#idAgenteAssociado").val($("#aux_idAgenteAssociado").val());
    $("#div_subagente").show();
    $("#div_execao").show();
  }

  if ($("#tipo").val() == "Agente") {
    $("#div_subagente").hide();
    $("#div_execao").hide();
    $("#idAgenteAssociado").prop("disabled", true);
    $("#idAgenteAssociado").val(null);
    $("#div_infos_agente").show();
    $("#div_infos_subagente").hide();
  } else {
    $("#div_infos_agente").hide();
    $("#div_infos_subagente").show();
  }
  /* mudança de tipo de agente */


  $('#tipo').on('change', function () {
    if ($("#tipo").val() == "Subagente") {
      $("#div_subagente").show();
      $("#div_execao").show();
      $("#div_infos_subagente").show();
      $("#div_infos_agente").hide();
      $("#idAgenteAssociado").prop("disabled", false);
      $("#idAgenteAssociado").val(null);
      $("#idAgenteAssociado").focus();
    } else {
      $('#checkbox_exepcao').prop('checked', false);
      $("#exepcao").val("0");
      $("#div_subagente").hide();
      $("#div_execao").hide();
      $("#div_infos_subagente").hide();
      $("#div_infos_agente").show();
      $("#idAgenteAssociado").prop("disabled", true);
      $("#idAgenteAssociado").val(null);
      $("#idAgenteAssociado").prop("disabled", true);
      $("#idAgenteAssociado").val(null);
      $("#idAgenteAssociado").removeClass("was-validated");
      $("#idAgenteAssociado").removeClass("is-invalid");
      $("#idAgenteAssociado").addClass(":invalid");
    }
  });
  $('#idAgenteAssociado').on('change', function () {
    $("#idAgenteAssociado").removeClass("is-invalid");
    $("#idAgenteAssociado").addClass("invalid");
    $("#agent-type-tab").removeClass("border-danger text-danger");
  });
  /* VALIDAÇÃO DO FORMULÁRIO */

  window.addEventListener('load', function () {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation'); // Loop over them and prevent submission

    var validation = Array.prototype.filter.call(forms, function (form) {
      form.addEventListener('submit', function (event) {
        console.log('a', $("#tipo").val(), $("#idAgenteAssociado").val());
        /* mostrar div de espera */

        $("#wait_screen").show();

        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
          /* Se for subagente é obrigatorio ter um agente */

          console.log('a', $("#tipo").val(), $("#idAgenteAssociado").val());

          if ($("#tipo").val() == "Subagente" && $("#idAgenteAssociado").val() == 0 || $("#tipo").val() == "Subagente" && $("#idAgenteAssociado").val() == null) {
            $("#wait_screen").hide();
            $("#agent-type-tab").addClass("border-danger text-danger");
            $("#idAgenteAssociado").removeClass("is-valid");
            $("#idAgenteAssociado").addClass("is-invalid");
            $("#idAgenteAssociado").css("background-image", "none");
            $("#warning_msg").show();
            return false;
          } else {
            $("#agent-type-tab").removeClass("border-danger text-danger");
          }
          /* valida Dados pessoais */


          if ($("#nome").val() == "" || $("#apelido").val() == "" || $("#genero").val() == "" || $("#dataNasc").val() == "") {
            $("#wait_screen").hide();
            $("#personal-tab").addClass("border-danger text-danger");
            $("#warning_msg").show();
          } else {
            $("#personal-tab").removeClass("border-danger text-danger");
          }
          /* valida Documentos */


          if ($("#num_doc").val() == "" || $("#NIF").val() == "") {
            $("#wait_screen").hide();
            $("#documents-tab").addClass("border-danger text-danger");
            $("#warning_msg").show();
          } else {
            $("#documents-tab").removeClass("border-danger text-danger");
          }
          /* valida Contactos */


          if ($("#email").val() == "" || $("#pais").val() == "" || $("#morada").val() == "" || $("#telefone1").val() == "") {
            $("#wait_screen").hide();
            $("#contacts-tab").addClass("border-danger text-danger");
            $("#warning_msg").show();
          } else {
            $("#contacts-tab").removeClass("border-danger text-danger");
          }
        }

        form.classList.add('was-validated');
      }, false);
    });
  }, false);
});

/***/ }),

/***/ 48:
/*!*****************************************!*\
  !*** multi ./resources/js/old/agent.js ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/vagrant/code/resources/js/old/agent.js */"./resources/js/old/agent.js");


/***/ })

/******/ });