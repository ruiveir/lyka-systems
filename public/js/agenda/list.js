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
/******/ 	return __webpack_require__(__webpack_require__.s = 3);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/agenda/list.js":
/*!*************************************!*\
  !*** ./resources/js/agenda/list.js ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var _this = this;

function _createForOfIteratorHelper(o, allowArrayLike) { var it = typeof Symbol !== "undefined" && o[Symbol.iterator] || o["@@iterator"]; if (!it) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = it.call(o); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

$(function () {
  var parsedEvents = [];

  var _iterator = _createForOfIteratorHelper(eventList),
      _step;

  try {
    for (_iterator.s(); !(_step = _iterator.n()).done;) {
      var event = _step.value;

      if (event.idUser == userId || event.visibilidade) {
        var start_date = new Date(event.data_inicio);
        var end_date = event.data_fim ? new Date(event.data_fim) : null;
        parsedEvents.push({
          title: event.titulo,
          description: event.descricao || null,
          start: start_date.getFullYear() + ' - ' + start_date.getMonth() + ' - ' + start_date.getDay(),
          end: end_date ? end_date.getFullYear() + ' - ' + end_date.getMonth() + ' - ' + end_date.getDay() : null,
          color: event.cor,
          extendedProps: {
            visibilidade: event.visibilidade,
            id: event.agenda_id,
            universidade_id: event.idUniversidade || null,
            universidade_nome: event.universidade ? event.universidade.nome : null
          }
        });
      }
    }
  } catch (err) {
    _iterator.e(err);
  } finally {
    _iterator.f();
  }

  $(".needs-validation").on('submit', function (event) {
    if (_this.checkValidity() === false) {
      event.preventDefault();
      event.stopPropagation();
    } else {
      $("#close-option").removeAttr("onclick");
      button = "<button class='btn btn-primary' type='submit' disabled><span class='spinner-border spinner-border-sm' role='status' aria-hidden='true' style='position:relative; bottom:4px; right:3px;'></span>A fazer o registo...</button>";
      $("#groupBtn").append(button);
      $("#submitbtn").remove();
    }

    $(".needs-validation").addClass("was-validated");
  });
  var dateToday = new Date();
  var dd = String(dateToday.getDate()).padStart(2, '0');
  var mm = String(dateToday.getMonth() + 1).padStart(2, '0');
  var yyyy = dateToday.getFullYear();
  dateToday = dd + '/' + mm + '/' + yyyy;

  function dealWithDate(value) {
    var month = value.getMonth() + 1;
    return value.getFullYear() + "-" + ("0" + month).slice(-2) + "-" + ("0" + value.getDate()).slice(-2);
  }

  var calendarEl = document.getElementById('calendar'); // Função que acolhe todas as customizações necessárias para a agenda.

  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    themeSystem: 'flatly',
    locale: 'pt',
    weekNumbers: true,
    aspectRatio: 1.60,
    selectable: true,
    droppable: true,
    timeZone: 'UTC',
    editable: true,
    dayMaxEvents: true,
    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
    },
    // Aqui é onde se coloca os eventos.
    events: parsedEvents,
    // Ao clicar num evento, irá correr o seguinte código (Modal para editar e apagar um evento).
    eventClick: function eventClick(element) {
      var modal = $("#editModal");
      modal.find('.modal-body #titulo').val(element.event.title);
      modal.find('.modal-body #cor').val(element.event.backgroundColor);
      modal.find('.modal-body #data_inicio').val(dealWithDate(element.event.start));

      if (element.event.extendedProps.universidade_id != null) {
        modal.find('.modal-body #uni_selected').val(element.event.extendedProps.universidade_id);
        modal.find('.modal-body #uni_selected').text(element.event.extendedProps.universidade_nome);
      } else {
        modal.find('.modal-body #uni_selected').text("Escolha uma universidade...");
      }

      if (element.event.extendedProps.visibilidade == 1) {
        $("#publico").attr("selected", "true");
      } else {
        $("#privado").attr("selected", "true");
      }

      if (element.event.end != null) {
        modal.find('.modal-body #data_fim').val(dealWithDate(element.event.end));
      }

      if (element.event.extendedProps.description != null) {
        modal.find('.modal-body #descricao').val(element.event.extendedProps.description);
      }

      modal.find('#editForm').attr("action", "/agenda/" + element.event.extendedProps.id);
      modal.find('#deleteForm').attr("action", "/agenda/" + element.event.extendedProps.id);
      $("#editModal").modal("show");
    }
  });
  calendar.render();
});

/***/ }),

/***/ 3:
/*!*******************************************!*\
  !*** multi ./resources/js/agenda/list.js ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/vagrant/code/resources/js/agenda/list.js */"./resources/js/agenda/list.js");


/***/ })

/******/ });