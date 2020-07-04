<!DOCTYPE html>
<html lang="pt" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> @yield('title') - Lyka Systems</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('/media/favicon.png')}}" type="image/x-icon">
    <!-- Bootstrap core CSS -->
    <link href="{{asset('/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    {{-- DataTables --}}
    <link type="text/css" href="{{asset('/vendor/datatables/datatables.min.css')}} " rel="stylesheet">
    <!-- Fontawesome core CSS -->
    <link href="{{asset('/vendor/fontawesome-free/css/all.min.css')}}" rel=" stylesheet" type="text/css">
    <!-- Lyka Font -->
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
    <!-- CSS Link -->
    <link href="{{asset('/css/master.css')}}" rel="stylesheet">
    <link href="{{asset('/css/modal.css')}}" rel="stylesheet">

    @yield('styleLinks')

    {{-- Notificações --}}
    @php
    $Notificacoes = Auth()->user()->getNotifications();
    @endphp
</head>

<body>
    {{-- Modal de contactos --}}
    @include('layout.partials.modal-contactos')

    {{-- Modal para terminar a sessão --}}
    @include('layout.partials.modal-logout')

    {{-- Mensagem de carregamento / processamento --}}
    <div id="wait_screen" style="display:none; position:fixed; top:0; left:0; width:100% ; height:100%; background-color:black; opacity:0.7;z-index:999;">
        <div class="row" style="width: 100%; height:100%">
            <div class="col my-auto mx-auto text-center text-white">
                <div class="spinner-grow" style="width: 3rem; height: 3rem;" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <div style="font-size:30px">Aguarde por favor...</div>
            </div>
        </div>
    </div>

    {{-- Estrutura e navegação --}}
    <div class="container-fluid text-black ">
        <div class="row" style="min-height:100vh">
            {{-- Menu lateral --}}
            <div class="col main-menu shadow-sm" id="side-menu">
                @include('layout.partials.main-menu')
            </div>
            <!-- Content -->
            <div class="col pb-5 content">
                <!-- Error and Success Message -->
                @if ($errors->any())
                <div class="row mx-1">
                    <div class="col">
                        @include ('layout.msg-error-message.partials.errors')
                    </div>
                </div>
                @endif
                @if (!empty(session('success')))
                <div class="row mx-1">
                    <div class="col">
                        @include ('layout.msg-error-message.partials.success')
                    </div>
                </div>
                @endif
                <!-- Content -->
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Scripts -->
    @include('layout.partials.footer')

    <script type="text/javascript">
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
