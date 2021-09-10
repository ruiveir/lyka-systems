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
/******/ 	return __webpack_require__(__webpack_require__.s = 4);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/agents/add.js":
/*!************************************!*\
  !*** ./resources/js/agents/add.js ***!
  \************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var _this = this;

function checkTypeValidity(event) {
  var typeField = document.querySelector("#tipo");
  var parentAgentField = document.querySelector("#idAgenteAssociado");
  var type = typeField.value;
  var parentAgentId = parentAgentField.value;

  if (type === 'Subagente' && (!parentAgentId || parentAgentId === 0)) {
    parentAgentField.setCustomValidity("Tem que selecionar um agente");
  } else parentAgentField.setCustomValidity("");
}

$(function () {
  $("#tipo").on('input', checkTypeValidity);
  $("#idAgenteAssociado").on('input', checkTypeValidity);
  $(".needs-validation").on('submit', function (event) {
    if (event.currentTarget.checkValidity() === false) {
      event.preventDefault();
      event.stopPropagation();
    } else {
      $("#cancelBtn").removeAttr("onclick");
      var button = "<button class='btn btn-primary' type='submit' disabled><span class='spinner-border spinner-border-sm' role='status' aria-hidden='true' style='position:relative; bottom:4px; right:3px;'></span>A fazer o registo...</button>";
      $("#groupBtn").append(button);
      $("#submitbtn").remove();
    }

    $(".needs-validation").addClass("was-validated");
  });

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
  var options = [{
    "option": document.getElementById("agent-type-tab")
  }, {
    "option": document.getElementById("personal-tab")
  }, {
    "option": document.getElementById("documents-tab")
  }, {
    "option": document.getElementById("contacts-tab")
  }, {
    "option": document.getElementById("financas-tab")
  }];
  $("#agent-type-tab, #personal-tab, #documents-tab, #contacts-tab, #financas-tab").on('click', function () {
    for (var i = 0; i < options.length; i++) {
      if (_this.id === options[i].option.id) {
        $(_this).removeClass("bg-white").addClass("bg-primary text-white");
      } else {
        $(options[i].option).removeClass("bg-primary text-white").addClass("bg-white");
      }
    }
  });
});

/***/ }),

/***/ 4:
/*!******************************************!*\
  !*** multi ./resources/js/agents/add.js ***!
  \******************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/vagrant/code/resources/js/agents/add.js */"./resources/js/agents/add.js");


/***/ })

/******/ });