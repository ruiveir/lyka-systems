<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800">Dashboard</h1>
        <a href="#" data-toggle="modal" data-target="#infoModal" class="btn btn-secondary btn-icon-split btn-sm" title="Informações">
            <span class="icon text-white-50">
                <i class="fas fa-info-circle"></i>
            </span>
            <span class="text">Informações</span>
        </a>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Active Clients -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Estudantes (Ativos)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{count($clientes->where("estado", "Ativo"))}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- All Clients -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Estudantes (Total)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{count($clientes)}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-friends fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Agents -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Agentes</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$agentes}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Universidades</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$universidades}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-university fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Content Row -->
    <div class="row">
        <!-- Content Column -->
        <div class="col-lg-6 mb-4">
            <!-- Approach -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Pagamentos pendentes (por mês)</h6>
                </div>
                <div class="card-body">
                    <p class="mb-0 text-center">Não existem pagamentos pendentes este mês.</p>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <!-- Approach -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Calendário de eventos mensais</h6>
                </div>
                <div class="card-body">
                    @if(count($events))
                        @foreach ($events as $event)
                            @if ($event->idUser == Auth()->user()->idUser && !$event->visibilidade)
                                <div class="row d-inline-block">
                                    <div class="col-12 mb-2">
                                        <div>
                                            <div class="rounded-circle d-inline-block" style="background-color:{{$event->cor}}; width:10px; height:10px;"></div>
                                            @isset($event->data_fim)
                                                <a href="{{route("agenda.index")}}" class="d-inline">
                                                    <p class="d-inline ml-2">{{$event->titulo}} ({{date('d/m/Y', strtotime($event->data_inicio))}} - {{date('d/m/Y', strtotime($event->data_fim))}})</p>
                                                </a>
                                            @else
                                                <a href="{{route("agenda.index")}}" class="d-inline">
                                                    <p class="d-inline ml-2">{{$event->titulo}} ({{date('d/m/Y', strtotime($event->data_inicio))}})</p>
                                                </a>
                                            @endisset
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if ($event->visibilidade)
                                <div class="row d-inline-block">
                                    <div class="col-12 mb-2">
                                        <div>
                                            <div class="rounded-circle d-inline-block" style="background-color:{{$event->cor}}; width:10px; height:10px;"></div>
                                            @isset($event->data_fim)
                                                <a href="{{route("agenda.index")}}" class="d-inline">
                                                    <p class="d-inline ml-2">{{$event->titulo}} ({{date('d/m/Y', strtotime($event->data_inicio))}} - {{date('d/m/Y', strtotime($event->data_fim))}})</p>
                                                </a>
                                            @else
                                                <a href="{{route("agenda.index")}}" class="d-inline">
                                                    <p class="d-inline ml-2">{{$event->titulo}} ({{date('d/m/Y', strtotime($event->data_inicio))}})</p>
                                                </a>
                                            @endisset
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @else
                        <p class="mb-0 text-center">Não existem eventos registados no sistema.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>
<!-- End of container-fluid -->
