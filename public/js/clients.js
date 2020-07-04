    $(document).ready(function () {

        var table = $('#dataTable').DataTable({

            "pageLength": 100,

            "columnDefs": [
/*                 {
                    "orderable": false,
                    "width": "60px",
                    "targets": 0
                }, */
/*                 {
                    "orderable": false,
                    "targets": 2
                }, */
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







        /* Definir paisNaturalidade */
        var str_paisNaturalidade = $("#hidden_paisNaturalidade").val();
        $('#paisNaturalidade').val(str_paisNaturalidade);


        /* Definir passaportPaisEmi */
        var str_passaportPaisEmi = $("#hidden_passaportPaisEmi").val();
        $('#passaportPaisEmi').val(str_passaportPaisEmi);





        //Preview da fotografia++++++++++++++++++
        $('#preview').on('click', function (e) {
            e.preventDefault();
            $('#fotografia').trigger('click');
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#preview').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#fotografia").change(function () {
            readURL(this);
        });




        //Preview do DOCUMENTO DE IDENTIFICAÇÃO+++++++++++++++

        $('#doc_id_preview_file').on('click', function (e) {
            e.preventDefault();
            $('#img_docOficial').trigger('click');
        });

        $('#doc_id_preview').on('click', function (e) {
            e.preventDefault();
            $('#img_docOficial').trigger('click');
        });


        function readDocImgURL(input) {
            if (input.files && input.files[0]) {
                var iddocumento = new FileReader();
                iddocumento.onload = function (e) {
                    iddocumento.fileName = img_docOficial.name;
                    $('#name_doc_id_file').text(input.files[0].name);
                }

                iddocumento.readAsDataURL(input.files[0]);
            }
        }

        $("#img_docOficial").change(function () {
            readDocImgURL(this);
            $('#doc_id_preview_file').hide();
            $('#doc_id_preview').show();

        });





        //Preview do Passporte+++++++++++++++
        $('#passport_preview_file').on('click', function (e) {
            e.preventDefault();
            $('#img_Passaporte').trigger('click');
        });

        $('#passporte_preview').on('click', function (e) {
            e.preventDefault();
            $('#img_Passaporte').trigger('click');
        });


        function readPassaPortImgURL(input) {
            if (input.files && input.files[0]) {
                var iddocumento = new FileReader();
                iddocumento.onload = function (e) {
                    iddocumento.fileName = img_Passaporte.name;
                    $('#name_passaporte_file').text(input.files[0].name);
                }

                iddocumento.readAsDataURL(input.files[0]);
            }
        }

        $("#img_Passaporte").change(function () {
            readPassaPortImgURL(this);
            $('#passport_preview_file').hide();
            $('#passporte_preview').show();

        });




        /* Permitir/negar edição */



        /* Estado inicial */
        /* Para novo cliente */


        if ($('#editavel').length) {
            if( $('#editavel').val().length<=1){
                $('#editavel').val("1");
            }
        }

        /* Caso a edição seja permitida */
        if( $('#editavel').val()==1 ){
            $("#editavel_sim").show();
            $("#editavel_nao").hide();
        }else{
        /* Caso a edição NÃO seja permitida */
            $("#editavel_sim").hide();
            $("#editavel_nao").show();
        }


        /* Mudança de estado */
        $('#btn_editavel').click(function(){
            if ( $('#editavel').val()==1 ){
                $("#editavel_sim").hide();
                $("#editavel_nao").show();
                $('#editavel').val(0);
            }else{
                $("#editavel_sim").show();
                $("#editavel_nao").hide();
                $('#editavel').val(1);
            }

        });



        /* OPÇÃO DE APAGAR */
        var formToSubmit //Variavel para indicar o forumulário a submeter

        $(".form_client_id").submit(function (e) {
            e.preventDefault();
            formToSubmit = this;
            $("#student_name").text($(this).attr("data"));
            return false;
        });

        //click sim na modal
        $(".btn_submit").click(function (e) {
            formToSubmit.submit();
        });






        /* VALIDAÇÃO DE INPUTS */

        if ($('#nome').length) {

            /* Apenas letras:  .lettersOnly();  */
            $("#nome").lettersOnly();
            $("#apelido").lettersOnly();
            $("#cidadeInstituicaoOrigem").lettersOnly();
            $("#nomePai").lettersOnly();
            $("#nomeMae").lettersOnly();
            $("#localEmissaoPP").lettersOnly();

            /* Apenas numeros:  .numbersOnly();  */
            $("#telefone1").numbersOnly();
            $("#telefone2").numbersOnly();
            $("#telefonePai").numbersOnly();
            $("#telefoneMae").numbersOnly();
            /*$("#num_docOficial").numbersOnly();
            $("#numPassaporte").numbersOnly();
            $("#IBAN").numbersOnly(); */
            $("#NIF").numbersOnly();

        }



        /* Quando um input é modificado remove a validação do bootstrap */
        $("input, select").change(function(){
            $(this).removeClass("is-invalid");
          });



/*           Validação do formulário / campos */

        $('#form_client').on('submit', function () {

            /* mostrar div de espera */
            $("#wait_screen").show();

            var validated = true;

            /* valida Campos da informação pessoal */

            /* Campo do nome */
            if ($("#nome").val() == "") {
                $("#wait_screen").hide();
                $("#nome").addClass("is-invalid");
                $("#pessoal-tab").addClass("border-danger text-danger");
                $("#warning_msg").show();
                validated = false;
            } else {
                /* $("#pessoal-tab").removeClass("border-danger text-danger"); */
                $("#nome").removeClass("is-invalid");
            }


            /* Campo do apelido */
            if ($("#apelido").val() == "") {
                $("#wait_screen").hide();
                $("#apelido").addClass("is-invalid");
                $("#pessoal-tab").addClass("border-danger text-danger");
                $("#warning_msg").show();
                validated = false;
            } else {
                /* $("#pessoal-tab").removeClass("border-danger text-danger"); */
                $("#apelido").removeClass("is-invalid");
            }


            /* Campo do genero */
            if ($("#genero").val() == "") {
                $("#wait_screen").hide();
                $("#genero").addClass("is-invalid");
                $("#pessoal-tab").addClass("border-danger text-danger");
                $("#warning_msg").show();
                validated = false;
            } else {
                /* $("#pessoal-tab").removeClass("border-danger text-danger"); */
                $("#genero").removeClass("is-invalid");
            }


            /* Campo do paisNaturalidade */
            if ($("#paisNaturalidade").val() == "") {
                $("#wait_screen").hide();
                $("#paisNaturalidade").addClass("is-invalid");
                $("#pessoal-tab").addClass("border-danger text-danger");
                $("#warning_msg").show();
                validated = false;
            } else {
                /* $("#pessoal-tab").removeClass("border-danger text-danger"); */
                $("#paisNaturalidade").removeClass("is-invalid");
            }


            if( $("#nome").val() != "" && $("#apelido").val() != "" && $("#paisNaturalidade").val() != "" && $("#genero").val() != ""  ){
                $("#pessoal-tab").removeClass("border-danger text-danger");
            }



            /* Campo do e-mail  */
/*             if (($("#email").val() == "")) {
                $("#wait_screen").hide();
                $("#email").addClass("is-invalid");
                $("#contacts-tab").addClass("border-danger text-danger");
                $("#warning_msg").show();
                validated = false;
            } else {
                $("#contacts-tab").removeClass("border-danger text-danger");
                $("#email").removeClass("is-invalid");

            } */



            /* Valida se tem agente associado */
            if ($('#idAgente').val() == "0") {
                $("#wait_screen").hide();
                $("#idAgente").addClass("is-invalid");
                $("#div_agente").addClass("border border-danger text-danger ");
                $("#idAgente").removeClass("is-valid");
                $("#idAgente").addClass("is-invalid");
                $("#idAgente").css("background-image", "none");
                $("#warning_msg").show();
                validated = false;
            } else {
                $("#div_agente").removeClass("border-danger text-danger");
                $("#idAgente").removeClass("is-invalid");
            }




            if (validated==true) {
                return true;
            } else {
                $("#wait_screen").hide();
                window.scrollTo(0, 0);
                return false;
            }

        });




    });
