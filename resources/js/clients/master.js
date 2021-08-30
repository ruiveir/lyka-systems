$(() => {
    /* Definir passaportPaisEmi */
    var str_passaportPaisEmi = $("#hidden_passaportPaisEmi").val();
    $('#passaportPaisEmi').val(str_passaportPaisEmi);

    //Preview da fotografia++++++++++++++++++
    $('#preview').on('click', event => {
        event.preventDefault();
        $('#fotografia').trigger('click');
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = () => {
                $('#preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#fotografia").on('change', event => {
        readURL(event.currentTarget);
    });

    //Preview do DOCUMENTO DE IDENTIFICAÇÃO+++++++++++++++

    $('#doc_id_preview_file').on('click', event => {
        event.preventDefault();
        $('#img_docOficial').trigger('click');
    });

    $('#doc_id_preview').on('click', event => {
        event.preventDefault();
        $('#img_docOficial').trigger('click');
    });

    function readDocImgURL(input) {
        if (input.files && input.files[0]) {
            var iddocumento = new FileReader();
            iddocumento.onload = () => {
                iddocumento.fileName = img_docOficial.name;
                $('#name_doc_id_file').text(input.files[0].name);
            }

            iddocumento.readAsDataURL(input.files[0]);
        }
    }

    $("#img_docOficial").on('change', event => {
        readDocImgURL(event.currentTarget);
        $('#doc_id_preview_file').hide();
        $('#doc_id_preview').show();

    });

    //Preview do Passporte+++++++++++++++
    $('#passport_preview_file').on('click', event => {
        event.preventDefault();
        $('#img_Passaporte').trigger('click');
    });

    $('#passporte_preview').on('click', event => {
        event.preventDefault();
        $('#img_Passaporte').trigger('click');
    });

    function readPassaPortImgURL(input) {
        if (input.files && input.files[0]) {
            var iddocumento = new FileReader();
            iddocumento.onload = () => {
                iddocumento.fileName = img_Passaporte.name;
                $('#name_passaporte_file').text(input.files[0].name);
            }

            iddocumento.readAsDataURL(input.files[0]);
        }
    }

    $("#img_Passaporte").on('change', event => {
        readPassaPortImgURL(event.currentTarget);
        $('#passport_preview_file').hide();
        $('#passporte_preview').show();

    });

    if ($('#editavel').length) {
        if ($('#editavel').val().length <= 1) {
            $('#editavel').val("1");
        }
    }

    /* OPÇÃO DE APAGAR */
    var formToSubmit

    $(".form_client_id").on('submit', event => {
        event.preventDefault();
        formToSubmit = event.currentTarget;
        $("#student_name").text($(event.currentTarget).attr("data"));
        return false;
    });

    //click sim na modal
    $(".btn_submit").on('click', () => {
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
    $("input, select").on('change', event => {
        $(event.currentTarget).removeClass("is-invalid");
    });

    $('#form_client').on('submit', function () {

        $("#wait_screen").show();

        var validated = true;

        /* Campo do nome */
        if ($("#nome").val() == "") {
            $("#wait_screen").hide();
            $("#nome").addClass("is-invalid");
            $("#pessoal-tab").addClass("border-danger");
            $("#pessoal-tab").css("color", "#e74a3b");
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
            $("#pessoal-tab").addClass("border-danger");
            $("#pessoal-tab").css("color", "#e74a3b");
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
            $("#pessoal-tab").css("color", "#e74a3b");
            $("#pessoal-tab").addClass("border-danger");
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
            $("#pessoal-tab").addClass("border-danger");
            $("#pessoal-tab").css("color", "#e74a3b");
            $("#warning_msg").show();
            validated = false;
        } else {
            /* $("#pessoal-tab").removeClass("border-danger text-danger"); */
            $("#paisNaturalidade").removeClass("is-invalid");
        }


        if ($("#nome").val() != "" && $("#apelido").val() != "" && $("#paisNaturalidade").val() != "" && $("#genero").val() != "") {
            $("#pessoal-tab").removeClass("border-danger text-danger");
        }

        if (validated == true) {
            return true;
        } else {
            $("#wait_screen").hide();
            window.scrollTo(0, 0);
            return false;
        }
    });
});
