var clones = $('#clonar').clone();
$('.fornecedor').html('');

$(() => {
    $(".needs-validation").on('submit', event => {
        if (event.currentTarget.checkValidity() === false) {
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
    var numF = parseInt(closest.find('.numF').first().text());
    var clone = clones.clone();
    var sup = "<sup class='text-danger small'>&#10033;</sup>";
    closest.find('.numF').first().text(numF + 1);
    clone.attr('id', 'div-fornecedor' + numF + '-fase' + idFase);
    $('#label1', clone).text("Fornecedor #" + numF);
    $('#label1', clone).append(" " + sup);
    $('#label1', clone).attr('for', 'fornecedor' + numF + '-fase' + idFase);
    $('select', clone).attr('id', 'fornecedor' + numF + '-fase' + idFase);
    $('select', clone).attr('name', 'fornecedor' + numF + '-fase' + idFase);
    $('#label2', clone).attr('for', 'valor-fornecedor' + numF + '-fase' + idFase);
    $('#valor-fornecedor-fase', clone).attr('name', 'valor-fornecedor' + numF + '-fase' + idFase);
    $('#valor-fornecedor-fase', clone).attr('id', 'valor-fornecedor' + numF + '-fase' + idFase);
    $('#label3', clone).text('Data de vencimento (Fornecedor #' + numF + ")");
    $('#label3', clone).attr('for', 'data-fornecedor' + numF + '-fase' + idFase);
    $('#data-fornecedor-fase', clone).attr('name', 'data-fornecedor' + numF + '-fase' + idFase);
    $('#data-fornecedor-fase', clone).attr('id', 'data-fornecedor' + numF + '-fase' + idFase);
    $('#button', clone).attr('onclick', 'removerFornecedor(' + numF + ',' + idFase + ',$(this).closest("#div-fornecedor' + numF + '-fase' + idFase + '"))');
    $('#a_button', clone).text('Remover fornecedor #' + numF);
    closest.find('.fornecedor').first().append(clone);
}

function removerFornecedor(numF, idFase, fornecedor) {
    $('#fornecedor' + numF + '-fase' + idFase).val($('#fornecedor' + numF + '-fase' + idFase + ' > option:first').val());
    $("#fornecedor" + numF + "-fase" + idFase).attr("required", false);
    $("#valor-fornecedor" + numF + "-fase" + idFase).attr("required", false);
    fornecedor.css("display", "none");
}
