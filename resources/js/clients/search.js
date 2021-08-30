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
            },
            "pageLength": 50
        }
    });

    // Modal for DELETE
    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var modal = $(this);
        modal.find("form").attr('action', '/estudantes/' + button.data('slug'));
    });

    /* Variavel para permitir/negar pesquisa */
    var pesquisaOk = 1;
    /*  console.log('Inicial: '+pesquisaOk); */

    /* Inicialmente, esconde todos os DIV's dentro do div "searchfields", exepto "divPaisOrigem" */
    $('#searchfields div:not(#divPaisOrigem)').hide();


    /* Quando os dados da pesquisa são alterados */
    $('#searchfields :input').on('change', function () {
        if (pesquisaOk == 1) {
            pesquisaOk++;
        }

        /* console.log('searchFields: '+pesquisaOk); */
    });


    /* Quando os Campos da pesquisa são alterados */
    $('#search_options').on('change', function () {
        /* Pais de origem */
        if ($('#search_options').val() == "País de origem") {
            $('#searchfields div:not(#divPaisOrigem)').hide();
            $("#divPaisOrigem").show();
        }

        /* Cidade de origem */
        if ($('#search_options').val() == "Cidade de origem") {
            $('#searchfields div:not(#divCidade)').hide();
            $("#divCidade").show();
        }

        /* Instituição de origem */
        if ($('#search_options').val() == "Instituição de origem") {
            $('#searchfields div:not(#divInstituicaoOrigem)').hide();
            $("#divInstituicaoOrigem").show();
        }

        /* Agente */
        if ($('#search_options').val() == "Agente") {
            $('#searchfields div:not(#divAgents)').hide();
            $("#divAgents").show();
        }

        /* Universidade */
        if ($('#search_options').val() == "Universidade") {
            $('#searchfields div:not(#divUniversidades)').hide();
            $("#divUniversidades").show();
        }


        /* Nível de estudos */
        if ($('#search_options').val() == "Nível de estudos") {
            $('#searchfields div:not(#divNivelEstudos)').hide();
            $("#divNivelEstudos").show();
        }


        /* Estado de cliente */
        if ($('#search_options').val() == "Estado de cliente") {
            $('#searchfields div:not(#divEstadoCliente)').hide();
            $("#divEstadoCliente").show();
        }

        pesquisaOk = 1;
        /* console.log('Campos: '+pesquisaOk); */

    });

    /* Opções de campos visiveis na ListeningStateChangedEvent( checkbox) */
    var $chk = $("#grpChkBox input:checkbox");
    var $tbl = $("#dataTable");
    var $tblhead = $("#dataTable th");


    $chk.on('click', event => {
        var colToHide = $tblhead.filter("." + $(event.currentTarget).attr("name"));
        var index = $(colToHide).index();
        $tbl.find('tr :nth-child(' + (index + 1) + ')').not(".btn-outline-danger, .btn-outline-warning, .btn-outline-primary").toggle();
    });

    /* Verifica se os campos de pesquisa foram modificados. Se sim, permite a pesquisa */
    $("#searchForm").on('submit', event => {
        if (pesquisaOk >= 2) {
            /* mostrar div de espera */
            $("#wait_screen").show();
            return;
        }
        event.preventDefault();
    });
});
