<div class="menu-content">
    <!-- User info -->
    <div class="row pt-4 pl-2">
        <div class="col">
            <div class="user-image">
                @if(Auth()->user()->admin->fotografia)
                    <img src="{{url('/storage/admin-photos/'.Auth()->user()->admin->fotografia)}}" alt="Imagem de apresentação" width="100%">
                    @elseif(Auth()->user()->admin->genero == 'F')
                        <img src="{{url('/storage/default-photos/F.jpg')}}" alt="Imagem de apresentação" width="100%">
                        @else
                        <img src="{{url('/storage/default-photos/M.jpg')}}" alt="Imagem de apresentação" width="100%">
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

        @if(Auth()->user()->tipo == 'cliente' && Auth()->user()->idCliente != null)
            <!-- Estudantes  -->
            <li class="menu-option">
                @php
                $cliente = Auth()->user()->cliente;
                @endphp
                <a href="{{route('clients.show',$cliente)}}">
                    <div class="menu-icon">
                        <ion-icon name="person-circle-outline" style="font-size: 16pt; --ionicon-stroke-width: 40px; position: relative; top: 5px; right: 3px;"></ion-icon>
                    </div>
                    <span>Meus cursos</span>
                </a>
            </li>
            @endif

            <!-- Estudantes  -->
            @if((Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null)||
                (Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null))
                <li class="menu-option">
                    <a href="{{route('clients.index')}}">
                        <div class="menu-icon">
                            <span class="iconify {{Route::is('clients.*') ? 'active' : ''}}" data-inline="false" data-icon="jam:user"></span>
                        </div>
                        <span class="option-name {{Route::is('clients.*') ? 'active' : ''}} option-name">Estudantes</span>
                    </a>
                </li>
                @endif

                <!-- Agentes  -->
                @if (Auth()->user()->tipo == "admin" && Auth()->user()->idAdmin != null)
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
                @if((Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null)||
                    (Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null))
                    <li class="menu-option">
                        <a href="{{route('universities.index')}}">
                            <div class="menu-icon">
                                <span class="iconify {{Route::is('universities.*') ? 'active' : ''}}" data-inline="false" data-icon="uil:university"></span>
                            </div>
                            <span class="option-name {{Route::is('universities.*') ? 'active' : ''}}">Universidades</span>
                        </a>
                    </li>
                    @endif

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
                        @if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin)
                            <li class="menu-option">
                                <a href="{{route('payments.index')}}">
                                    <span class="option-name {{Route::is('payments.*') ? 'active' : ''}}">Pagamentos</span>
                                </a>
                            </li>
                            @endif

                            <!-- Cobranças -->
                            <li class="menu-option">
                                <a href="{{route('charges.index')}}">
                                    <span class="option-name {{Route::is('charges.*') ? 'active' : ''}}">Cobranças</span>
                                </a>
                            </li>

                            <!-- Relatório de contas -->
                            @if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null)
                                <li class="menu-option">
                                    <a href="#">
                                        <span class="option-name">Relatório e contas</span>
                                    </a>
                                </li>
                                @endif

                                <!-- Conta bancária -->
                                @if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin)
                                    <li class="menu-option">
                                        <a href="{{route('conta.index')}}">
                                            <span class="option-name {{Route::is('conta.*') ? 'active' : ''}}">Conta bancária</span>
                                        </a>
                                    </li>
                                    @endif
                    </div>

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
                        @if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin)
                            <li class="menu-option">
                                <a href="{{route('produtostock.index')}}">
                                    <span class="option-name {{Route::is('produtostock.*') ? 'active' : ''}}">Produtos Stock</span>
                                </a>
                            </li>
                            @endif

                            <!-- Listagens -->
                            @if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin)
                                <li class="menu-option">
                                    <a href="{{route('listagens.index')}}">
                                        <span class="option-name">Listagens</span>
                                    </a>
                                </li>
                                @endif

                                <!-- Fornecedores -->
                                @if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin)
                                    <li class="menu-option">
                                        <a href="{{route('provider.index')}}">
                                            <span class="option-name {{Route::is('fornecedores.*') ? 'active' : ''}}">Fornecedores</span>
                                        </a>
                                    </li>
                                    @endif

                                    <!-- Biblioteca -->
                                    @if((Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null)||
                                        (Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null))
                                        <li class="menu-option">
                                            <a href="{{route('libraries.index')}}">
                                                <span class="option-name {{Route::is('libraries.*') ? 'active' : ''}}">Biblioteca</span>
                                            </a>
                                        </li>
                                        @endif

                                        <!-- Lista telefónica -->
                                        @if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null)
                                            <li class="menu-option">
                                                <a href="{{route('contacts.index')}}">
                                                    <span class="option-name {{Route::is('contacts.*') ? 'active' : ''}}">Lista telefónica</span>
                                                </a>
                                            </li>
                                            @endif

                                            <!-- Agenda -->
                                            @if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null)
                                                <li class="menu-option">
                                                    <a href="{{route('agenda.index')}}">
                                                        <span class="option-name {{Route::is('agenda.*') ? 'active' : ''}}">Agenda</span>
                                                    </a>
                                                </li>
                                                @endif

                                                <!-- Utilizadores -->
                                                @if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin)
                                                    <li class="menu-option">
                                                        <a href="{{route('users.index')}}">
                                                            <span class="{{Route::is('users.*') ? 'active' : ''}} option-name">Administradores</span>
                                                        </a>
                                                    </li>
                                                    @endif
                    </div>

                    {{--@if (Auth()->user()->tipo == "admin")--}}
                    {{-- Financeiro Collapse --}}
                    <li class="menu-option">
                        <a href="{{route('notifications.index')}}">
                            <div class="menu-icon">
                                <span class="iconify" data-inline="false" data-icon="ant-design:bell-outlined"></span>
                            </div>
                            <span class="option-name">Notificações</span>
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
                    {{--@endif--}}

                    <!-- Utilizadores -->
                    @if (Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin)
                    <li class="menu-option">
                        <a href="#">
                            <div class="menu-icon">
                                <span class="iconify" data-inline="false" data-icon="cil:cog"></span>
                            </div>
                            <span class="option-name">Definições</span>
                        </a>
                    </li>
                    @endif
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
