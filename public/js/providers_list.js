$(document).ready(function () {

    var table = $('#dataTable').DataTable({

        "pageLength": 100,

        "columnDefs": [
            {
                "orderable": false,
                "targets": 2
            },
            {
                "orderable": false,
                "width": "130px",
                "targets": 3
            },

        ],


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

        "order": [1, 'asc'],

        /* "bLengthChange": false, */
        /* "bFilter": false, */


    });


    $(".dataTables_filter").hide(); // Esconde o input search por defeito
    $("#customSearchBox").on('keyup', function () {
        $(".dataTables_filter input").val($("#customSearchBox").val())
        table.search($(".dataTables_filter input").val()).draw();
    });



    $('.dataTables_length').hide(); // Esconde o select "rows per page" por defeito
    $('#records_per_page').val(table.page.len());
    $('#records_per_page').change(function () {
        table.page.len($(this).val()).draw();
    });

    /* FIM configs DATATABLES */





    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var name = button.data('name');
        var modal = $(this);
        modal.find('#text').text('Pretende eliminar o fornecedor ' + name + '?');
        modal.find('#provider-delete-descricao').val(button.data('descricao'));
        modal.find("form").attr('action', '/fornecedores/' + button.data('descricao'));
    });



});
