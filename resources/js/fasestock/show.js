$(() => {
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

    // Modal for DELETE
    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var modal = $(this);
        modal.find("form").attr('action', '/documentostock/' + button.data('slug'));
    });

    // Modal for EDIT
    $('#editDocument').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var modal = $(this);
        modal.find("form").attr('action', '/documentostock/' + button.data('slug'));
        modal.find("form #tipoDocumento").val(button.data('name'));
        option = "<option selected hidden disabled value='" + button.data('tipo') + "'>" + button.data('tipo') + "</option>";
        modal.find("form #tipo").prepend(option);
    });
});
