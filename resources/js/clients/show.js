// Truncate a string
function strtrunc(str, max, add) {
    add = add || '...';
    return (typeof str === 'string' && str.length > max ? str.substring(0, max) + add : str);
};

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
        },
        "order": [
            [5, 'desc'],
            [4, 'asc']
        ],
        "columnDefs": [{
                "targets": 4,
                "type": "date-eu"
            },
            {
                'targets': [1, 2],
                'render': function (data, type, full, meta) {
                    if (type === 'display') {
                        data = strtrunc(data, 12);
                    }
                    return data;
                }
            }
        ]
    });

    $('#tableObs').DataTable({
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

    var options = [{
            "option": document.getElementById("produtos-tab")
        },
        {
            "option": document.getElementById("documentation-tab")
        },
        {
            "option": document.getElementById("academicos-tab")
        },
        {
            "option": document.getElementById("contacts-tab")
        },
        {
            "option": document.getElementById("financas-tab")
        },
        {
            "option": document.getElementById("observations-tab")
        }
    ]

    $("#produtos-tab, #documentation-tab, #academicos-tab, #contacts-tab, #financas-tab, #observations-tab").on('click', event => {
        for (var i = 0; i < options.length; i++) {
            if (event.currentTarget.id === options[i].option.id) {
                $(event.currentTarget).removeClass("bg-white").addClass("bg-primary text-white");
            } else {
                $(options[i].option).removeClass("bg-primary text-white").addClass("bg-white");
            }
        }
    });

    $(".needs-validation").on('submit', event => {
        if (event.currentTarget.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
        } else {
            $("#cancelBtn").removeAttr("onclick");
            button =
                "<button class='btn btn-primary' type='submit' disabled><span class='spinner-border spinner-border-sm' role='status' aria-hidden='true' style='position:relative; bottom:4px; right:3px;'></span>A fazer o registo...</button>";
            $("#groupBtn").append(button);
            $("#submitbtn").remove();
        }
        $(".needs-validation").addClass("was-validated");
    });

    $('#printModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var modal = $(this);
        modal.find("form").attr('action', '/clientes/imprimir-ficha-financeiro/' + button.data('slug'));
    });

    $('#deleteObs').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var modal = $(this);
        modal.find("form").attr('action', '/clientes/observacoes-pessoais/' + button.data('slugobs') + '/' + button.data('slugcliente') + '/apagar');
    });

    $('#editObs').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var modal = $(this);
        modal.find("#titulo").val(button.data("titulo"));
        modal.find("#texto").val(button.data("texto"));
        modal.find("form").attr('action', '/clientes/observacoes-pessoais/' + button.data('slugobs') + '/' + button.data('slugcliente') + '/editar');
    });

    $("#submitPrint").on('click', () => {
        $('#printModal').modal('hide');
    })
});
