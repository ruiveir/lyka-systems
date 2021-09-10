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
/******/ 	return __webpack_require__(__webpack_require__.s = 52);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/old/charges.js":
/*!*************************************!*\
  !*** ./resources/js/old/charges.js ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// Custom upload file area
function getFile() {
  document.getElementById("upfile").click();
}

function sub(obj) {
  var file = obj.value;
  var fileName = file.split("\\");
  document.getElementById("addFileButton").innerHTML = fileName[fileName.length - 1];
}

function removeFile() {
  document.getElementById("upfile").value = "";
  document.getElementById("addFileButton").innerHTML = 'Adicionar um ficheiro';
} // Tooltip


$(function () {
  $('[data-toggle="tooltip"]').tooltip();
}); // Context Menu

window.onclick = hideContextMenu;
var contextMenu = document.getElementById("contextMenu");

function showContextMenu() {
  contextMenu.style.display = "inline-block";
  contextMenu.style.left = event.clientX - '260' + 'px';
  contextMenu.style.top = event.clientY + 'px';
  return false;
}

function hideContextMenu() {
  if ($('#contextMenu, .contextMenu').length) {
    contextMenu.style.display = "none";
  }
}

$(document).ready(function () {
  var _this = this;

  var table = $('#dataTable').DataTable({
    "pageLength": 100,
    "columnDefs": [
    /*                 {
                    "orderable": false,
                    "width": "60px",
                    "targets": 0
                }, */

    /*                 {
                    "orderable": false,
                    "targets": 2
                }, */
    {
      "orderable": false,
      "width": "130px",
      "targets": -1
    }],
    "language": {
      "lengthMenu": "Mostrar _MENU_ por página",
      "search": "Procurar",
      "zeroRecords": "Sem registos",
      "paginate": {
        "first": "Primeiro",
        "last": "Ultimo",
        "next": "Proximo",
        "previous": "Anterior"
      },
      "info": "",
      "infoEmpty": "",
      "infoFiltered": ""
    },
    "order": [1, 'desc']
    /* "bLengthChange": false, */

    /* "bFilter": false, */

  });
  $(".dataTables_filter").hide(); // Esconde o input search por defeito

  $("#customSearchBox").on('keyup', function () {
    $(".dataTables_filter input").val($("#customSearchBox").val());
    table.search($(".dataTables_filter input").val()).draw();
  });
  $('.dataTables_length').hide(); // Esconde o select "rows per page" por defeito

  $('#records_per_page').val(table.page.len());
  $('#records_per_page').on('change', function () {
    table.page.len($(_this).val()).draw();
  });
  /* FIM configs DATATABLES */
});

/***/ }),

/***/ 52:
/*!*******************************************!*\
  !*** multi ./resources/js/old/charges.js ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/vagrant/code/resources/js/old/charges.js */"./resources/js/old/charges.js");


/***/ })

/******/ });