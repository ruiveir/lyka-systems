<!DOCTYPE html>
<html lang="pt" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title> @yield('title') - Lyka Systems</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('/media/favicon.png')}}" type="image/x-icon">

    <!-- Bootstrap core CSS -->
    <link href="{{asset('/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- DataTables -->
    <link type="text/css" href="{{asset('/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

    <!-- Datetime Picker -->
    <link type="text/css" href="{{asset('/vendor/datetimepicker/build/jquery.datetimepicker.min.css')}}" rel="stylesheet">

    <!-- Fontawesome core CSS -->
    <link href="{{asset('/vendor/fontawesome-free/css/all.min.css')}}" rel=" stylesheet" type="text/css">

    <!-- Lyka Font -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- CSS Link -->
    <link href="{{asset("/css/sb-admin-2.min.css")}}" rel="stylesheet">
    <link href="{{asset("/css/modal.css")}}" rel="stylesheet">

    @yield('style-links')

    <!-- Notificações -->
    @php
    use App\Cliente;
    $clientesNotificacao = Cliente::all();
    $notifications = Auth()->user()->getNotifications();
    @endphp
</head>

<body id="page-top">
    {{-- Modal de contactos --}}
    @include('layout.partials.modal-contactos')
    {{-- Modal para terminar a sessão --}}
    @include('layout.partials.modal-logout')

    <div id="wrapper">
        <!-- Sidebar -->
        @include('layout.partials.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                @include('layout.partials.topbar')

                <!-- Success message on forms -->
                @if (!empty(session('success')))
                @include('layout.msg-error-message.partials.success')
                @endif

                <!-- Error message on forms -->
                @if ($errors->any())
                @include ('layout.msg-error-message.partials.errors')
                @endif

                <!-- Content -->
                @yield('content')

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Estudar Portugal {{date("Y")}}</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->
    </div>

    <!-- Scripts -->
    @include('layout.partials.footer')

    <script>
        $(document).ready(function() {
            var table = $('#table-contactos').DataTable({
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
                },
                searching: false,
                paging: false,
            });

            $("#procurar-contactos").click(function(event) {
                event.preventDefault();
                $(".custom-inputs").remove();
                $('#div-table-contactos').addClass("d-none");
                $("#form-contact").removeClass("was-validated");
                $('#modalContacts').modal('show');
                $("#user-type").prepend("<option disabled hidden selected>Escolher tipo de utilizador</option>");
            });

            $("#user-type").change(function() {
                $("#form-contact").removeClass("was-validated");
                value = $("#user-type").find(":selected").val();
                switch (value) {
                    case "clientes":
                        $(".custom-inputs").remove();
                        input = "<div class='col-md-4 custom-inputs'><label for='name'>Nome do cliente <sup class='text-danger small'>&#10033;</sup></label><input type='text' class='form-control' id='name' name='name' placeholder='Inserir um nome...' required><div class='invalid-feedback'>Oops, parece que algo não está bem...</div></div><div class='col-md-4 custom-inputs'><label for='surname'>Apelido do cliente</label><input type='text' class='form-control' id='surname' name='surname' placeholder='Inserir um apelido...'></div>";
                        $("#contactos-form-row").append(input);
                        break;

                    case "agentes":
                        $(".custom-inputs").remove();
                        input = "<div class='col-md-4 custom-inputs'><label for='name'>Nome do agente <sup class='text-danger small'>&#10033;</sup></label><input type='text' class='form-control' id='name' name='name' placeholder='Inserir um nome...' required><div class='invalid-feedback'>Oops, parece que algo não está bem...</div></div><div class='col-md-4 custom-inputs'><label for='surname'>Apelido do agente</label><input type='text' class='form-control' id='surname' name='surname' placeholder='Inserir um apelido...'></div>";
                        $("#contactos-form-row").append(input);
                        break;

                    case "universidades":
                        $(".custom-inputs").remove();
                        input = "<div class='col-md-8 custom-inputs'><label for='name'>Nome da universidade <sup class='text-danger small'>&#10033;</sup></label><input type='text' class='form-control' id='name' name='name' placeholder='Inserir um nome...' required><div class='invalid-feedback'>Oops, parece que algo não está bem...</div></div>";
                        $("#contactos-form-row").append(input);
                        break;

                    case "fornecedores":
                        $(".custom-inputs").remove();
                        input = "<div class='col-md-8 custom-inputs'><label for='name'>Nome do fornecedor <sup class='text-danger small'>&#10033;</sup></label><input type='text' class='form-control' id='name' name='name' placeholder='Inserir um nome...' required><div class='invalid-feedback'>Oops, parece que algo não está bem...</div></div>";
                        $("#contactos-form-row").append(input);
                        break;

                    default:
                        $(".custom-inputs").remove();
                        break;
                }
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{csrf_token()}}"
                }
            });

            $('#form-contact').submit(function(event) {
                if (this.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                } else {
                    event.preventDefault();
                    button = "<button class='btn btn-primary' type='submit' disabled id='spin-button'><span class='spinner-border spinner-border-sm' role='status' aria-hidden='true' style='position:relative; bottom:4px; right:3px;'></span>A procurar contacto...</button>";
                    $("#groupBtn").append(button);
                    $("#submitbtn").addClass("d-none");

                    info = {
                        user: $("#user-type").find(":selected").val(),
                        name: $("#name").val(),
                        surname: $("#surname").val()
                    };

                    $.ajax({
                        type: "post",
                        url: "{{route('search.contact')}}",
                        context: this,
                        data: info,
                        success: function(data) {
                            $("#submitbtn").removeClass("d-none");
                            $("#spin-button").remove();
                            table.clear().draw();
                            user = $("#user-type").find(":selected").val();
                            switch (user) {
                                case 'clientes':
                                    for (var i = 0; i < data.length; i++) {
                                        table.row.add([
                                            data[i].nome + ' ' + data[i].apelido,
                                            data[i].email,
                                            data[i].telefone1
                                        ]).draw();
                                        $('#div-table-contactos').removeClass("d-none");
                                    }
                                break;

                                case 'agentes':
                                    for (var i = 0; i < data.length; i++) {
                                        table.row.add([
                                            data[i].nome + ' ' + data[i].apelido,
                                            data[i].email,
                                            data[i].telefone1
                                        ]).draw();
                                        $('#div-table-contactos').removeClass("d-none");
                                    }
                                    break;

                                case 'universidades':
                                    for (var i = 0; i < data.length; i++) {
                                        table.row.add([
                                            data[i].nome,
                                            data[i].email,
                                            data[i].telefone
                                        ]).draw();
                                        $('#div-table-contactos').removeClass("d-none");
                                    }
                                    break;

                                case 'fornecedores':
                                    for (var i = 0; i < data.length; i++) {
                                        table.row.add([
                                            data[i].nome,
                                            "N/A",
                                            data[i].contacto
                                        ]).draw();
                                        $('#div-table-contactos').removeClass("d-none");
                                    }
                                    break;
                            }
                        },
                        error: function(error) {
                            if (error.status == 404) {
                                $("#submitbtn").removeClass("d-none");
                                $("#spin-button").remove();
                                table.clear().draw();
                                $('#div-table-contactos').removeClass("d-none");
                            }
                        }
                    });
                }
                $("#form-contact").addClass("was-validated");
            });
        });
    </script>
</body>

</html>
