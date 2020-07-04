// Tooltip
$(function() {
    $('[data-toggle="tooltip"]').tooltip()
});

// Custom upload file area
function getFileCliente() {
    document.getElementById("upfileCliente").click();
}

function getFileAgente() {
    document.getElementById("upfileAgente").click();
}

function getFileSubAgente() {
    document.getElementById("upfileSubAgente").click();
}

function getFileUni1() {
    document.getElementById("upfileUni1").click();
}

function getFileUni2() {
    document.getElementById("upfileUni2").click();
}


function sub(obj) {
    var file = obj.value;
    var fileName = file.split("\\");

    if (obj.id == "upfileCliente") {
        document.getElementById("addFileButtonCliente").innerHTML = fileName[fileName.length - 1];
    }
    if (obj.id == "upfileAgente") {
        document.getElementById("addFileButtonAgente").innerHTML = fileName[fileName.length - 1];
    }
    if (obj.id == "upfileSubAgente") {
        document.getElementById("addFileButtonSubAgente").innerHTML = fileName[fileName.length - 1];
    }
    if (obj.id == "upfileUni1") {
        document.getElementById("addFileButtonUni1").innerHTML = fileName[fileName.length - 1];
    }
    if (obj.id == "upfileUni2") {
        document.getElementById("addFileButtonUni2").innerHTML = fileName[fileName.length - 1];
    }
}

function removeFile() {
    document.getElementById("upfile").value = "";
    document.getElementById("addFileButton").innerHTML = 'Adicionar um ficheiro';
}

// Filters
var closeButton = document.getElementById('close-icon-div');
var filterButton = document.getElementById('filter-icon-div');

function showCloseIcon() {
    filterButton.style.display = "none";
    closeButton.style.display = "inline-block";
    closeButton.style.float = "right";
}

function showFunnelIcon() {
    filterButton.style.display = "inline-block";
    filterButton.style.float = "right";
    closeButton.style.display = "none";
}

// Valor dos inputs -> Bloquear inputs -> .setAttribute("disabled", "true");

function selected() {
    var defaultValue = "default";
    // Input ESTUDANTES
    var estudanteInput = document.getElementById('estudantes');
    var valueEstudante = estudanteInput.options[estudanteInput.selectedIndex].value;

    if (valueEstudante != defaultValue) {
        var span = document.createElement("span");
        span.id = "closeEstudante";
        span.className = "closeButton"

        var x = document.createTextNode("x");
        span.appendChild(x);

        var parentDiv = estudanteInput.parentElement;
        parentDiv.appendChild(span);

        span.addEventListener("click", function() {
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
    }



    // Input AGENTES
    var agenteInput = document.getElementById('agentes');
    var valueAgente = agenteInput.options[agenteInput.selectedIndex].value;

    if (valueAgente != defaultValue) {
        var span = document.createElement("span");
        span.id = "closeAgente";
        span.className = "closeButton"

        var x = document.createTextNode("x");
        span.appendChild(x);

        var parentDiv = agenteInput.parentElement;
        parentDiv.appendChild(span);

        span.addEventListener("click", function() {
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
    }

    // Input SUBAGENTES
    var subagenteInput = document.getElementById('subagentes');
    var valueSubagente = subagenteInput.options[subagenteInput.selectedIndex].value;

    if (valueSubagente != defaultValue) {
        var span = document.createElement("span");
        span.id = "closeSubagente";
        span.className = "closeButton"

        var x = document.createTextNode("x");
        span.appendChild(x);

        var parentDiv = subagenteInput.parentElement;
        parentDiv.appendChild(span);

        span.addEventListener("click", function() {
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
    }

    // Input UNIVERSIDADE PRINCIPAL
    var universidadeInput = document.getElementById('universidades');
    var valueUni = universidadeInput.options[universidadeInput.selectedIndex].value;

    if (valueUni != defaultValue) {
        var span = document.createElement("span");
        span.id = "closeUni";
        span.className = "closeButton"

        var x = document.createTextNode("x");
        span.appendChild(x);

        var parentDiv = universidadeInput.parentElement;
        parentDiv.appendChild(span);

        span.addEventListener("click", function() {
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
    }

    // Input UNIVERSIDADE SECUNDÁRIA
    var universidadeSecInput = document.getElementById('universidadesec');
    var valueUniSec = universidadeSecInput.options[universidadeSecInput.selectedIndex].value;

    if (valueUniSec != defaultValue) {
        var span = document.createElement("span");
        span.id = "closeUni";
        span.className = "closeButton"

        var x = document.createTextNode("x");
        span.appendChild(x);

        var parentDiv = universidadeSecInput.parentElement;
        parentDiv.appendChild(span);

        span.addEventListener("click", function() {
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
    }

    // Input FORNECEDORES
    var fornecedorInput = document.getElementById('fornecedores');
    var valueFornecedor = fornecedorInput.options[fornecedorInput.selectedIndex].value;

    if (valueFornecedor != defaultValue) {
        var span = document.createElement("span");
        span.id = "closeFornecedor";
        span.className = "closeButton"

        var x = document.createTextNode("x");
        span.appendChild(x);

        var parentDiv = fornecedorInput.parentElement;
        parentDiv.appendChild(span);

        span.addEventListener("click", function() {
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
}

// Limpar os campos do formulário

$("#cleanButton").click(function(event) {
    event.preventDefault();
    $("#dataInicio").val("");
    $("#dataFim").val("");
});


$("select").change(function() {
    $("#error500").remove();
});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': "{{csrf_token()}}"
    }
});

// Formulário de FILTRAGEM DE PAGAMENTOS
$('#search-form').submit(function(event) {
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
        success: function(data) {
            $("#error").remove();
            $(".payments").remove();
            div = "<div class='payments'><div>";
            $("#append-payment").append(div);

            const currentdate = new Date();

            for (var i = 0; i < data.length; i++) {
                // Pagamentos aos CLIENTES
                if (data[i].valorCliente != null && $("#estudantes").find(":selected").val() != 'default') {
                    // Formato da DATA DE VENCIMENTO
                    const d = new Date(data[i].dataVencimentoCliente);
                    const da = new Intl.DateTimeFormat('pt', {
                        day: '2-digit'
                    }).format(d);
                    const mo = new Intl.DateTimeFormat('pt', {
                        month: '2-digit'
                    }).format(d);
                    const ye = new Intl.DateTimeFormat('pt', {
                        year: 'numeric'
                    }).format(d);
                    duedate = `${da}/${mo}/${ye}`;

                    // Seleções de CORES _ Estado de PAGAMENTOS
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

                    html = "<a href='/pagamentos/cliente/" + data[i].cliente.slug + "/fase/" + data[i].fase.slug + "/" + data[i].idResponsabilidade + "'><div class='row charge-div'> <div class='col-md-1 align-self-center'><div class='white-circle'><img src='http://lykasystems.test/storage/default-photos/M.jpg' width='100%' class='mx-auto'></div></div> <div class='col-md-3 text-truncate align-self-center ml-4'><p class='text-truncate' title='" + data[i].cliente.nome + ' ' + data[i].cliente.apelido + "'>" + data[i].cliente.nome + ' ' + data[i].cliente.apelido + "</p></div> <div class='col-md-2 text-truncate align-self-center'><p class='text-truncate'>" + data[i].valorCliente.split('.').join(',') + "€</p></div> <div class='col-md-2 align-self-center ml-4'><p class='text-truncate' title='" + duedate + "'>" + duedate + "</p></div> <div class='col-md-2 text-truncate align-self-center ml-auto'><p class='text-truncate' style='color:" + color + ";'>" + status + "</p></div> </div></a>";
                    $(".payments").append(html);
                }

                // Pagamentos aos AGENTES
                if (data[i].valorAgente != null && $("#agentes").find(":selected").val() != 'default') {
                    // Formato da DATA DE VENCIMENTO
                    const d = new Date(data[i].dataVencimentoAgente);
                    const da = new Intl.DateTimeFormat('pt', {
                        day: '2-digit'
                    }).format(d);
                    const mo = new Intl.DateTimeFormat('pt', {
                        month: '2-digit'
                    }).format(d);
                    const ye = new Intl.DateTimeFormat('pt', {
                        year: 'numeric'
                    }).format(d);
                    duedate = `${da}/${mo}/${ye}`;

                    // Seleções de CORES _ Estado de PAGAMENTOS
                    if (data[i].verificacaoPagoAgente == true) {
                        status = "Pago";
                        color = "#47BC00"; // VERDE
                    } else if (data[i].verificacaoPagoAgente == false && d < currentdate) {
                        status = "Dívida";
                        color = "#FF3D00"; // VERMELHO
                    } else if (data[i].verificacaoPagoAgente == false && d > currentdate) {
                        status = "Pendente";
                        color = "#747474"; // CINZENTO (DEFAULT)
                    }

                    html = "<a href='/pagamentos/agente/" + data[i].agente.slug + "/fase/" + data[i].fase.slug + "/" + data[i].idResponsabilidade + "'><div class='row charge-div'> <div class='col-md-1 align-self-center'><div class='white-circle'><img src='http://lykasystems.test/storage/default-photos/M.jpg' width='100%' class='mx-auto'></div></div> <div class='col-md-3 text-truncate align-self-center ml-4'><p class='text-truncate' title='" + data[i].agente.nome + ' ' + data[i].agente.apelido + "'>" + data[i].agente.nome + ' ' + data[i].agente.apelido + "</p></div> <div class='col-md-2 text-truncate align-self-center'><p class='text-truncate'>" + data[i].valorAgente.split('.').join(',') + "€</p></div> <div class='col-md-2 align-self-center ml-4'><p class='text-truncate' title='" + duedate + "'>" + duedate + "</p></div> <div class='col-md-2 text-truncate align-self-center ml-auto'><p class='text-truncate' style='color:" + color + ";'>" + status + "</p></div> </div></a>";
                    $(".payments").append(html);
                }

                // Pagamentos aos SUBAGENTES
                if (data[i].valorSubAgente != null && $("#subagentes").find(":selected").val() != 'default') {
                    // Formato da DATA DE VENCIMENTO
                    const d = new Date(data[i].dataVencimentoAgente);
                    const da = new Intl.DateTimeFormat('pt', {
                        day: '2-digit'
                    }).format(d);
                    const mo = new Intl.DateTimeFormat('pt', {
                        month: '2-digit'
                    }).format(d);
                    const ye = new Intl.DateTimeFormat('pt', {
                        year: 'numeric'
                    }).format(d);
                    duedate = `${da}/${mo}/${ye}`;

                    // Seleções de CORES _ Estado de PAGAMENTOS
                    if (data[i].verificacaoPagoSubAgente == true) {
                        status = "Pago";
                        color = "#47BC00"; // VERDE
                    } else if (data[i].verificacaoPagoSubAgente == false && d < currentdate) {
                        status = "Dívida";
                        color = "#FF3D00"; // VERMELHO
                    } else if (data[i].verificacaoPagoSubAgente == false && d > currentdate) {
                        status = "Pendente";
                        color = "#747474"; // CINZENTO (DEFAULT)
                    }

                    html = "<a href='/pagamentos/subagente/" + data[i].sub_agente.slug + "/fase/" + data[i].fase.slug + "/" + data[i].idResponsabilidade + "'><div class='row charge-div'> <div class='col-md-1 align-self-center'><div class='white-circle'><img src='http://lykasystems.test/storage/default-photos/M.jpg' width='100%' class='mx-auto'></div></div> <div class='col-md-3 text-truncate align-self-center ml-4'><p class='text-truncate' title='" + data[i].sub_agente.nome + ' ' + data[i].sub_agente.apelido + "'>" + data[i].sub_agente.nome + ' ' + data[i].sub_agente.apelido + "</p></div> <div class='col-md-2 text-truncate align-self-center'><p class='text-truncate'>" + data[i].valorSubAgente.split('.').join(',') + "€</p></div> <div class='col-md-2 align-self-center ml-4'><p class='text-truncate' title='" + duedate + "'>" + duedate + "</p></div> <div class='col-md-2 text-truncate align-self-center ml-auto'><p class='text-truncate' style='color:" + color + ";'>" + status + "</p></div> </div></a>";
                    $(".payments").append(html);
                }

                // Pagamentos as UNIVERSIDADES PRINCIPAIS
                if (data[i].valorUniversidade1 != null && $("#universidades").find(":selected").val() != 'default') {
                    // Formato da DATA DE VENCIMENTO
                    const d = new Date(data[i].dataVencimentoUni1);
                    const da = new Intl.DateTimeFormat('pt', {
                        day: '2-digit'
                    }).format(d);
                    const mo = new Intl.DateTimeFormat('pt', {
                        month: '2-digit'
                    }).format(d);
                    const ye = new Intl.DateTimeFormat('pt', {
                        year: 'numeric'
                    }).format(d);
                    duedate = `${da}/${mo}/${ye}`;

                    // Seleções de CORES _ Estado de PAGAMENTOS
                    if (data[i].verificacaoPagoUni1 == true) {
                        status = "Pago";
                        color = "#47BC00"; // VERDE
                    } else if (data[i].verificacaoPagoUni1 == false && d < currentdate) {
                        status = "Dívida";
                        color = "#FF3D00"; // VERMELHO
                    } else if (data[i].verificacaoPagoUni1 == false && d > currentdate) {
                        status = "Pendente";
                        color = "#747474"; // CINZENTO (DEFAULT)
                    }

                    html = "<a href='/pagamentos/universidade-principal/" + data[i].universidade1.slug + "/fase/" + data[i].fase.slug + "/" + data[i].idResponsabilidade + "'><div class='row charge-div'> <div class='col-md-1 align-self-center'><div class='white-circle'><img src='http://lykasystems.test/storage/default-photos/M.jpg' width='100%' class='mx-auto'></div></div> <div class='col-md-3 text-truncate align-self-center ml-4'><p class='text-truncate' title='" + data[i].universidade1.nome + "'>" + data[i].universidade1.nome + "</p></div> <div class='col-md-2 text-truncate align-self-center'><p class='text-truncate'>" + data[i].valorUniversidade1.split('.').join(',') + "€</p></div> <div class='col-md-2 align-self-center ml-4'><p class='text-truncate' title='" + duedate + "'>" + duedate + "</p></div> <div class='col-md-2 text-truncate align-self-center ml-auto'><p class='text-truncate' style='color:" + color + ";'>" + status + "</p></div> </div></a>";
                    $(".payments").append(html);
                }

                // Pagamentos as UNIVERSIDADES SECUNDÁRIAS
                if (data[i].valorUniversidade2 != null && $("#universidadesec").find(":selected").val() != 'default') {
                    // Formato da DATA DE VENCIMENTO
                    const d = new Date(data[i].dataVencimentoUni2);
                    const da = new Intl.DateTimeFormat('pt', {
                        day: '2-digit'
                    }).format(d);
                    const mo = new Intl.DateTimeFormat('pt', {
                        month: '2-digit'
                    }).format(d);
                    const ye = new Intl.DateTimeFormat('pt', {
                        year: 'numeric'
                    }).format(d);
                    duedate = `${da}/${mo}/${ye}`;

                    // Seleções de CORES _ Estado de PAGAMENTOS
                    if (data[i].verificacaoPagoUni2 == true) {
                        status = "Pago";
                        color = "#47BC00"; // VERDE
                    } else if (data[i].verificacaoPagoUni2 == false && d < currentdate) {
                        status = "Dívida";
                        color = "#FF3D00"; // VERMELHO
                    } else if (data[i].verificacaoPagoUni2 == false && d > currentdate) {
                        status = "Pendente";
                        color = "#747474"; // CINZENTO (DEFAULT)
                    }

                    html = "<a href='/pagamentos/universidade-secundaria/" + data[i].universidade2.slug + "/fase/" + data[i].fase.slug + "/" + data[i].idResponsabilidade + "'><div class='row charge-div'> <div class='col-md-1 align-self-center'><div class='white-circle'><img src='http://lykasystems.test/storage/default-photos/M.jpg' width='100%' class='mx-auto'></div></div> <div class='col-md-3 text-truncate align-self-center ml-4'><p class='text-truncate' title='" + data[i].universidade2.nome + "'>" + data[i].universidade2.nome + "</p></div> <div class='col-md-2 text-truncate align-self-center'><p class='text-truncate'>" + data[i].valorUniversidade2.split('.').join(',') + "€</p></div> <div class='col-md-2 align-self-center ml-4'><p class='text-truncate' title='" + duedate + "'>" + duedate + "</p></div> <div class='col-md-2 text-truncate align-self-center ml-auto'><p class='text-truncate' style='color:" + color + ";'>" + status + "</p></div> </div></a>";
                    $(".payments").append(html);
                }

                // Pagamentos aos FORNECEDORES
                if ($("#fornecedores").find(":selected").val() != 'default') {
                    // Formato da DATA DE VENCIMENTO
                    const d = new Date(data[i].dataVencimento);
                    const da = new Intl.DateTimeFormat('pt', {
                        day: '2-digit'
                    }).format(d);
                    const mo = new Intl.DateTimeFormat('pt', {
                        month: '2-digit'
                    }).format(d);
                    const ye = new Intl.DateTimeFormat('pt', {
                        year: 'numeric'
                    }).format(d);
                    duedate = `${da}/${mo}/${ye}`;

                    // Seleções de CORES _ Estado de PAGAMENTOS
                    if (data[i].verificacaoPago == true) {
                        status = "Pago";
                        color = "#47BC00"; // VERDE
                    } else if (data[i].verificacaoPago == false && d < currentdate) {
                        status = "Dívida";
                        color = "#FF3D00"; // VERMELHO
                    } else if (data[i].verificacaoPago == false && d > currentdate) {
                        status = "Pendente";
                        color = "#747474"; // CINZENTO (DEFAULT)
                    }

                    html = "<a href='/pagamentos/fornecedor/" + data[i].fornecedor.slug + "/fase/" + data[i].responsabilidade.fase.slug + "/" + data[i].idRelacao + "'><div class='row charge-div'> <div class='col-md-1 align-self-center'><div class='white-circle'><img src='http://lykasystems.test/storage/default-photos/M.jpg' width='100%' class='mx-auto'></div></div> <div class='col-md-3 text-truncate align-self-center ml-4'><p class='text-truncate' title='" + data[i].fornecedor.nome + "'>" + data[i].fornecedor.nome + "</p></div> <div class='col-md-2 text-truncate align-self-center'><p class='text-truncate'>" + data[i].valor.split('.').join(',') + "€</p></div> <div class='col-md-2 align-self-center ml-4'><p class='text-truncate' title='" + duedate + "'>" + duedate + "</p></div> <div class='col-md-2 text-truncate align-self-center ml-auto'><p class='text-truncate' style='color:" + color + ";'>" + status + "</p></div> </div></a>";
                    $(".payments").append(html);
                }
            }

            window.location.assign("http://lykasystems.test/pagamentos#append-payment");
            history.pushState("", document.title, window.location.pathname);
        },
        error: function(data) {
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
                window.location.assign("http://lykasystems.test/pagamentos#append-payment");
                history.pushState("", document.title, window.location.pathname);
            } else {
                if ($('#error404').text() != '' || $('#error500').text() != '') {
                    $('#error404').remove();
                    $('#error500').remove();
                }
                error = "<div id='error500'><strong style='color: #e3342f;'>Preencha os campos necessários para a realização de uma filtragem.</strong><br><br></div>";
                $("#search-form").before(error);
            }
        }
    });
});

// Formulário para registar um PAGAMENTO
$('#registar-pagamento-form').submit(function(event) {
    event.preventDefault();
    var id = $("#idResp").val();
    var info = new FormData(this);
    $.ajax({
        type: "post",
        enctype: 'multipart/form-data',
        url: "/pagamentos/" + id + "/registar",
        data: info,
        context: this,
        cache: false,
        processData: false,
        contentType: false,
        beforeSend: function() {
            $('#loader-background').css({
                "display": "block",
                "opacity": "1"
            });
        },
        complete: function() {
            $('#loader-background').css("opacity", 0);
            setTimeout(function() {
                $('#loader').remove();
            }, 0500);
        },
        success: function(data) {
            $("#modal-success").modal("show");
            $("#anchor-stream").attr("href", "/pagamentos/nota-pagamento/" + data.idPagoResp + "/transferir");
            $("#anchor-stream").click(function() {
                setTimeout(function() {
                    window.location.assign("http://lykasystems.test/pagamentos");
                }, 1000);
            });
        },
        error: function() {
            $("#modal-error").modal("show");
        }
    });
});
