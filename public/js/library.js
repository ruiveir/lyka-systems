    $(document).ready(function () {

                /* OPÇÃO DE APAGAR */
                var formToSubmit //Variavel para indicar o forumulário a submeter

                $(".form_file_id").submit(function (e) {
                    e.preventDefault();
                    formToSubmit = this;
                    $("#deletefile_name").text($(this).attr("data"));
                    return false;
                });

                //click sim na modal
                $(".btn_submit").click(function (e) {
                    formToSubmit.submit();
                });





        /* Verificação inicial: Existe Ficheiro? */

        /* SE EXISTE */
        if ($("#file_name").val() !='') {
            $("#div_nofile").hide();
            $("#add_file").hide();
            $("#replace_file").show();
            $("#div_propriedades").show();

            /* SE NÃO EXISTE */
        } else {
            $("#div_nofile").show();
            $("#add_file").show();
            $("#replace_file").hide();
            $("#div_propriedades").hide();
        }


        /* Clique no file input */
        $('#add_file , #replace_file').on('click', function (e) {
            e.preventDefault();
            $('#ficheiro').trigger('click');
        });



        /* Lê o ficheiro */
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {

                    $("#add_file").hide();
                    $("#replace_file").show();

                    $("#div_nofile").hide();
                    $("#div_propriedades").show();

                    var str = input.files[0].name;
                    str = str.split('.').slice(0, -1).join('.'); /* remove a extensão nome do ficheiro*/
                    str = str.replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '-'); /* remove caracteres especiais do nome*/
                    str = str.substring(0, 15); /* limita o nome a 15 caracteres */

                    $('#file_name').val(str);
                    $('#aux_file_name').text(input.files[0].name);
                    $('#aux_file_name').val(input.files[0].name);

                    $('#info_fileType').text(input.files[0].type);
                    $('#tipo').val(input.files[0].type);

                    $('#info_fileSize').text( formatBytes(input.files[0].size) );
                    $('#tamanho').val( formatBytes(input.files[0].size ));

                    $('#descricao').focus();

                    $('#file_frame').removeClass("border-danger");
                    $('#warning-file').hide();
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#ficheiro").change(function () {
            readURL(this);
        });





        /* Converte Tamanho de ficheiro */
        function formatBytes(bytes, decimals = 2) {
            if (bytes === 0) return '0 Bytes';

            const k = 1024;
            const dm = decimals < 0 ? 0 : decimals;
            const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];

            const i = Math.floor(Math.log(bytes) / Math.log(k));

            return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
        }





        /* Formata a data de modificação do ficheiro */
        function formatDate(date) {
            var d = new Date(date),
                month = '' + (d.getMonth() + 1),
                day = '' + d.getDate(),
                year = d.getFullYear();

            if (month.length < 2) month = '0' + month;
            if (day.length < 2) day = '0' + day;

            return [day,month,year].join(' / ');
        }




        /* VALIDAÇÃO DO FORMULÁRIO */
        (function() {
            'use strict';
            window.addEventListener('load', function() {
              // Fetch all the forms we want to apply custom Bootstrap validation styles to
              var forms = document.getElementsByClassName('needs-validation');
              // Loop over them and prevent submission
              var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {

                    /* mostrar div de espera */
                    $("#wait_screen").show();

                  if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();



                    if ( $('#aux_file_name').val()==""){
                        $("#wait_screen").hide();
                        $('#file_frame').addClass("border-danger");
                        $('#warning-file').show();
                        return;
                    }

                    /* É obrigatório ter uma descrição */
                    if ( $("#descricao").val()=="" ){
                        $("#wait_screen").hide();
                        $("#descricao").addClass("is-invalid");
                        $("#descricao").addClass(":invalid");
                        $('#descricao').focus();
                        return;
                    }

                  }
                  form.classList.add('was-validated');
                }, false);
              });
            }, false);
          })();













    });
