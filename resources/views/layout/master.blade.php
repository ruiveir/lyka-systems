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
        $("#procurar-contactos-icon").click(function(event) {
            event.preventDefault();
            $('#modalContacts').modal('show');
        });

        $("#user-type").change(function() {
            $("#error").remove();
            $("#length").remove();
            $("#prepend-div").remove();
            value = $("#user-type").find(":selected").val();
            switch (value) {
                case "clientes":
                    $("#first-div").remove();
                    $("#second-div").remove();
                    input =
                        "<div class='col-md-4' id='first-div'><label for='name'>Nome do cliente:</label><br><input id='name' type='text' name='name' placeholder='Inserir nome do cliente'></div><div class='col-md-4' id='second-div'><label for='surname'>Apelido do cliente:</label><br><input id='surname' type='text' name='surname' placeholder='Inserir apelido do cliente'></div>";
                    $("#contact-row").append(input);
                    break;

                case "agentes":
                    $("#first-div").remove();
                    $("#second-div").remove();
                    input =
                        "<div class='col-md-4' id='first-div'><label for='name'>Nome do agente:</label><br><input id='name' type='text' name='name' placeholder='Inserir nome do agente'></div><div class='col-md-4' id='second-div'><label for='surname'>Apelido do agente:</label><br><input id='surname' type='text' name='surname' placeholder='Inserir apelido do agente'></div>";
                    $("#contact-row").append(input);
                    break;

                case "universidades":
                    $("#first-div").remove();
                    $("#second-div").remove();
                    input = "<div class='col-md-4' id='first-div'><label for='name'>Nome da universidade:</label><br><input id='name' type='text' name='name' placeholder='Inserir nome da universidade'></div>";
                    $("#contact-row").append(input);
                    break;

                case "fornecedores":
                    $("#first-div").remove();
                    $("#second-div").remove();
                    input = "<div class='col-md-4' id='first-div'><label for='name'>Nome do fornecedor:</label><br><input id='name' type='text' name='name' placeholder='Inserir nome do fornecedor'></div>";
                    $("#contact-row").append(input);
                    break;

                default:
                    $("#first-div").remove();
                    $("#second-div").remove();
                    break;
            }
        });

        $("#procurar-contactos-icon").click(function(event) {
            event.preventDefault();
            $("#error").remove();
            $("#first-div").remove();
            $("#second-div").remove();
            $("#length").remove();
            $("#prepend-div").remove();
            $("#modalContacts").modal("show");
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
        });

        $('#form-contact').submit(function(event) {
            event.preventDefault();
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
                    $("#error").remove();
                    $("#length").remove();
                    $("#prepend-div").remove();

                    if (data.length == 1) {
                        length = "<div class='mt-4' id='length'><p>Foi encontrado " + data.length + " contacto no sistema.</p></div>";
                    } else {
                        length = "<div class='mt-4' id='length'><p>Foram encontrados " + data.length + " contactos no sistema.</p></div>";
                    }

                    div = "<div class='container mt-2' id='prepend-div'></div>";
                    $("#modal-body-contact").append(div);

                    $("#prepend-div").before(length);

                    user = $("#user-type").find(":selected").val();

                    switch (user) {
                        case 'clientes':
                            for (var i = 0; i < data.length; i++) {
                                html = "<a href='/clients/" + data[i].slug +
                                    "'><div class='row charge-div'><div class='col-md-1 align-self-center'><div class='white-circle'><img src='{{Storage::disk('public')->url('default-photos/M.jpg')}}' width='100%' class='mx-auto'></div></div><div class='col-md-3 text-truncate align-self-center ml-4'><p class='text-truncate'>" +
                                    data[i].nome + ' ' + data[i].apelido + "</p></div><div class='col-md-3 align-self-center'><p class='text-truncate'>" + data[i].telefone1 +
                                    "</p></div><div class='col-md-4 text-truncate align-self-center ml-2'><p class='text-truncate'>" + data[i].email + "</p></div></div></a>";
                                $("#prepend-div").append(html);
                            }
                            break;

                        case 'agentes':
                            for (var i = 0; i < data.length; i++) {
                                html = "<a href='/agents/" + data[i].slug +
                                    "'><div class='row charge-div'><div class='col-md-1 align-self-center'><div class='white-circle'><img src='{{Storage::disk('public')->url('default-photos/M.jpg')}}' width='100%' class='mx-auto'></div></div><div class='col-md-3 text-truncate align-self-center ml-4'><p class='text-truncate'>" +
                                    data[i].nome + ' ' + data[i].apelido + "</p></div><div class='col-md-3 align-self-center'><p class='text-truncate'>" + data[i].telefone1 +
                                    "</p></div><div class='col-md-4 text-truncate align-self-center ml-2'><p class='text-truncate'>" + data[i].email + "</p></div></div></a>";
                                $("#prepend-div").append(html);
                            }
                            break;

                        case 'universidades':
                            for (var i = 0; i < data.length; i++) {
                                html = "<a href='/universities/" + data[i].slug +
                                    "'><div class='row charge-div'><div class='col-md-1 align-self-center'><div class='white-circle'><img src='{{Storage::disk('public')->url('default-photos/M.jpg')}}' width='100%' class='mx-auto'></div></div><div class='col-md-3 text-truncate align-self-center ml-4'><p class='text-truncate'>" +
                                    data[i].nome + "</p></div><div class='col-md-3 align-self-center'><p class='text-truncate'>" + data[i].telefone +
                                    "</p></div><div class='col-md-4 text-truncate align-self-center ml-2'><p class='text-truncate'>" + data[i].email + "</p></div></div></a>";
                                $("#prepend-div").append(html);
                            }
                            break;

                        case 'fornecedores':
                            for (var i = 0; i < data.length; i++) {
                                html = "<a href='/fornecedores/" + data[i].slug +
                                    "'><div class='row charge-div'><div class='col-md-1 align-self-center'><div class='white-circle'><img src='{{Storage::disk('public')->url('default-photos/M.jpg')}}' width='100%' class='mx-auto'></div></div><div class='col-md-3 text-truncate align-self-center ml-4'><p class='text-truncate'>" +
                                    data[i].nome + "</p></div><div class='col-md-3 align-self-center'><p class='text-truncate'>" + data[i].contacto +
                                    "</p></div><div class='col-md-4 text-truncate align-self-center ml-2'><p class='text-truncate'>" + data[i].morada + "</p></div></div></a>";
                                $("#prepend-div").append(html);
                            }
                            break;
                    }
                },
                error: function(error) {
                    if (error.status == 500) {
                        $("#error").remove();
                        $("#length").remove();
                        $("#prepend-div").remove();
                        msg = "<strong id='error'>Preencha os campos disponíveis para realizar uma procura.</strong>";
                        $("#modal-body-contact").prepend(msg);
                    } else {
                        $("#error").remove();
                        $("#length").remove();
                        $("#prepend-div").remove();
                        msg = "<strong id='error'>Não foi encontrado nenhum contacto relacionado com o utilizador que inseriu.</strong>";
                        $("#modal-body-contact").prepend(msg);
                    }
                }
            });
        });
    </script>
</body>

</html>
