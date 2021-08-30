$(() => {
    $('#table').DataTable({
        "language": {
            "sEmptyTable": "Não foi encontrado nenhum registo",
            "sLoadingRecords": "A carregar...",
            "sProcessing": "A processar...",
            "sLengthMenu": "Mostrar _MENU_ registos",
            "sZeroRecords": "Não foram encontrados resultados",
            "sInfo": "Mostrando _END_ de _TOTAL_ registos",
            "sInfoEmpty": "Mostrando de 0 de 0 registos",
            "sInfoFiltered": "(filtrado de _MAX_ registos no total)",
            "sInfoPostFix": "",
            "sSearch": "Procurar:",
            "sUrl": "",
            "oPaginate": {
                "sFirst": "Primeiro",
                "sPrevious": "Anterior",
                "sNext": "Seguinte",
                "sLast": "Último"
            },
            "oAria": {
                "sSortAscending": ": Ordenar colunas de forma ascendente",
                "sSortDescending": ": Ordenar colunas de forma descendente"
            }
        }
    });

    var clone = $('#clonar').clone();
    $('#clonar').remove();
    var clonecity = $('#clonecity').clone();
    $('#clonecity').remove();
});

function GetCountries() {

    GetList();
    $('.butCity').children('option:not(:first)').remove();
    var pais = null;

    if ($('#pais').val() != "null") {
        pais = $('#pais').val();
    }
    if (pais) {
        $('.butCity').attr("readonly", false);
        var link = '/../api/listagem/cidades/' + pais;
        $.ajax({
                method: "GET",
                url: link
            })
            .done(function (response) {
                if (response != null) {
                    for (i = 0; i < response.results.length; i++) {
                        var CloneCidade = clonecity.clone();
                        $(CloneCidade).text(response.results[i]);
                        $(CloneCidade).attr(response.results[i]);
                        $('.butCity').append(CloneCidade);
                    }
                }
            })
    } else {
        $('.butCity').attr("readonly", true);
    }
}

function GetList() {
    $('#table-body').html("");

    var lista = null;

    if ($('#pais').val() != "null") {
        lista = "pais-" + $('#pais').val();
    } else {
        lista = "pais-null";
    }

    if ($('#cidade').val() != "null") {
        lista += "_cidade-" + $('#cidade').val();
    } else {
        lista += "_cidade-null";
    }

    if ($('#agente').val() != "null") {
        lista += "_agente-" + $('#agente').val();
    } else {
        lista += "_agente-null";
    }

    if ($('#subagente').val() != "null") {
        lista += "_subagente-" + $('#subagente').val();
    } else {
        lista += "_subagente-null";
    }

    if ($('#universidade').val() != "null") {
        lista += "_universidade-" + $('#universidade').val();
    } else {
        lista += "_universidade-null";
    }

    if ($('#curso').val() != "null") {
        lista += "_curso-" + $('#curso').val();
    } else {
        lista += "_curso-null";
    }

    if ($('#institutoOrigem').val() != "null") {
        lista += "_institutoOrigem-" + $('#institutoOrigem').val();
    } else {
        lista += "_institutoOrigem-null";
    }

    if ($('#atividade').val() != "null") {
        lista += "_atividade-" + $('#atividade').val();
    } else {
        lista += "_atividade-null";
    }

    var link = '/../api/listagem/' + lista;
    $.ajax({
            method: "GET",
            url: link
        })
        .done(function (response) {
            if (response != null) {
                for (i = 0; i < response.results.length; i++) {
                    var resultClone = clone.clone();

                    $('.routa-show', resultClone).attr('href', "clientes/" + response.results[i].slug);
                    $('.routa-show', resultClone).text(response.results[i].nome + " " + response.results[i].apelido);

                    $('.numPassaporte', resultClone).text(response.results[i].numPassaporte);

                    $('.paisNaturalidade', resultClone).text(response.results[i].paisNaturalidade);

                    if (response.results[i].estado == "Inativo") {
                        $('.span-estado', resultClone).text('Inativo');
                        $('.span-estado', resultClone).attr('class', 'span-estado text-danger');
                    } else {
                        if (response.results[i].estado == "Ativo") {
                            $('.span-estado', resultClone).text('Ativo');
                            $('.span-estado', resultClone).attr('class', 'span-estado text-success');
                        } else {
                            $('.span-estado', resultClone).text('Proponente');
                            $('.span-estado', resultClone).attr('class', 'span-estado text-info');
                        }
                    }

                    $('.butao-show', resultClone).attr('href', "clientes/" + response.results[i].slug);


                    $('#table-body').append(resultClone);
                }
            }
        })
}
