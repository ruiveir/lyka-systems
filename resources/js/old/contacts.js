$(document).ready(function () {

    var table = $('#dataTable').DataTable({
        "pageLength": 100,

        "columnDefs": [{
                "orderable": false,
                "width": "60px",
                "targets": 0
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
    $('#records_per_page').on('change', () => {
        table.page.len($(this).val()).draw();
    });


    /* FIM configs DATATABLES */



        /* OPÇÃO DE APAGAR */
        var formToSubmit //Variavel para indicar o forumulário a submeter

        $(".form_contact_id").on('submit', (e) => {
            e.preventDefault();
            formToSubmit = this;
            $("#contact_name").text($(this).attr("data"));
            return false;
        });

        //click sim na modal
        $(".btn_submit").click(function (e) {
            formToSubmit.submit();
        });






        //Preview da fotografia

        $('#search_btn').on('click', function (e) {
            e.preventDefault();
            $('#fotografia').trigger('click');
        });

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

        $("#fotografia").on('change', () => {
            readURL(this);
        });




        /* VALIDAÇÃO DE INPUTS */

        /* Apenas letras:  .lettersOnly();  */
/*         $("#nome").lettersOnly(); */


        /* Apenas numeros:  .numbersOnly();  */
        if ($('#telefone1').length) {
            $("#telefone1").numbersOnly();
            $("#telefone2").numbersOnly();
            $("#fax").numbersOnly();
        }


        // Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
    'use strict';
    window.addEventListener('load', function() {
      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.getElementsByClassName('needs-validation');
      // Loop over them and prevent submission
      var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
          if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false);
      });
    }, false);
  })();


});




