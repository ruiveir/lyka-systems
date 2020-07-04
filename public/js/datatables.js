$(document).ready(function() {

    var table = $('#dataTable').DataTable({

        "columnDefs": [{
                "orderable": false,
                "width": "60px",
                "targets": 0
            },
            {
                "orderable": false,
                "targets": 2
            },
            {
                "orderable": false,
                "width": "130px",
                "targets": 4
            },

        ],


        "language": {
            "lengthMenu": "Mostrar _MENU_ por página",
            "search": "Procurar",
            "zeroRecords": "Sem registos",
            "paginate": {
                "first": "Primeiro",
                "last": "Ultimo",
                "next": "Seguinte",
                "previous": "Anterior"
            },

            "info": "",
            "infoEmpty": "",
            "infoFiltered": ""
        },

        "order": [2, 'asc'],
    });


    $(".dataTables_filter").hide()
    $("#customSearchBox").on('keyup', function() {
        $(".dataTables_filter input").val($("#customSearchBox").val())
        table.search($(".dataTables_filter input").val()).draw();
    });



    $('.dataTables_length').hide();
    $('#records_per_page').val(table.page.len());
    $('#records_per_page').change(function() {
        table.page.len($(this).val()).draw();
    });
});
