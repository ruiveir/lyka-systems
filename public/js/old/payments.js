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
/******/ 	return __webpack_require__(__webpack_require__.s = 60);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/old/payments.js":
/*!**************************************!*\
  !*** ./resources/js/old/payments.js ***!
  \**************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// Filters
var closeButton = document.getElementById('close-icon-div');
var filterButton = document.getElementById('filter-icon-div');

function showCloseIcon() {
  filterButton.style.display = "none";
  closeButton.style.display = "inline-block";
  closeButton.style["float"] = "right";
}

function showFunnelIcon() {
  filterButton.style.display = "inline-block";
  filterButton.style["float"] = "right";
  closeButton.style.display = "none";
} // Valor dos inputs -> Bloquear inputs -> .setAttribute("disabled", "true");


function selected() {
  var defaultValue = "default"; // Input ESTUDANTES

  var estudanteInput = document.getElementById('estudantes');
  var valueEstudante = estudanteInput.options[estudanteInput.selectedIndex].value;

  if (valueEstudante != defaultValue) {
    var span = document.createElement("span");
    span.id = "closeEstudante";
    span.className = "closeButton";
    var x = document.createTextNode("x");
    span.appendChild(x);
    var parentDiv = estudanteInput.parentElement;
    parentDiv.appendChild(span);
    span.addEventListener("click", function () {
      var options = estudanteInput.options;

      for (var i = 0; options = options[i]; i++) {
        if (options.value == defaultValue) {
          estudanteInput.selectedIndex = i;
          span.style.display = "none";
          break;
        }
      }

      document.getElementById('agentes').removeAttribute("disabled");
      document.getElementById('subagentes').removeAttribute("disabled");
      document.getElementById('universidades').removeAttribute("disabled");
      document.getElementById('universidadesec').removeAttribute("disabled");
      document.getElementById('fornecedores').removeAttribute("disabled");
    });
    document.getElementById('agentes').setAttribute("disabled", "true");
    document.getElementById('subagentes').setAttribute("disabled", "true");
    document.getElementById('universidades').setAttribute("disabled", "true");
    document.getElementById('universidadesec').setAttribute("disabled", "true");
    document.getElementById('fornecedores').setAttribute("disabled", "true");
  } // Input AGENTES


  var agenteInput = document.getElementById('agentes');
  var valueAgente = agenteInput.options[agenteInput.selectedIndex].value;

  if (valueAgente != defaultValue) {
    var span = document.createElement("span");
    span.id = "closeAgente";
    span.className = "closeButton";
    var x = document.createTextNode("x");
    span.appendChild(x);
    var parentDiv = agenteInput.parentElement;
    parentDiv.appendChild(span);
    span.addEventListener("click", function () {
      var options = agenteInput.options;

      for (var i = 0; options = options[i]; i++) {
        if (options.value == defaultValue) {
          agenteInput.selectedIndex = i;
          span.style.display = "none";
          break;
        }
      }

      document.getElementById('estudantes').removeAttribute("disabled");
      document.getElementById('subagentes').removeAttribute("disabled");
      document.getElementById('universidades').removeAttribute("disabled");
      document.getElementById('universidadesec').removeAttribute("disabled");
      document.getElementById('fornecedores').removeAttribute("disabled");
    });
    document.getElementById('estudantes').setAttribute("disabled", "true");
    document.getElementById('subagentes').setAttribute("disabled", "true");
    document.getElementById('universidades').setAttribute("disabled", "true");
    document.getElementById('universidadesec').setAttribute("disabled", "true");
    document.getElementById('fornecedores').setAttribute("disabled", "true");
  } // Input SUBAGENTES


  var subagenteInput = document.getElementById('subagentes');
  var valueSubagente = subagenteInput.options[subagenteInput.selectedIndex].value;

  if (valueSubagente != defaultValue) {
    var span = document.createElement("span");
    span.id = "closeSubagente";
    span.className = "closeButton";
    var x = document.createTextNode("x");
    span.appendChild(x);
    var parentDiv = subagenteInput.parentElement;
    parentDiv.appendChild(span);
    span.addEventListener("click", function () {
      var options = subagenteInput.options;

      for (var i = 0; options = options[i]; i++) {
        if (options.value == defaultValue) {
          subagenteInput.selectedIndex = i;
          span.style.display = "none";
          break;
        }
      }

      document.getElementById('estudantes').removeAttribute("disabled");
      document.getElementById('agentes').removeAttribute("disabled");
      document.getElementById('universidades').removeAttribute("disabled");
      document.getElementById('universidadesec').removeAttribute("disabled");
      document.getElementById('fornecedores').removeAttribute("disabled");
    });
    document.getElementById('estudantes').setAttribute("disabled", "true");
    document.getElementById('agentes').setAttribute("disabled", "true");
    document.getElementById('universidades').setAttribute("disabled", "true");
    document.getElementById('universidadesec').setAttribute("disabled", "true");
    document.getElementById('fornecedores').setAttribute("disabled", "true");
  } // Input UNIVERSIDADE PRINCIPAL


  var universidadeInput = document.getElementById('universidades');
  var valueUni = universidadeInput.options[universidadeInput.selectedIndex].value;

  if (valueUni != defaultValue) {
    var span = document.createElement("span");
    span.id = "closeUni";
    span.className = "closeButton";
    var x = document.createTextNode("x");
    span.appendChild(x);
    var parentDiv = universidadeInput.parentElement;
    parentDiv.appendChild(span);
    span.addEventListener("click", function () {
      var options = universidadeInput.options;

      for (var i = 0; options = options[i]; i++) {
        if (options.value == defaultValue) {
          universidadeInput.selectedIndex = i;
          span.style.display = "none";
          break;
        }
      }

      document.getElementById('estudantes').removeAttribute("disabled");
      document.getElementById('agentes').removeAttribute("disabled");
      document.getElementById('subagentes').removeAttribute("disabled");
      document.getElementById('universidadesec').removeAttribute("disabled");
      document.getElementById('fornecedores').removeAttribute("disabled");
    });
    document.getElementById('estudantes').setAttribute("disabled", "true");
    document.getElementById('agentes').setAttribute("disabled", "true");
    document.getElementById('subagentes').setAttribute("disabled", "true");
    document.getElementById('universidadesec').setAttribute("disabled", "true");
    document.getElementById('fornecedores').setAttribute("disabled", "true");
  } // Input UNIVERSIDADE SECUNDÁRIA


  var universidadeSecInput = document.getElementById('universidadesec');
  var valueUniSec = universidadeSecInput.options[universidadeSecInput.selectedIndex].value;

  if (valueUniSec != defaultValue) {
    var span = document.createElement("span");
    span.id = "closeUni";
    span.className = "closeButton";
    var x = document.createTextNode("x");
    span.appendChild(x);
    var parentDiv = universidadeSecInput.parentElement;
    parentDiv.appendChild(span);
    span.addEventListener("click", function () {
      var options = universidadeSecInput.options;

      for (var i = 0; options = options[i]; i++) {
        if (options.value == defaultValue) {
          universidadeSecInput.selectedIndex = i;
          span.style.display = "none";
          break;
        }
      }

      document.getElementById('estudantes').removeAttribute("disabled");
      document.getElementById('agentes').removeAttribute("disabled");
      document.getElementById('subagentes').removeAttribute("disabled");
      document.getElementById('universidades').removeAttribute("disabled");
      document.getElementById('fornecedores').removeAttribute("disabled");
    });
    document.getElementById('estudantes').setAttribute("disabled", "true");
    document.getElementById('agentes').setAttribute("disabled", "true");
    document.getElementById('subagentes').setAttribute("disabled", "true");
    document.getElementById('universidades').setAttribute("disabled", "true");
    document.getElementById('fornecedores').setAttribute("disabled", "true");
  } // Input FORNECEDORES


  var fornecedorInput = document.getElementById('fornecedores');
  var valueFornecedor = fornecedorInput.options[fornecedorInput.selectedIndex].value;

  if (valueFornecedor != defaultValue) {
    var span = document.createElement("span");
    span.id = "closeFornecedor";
    span.className = "closeButton";
    var x = document.createTextNode("x");
    span.appendChild(x);
    var parentDiv = fornecedorInput.parentElement;
    parentDiv.appendChild(span);
    span.addEventListener("click", function () {
      var options = fornecedorInput.options;

      for (var i = 0; options = options[i]; i++) {
        if (options.value == defaultValue) {
          fornecedorInput.selectedIndex = i;
          span.style.display = "none";
          break;
        }
      }

      document.getElementById('estudantes').removeAttribute("disabled");
      document.getElementById('agentes').removeAttribute("disabled");
      document.getElementById('subagentes').removeAttribute("disabled");
      document.getElementById('universidades').removeAttribute("disabled");
      document.getElementById('universidadesec').removeAttribute("disabled");
    });
    document.getElementById('estudantes').setAttribute("disabled", "true");
    document.getElementById('agentes').setAttribute("disabled", "true");
    document.getElementById('subagentes').setAttribute("disabled", "true");
    document.getElementById('universidades').setAttribute("disabled", "true");
    document.getElementById('universidadesec').setAttribute("disabled", "true");
  }
} // Limpar os campos do formulário


$("#cleanButton").click(function (event) {
  event.preventDefault();
  $("#dataInicio").val("");
  $("#dataFim").val("");
});
$("select").change(function () {
  $("#error500").remove();
});
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': "{{csrf_token()}}"
  }
}); // Formulário de FILTRAGEM DE PAGAMENTOS

$('#search-form').submit(function (event) {
  event.preventDefault();
  info = {
    estudante: $("#estudantes").find(":selected").val(),
    agente: $("#agentes").find(":selected").val(),
    subagente: $("#subagentes").find(":selected").val(),
    universidade: $("#universidades").find(":selected").val(),
    universidadesec: $("#universidadesec").find(":selected").val(),
    fornecedor: $("#fornecedores").find(":selected").val(),
    datainicio: $("#dataInicio").val(),
    datafim: $("#dataFim").val()
  };
  $.ajax({
    type: "post",
    url: "/pagamentos/pesquisa",
    context: this,
    data: info,
    success: function success(data) {
      $("#error").remove();
      $(".payments").remove();
      div = "<div class='payments'><div>";
      $("#append-payment").append(div);
      var currentdate = new Date();

      for (var i = 0; i < data.length; i++) {
        // Pagamentos aos CLIENTES
        if (data[i].valorCliente != null && $("#estudantes").find(":selected").val() != 'default') {
          // Formato da DATA DE VENCIMENTO
          var d = new Date(data[i].dataVencimentoCliente);
          var da = new Intl.DateTimeFormat('pt', {
            day: '2-digit'
          }).format(d);
          var mo = new Intl.DateTimeFormat('pt', {
            month: '2-digit'
          }).format(d);
          var ye = new Intl.DateTimeFormat('pt', {
            year: 'numeric'
          }).format(d);
          duedate = "".concat(da, "/").concat(mo, "/").concat(ye); // Seleções de CORES _ Estado de PAGAMENTOS

          if (data[i].verificacaoPagoCliente == true) {
            status = "Pago";
            color = "#47BC00"; // VERDE
          } else if (data[i].verificacaoPagoCliente == false && d < currentdate) {
            status = "Dívida";
            color = "#FF3D00"; // VERMELHO
          } else if (data[i].verificacaoPagoCliente == false && d > currentdate) {
            status = "Pendente";
            color = "#747474"; // CINZENTO (DEFAULT)
          }

          html = "<a href='/pagamentos/cliente/" + data[i].cliente.slug + "/fase/" + data[i].fase.slug + "/" + data[i].idResponsabilidade + "'><div class='row charge-div'> <div class='col-md-1 align-self-center'><div class='white-circle'><img src='" + '"{{url(/storage/default-photos/M.jpg)}}"' + " width='100%' class='mx-auto'></div></div> <div class='col-md-3 text-truncate align-self-center ml-4'><p class='text-truncate' title='" + data[i].cliente.nome + ' ' + data[i].cliente.apelido + "'>" + data[i].cliente.nome + ' ' + data[i].cliente.apelido + "</p></div> <div class='col-md-2 text-truncate align-self-center'><p class='text-truncate'>" + data[i].valorCliente.split('.').join(',') + "€</p></div> <div class='col-md-2 align-self-center ml-4'><p class='text-truncate' title='" + duedate + "'>" + duedate + "</p></div> <div class='col-md-2 text-truncate align-self-center ml-auto'><p class='text-truncate' style='color:" + color + ";'>" + status + "</p></div> </div></a>";
          $(".payments").append(html);
        } // Pagamentos aos AGENTES


        if (data[i].valorAgente != null && $("#agentes").find(":selected").val() != 'default') {
          // Formato da DATA DE VENCIMENTO
          var _d = new Date(data[i].dataVencimentoAgente);

          var _da = new Intl.DateTimeFormat('pt', {
            day: '2-digit'
          }).format(_d);

          var _mo = new Intl.DateTimeFormat('pt', {
            month: '2-digit'
          }).format(_d);

          var _ye = new Intl.DateTimeFormat('pt', {
            year: 'numeric'
          }).format(_d);

          duedate = "".concat(_da, "/").concat(_mo, "/").concat(_ye); // Seleções de CORES _ Estado de PAGAMENTOS

          if (data[i].verificacaoPagoAgente == true) {
            status = "Pago";
            color = "#47BC00"; // VERDE
          } else if (data[i].verificacaoPagoAgente == false && _d < currentdate) {
            status = "Dívida";
            color = "#FF3D00"; // VERMELHO
          } else if (data[i].verificacaoPagoAgente == false && _d > currentdate) {
            status = "Pendente";
            color = "#747474"; // CINZENTO (DEFAULT)
          }

          html = "<a href='/pagamentos/agente/" + data[i].agente.slug + "/fase/" + data[i].fase.slug + "/" + data[i].idResponsabilidade + "'><div class='row charge-div'> <div class='col-md-1 align-self-center'><div class='white-circle'><img src='" + '"{{url(/storage/default-photos/M.jpg)}}"' + " width='100%' class='mx-auto'></div></div> <div class='col-md-3 text-truncate align-self-center ml-4'><p class='text-truncate' title='" + data[i].agente.nome + ' ' + data[i].agente.apelido + "'>" + data[i].agente.nome + ' ' + data[i].agente.apelido + "</p></div> <div class='col-md-2 text-truncate align-self-center'><p class='text-truncate'>" + data[i].valorAgente.split('.').join(',') + "€</p></div> <div class='col-md-2 align-self-center ml-4'><p class='text-truncate' title='" + duedate + "'>" + duedate + "</p></div> <div class='col-md-2 text-truncate align-self-center ml-auto'><p class='text-truncate' style='color:" + color + ";'>" + status + "</p></div> </div></a>";
          $(".payments").append(html);
        } // Pagamentos aos SUBAGENTES


        if (data[i].valorSubAgente != null && $("#subagentes").find(":selected").val() != 'default') {
          // Formato da DATA DE VENCIMENTO
          var _d2 = new Date(data[i].dataVencimentoAgente);

          var _da2 = new Intl.DateTimeFormat('pt', {
            day: '2-digit'
          }).format(_d2);

          var _mo2 = new Intl.DateTimeFormat('pt', {
            month: '2-digit'
          }).format(_d2);

          var _ye2 = new Intl.DateTimeFormat('pt', {
            year: 'numeric'
          }).format(_d2);

          duedate = "".concat(_da2, "/").concat(_mo2, "/").concat(_ye2); // Seleções de CORES _ Estado de PAGAMENTOS

          if (data[i].verificacaoPagoSubAgente == true) {
            status = "Pago";
            color = "#47BC00"; // VERDE
          } else if (data[i].verificacaoPagoSubAgente == false && _d2 < currentdate) {
            status = "Dívida";
            color = "#FF3D00"; // VERMELHO
          } else if (data[i].verificacaoPagoSubAgente == false && _d2 > currentdate) {
            status = "Pendente";
            color = "#747474"; // CINZENTO (DEFAULT)
          }

          html = "<a href='/pagamentos/subagente/" + data[i].sub_agente.slug + "/fase/" + data[i].fase.slug + "/" + data[i].idResponsabilidade + "'><div class='row charge-div'> <div class='col-md-1 align-self-center'><div class='white-circle'><img src='" + '"{{url(/storage/default-photos/M.jpg)}}"' + " width='100%' class='mx-auto'></div></div> <div class='col-md-3 text-truncate align-self-center ml-4'><p class='text-truncate' title='" + data[i].sub_agente.nome + ' ' + data[i].sub_agente.apelido + "'>" + data[i].sub_agente.nome + ' ' + data[i].sub_agente.apelido + "</p></div> <div class='col-md-2 text-truncate align-self-center'><p class='text-truncate'>" + data[i].valorSubAgente.split('.').join(',') + "€</p></div> <div class='col-md-2 align-self-center ml-4'><p class='text-truncate' title='" + duedate + "'>" + duedate + "</p></div> <div class='col-md-2 text-truncate align-self-center ml-auto'><p class='text-truncate' style='color:" + color + ";'>" + status + "</p></div> </div></a>";
          $(".payments").append(html);
        } // Pagamentos as UNIVERSIDADES PRINCIPAIS


        if (data[i].valorUniversidade1 != null && $("#universidades").find(":selected").val() != 'default') {
          // Formato da DATA DE VENCIMENTO
          var _d3 = new Date(data[i].dataVencimentoUni1);

          var _da3 = new Intl.DateTimeFormat('pt', {
            day: '2-digit'
          }).format(_d3);

          var _mo3 = new Intl.DateTimeFormat('pt', {
            month: '2-digit'
          }).format(_d3);

          var _ye3 = new Intl.DateTimeFormat('pt', {
            year: 'numeric'
          }).format(_d3);

          duedate = "".concat(_da3, "/").concat(_mo3, "/").concat(_ye3); // Seleções de CORES _ Estado de PAGAMENTOS

          if (data[i].verificacaoPagoUni1 == true) {
            status = "Pago";
            color = "#47BC00"; // VERDE
          } else if (data[i].verificacaoPagoUni1 == false && _d3 < currentdate) {
            status = "Dívida";
            color = "#FF3D00"; // VERMELHO
          } else if (data[i].verificacaoPagoUni1 == false && _d3 > currentdate) {
            status = "Pendente";
            color = "#747474"; // CINZENTO (DEFAULT)
          }

          html = "<a href='/pagamentos/universidade-principal/" + data[i].universidade1.slug + "/fase/" + data[i].fase.slug + "/" + data[i].idResponsabilidade + "'><div class='row charge-div'> <div class='col-md-1 align-self-center'><div class='white-circle'><img src='" + '"{{url(/storage/default-photos/M.jpg)}}"' + " width='100%' class='mx-auto'></div></div> <div class='col-md-3 text-truncate align-self-center ml-4'><p class='text-truncate' title='" + data[i].universidade1.nome + "'>" + data[i].universidade1.nome + "</p></div> <div class='col-md-2 text-truncate align-self-center'><p class='text-truncate'>" + data[i].valorUniversidade1.split('.').join(',') + "€</p></div> <div class='col-md-2 align-self-center ml-4'><p class='text-truncate' title='" + duedate + "'>" + duedate + "</p></div> <div class='col-md-2 text-truncate align-self-center ml-auto'><p class='text-truncate' style='color:" + color + ";'>" + status + "</p></div> </div></a>";
          $(".payments").append(html);
        } // Pagamentos as UNIVERSIDADES SECUNDÁRIAS


        if (data[i].valorUniversidade2 != null && $("#universidadesec").find(":selected").val() != 'default') {
          // Formato da DATA DE VENCIMENTO
          var _d4 = new Date(data[i].dataVencimentoUni2);

          var _da4 = new Intl.DateTimeFormat('pt', {
            day: '2-digit'
          }).format(_d4);

          var _mo4 = new Intl.DateTimeFormat('pt', {
            month: '2-digit'
          }).format(_d4);

          var _ye4 = new Intl.DateTimeFormat('pt', {
            year: 'numeric'
          }).format(_d4);

          duedate = "".concat(_da4, "/").concat(_mo4, "/").concat(_ye4); // Seleções de CORES _ Estado de PAGAMENTOS

          if (data[i].verificacaoPagoUni2 == true) {
            status = "Pago";
            color = "#47BC00"; // VERDE
          } else if (data[i].verificacaoPagoUni2 == false && _d4 < currentdate) {
            status = "Dívida";
            color = "#FF3D00"; // VERMELHO
          } else if (data[i].verificacaoPagoUni2 == false && _d4 > currentdate) {
            status = "Pendente";
            color = "#747474"; // CINZENTO (DEFAULT)
          }

          html = "<a href='/pagamentos/universidade-secundaria/" + data[i].universidade2.slug + "/fase/" + data[i].fase.slug + "/" + data[i].idResponsabilidade + "'><div class='row charge-div'> <div class='col-md-1 align-self-center'><div class='white-circle'><img src='" + '"{{url(/storage/default-photos/M.jpg)}}"' + " width='100%' class='mx-auto'></div></div> <div class='col-md-3 text-truncate align-self-center ml-4'><p class='text-truncate' title='" + data[i].universidade2.nome + "'>" + data[i].universidade2.nome + "</p></div> <div class='col-md-2 text-truncate align-self-center'><p class='text-truncate'>" + data[i].valorUniversidade2.split('.').join(',') + "€</p></div> <div class='col-md-2 align-self-center ml-4'><p class='text-truncate' title='" + duedate + "'>" + duedate + "</p></div> <div class='col-md-2 text-truncate align-self-center ml-auto'><p class='text-truncate' style='color:" + color + ";'>" + status + "</p></div> </div></a>";
          $(".payments").append(html);
        } // Pagamentos aos FORNECEDORES


        if ($("#fornecedores").find(":selected").val() != 'default') {
          // Formato da DATA DE VENCIMENTO
          var _d5 = new Date(data[i].dataVencimento);

          var _da5 = new Intl.DateTimeFormat('pt', {
            day: '2-digit'
          }).format(_d5);

          var _mo5 = new Intl.DateTimeFormat('pt', {
            month: '2-digit'
          }).format(_d5);

          var _ye5 = new Intl.DateTimeFormat('pt', {
            year: 'numeric'
          }).format(_d5);

          duedate = "".concat(_da5, "/").concat(_mo5, "/").concat(_ye5); // Seleções de CORES _ Estado de PAGAMENTOS

          if (data[i].verificacaoPago == true) {
            status = "Pago";
            color = "#47BC00"; // VERDE
          } else if (data[i].verificacaoPago == false && _d5 < currentdate) {
            status = "Dívida";
            color = "#FF3D00"; // VERMELHO
          } else if (data[i].verificacaoPago == false && _d5 > currentdate) {
            status = "Pendente";
            color = "#747474"; // CINZENTO (DEFAULT)
          }

          html = "<a href='/pagamentos/fornecedor/" + data[i].fornecedor.slug + "/fase/" + data[i].responsabilidade.fase.slug + "/" + data[i].idRelacao + "'><div class='row charge-div'> <div class='col-md-1 align-self-center'><div class='white-circle'><img src='" + '"{{url(/storage/default-photos/M.jpg)}}"' + " width='100%' class='mx-auto'></div></div> <div class='col-md-3 text-truncate align-self-center ml-4'><p class='text-truncate' title='" + data[i].fornecedor.nome + "'>" + data[i].fornecedor.nome + "</p></div> <div class='col-md-2 text-truncate align-self-center'><p class='text-truncate'>" + data[i].valor.split('.').join(',') + "€</p></div> <div class='col-md-2 align-self-center ml-4'><p class='text-truncate' title='" + duedate + "'>" + duedate + "</p></div> <div class='col-md-2 text-truncate align-self-center ml-auto'><p class='text-truncate' style='color:" + color + ";'>" + status + "</p></div> </div></a>";
          $(".payments").append(html);
        }
      }

      linkSite = window.location.origin;
      window.location.assign(linkSite + "/pagamentos#append-payment"); //window.location.assign("http://lykasystems.test/pagamentos#append-payment");

      history.pushState("", document.title, window.location.pathname);
    },
    error: function (_error) {
      function error(_x) {
        return _error.apply(this, arguments);
      }

      error.toString = function () {
        return _error.toString();
      };

      return error;
    }(function (data) {
      if ($('#error404').text() != '' || $('#error500').text() != '') {
        $('#error404').remove();
        $('#error500').remove();
      }

      if (data.status == 404) {
        $(".payments").remove();
        div = "<div class='payments'><div>";
        $("#append-payment").append(div);
        error = "<div class='row' id='error404' style='padding: 0px 18px;'><div class='container no-data-div text-center mt-3'><p style='color:#e3342f;'>Não existem pagamentos registados no sistema perante a sua pesquisa.</p></div></div>";
        $(".payments").append(error);
        linkSite = window.location.origin;
        window.location.assign(linkSite + "/pagamentos#append-payment"); //window.location.assign("http://lykasystems.test/pagamentos#append-payment");

        history.pushState("", document.title, window.location.pathname);
      } else {
        if ($('#error404').text() != '' || $('#error500').text() != '') {
          $('#error404').remove();
          $('#error500').remove();
        }

        error = "<div id='error500'><strong style='color: #e3342f;'>Preencha os campos necessários para a realização de uma filtragem.</strong><br><br></div>";
        $("#search-form").before(error);
      }
    })
  });
}); // Formulário para registar um PAGAMENTO

/***/ }),

/***/ 60:
/*!********************************************!*\
  !*** multi ./resources/js/old/payments.js ***!
  \********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/vagrant/code/resources/js/old/payments.js */"./resources/js/old/payments.js");


/***/ })

/******/ });