var clones = $('#clonar').clone();
$(".clones").remove();
$("#formulario-produto").css("display", "none");
$("#formulario-fases").css("display", "none");

$(() => {
    $(".needs-validation").on('submit', event => {
        if (event.target.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
        } else {
            $("#cancelBtn").removeAttr("onclick");
            button =
                "<button class='btn btn-primary' type='submit' disabled><span class='spinner-border spinner-border-sm' role='status' aria-hidden='true' style='position:relative; bottom:4px; right:3px;'></span>A enviar...</button>";
            $("#groupBtn").append(button);
            $("#submitbtn").remove();
        }
        $(".needs-validation").addClass("was-validated");
    });
});

function addFornecedor(idFase, closest) {
    console.log(idFase);
    var numF = parseInt(closest.find('.numF').first().text());
    var clone = clones.clone();
    closest.find('.numF').first().text(numF + 1);
    clone.attr('id', 'div-fornecedor' + numF + '-fase' + idFase);
    $('#label1', clone).text("Fornecedor #" + numF + ":");
    $('#label1', clone).attr('for', 'fornecedor' + numF + '-fase' + idFase);
    $('select', clone).attr('id', 'fornecedor' + numF + '-fase' + idFase);
    $('select', clone).attr('name', 'fornecedor' + numF + '-fase' + idFase);
    $('#label2', clone).attr('for', 'valor-fornecedor' + numF + '-fase' + idFase);
    $('#valor-fornecedor-fase', clone).attr('name', 'valor-fornecedor' + numF + '-fase' + idFase);
    $('#valor-fornecedor-fase', clone).attr('id', 'valor-fornecedor' + numF + '-fase' + idFase);
    $('#label3', clone).text('Data de vencimento (Fornecedor #' + numF + ")");
    $('#label3', clone).attr('for', 'data-fornecedor' + numF + '-fase' + idFase);
    $('#data-fornecedor-fase' + idFase, clone).attr('name', 'data-fornecedor' + numF + '-fase' + idFase);
    $('#data-fornecedor-fase' + idFase, clone).attr('id', 'data-fornecedor' + numF + '-fase' + idFase);
    $('#button', clone).attr('onclick', 'removerFornecedor(' + numF + ',' + idFase + ',$(this).closest("#div-fornecedor' + numF + '-fase' + idFase + '"))');
    $('#a_button', clone).text('Remover fornecedor ' + numF);
    closest.find('.fornecedor').first().append(clone);
}

function removerFornecedor(numF, idFase, fornecedor) {
    $('#fornecedor' + numF + '-fase' + idFase).val($('#fornecedor' + numF + '-fase' + idFase + ' > option:first').val());
    $("#fornecedor" + numF + "-fase" + idFase).attr("required", false);
    $("#valor-fornecedor" + numF + "-fase" + idFase).attr("required", false);
    fornecedor.css("display", "none");
}

function AlteraInputSubAgente(input) {
    var valueInput = input.val();
    if (valueInput) {
        $(".valor-responsabilidade-subagente").css("display", "block");
        $(".valor-responsabilidade-subagente").find(input).first().attr("required", true);
    } else {
        $(".valor-responsabilidade-subagente").css("display", "none");
        $(".valor-responsabilidade-subagente").find(input).first().attr("required", false);
    }
}

function adicionaValorSubAgente(valorAgente, formulario, valorTotal) {
    var inputAgente = formulario.find('.valor-pagar-agente').first();
    var inputSubAgente = formulario.find('.valor-pagar-subagente').first();
    var valorSubAgente = parseFloat(inputSubAgente.text());
    var novoValorAgente = valorTotal - valorSubAgente;
    if (novoValorAgente == 0) {
        inputAgente.text(0);
        inputSubAgente.text(valorAgente);
    } else {
        if (novoValorAgente < 0) {
            inputAgente.text(0);
            inputSubAgente.text(valorTotal);
        } else {
            inputAgente.text(novoValorAgente);
        }
    }
}
