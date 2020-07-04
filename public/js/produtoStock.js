$(document).ready(function () {

    var table = $('#dataTable').DataTable({

        "pageLength": 100,

        "columnDefs": [
            {
                "orderable": false,
                "width": "130px",
                "targets": -1
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









    /* Isto é utilizado??? */

    var clones = $('.clonar').clone();
    $('.fases').html('');
    function AtualizaProduto(Produtos){
        var idproduto = new Array;
        $("select.toolbar-escolha#produto").each(function () {
            idproduto.push(this.value);
        });
        var filtros = null;
        var i;
        for (i = 0; i < Produtos.length; i++) {
            filtros = filtros + filtroCB[i] + "_" + checkbox[i] + "__";
            if(Produtos[i].idProduto == idproduto){
                var clone = clones.clone();
                $('#fases-tab', clone).attr('href','fase-'+Produtos[i].idProduto);
                $('#fases-tab', clone).attr('aria-controls','fase-'+Produtos[i].idProduto);
                $('#fases-tab', clone).attr('id','fase'+Produtos[i].idProduto+'-tab');
                $('.fases').append(clone);
            }
        }
    }


});










