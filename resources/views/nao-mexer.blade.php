
{{-- AJUDA + Terminar Sessão --}}
<div class="text-center mb-4">
    <div class="opts_btn shadow-sm align-self-center">
        <a href="{{route('ajuda')}}" title="Ajuda" class="user_btn {{Route::is('ajuda') ? 'active' : ''}}"><i class="fas fa-question"></i></a>
    </div>

    <div class="user_opts shadow-sm align-self-center">
        <a href="#" title="Terminar sessão" class="user_btn" data-toggle="modal" data-target="#Modal"><i class="fas fa-power-off"></i></a>
    </div>

    {{-- SE FOR ADMIN --}}
    @if (Auth::user()->tipo == "admin" && Auth::user()->idAdmin != null)
    <div class="mx-auto user_photo rounded-circle shadow">
        {{-- Foto Utilizador --}}
        @if(Auth::user()->admin->fotografia != null)
            <img src="{{asset('/storage/admin-photos/'.Auth::user()->admin->fotografia)}}" style="width:100%">
            @elseif (Auth::user()->admin->genero == "F")
            <img src="{{asset('/storage/default-photos/F.jpg')}}" style="width:100%">
            @else
            <img src="{{asset('/storage/default-photos/M.jpg')}}" style="width:100%">
            @endif
    </div>

    <div class="text-center mt-3">
        {{-- Nome e Perfil --}}
        <span class="font-weight-bold text-uppercase">{{Auth::user()->admin->nome}}</span><br>
        <span class="text-muted " style="font-size:14px">{{Auth::user()->tipo}}</span>
    </div>


    {{-- SE FOR AGENTE / SUBAGENTE --}}
    @elseif (Auth::user()->tipo == "agente" && Auth::user()->idAgente != null)
    <div class="mx-auto user_photo rounded-circle shadow">
        <a href="{{route('agents.show', Auth::user()->agente )}}" title="Ver as minhas informações">
            {{-- Foto Utilizador --}}
            @if(Auth::user()->agente->fotografia != null)
                <img src="{{asset('/storage/agent-documents/'.Auth::user()->agente->idAgente.'/'.Auth::user()->agente->fotografia)}}" style="width:100%">
                @elseif (Auth::user()->agente->genero == "F")
                <img src="{{asset('/storage/default-photos/F.jpg')}}" style="width:100%">
                @else
                <img src="{{asset('/storage/default-photos/M.jpg')}}" style="width:100%">
                @endif
        </a>
    </div>

    <div class="text-center mt-3">
        {{-- Nome e Perfil --}}
        <span class="font-weight-bold text-uppercase">{{Auth::user()->agente->nome}}</span><br>
        <span class="text-muted " style="font-size:14px">{{Auth::user()->agente->tipo}}</span>
    </div>


    {{-- SE FOR CLIENTE --}}
    @elseif (Auth::user()->tipo == "cliente" && Auth::user()->idCliente != null)
    <div class="mx-auto user_photo rounded-circle shadow">
        <a href="#" title="Ver as minhas informações">
            {{-- Foto Utilizador --}}
            @if(Auth::user()->cliente->fotografia != null)
                <img src="{{asset('/storage/client-photos/'.Auth::user()->cliente->fotografia)}}" style="width:100%">
                @elseif (Auth::user()->cliente->genero == "F")
                <img src="{{asset('/storage/default-photos/F.jpg')}}" style="width:100%">
                @else
                <img src="{{asset('/storage/default-photos/M.jpg')}}" style="width:100%">
                @endif
        </a>
    </div>

    <div class="text-center mt-3">
        {{-- Nome e Perfil --}}
        <span class="font-weight-bold text-uppercase">{{Auth::user()->cliente->nome}}</span><br>
        <span class="text-muted " style="font-size:14px">{{Auth::user()->tipo}}</span>
    </div>
    @endif

</div>


<br>
<div class="report">
    <div class="row">
        <div class="title col-md-10">
            <h6>Relatório e contas</h6>
        </div>
        <div class="col-md-2 text-right">
            <button type="button" name="button">ver todos</button>
        </div>
    </div>
    <div class="row graphic-group">
        <div class="col-md-6">
            <div class="graphic">

            </div>
        </div>
        <div class="col-md-6">
            <div class="graphic">
                @if($agends!=null)
                    <div class="table-responsive " style="overflow:hidden">
                        <table nowarp class="table table-borderless" row-border="0"
                               style="overflow:hidden;">
                            {{-- Cabeçalho da tabela --}}
                            <thead>
                            @foreach ($todayAgends as $agend)
                                <tr>
                                    <th colspan="2">Todos os eventos {{ date('d/m/Y', strtotime($agend->Date.now())) }}</th>
                                </tr>
                            </thead>
                            {{-- Corpo da tabela --}}
                            <tbody>

                            <tr href="#">
                                <td style="padding:0!important"><i class="fas fa-circle ml-3 mt-2"
                                                                   style="color:{{$agend->cor}}"></i></td>
                                {{-- Título --}}
                                <td style="padding: 0 3px 0 0!important"><a>{{$agend->titulo}}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="border rounded bg-light p-3">
                        <div class="text-muted"><small>(sem registos)</small></div>
                    </div>
                    <br>
                @endif
            </div>
        </div>
    </div>


    <div class="title  mt-5 ">
        <h6>Espaço de aramazenamento</h6>
    </div>

    <div class="row ">
        <div class="col">
            <div>
                Espaço de armazenamento ocupado: {{$size}}
                <br>Disponivel: XX
                <br> Gráfico ?
            </div>
        </div>

    </div>
















    css


    /* General Style */
    * {
        outline: none;
    }

    html, body {
        height: 100%;
        min-width: 750px;
        scroll-behavior: smooth;
        transition: all 0.3 ease;
        background-color: #EAEAEA;
        font-family: 'Lato', sans-serif;
    }

    label {
        color: black !important;
    }

    /* Layout Style -> Main Menu */
    .main-menu {
        top: 0;
        left: 0;
        height: 100%;
        width: 230px;
        position: fixed;
        overflow-x: hidden;
        background-color: white;
    }

    .user-image {
        width: 50px;
        height: 50px;
        overflow: hidden;
        border-radius: 50%;
    }

    .user-info p:first-child {
        font-weight: 700;
        margin-bottom: 0px !important;
    }

    .user-info p:last-child {
        color: #919191;
        font-size: 12px;
    }

    .menu-list {
        width: 100%;
        font-size: 16px;
        padding-top: 25px;
        padding-left: 0px;
        list-style-type: none;
    }

    .menu-option {
        padding-top: 12px;
        padding-left: 8px;
        padding-bottom: 8px;
    }

    .menu-icon .iconify {
        color: #454545;
    }

    .menu-list .active {
        color: #5E9DF5;
        font-weight: 800;
    }

    .menu-list a span {
        color: #454545;
        font-weight: 500;
        position: relative;
        font-size: 0.85rem;
        text-decoration: none;
        transition: 0.3s ease-in-out;
    }

    .menu-icon {
        width: 18px;
        color: #454545;
        text-align: center;
        margin-right: 10px;
        display: inline-block;
    }

    .content {
        margin-left: 250px;
    }

    /* FIM ESPAÇO PARA CSS DE ESTRUTURA */
    /* ESTILO DOS LINKS */
    a {
        color: black;
    }

    a:hover {
        text-decoration: none;
        color: #6A74C9;
    }

    .active {
        color: #6A74C9;
        font-weight: bold;
    }

    /* ESTILO DOS LINKS */
    /* Buttons */
    .top-button {
        border: none;
        color: white;
        font-weight: 800;
        padding: 8px 18px;
        font-size: 0.6rem;
        border-radius: 25px;
        text-transform: uppercase;
        background-color: #6A74C9;
        box-shadow: 0 .3rem 1rem rgba(0, 0, 0, .15);
    }

    .top-button:hover {
        color: white;
        text-decoration: none;
    }

    .top-button:focus {
        outline: none;
    }

    .cancel-button {
        color: #A9A9A9;
        font-weight: 800;
        padding: 7px 17px;
        font-size: 0.6rem;
        cursor: pointer;
        border-radius: 25px;
        border: 2px solid #A9A9A9;
        text-transform: uppercase;
        background-color: #EAEAEA;
        transition: 0.3s ease-in-out;
    }

    .cancel-button:hover {
        color: white;
        text-decoration: none;
        background-color: #A9A9A9;
    }

    .buttons a {
        outline: none;
    }

    .buttons a:hover {
        text-decoration: none;
    }

    .button-back {
        width: 20px;
        height: 20px;
        padding: 5px;
        border-radius: 50%;
        color: gray !important;
        background-color: white;
        border: 1px solid rgba(0, 0, 0, 0.2);
    }

    .button-foward {
        width: 20px;
        height: 20px;
        padding: 5px;
        outline: none;
        margin-left: 10px;
        border-radius: 50%;
        color: gray !important;
        background-color: transparent;
    }

    /* Cards Navigation Style */
    /* Title */
    .cards-navigation {
        margin-top: 19px;
    }

    .title h6 {
        color: #252525;
        font-weight: 700;
        font-size: 1.1rem;
    }

    /* Cards */
    .cards-group {
        margin-top: 10px;
    }

    .card-navigation {
        width: 85%;
        height: 110px;
        margin-left: auto;
        margin-right: auto;
        border-radius: 5px;
        background-color: white;
        transition: 0.3s ease-in-out;
        box-shadow: 0 .2rem 1rem rgba(0, 0, 0, .10);
    }

    .card-navigation .help-button {
        top: 7px;
        right: 8px;
        width: 20px;
        height: 20px;
        float: right;
        cursor: default;
        position: relative;
        border-radius: 50%;
        background-color: #DFDFDF;
    }

    .card-navigation .help-button span {
        top: -10%;
        left: 32%;
        color: white;
        font-weight: 800;
        font-size: 0.9rem;
        position: relative;
        transform: translate(-50%, -50%);
    }

    .card-navigation .info {
        padding-top: 5px;
        padding-left: 15px;
        display: inline-block;
    }

    .card-navigation .info .number {
        color: #575757;
        font-weight: 700;
        font-size: 2.6rem;
        margin: 0 !important;
    }

    .card-navigation .info .word {
        bottom: 7px;
        color: #C8C8C8;
        font-weight: 800;
        font-size: .72rem;
        position: relative;
        margin: 0 !important;
        text-transform: uppercase;
    }

    .close_btn {
        position: absolute;
        right: -5px;
        top: -7px;
        height: 20px;
        width: 20px;
        background-color: white;
        padding-top: -3px;
        border-radius: 50%;
    }

    .close_btn a {
        color: gray;
    }

    .close_btn a:hover {
        color: blue;
    }

    .search-bar {
        width: 100%;
        height: 30px;
        border-radius: 30px;
        background-color: #EAEAEA;
        position: relative;
        top: 4%;
    }

    .search-bar p {
        font-weight: 800;
        font-size: 0.6rem;
        text-transform: uppercase;
        display: inline-block;
        padding: 8px 15px;
        color: #BBBBBB;
    }

    .search-icon {
        color: white;
        position: relative;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -55%);
        --ionicon-stroke-width: 60px;
    }

    .search-button {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background-color: #6A74C9;
        position: relative;
        float: right;
    }

    .page-item.active .page-link {
        background-color: #6A74C9;
        border-color: #6A74C9;
    }

    .table-striped>tbody>tr:nth-child(odd)>td,
    .table-striped>tbody>tr:nth-child(odd)>th {
        background-color: rgba(255, 255, 255, 0.8);
    }


    // MAIN menu

    <div class="menu-content">
        <!-- User info -->
        <div class="row pt-4 pl-2">
            <div class="col">
                <div class="user-image">
                    @if(Auth()->user()->admin->fotografia)
                        <img src="{{Storage::disk('public')->url('admin-photos/').Auth()->user()->admin->fotografia}}" alt="Imagem de apresentação" width="100%">
                    @elseif(Auth()->user()->admin->genero == 'F')
                        <img src="{{Storage::disk('public')->url('default-photos/F.jpg')}}" alt="Imagem de apresentação" width="100%">
                    @else
                        <img src="{{Storage::disk('public')->url('default-photos/M.jpg')}}" alt="Imagem de apresentação" width="100%">
                    @endif
                </div>
            </div>
        </div>
        <div class="row pt-2 pl-2">
            <div class="col">
                <div class="user-info">
                    @if (Auth()->user()->tipo == "admin")
                    <p>{{Auth()->user()->admin->nome.' '.Auth()->user()->admin->apelido}}</p>
                    @elseif (Auth()->user()->tipo == "agente")
                    <p>{{Auth()->user()->agente->nome.' '.Auth()->user()->agente->apelido}}</p>
                    @else
                    <p>{{Auth()->user()->cliente->nome.' '.Auth()->user()->cliente->apelido}}</p>
                    @endif
                    @if (Auth()->user()->tipo == "admin")
                    <p>Administrador, Portugal</p>
                    @elseif (Auth()->user()->tipo == "agente")
                    <p>Agente, Portugal</p>
                    @else
                    <p>Cliente, Portugal</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Menu Options -->
        <ul class="menu-list">
            <!-- Dashboard -->
            <li class="menu-option">
                <a href="{{route('dashboard')}}">
                    <div class="menu-icon">
                        <span class="iconify {{Route::is('dashboard') ? 'active' : ''}}" data-inline="false" data-icon="ant-design:home-outlined"></span>
                    </div>
                    <span class="{{Route::is('dashboard') ? 'active' : ''}} option-name" style="top:1px;">Dashboard</span>
                </a>
            </li>

            <!-- Estudantes  -->
            <li class="menu-option">
                <a href="{{route('clients.index')}}">
                    <div class="menu-icon">
                        <span class="iconify {{Route::is('clients.*') ? 'active' : ''}}" data-inline="false" data-icon="jam:user"></span>
                    </div>
                    <span class="option-name {{Route::is('clients.*') ? 'active' : ''}} option-name">Estudantes</span>
                </a>
            </li>

            <!-- Agentes  -->
            @if (Auth()->user()->tipo == "admin")
            <li class="menu-option">
                <a href="{{route('agents.index')}}">
                    <div class="menu-icon">
                        <span class="iconify {{Route::is('agents.*') ? 'active' : ''}}" data-inline="false" data-icon="jam:users"></span>
                    </div>
                    <span class="option-name {{Route::is('agents.*') ? 'active' : ''}}">Agentes</span>
                </a>
            </li>
            @endif

            <!-- Universidades  -->
            @if (Auth()->user()->tipo == 'admin')
            <li class="menu-option">
                <a href="{{route('universities.index')}}">
                    <div class="menu-icon">
                        <span class="iconify {{Route::is('universities.*') ? 'active' : ''}}" data-inline="false" data-icon="uil:university"></span>
                    </div>
                    <span class="option-name {{Route::is('universities.*') ? 'active' : ''}}">Universidades</span>
                </a>
            </li>
            @endif

            @if (Auth()->user()->tipo == "admin")
            {{-- Financeiro Collapse --}}
            <li class="menu-option">
                <a data-toggle="collapse" href="#collapseFinance" aria-expanded="false" aria-controls="collapseFinance">
                    <div class="menu-icon">
                        <span class="iconify <?php if (Route::is('payments.*') || Route::is('charges.*') || Route::is('conta.*')) { echo 'active'; } ?>" data-inline="false" data-icon="ant-design:bar-chart-outlined"></span>
                    </div>
                    <span class="option-name <?php if (Route::is('payments.*') || Route::is('charges.*') || Route::is('conta.*')) { echo 'active'; } ?>">Finanças</span>
                </a>
            </li>

            <div class="collapse" id="collapseFinance">
                <!-- Pagamentos -->
                <li class="menu-option">
                    <a href="{{route('payments.index')}}">
                        <span class="option-name {{Route::is('payments.*') ? 'active' : ''}}">Pagamentos</span>
                    </a>
                </li>

                <!-- Cobranças -->
                <li class="menu-option">
                    <a href="{{route('charges.index')}}">
                        <span class="option-name {{Route::is('charges.*') ? 'active' : ''}}">Cobranças</span>
                    </a>
                </li>

                <!-- Relatório de contas -->
                <li class="menu-option">
                    <a href="#">
                        <span class="option-name">Relatório e contas</span>
                    </a>
                </li>

                <!-- Conta bancária -->
                <li class="menu-option">
                    <a href="{{route('conta.index')}}">
                        <span class="option-name {{Route::is('conta.*') ? 'active' : ''}}">Conta bancária</span>
                    </a>
                </li>
            </div>
            @endif

            {{-- Diversos Collapse --}}
            <li class="menu-option">
                <a data-toggle="collapse" href="#collapseDiv" aria-expanded="false" aria-controls="collapseDiv">
                    <div class="menu-icon">
                        <span class="iconify <?php if (Route::is('libraries.*') || Route::is('contacts.*') || Route::is('agends.*') || Route::is('produtostock.*')) { echo 'active'; } ?>" data-inline="false" data-icon="carbon:tools"></span>
                    </div>
                    <span class="option-name <?php if (Route::is('libraries.*') || Route::is('contacts.*') || Route::is('agends.*') || Route::is('produtostock.*')) { echo 'active'; } ?>">Diversos</span>
                </a>
            </li>

            <div class="collapse" id="collapseDiv">
                {{-- Produtos--}}
                <li class="menu-option">
                    <a href="{{route('produtostock.index')}}">
                        <span class="option-name {{Route::is('produtostock.*') ? 'active' : ''}}">Produtos Stock</span>
                    </a>
                </li>

                <!-- Listagens -->
                <li class="menu-option">
                    <a href="#">
                        <span class="option-name">Listagens</span>
                    </a>
                </li>

                <!-- Fornecedores -->
                <li class="menu-option">
                    <a href="{{route('provider.index')}}">
                        <span class="option-name {{Route::is('fornecedores.*') ? 'active' : ''}}">Fornecedores</span>
                    </a>
                </li>

                <!-- Biblioteca -->
                <li class="menu-option">
                    <a href="{{route('libraries.index')}}">
                        <span class="option-name {{Route::is('libraries.*') ? 'active' : ''}}">Biblioteca</span>
                    </a>
                </li>

                <!-- Lista telefónica -->
                <li class="menu-option">
                    <a href="{{route('contacts.index')}}">
                        <span class="option-name {{Route::is('contacts.*') ? 'active' : ''}}">Lista telefónica</span>
                    </a>
                </li>

                <!-- Agenda -->
                <li class="menu-option">
                    <a href="{{route('agenda.index')}}">
                        <span class="option-name {{Route::is('agenda.*') ? 'active' : ''}}">Agenda</span>
                    </a>
                </li>

                <!-- Utilizadores -->
                @if (Auth()->user()->tipo == 'admin')
                <li class="menu-option">
                    <a href="{{route('users.index')}}">
                        <span class="{{Route::is('users.*') ? 'active' : ''}} option-name">Administradores</span>
                    </a>
                </li>
                @endif
            </div>

            <li class="menu-option">
                <a href="#">
                    <div class="menu-icon">
                        <span class="iconify" data-inline="false" data-icon="ant-design:bell-outlined"></span>
                    </div>
                    <span class="option-name">Notificações</span>
                </a>
            </li>

            <li class="menu-option">
                <a href="#">
                    <div class="menu-icon">
                        <span class="iconify" data-inline="false" data-icon="cil:cog"></span>
                    </div>
                    <span class="option-name">Definições</span>
                </a>
            </li>
        </ul>
    </div>
    <div style="bottom:0; position:absolute;">
        <ul class="menu-list">
            <li class="menu-option">
                <a data-toggle="modal" data-target="#modalLogout" style="cursor:pointer;">
                    <div class="menu-icon">
                        <span class="iconify" data-inline="false" data-icon="ri:shut-down-line"></span>
                    </div>
                    <span class="option-name">Terminar sessão</span>
                </a>
            </li>
        </ul>
    </div>



//MASTEE

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
