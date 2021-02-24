@extends('layout.master')
<!-- Page Title -->
@section('title', 'Visualizar agente')
@section('style-links')
    <link href="{{asset("/css/clientes.css")}}" rel="stylesheet">
@endsection
<!-- Page Content -->
@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row d-sm-flex align-items-top justify-content-between mb-4">
        <div class="col-md-6">
            @if ($agent->tipo == "Agente")
                <h1 class="h4 mb-0 text-gray-800">Visualização do(a) agente {{$agent->nome.' '.$agent->apelido}}</h1>
            @else
                <h1 class="h4 mb-0 text-gray-800">Visualização do(a) sub-agente {{$agent->nome.' '.$agent->apelido}}</h1>
            @endif
        </div>
        <div class="col-md-6 text-right">
            <a href="{{route('agents.edit', $agent)}}" class="btn btn-success btn-icon-split btn-sm" title="Editar agente">
                <span class="icon text-white-50">
                    <i class="fas fa-pencil-alt"></i>
                </span>
                @if ($agent->tipo == "Agente")
                    <span class="text">Editar agente</span>
                @else
                    <span class="text">Editar sub-agente</span>
                @endif
            </a>
            <a href="#" data-toggle="modal" data-target="#printModal" data-slug="{{$agent->slug}}" class="btn btn-primary btn-icon-split btn-sm" title="Imprimir ficha financeira">
                <span class="icon text-white-50">
                    <i class="fas fa-print"></i>
                </span>
                <span class="text">Imprimir ficha financeira</span>
            </a>
            <a href="#" data-toggle="modal" data-target="#infoModal" class="btn btn-secondary btn-icon-split btn-sm" title="Informações">
                <span class="icon text-white-50">
                    <i class="fas fa-info-circle"></i>
                </span>
                <span class="text">Informações</span>
            </a>
        </div>
    </div>
    <!-- Approach -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            @if ($agent->tipo == "Agente")
                <h6 class="m-0 font-weight-bold text-primary">Ficha do(a) agente {{$agent->nome.' '.$agent->apelido}}.</h6>
            @else
                <h6 class="m-0 font-weight-bold text-primary">Ficha do(a) sub-agente {{$agent->nome.' '.$agent->apelido}}.</h6>
            @endif
        </div>
        <div class="card-body">
                <div class="row mt-2 container">
                    <div class="col col-2 col-md-12 text-center" style="min-width:195px; max-width:230px; max-height:295px; overflow:hidden">
                        @if($agent->fotografia)
                            <img class="align-middle p-1 rounded bg-white shadow-sm border" src="{{url('/storage/agent-documents/'.$agent->idAgente.'/'.$agent->fotografia)}}" style="width:100%;">
                        @elseif($agent->genero == 'F')
                            <img class="align-middle p-1 rounded bg-white shadow-sm border" src="{{url('/storage/default-photos/F.jpg')}}" style="width:100%">
                        @else
                            <img class="align-middle p-1 rounded bg-white shadow-sm border" src="{{url('/storage/default-photos/M.jpg')}}" style="width:100%">
                        @endif
                    </div>

                    <div class="col col-3 mr-3" style="min-width:280px !important">
                        <div class="mb-3">
                            <span class="text-gray-900"><b>Género:</b></span>
                            @if ($agent->genero == 'M')
                            <span class="text-gray-900">Masculino</span>
                            @else
                            <span class="text-gray-900">Feminino</span>
                            @endif
                        </div>

                        <div class="mb-3">
                            <span class="text-gray-900"><b>Naturalidade:</b></span>
                            <span class="text-gray-900">{{$agent->pais}}</span>
                        </div>

                        <div class="mb-3">
                            <span class="text-gray-900"><b>Data de nascimento:</b></span>
                            @if ($agent->dataNasc)
                                <span class="text-gray-900">{{date('d/m/Y', strtotime($agent->dataNasc))}}</span>
                            @else
                                <span class="text-gray-900">N/A</span>
                            @endif
                        </div>

                        <div class="mb-3">
                            <span class="text-gray-900"><b>Telefone:</b></span>
                            @if ($agent->telefone1)
                                <span class="text-gray-900">{{$agent->telefone1}}</span>
                            @else
                                <span class="text-gray-900">N/A</span>
                            @endif
                        </div>

                        <div class="mb-3">
                            <span class="text-gray-900"><b>E-Mail:</b></span>
                            @if ($agent->email)
                                <span class="text-gray-900">{{$agent->email}}</span>
                            @else
                                <span class="text-gray-900">N/A</span>
                            @endif
                        </div>
                    </div>

                    <div class="col pr-3 pb-3" style="min-width:300px !important">
                        @if ($agent->tipo == "Subagente")
                            <div class="mb-3">
                                <span class="text-gray-900"><b>Sub-Agente de:</b></span>
                                @if (Auth::user()->tipo == "admin")
                                    <a class="font-weight-bold" href="{{route('agents.show', $mainAgent)}}">{{$mainAgent->nome.' '.$mainAgent->apelido}}</a>
                                @else
                                    <span class="font-weight-bold">{{$mainAgent->nome.' '.$mainAgent->apelido}}</span>
                                @endif
                            </div>
                        @endif

                        @if (Auth::user()->tipo == "admin")
                            <span class="text-gray-900"><b>Observacões:</b></span>
                            <div class="border rounded bg-light p-2 mt-2 text-gray-900" style="height:130px; width:100%; overflow: auto">
                                @if ($agent->observacoes)
                                    {{$agent->observacoes}}
                                @else
                                    <span class="text-muted"><small>(sem dados para apresentar)</small></span>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>

        <div class="row nav nav-fill w-100 text-center mt-4 mx-auto p-3">
            <a class="nav-item nav-link active border p-3 m-1 bg-primary text-white rounded shadow-sm name_link" id="subagentes-type-tab" data-toggle="tab" href="#subagentes-type" role="tab" aria-controls="agent_type" aria-selected="true">
                <div class="col"><i class="fas fa-share-alt mr-2"></i>Subagentes</div>
            </a>

            <a class="nav-item nav-link border p-3 m-1 bg-white rounded shadow-sm name_link" id="clients-tab" data-toggle="tab" href="#clients" role="tab" aria-controls="clients" aria-selected="false">
                <div class="col"><i class="fas fa-user mr-2"></i>Estudantes</div>
            </a>

            <a class="nav-item nav-link border p-3 m-1 bg-white rounded shadow-sm name_link" id="documents-tab" data-toggle="tab" href="#documents" role="tab" aria-controls="documents" aria-selected="false">
                <div class="col"><i class="far fa-id-card mr-2"></i>Dados pessoais</div>
            </a>

            <a class="nav-item nav-link border p-3 m-1 bg-white rounded shadow-sm name_link" id="contacts-tab" data-toggle="tab" href="#contacts" role="tab" aria-controls="contacts" aria-selected="false">
                <div class="col"><i class="fas fa-comments mr-2"></i>Contactos</div>
            </a>

            <a class="nav-item nav-link border p-3 m-1 bg-white rounded shadow-sm name_link border" id="financas-tab" data-toggle="tab" href="#financas" role="tab" aria-controls="financas" aria-selected="false">
                <div class="col"><i class="fas fa-chart-pie mr-2"></i>Financeiro</div>
            </a>
        </div>

        <div class="bg-white shadow-sm mb-4 p-4 border text-gray-900" style="margin-top:-30px">
            <div class="tab-content p-2 mt-3 " id="myTabContent">
                <div class="tab-pane fade show active" id="subagentes-type" role="tabpanel" aria-labelledby="subagentes-type-tab">
                    @if($listagents)
                        <div class="table-responsive">
                            <table id="tableSubagentes" class="display table table-bordered table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>E-Mail</th>
                                        <th>Telefone</th>
                                        <th style="max-width:80px; min-width:80px;">Estado</th>
                                        <th style="max-width:100px; min-width:100px;">Opções</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($listagents as $subagente)
                                    <tr>
                                        <td>{{$subagente->nome.' '.$subagente->apelido}}</td>
                                        <td>
                                            @if ($subagente->email)
                                                {{$subagente->email}}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>
                                            @if ($subagente->telefone1)
                                                {{$subagente->telefone1}}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>
                                            @if ($subagente->estado == "Ativo")
                                                <span class="text-success font-weight-bold">Ativo</span>
                                            @else
                                                <span class="text-danger font-weight-bold">Inativo</span>
                                            @endif
                                        </td>

                                        <td class="text-center align-middle">
                                            <a href="{{route('agents.show', $subagente)}}" class="btn btn-sm btn-outline-primary" title="Ver ficha completa"><i class="far fa-eye"></i></a>
                                            @if (Auth::user()->tipo == "admin")
                                                <a href="{{route('agents.edit', $subagente)}}" class="btn btn-sm btn-outline-warning" title="Editar"><i class="fas fa-pencil-alt"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="border rounded bg-light p-3">
                            <div class="text-muted">
                                <small>(sem dados para apresentar)</small>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="tab-pane fade" id="clients" role="tabpanel" aria-labelledby="clients-tab">
                    @if($clients)
                        <div class="table-responsive">
                            <table id="tableClientes" class="display table table-bordered table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Referência</th>
                                        <th>Nome</th>
                                        <th>Telefone</th>
                                        <th style="max-width:50px; min-width:50px;">Estado</th>
                                        <th style="max-width:50px; min-width:50px;">Opções</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clients as $client)
                                    <tr>
                                        <td>{{$client->refCliente}}</td>
                                        <td>{{$client->nome.' '.$client->apelido}}</td>
                                        <td>
                                            @if ($client->telefone1)
                                                {{$client->telefone1}}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>
                                            @if ($client->estado == "Ativo")
                                                <span class="text-success font-weight-bold">Ativo</span>
                                            @elseif ($client->estado == "Inativo")
                                                <span class="text-danger font-weight-bold">Inativo</span>
                                            @else
                                                <span class="text-info font-weight-bold">Proponente</span>
                                            @endif
                                        </td>

                                        <td class="text-center align-middle">
                                            <a href="{{route('clients.show',$client)}}" class="btn btn-sm btn-outline-primary" title="Ver ficha completa"><i class="far fa-eye"></i></a>
                                            @if (Auth::user()->tipo == "admin")
                                                <a href="{{route('clients.edit',$client)}}" class="btn btn-sm btn-outline-warning" title="Editar"><i class="fas fa-pencil-alt"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="border rounded bg-light p-3">
                            <div class="text-muted">
                                <small>(sem dados para apresentar)</small>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="tab-pane fade" id="documents" role="tabpanel" aria-labelledby="documents-tab">
                    <div class="row">
                        <div class="col">
                            <div class="mb-2 font-weight-bold">Número de identificação pessoal:</div>
                            <div class="border rounded bg-light p-3">
                                @if ($agent->num_doc)
                                    <div>{{$agent->num_doc}}</div>
                                @else
                                    <div class="text-muted"><small>(sem dados para apresentar)</small></div>
                                @endif
                            </div>
                            <br>
                            <div class="mb-2 font-weight-bold">Número de identificação fiscal:</div>
                            <div class="border rounded bg-light p-3">
                                @if ($agent->NIF)
                                    <div>{{$agent->NIF}}</div>
                                @else
                                    <div class="text-muted"><small>(sem dados para apresentar)</small></div>
                                @endif
                            </div>
                        </div>
                        <div class="col col-4 text-center" style="min-width:240px">
                            <div class="card rounded shadow-sm m-2 p-3 h-100">
                                @if ($agent->img_doc)
                                    <a class="name_link my-auto" target="_blank" href="{{url('/storage/agent-documents/'.$agent->idAgente.'/'.$agent->img_doc)}}">
                                        <i class="far fa-id-card" style="font-size:40px"></i><br>
                                        <div>Ver documento de identificação pessoal</div>
                                    </a>
                                @else
                                    <a href="{{route('agents.edit', $agent)}}" class="mt-2 name_link my-auto">
                                        <small class="text-danger mt-2">
                                            <i class="far fa-id-card" style="font-size:40px"></i><br>
                                            <strong>Sem documento de identificação</strong>
                                        </small>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="contacts" role="tabpanel" aria-labelledby="documents-tab">
                    <div class="row">
                        <div class="col">
                            <div class="mb-2 font-weight-bold">E-mail:</div>
                            <div class="border rounded bg-light p-3">
                                @if ($agent->email)
                                    <div>{{$agent->email}}</div>
                                @else
                                    <div class="text-muted"><small>(sem dados para apresentar)</small></div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <div class="mb-2 font-weight-bold">Telefone principal:</div>
                            <div class="border rounded bg-light p-3">
                                @if ($agent->telefone1)
                                    <div>{{$agent->telefone1}}</div>
                                @else
                                    <div class="text-muted"><small>(sem dados para apresentar)</small></div>
                                @endif
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-2 font-weight-bold">Telefone secundário:</div>
                            <div class="border rounded bg-light p-3">
                                @if ($agent->telefone2)
                                    <div>{{$agent->telefone2}}</div>
                                @else
                                    <div class="text-muted"><small>(sem dados para apresentar)</small></div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <div class="mb-2 font-weight-bold">País:</div>
                            <div class="border rounded bg-light p-3">
                                @if ($agent->pais)
                                    <div>{{$agent->pais}}</div>
                                @else
                                    <div class="text-muted"><small>(sem dados para apresentar)</small></div>
                                @endif
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-2 font-weight-bold">Morada:</div>
                            <div class="border rounded bg-light p-3">
                                @if ($agent->morada)
                                    <div>{{$agent->morada}}</div>
                                @else
                                    <div class="text-muted"><small>(sem dados para apresentar)</small></div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="financas" role="tabpanel" aria-labelledby="financas-tab">
                    <div class="row">
                        <div class="col">
                            <div class="mb-2 font-weight-bold">IBAN:</div>
                            <div class="border rounded bg-light p-3">
                                <div>
                                    @if($IBAN)
                                        <div>{{$IBAN}}</div>
                                    @else
                                        <div class="text-muted"><small>(sem dados para apresentar)</small></div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-2 font-weight-bold">Total de comissões:</div>
                                <div class="border rounded bg-light p-3">
                                    <div>
                                        @if($comissoes)
                                            <div class="text-success">{{number_format((float) $comissoes, 2, ',', '').'€'}}</div>
                                        @else
                                            <div class="text-muted"><small>(sem dados para apresentar)</small></div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive mt-5">
                            <table id="tableFinancas" class="display table table-bordered table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Tipo</th>
                                        <th>Produto</th>
                                        <th>Fase</th>
                                        <th>Valor</th>
                                        <th class="text-truncate" style="max-width:60px; min-width:60px;" title="Data de vencimento">Data de vencimento</th>
                                        <th style="max-width:50px; min-width:50px;">Estado</th>
                                        <th style="max-width:80px; min-width:80px;">Opções</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($produtos as $produto)
                                        @foreach ($produto->fase as $fase)
                                            <tr>
                                                <td class="tooltip-td" data-toggle="tooltip" data-placement="top" title="Cobrança sujeita ao cliente {{$produto->cliente->nome.' '.$produto->cliente->apelido}}.">Cobrança</td>
                                                <td title="{{$produto->descricao}}">{{$produto->descricao}}</td>
                                                <td title="{{$fase->descricao}}">{{$fase->descricao}}</td>
                                                <td>{{number_format((float) $fase->valorFase, 2, ',', '').'€'}}</td>
                                                <td>{{date('d/m/Y', strtotime($fase->dataVencimento))}}</td>
                                                @if ($fase->verificacaoPago && $fase->estado == "Pago")
                                                    <td class="font-weight-bold text-success">Pago</td>
                                                @elseif (!$fase->verificacaoPago && $fase->estado == "Dívida")
                                                    <td class="font-weight-bold text-danger">Vencido</td>
                                                @else
                                                    <td class="font-weight-bold">Pendente</td>
                                                @endif
                                                <td class="text-center align-middle">
                                                @if (count($fase->docTransacao))
                                                    <button class="btn btn-sm btn-outline-dark text-gray-900" title="Editar" disabled><i class="fas fa-check"></i></button>
                                                    <a href="{{route("charges.show", [$fase->produto, $fase, $fase->docTransacao[0]])}}" class="btn btn-sm btn-outline-primary" title="Ver em detalhe"><i class="far fa-eye"></i></a>
                                                    <a href="{{route("charges.edit", [$fase->produto, $fase, $fase->docTransacao[0]])}}" class="btn btn-sm btn-outline-warning" title="Editar"><i class="fas fa-pencil-alt"></i></a>
                                                @else
                                                    <a href="{{route("charges.create", [$fase->produto, $fase])}}" class="btn btn-sm btn-outline-success" title="Registar"><i class="fas fa-check"></i></i></a>
                                                    <button class="btn btn-sm btn-outline-dark text-gray-900" title="Ver em detalhe" disabled><i class="far fa-eye"></i></button>
                                                    <button class="btn btn-sm btn-outline-dark text-gray-900" title="Editar" disabled><i class="fas fa-pencil-alt"></i></button>
                                                @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach

                                    @if ($responsabilidadesAgentes && $agent->tipo == "Agente")
                                        @foreach ($responsabilidadesAgentes as $responsabilidade)
                                            <tr>
                                                <td class="tooltip-td" data-toggle="tooltip" data-placement="top" title="Pagamento afeto ao cliente {{$responsabilidade->cliente->nome.' '.$responsabilidade->cliente->apelido}}.">Pagamento</td>
                                                <td title="{{$responsabilidade->fase->produto->descricao}}">{{$responsabilidade->fase->produto->descricao}}</td>
                                                <td title="{{$responsabilidade->fase->descricao}}">{{$responsabilidade->fase->descricao}}</td>
                                                <td>{{number_format((float) $responsabilidade->valorAgente, 2, ',', '').'€'}}</td>
                                                <td>{{date('d/m/Y', strtotime($responsabilidade->dataVencimentoAgente))}}</td>
                                                <td class="@if(!$responsabilidade->verificacaoPagoAgente && $responsabilidade->dataVencimentoAgente < $currentdate) text-danger font-weight-bold @elseif ($responsabilidade->verificacaoPagoAgente) text-success font-weight-bold @else font-weight-bold text-gray @endif">
                                                @if (!$responsabilidade->verificacaoPagoAgente && $responsabilidade->dataVencimentoAgente < $currentdate)
                                                    Vencido
                                                @elseif (!$responsabilidade->verificacaoPagoAgente && $responsabilidade->dataVencimentoAgente > $currentdate)
                                                    Pendente
                                                @elseif ($responsabilidade->verificacaoPagoAgente)
                                                    Pago
                                                @endif
                                                </td>
                                                <td class="text-center align-middle">
                                                    @if($responsabilidade->pagoResponsabilidade && $responsabilidade->verificacaoPagoAgente)
                                                        <button class="btn btn-sm btn-outline-dark text-gray-900" disabled><i class="fas fa-check"></i></button>
                                                        <a href="{{route('payments.showagente', [$responsabilidade->agente, $responsabilidade->fase, $responsabilidade, $responsabilidade->pagoResponsabilidade])}}" class="btn btn-sm btn-outline-primary" title="Visualizar"><i class="far fa-eye"></i></a>
                                                        <a href="{{route('payments.editagente', [$responsabilidade->agente, $responsabilidade->fase, $responsabilidade, $responsabilidade->pagoResponsabilidade])}}" class="btn btn-sm btn-outline-warning" title="Editar"><i class="fas fa-pencil-alt"></i></a>
                                                    @else
                                                        <a href="{{route('payments.agente', [$responsabilidade->agente, $responsabilidade->fase, $responsabilidade])}}" class="btn btn-sm btn-outline-success" title="Registar"><i class="fas fa-check"></i></a>
                                                        <button class="btn btn-sm btn-outline-dark text-gray-900" disabled><i class="far fa-eye"></i></button>
                                                        <button class="btn btn-sm btn-outline-dark text-gray-900" disabled><i class="fas fa-pencil-alt"></i></button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif

                                    @if ($responsabilidadesSubAgentes && $agent->tipo == "Subagente")
                                        @foreach ($responsabilidadesSubAgentes as $responsabilidade)
                                            <tr>
                                                <td class="tooltip-td" data-toggle="tooltip" data-placement="top" title="Pagamento afeto ao cliente {{$responsabilidade->cliente->nome.' '.$responsabilidade->cliente->apelido}}.">Pagamento</td>
                                                <td title="{{$responsabilidade->fase->produto->descricao}}">{{$responsabilidade->fase->produto->descricao}}</td>
                                                <td title="{{$responsabilidade->fase->descricao}}">{{$responsabilidade->fase->descricao}}</td>
                                                <td>{{number_format((float) $responsabilidade->valorSubAgente, 2, ',', '').'€'}}</td>
                                                <td>{{date('d/m/Y', strtotime($responsabilidade->dataVencimentoSubAgente))}}</td>
                                                <td class="@if(!$responsabilidade->verificacaoPagoSubAgente && $responsabilidade->dataVencimentoSubAgente < $currentdate) text-danger font-weight-bold @elseif ($responsabilidade->verificacaoPagoSubAgente) text-success font-weight-bold @else font-weight-bold text-gray @endif">
                                                @if (!$responsabilidade->verificacaoPagoSubAgente && $responsabilidade->dataVencimentoSubAgente < $currentdate)
                                                    Vencido
                                                @elseif (!$responsabilidade->verificacaoPagoSubAgente && $responsabilidade->dataVencimentoSubAgente > $currentdate)
                                                    Pendente
                                                @elseif ($responsabilidade->verificacaoPagoSubAgente)
                                                    Pago
                                                @endif
                                                </td>
                                                <td class="text-center align-middle">
                                                    @if($responsabilidade->pagoResponsabilidade && $responsabilidade->verificacaoPagoSubAgente)
                                                        <button class="btn btn-sm btn-outline-dark text-gray-900" disabled><i class="fas fa-check"></i></button>
                                                        <a href="{{route('payments.showsubagente', [$responsabilidade->subAgente, $responsabilidade->fase, $responsabilidade, $responsabilidade->pagoResponsabilidade])}}" class="btn btn-sm btn-outline-primary" title="Visualizar"><i class="far fa-eye"></i></a>
                                                        <a href="{{route('payments.editsubagente', [$responsabilidade->subAgente, $responsabilidade->fase, $responsabilidade, $responsabilidade->pagoResponsabilidade])}}" class="btn btn-sm btn-outline-warning" title="Editar"><i class="fas fa-pencil-alt"></i></a>
                                                    @else
                                                        <a href="{{route('payments.subagente', [$responsabilidade->subAgente, $responsabilidade->fase, $responsabilidade])}}" class="btn btn-sm btn-outline-success" title="Registar"><i class="fas fa-check"></i></a>
                                                        <button class="btn btn-sm btn-outline-dark text-gray-900" disabled><i class="far fa-eye"></i></button>
                                                        <button class="btn btn-sm btn-outline-dark text-gray-900" disabled><i class="fas fa-pencil-alt"></i></button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Info -->
<div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header pl-4 pb-1 pt-4">
                <h5 class="modal-title text-gray-800 font-weight-bold">Para que serve?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-gray-800 pl-4 pr-5">
                Ao preencher o formulário irá criar um novo estudante. Os campos com o asterisco de cor vermelha são de preenchimento obrigatório.
            </div>
            <div class="modal-footer mt-3">
                <a data-dismiss="modal" class="mr-4 font-weight-bold" id="close-option">Fechar</a>
                <button type="button" data-dismiss="modal" class="btn btn-primary font-weight-bold mr-2">Entendido!</button>
            </div>
        </div>
    </div>
</div>
<!-- End of Modal Info -->

<!-- Modal Info -->
<div class="modal fade" id="printModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    @if ($clients)
        @foreach ($clients as $client)
            <option hidden disabled class="clients-options" value="{{$client->idCliente}}">{{$client->nome.' '.$client->apelido}}</option>
        @endforeach
    @endif
    <form id="formPrintModal" class="form-group needs-validation" method="post" novalidate target="_blank">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header pl-4 pb-1 pt-4">
                    <h5 class="modal-title text-gray-800 font-weight-bold">O que pretende imprimir?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-button">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <div class="modal-body text-gray-800 pl-4 pr-5">
                        <div id="div-with-select">
                            <label for="infoPrint">Escolha na seleção abaixo a informação financeira que pretende imprimir referente ao agente <b>{{$agent->nome.' '.$agent->apelido}}</b> <sup class="text-danger small">&#10033;</sup></label>
                            <select id="infoPrint" class="custom-select" name="infoPrint" required>
                                <option value="cobrancas">Cobranças</option>
                                <option value="pagamentos">Pagamentos</option>
                                <option value="todos">Pagamentos & Cobranças</option>
                            </select>
                            <div class="invalid-feedback">
                                Oops, parece que algo não está bem...
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer mt-3">
                        <a data-dismiss="modal" class="mr-4 font-weight-bold" id="close-option">Fechar</a>
                        <button id="submitPrint" type="submit" class="btn btn-primary font-weight-bold mr-2">Imprimir ficha financeira</button>
                    </div>
            </div>
        </div>
    </form>
</div>
<!-- End of Modal Info -->

<!-- Begin of Scripts -->
@section('scripts')
<script src="//cdn.datatables.net/plug-ins/1.10.11/sorting/date-eu.js" type="text/javascript"></script>
<script>
    function strtrunc(str, max, add){
        add = add || '...';
        return (typeof str === 'string' && str.length > max ? str.substring(0, max) + add : str);
    };

    $(document).ready(function() {
        $('#tableClientes').DataTable({
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
                }
            },
            "order": [1, 'asc']
        });

        $('#tableSubagentes').DataTable({
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
                }
            },
            "order": [0, 'asc']
        });

        $('#tableFinancas').DataTable({
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
                }
            },
            "order": [[5, 'desc'], [4, 'asc']],
            "columnDefs": [
                {
                    "targets": 4,
                    "type": "date-eu"
                },
                {
                   'targets': [1, 2],
                   'render': function(data, type, full, meta){
                      if(type === 'display'){
                         data = strtrunc(data, 12);
                      }
                      return data;
                  }
              }
            ]
        });

        var options = [
            {"option": document.getElementById("subagentes-type-tab")},
            {"option": document.getElementById("clients-tab")},
            {"option": document.getElementById("documents-tab")},
            {"option": document.getElementById("contacts-tab")},
            {"option": document.getElementById("financas-tab")}
        ]

        $("#subagentes-type-tab, #clients-tab, #documents-tab, #contacts-tab, #financas-tab").click(function(){
            for (var i = 0; i < options.length; i++) {
                if(this.id === options[i].option.id){
                    $(this).removeClass("bg-white").addClass("bg-primary text-white");
                }else{
                    $(options[i].option).removeClass("bg-primary text-white").addClass("bg-white");
                }
            }
        });

        bsCustomFileInput.init();
        $(".needs-validation").submit(function(event) {
            if (this.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
            } else {
                $("#cancelBtn").removeAttr("onclick");
                button =
                    "<button class='btn btn-primary' type='submit' disabled><span class='spinner-border spinner-border-sm' role='status' aria-hidden='true' style='position:relative; bottom:4px; right:3px;'></span>A fazer o registo...</button>";
                $("#groupBtn").append(button);
                $("#submitbtn").remove();
            }
            $(".needs-validation").addClass("was-validated");
        });

        $("#infoPrint").change(function() {
            $("#formPrintModal").removeClass("was-validated");
            value = $("#infoPrint").find(":selected").val();
            switch (value) {
                case "cobrancas":
                    $(".custom-inputs").remove();
                    input = "<div class='mt-3 custom-inputs'><label for='name'>Nome do estudante <sup class='text-danger small'>&#10033;</sup></label><select type='text' class='form-control custom-select' id='name' name='name' required></select><div class='invalid-feedback'>Oops, parece que algo não está bem...</div></div><div class='mt-3 custom-inputs'><label for='produto'>Produto <sup class='text-danger small'>&#10033;</sup></label><select type='text' class='form-control custom-select' id='produto' name='produto' required></select><div class='invalid-feedback'>Oops, parece que algo não está bem...</div></div>";
                    $("#div-with-select").after(input);

                    optionsNameSelected = "<option disabled selected hidden>Escolha um estudante...</option>";
                    $("#name").append(optionsNameSelected);

                    optionsProdutosSelected = "<option disabled selected hidden>Escolha um produto...</option>";
                    $("#produto").append(optionsProdutosSelected);

                    cloneCliente = $(".clients-options").clone().appendTo("#name");
                    cloneCliente.removeAttr("hidden disabled");
                    break;

                case "pagamentos":
                    $(".custom-inputs").remove();
                    input = "<div class='mt-3 custom-inputs'><label for='name'>Nome do estudante <sup class='text-danger small'>&#10033;</sup></label><select type='text' class='form-control custom-select' id='name' name='name' required></select><div class='invalid-feedback'>Oops, parece que algo não está bem...</div></div><div class='mt-3 custom-inputs'><label for='surname'>Produto <sup class='text-danger small'>&#10033;</sup></label><select type='text' class='form-control custom-select' id='produto' name='produto' required></select><div class='invalid-feedback'>Oops, parece que algo não está bem...</div></div>";
                    $("#div-with-select").after(input);

                    optionsNameSelected = "<option disabled selected hidden>Escolha um estudante...</option>";
                    $("#name").append(optionsNameSelected);

                    optionsProdutosSelected = "<option disabled selected hidden>Escolha um produto...</option>";
                    $("#produto").append(optionsProdutosSelected);

                    cloneCliente = $(".clients-options").clone().appendTo("#name");
                    cloneCliente.removeAttr("hidden disabled");
                    break;

                case "todos":
                    $(".custom-inputs").remove();
                    input = "<div class='mt-3 custom-inputs'><label for='name'>Nome do estudante <sup class='text-danger small'>&#10033;</sup></label><select type='text' class='form-control custom-select' id='name' name='name' required></select><div class='invalid-feedback'>Oops, parece que algo não está bem...</div></div><div class='mt-3 custom-inputs'><label for='surname'>Produto <sup class='text-danger small'>&#10033;</sup></label><select type='text' class='form-control custom-select' id='produto' name='produto' required></select><div class='invalid-feedback'>Oops, parece que algo não está bem...</div></div>";
                    $("#div-with-select").after(input);

                    optionsNameSelected = "<option disabled selected hidden>Escolha um estudante...</option>";
                    $("#name").append(optionsNameSelected);

                    optionsProdutosSelected = "<option disabled selected hidden>Escolha um produto...</option>";
                    $("#produto").append(optionsProdutosSelected);

                    cloneCliente = $(".clients-options").clone().appendTo("#name");
                    cloneCliente.removeAttr("hidden disabled");
                    break;

                default:
                    $(".custom-inputs").remove();
                    break;
            }

            $("#name").change(function() {
                select = $("#produto");
                info = {
                    user: $("#name").find(":selected").val()
                };

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': "{{csrf_token()}}"
                    }
                });

                $.ajax({
                    type: "post",
                    url: "{{route('agente.procuraProduto', $agent)}}",
                    context: this,
                    data: info,
                    success: function(data) {
                        var htmlOptions = [];
                        if(data.length){
                            for(item in data) {
                                  html = '<option value="' + data[item].idProduto + '">' + data[item].descricao + '</option>';
                                  htmlOptions[htmlOptions.length] = html;
                            }
                            selectedOption = "<option disabled selected hidden>Escolha um produto...</option>";
                            select.empty().append(htmlOptions.join('')).prepend(selectedOption);
                        }
                    },
                    error: function() {
                        alert("NOK");
                    }
                });
            });
        });

        $('#printModal').on('show.bs.modal', function(event) {
            $("#formPrintModal").removeClass("was-validated");
            $("#infoPrint").prepend("<option disabled selected hidden>Escolha uma informação...</option>");
            $(".custom-inputs").remove();

            var button = $(event.relatedTarget);
            var modal = $(this);
            modal.find("form").attr('action', '/agentes/imprimir-ficha-financeiro/' + button.data('slug'));
        });
    });
</script>
@endsection
<!-- End of Scripts -->
@endsection
