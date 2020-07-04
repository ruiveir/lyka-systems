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

        "order": [1, 'desc'],

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



    /* OPÇÃO DE APAGAR */
    var formToSubmit //Variavel para indicar o forumulário a submeter

    $(".form_university_id").submit(function (e) {
        e.preventDefault();
        formToSubmit = this;
        $("#tituloUniversidade").text($(this).attr("data"));
        return false;
    });

    //click sim na modal
    $(".btn_submit").click(function (e) {
        formToSubmit.submit();
    });






    /* VALIDAÇÃO DE INPUTS */

    /* Apenas letras:  .lettersOnly();  */
    /*     $("#inputNome").lettersOnly(); */

    if ($('#inputTelefone').length) {
        /* Apenas numeros:  .numbersOnly();  */
        $("#inputTelefone").numbersOnly();
        $("#inputNIF").numbersOnly();
        $("#inputIBAN").numbersOnly();
    }





    /* VALIDAÇÃO DO FORMULÁRIO */
    (function () {
        'use strict';
        window.addEventListener('load', function () {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function (form) {
                form.addEventListener('submit', function (event) {

                        /* mostrar div de espera */
                        $("#wait_screen").show();

                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();

                        /* valida os  Campos  */
                        if (($("#inputNome").val() == "") || ($("#inputNIF").val() == "") || ($("#inputEmail").val() == "") ) {
                            $("#wait_screen").hide();
                            $("#warning_msg").show();
                            $("#infos-tab").addClass("border-danger text-danger");
                        } else {
                            $("#wait_screen").hide();
                            $("#infos-tab").removeClass("border-danger text-danger");
                        }
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();







});
