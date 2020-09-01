@extends('layout.master')

{{-- Page Title --}}
@section('title', 'Ficha de agente')

{{-- CSS Style Link --}}
@section('styleLinks')

<link href="{{asset('/css/datatables_general.css')}}" rel="stylesheet">
<link href="{{asset('/css/inputs.css')}}" rel="stylesheet">

@endsection

{{-- Page Content --}}
@section('content')



<div class="container-fluid my-4" style="color: black">

    {{-- Conteúdo --}}
    <div class="bg-white shadow-sm mb-4 p-4 ">

        <div class="row">

            <div class="col">
                <div class="title">
                    <h4><strong>@if ($agent->tipo=="Agente")
                            Ficha do Agente <span class="active">{{$agent->nome}} {{$agent->apelido}}</span>
                            @else
                            Ficha do Subagente <span class="active">{{$agent->nome}} {{$agent->apelido}}</span>
                            @endif</span></strong></h4>
                    <small>
                        <div>
                            <span>Ultima atualização:
                                <strong>{{ date('d-M-y', strtotime($agent->updated_at)) }}</strong></span>
                        </div>
                    </small>
                </div>
            </div>

            {{-- Opções --}}
            <div class="col text-right">
                {{-- Permissões para editar --}}
                @if (Auth::user()->tipo == "admin")
                <a href="{{route('agents.edit',$agent)}}" class="btn btn-sm btn-success m-1 mr-2 px-3 "><i
                        class="fas fa-pencil-alt mr-2"></i>Editar Informação</a>
                @endif
                <a href="{{route('agents.print',$agent)}}" target="_blank"
                    class="btn btn-sm btn-light border m-1 mr-2"><i class="fas fa-print mr-2"></i>Imprimir</a>
            </div>

        </div>


        <hr class="my-3">


        <div class="row mt-4">
            <div class="col col-2 text-center "
                style="min-width:195px; max-width:280px; max-height:300px; overflow:hidden">

                @if($agent->fotografia)
                <img class="align-middle p-1 rounded bg-white shadow-sm border"
                    src="{{url('/storage/agent-documents/'.$agent->idAgente.'/').$agent->fotografia}}"
                    style="width:100%; height:auto ">
                @elseif($agent->genero == 'F')
                <img class="align-middle p-1 rounded bg-white shadow-sm border"
                    src="{{url('/storage/default-photos/F.jpg')}}" style="width:100%">
                @else
                <img class="align-middle p-1 rounded bg-white shadow-sm border"
                    src="{{url('/storage/default-photos/M.jpg')}}" style="width:100%">
                @endif

            </div>

            <div class="col col-3 m-1" style="min-width:280px !important">

                {{-- Informações Pessoais --}}

                <div><span>Género: </span>
                    @if ($agent->genero == 'M')
                    <span class="font-weight-bold">Masculino<span>
                            @else
                            <span class="font-weight-bold">Feminino</span>
                            @endif
                </div>

                <br>

                <div>País: <span class="font-weight-bold">{{$agent->pais}}</span></div>

                <br>

                <div>Data de nascimento: <span
                        class="font-weight-bold">{{ date('d-M-y', strtotime($agent->dataNasc)) }}</span></div>

                @if ($agent->tipo=="Subagente")
                <br>
                <div>Subagente de:
                    {{-- Apenas cria o link para o perfil do agente SE for o administrador a consultar --}}
                    @if (Auth::user()->tipo == "admin")
                    <a class="font-weight-bold" href="{{route('agents.show',$mainAgent)}}">{{$mainAgent->nome}}
                        {{$mainAgent->apelido}}</a>
                    @else
                    <span class="active">{{$mainAgent->nome}} {{$mainAgent->apelido}}</span>
                    @endif

                </div>
                <br>
                @endif

            </div>

            @if (Auth::user()->tipo == "admin")
            <div class="col m-1" style="min-width: 320px">
                <div>Observacões:</div>
                <div class="border rounded bg-light p-2 mt-2 font-weight-bold"
                    style="height:130px; width:100%; overflow: auto">
                    {{ $agent->observacoes}}
                </div>

                @if ( $agent->exepcao == 1)
                <div class="p-2 mt-2 active"><i class="fas fa-info-circle mr-2"></i>Subagente assinalado como exeção
                </div>
                @endif

            </div>
            @endif

        </div>



        <div class="row nav nav-fill w-100 text-center mx-auto p-3 mt-3">

            @if ( $agent->tipo == "Agente" )
            <a class="nav-item nav-link active border p-3 m-1 bg-white rounded shadow-sm name_link"
                id="subagentes-type-tab" data-toggle="tab" href="#subagentes-type" role="tab" aria-controls="agent_type"
                aria-selected="true">
                <div class="col"><i class="fas fa-share-alt mr-2"></i>Subagentes</div>
            </a>
            @endif


            <a class="nav-item nav-link border p-3 m-1 bg-white rounded shadow-sm name_link {{ $agent->tipo == "Subagente" ? 'active' : '' }}"
                id="clients-tab" data-toggle="tab" href="#clients" role="tab" aria-controls="clients"
                aria-selected="false">
                <div class="col">
                    <ion-icon name="person-circle-outline" class="mr-2"
                        style="font-size: 16pt; --ionicon-stroke-width: 40px; position: relative; top: 5px; right: 0px;">
                    </ion-icon>Estudantes
                </div>
            </a>


            <a class="nav-item nav-link border p-3 m-1 bg-white rounded shadow-sm name_link" id="documents-tab"
                data-toggle="tab" href="#documents" role="tab" aria-controls="documents" aria-selected="false">
                <div class="col"><i class="far fa-id-card mr-2"></i>Dados pessoais</div>
            </a>


            <a class="nav-item nav-link border p-3 m-1 bg-white rounded shadow-sm name_link" id="contacts-tab"
                data-toggle="tab" href="#contacts" role="tab" aria-controls="contacts" aria-selected="false">
                <div class="col"><i class="fas fa-comments mr-2"></i>Contactos</div>
            </a>


            <a class="nav-item nav-link border p-3 m-1 bg-white rounded shadow-sm name_link border" id="financas-tab"
                data-toggle="tab" href="#financas" role="tab" aria-controls="financas" aria-selected="false">
                <div class="col"><i class="fas fa-chart-pie mr-2"></i>Financeiro</div>
            </a>

        </div>


        <div class="bg-white shadow-sm mb-4 p-4 border " style="margin-top:-30px">

            <div class="tab-content p-2 mt-3 " id="myTabContent">

                @if ($agent->tipo == "Agente")
                {{-- SUB AGENTES --}}
                <div class="tab-pane fade show active" id="subagentes-type" role="tabpanel"
                    aria-labelledby="subagentes-type-tab">

                    @if($listagents==null)
                    <div class="border rounded bg-light p-3">
                        <div class="text-muted"><small>(sem registos)</small></div>
                    </div>
                    <br>
                    @else
                    <div class="row mx-auto" style="max-height:1000px; overflow:auto ">
                        @foreach ($listagents as $agentx)
                        <a class="name_link text-center m-2" href="{{route('agents.show',$agentx)}}">
                            <div class="col">
                                <div style="width: 130px; height:120px; overflow:hidden">
                                    @if($agentx->fotografia)
                                    <img class="align-middle p-1 rounded bg-white shadow-sm border"
                                        src="{{url('/storage/agent-documents/'.$agentx->idAgente.'/').$agentx->fotografia}}"
                                        style="width:100%; height:auto">
                                    @elseif($agentx->genero == 'F')
                                    <img class="align-middle p-1 rounded bg-white shadow-sm border"
                                        src="{{url('/storage/default-photos/F.jpg')}}"
                                        style="width:100%">
                                    @else
                                    <img class="align-middle p-1 rounded bg-white shadow-sm border"
                                        src="{{url('/storage/default-photos/M.jpg')}}"
                                        style="width:100%">
                                    @endif
                                </div>
                                <div class="mt-1">{{$agentx->nome}} {{$agentx->apelido}}</div>
                                <div style="margin-top:-7px"><small>({{$agentx->pais}})</small></div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                    @endif
                </div>
                @endif




                {{-- Clientes --}}
                <div class="tab-pane fade {{ $agent->tipo == 'Subagente' ? 'show active' : '' }}" id="clients"
                    role="tabpanel" aria-labelledby="clients-tab">

                    @if($clients)


                    <div class="row">

                        <div class="col">
                            <div class="text-secondary">Existe {{count($clients)}} estudante(s) associados a este agente
                            </div>
                            <br>
                            {{-- Input de procura nos resultados da dataTable --}}
                            <input type="text" class="shadow-sm" id="customSearchBox"
                                placeholder="Procurar nos resultados..." aria-label="Procurar" style="width: 100%">
                        </div>



                    </div>


                    <br>


                    <div class="table-responsive font-weight-normal" >
                        <table id="dataTable" class="table table-bordered table-hover " style="width:100%">

                            {{-- Cabeçalho da tabela --}}
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>N.º Passaporte</th>
                                    <th>País</th>
                                    <th>Estado</th>
                                    <th class="text-center">Opções</th>
                                </tr>
                            </thead>

                            {{-- Corpo da tabela --}}
                            <tbody>

                                @foreach ($clients as $client)
                                <tr>

                                    {{-- Nome e Apelido --}}
                                    <td class="align-middle"><a class="name_link"
                                            href="{{route('clients.show',$client)}}">{{ $client->nome }}
                                            {{ $client->apelido }}</a></td>

                                    {{-- numPassaporte --}}
                                    <td class="align-middle">{{ $client->numPassaporte }}</td>

                                    {{-- paisNaturalidade --}}
                                    <td class="align-middle">{{ $client->paisNaturalidade }}</td>

                                    {{-- Estado --}}
                                    <td class="align-middle">
                                        @if ( $client->estado == "Ativo")
                                            <span class="text-success">Ativo</span>
                                        @elseif( $client->estado == "Inativo")
                                            <span class="text-danger">Inativo</span>
                                        @else
                                            <span class="text-info">Proponente</span>
                                        @endif
                                    </td>


                                    {{-- OPÇÔES --}}
                                    <td class="text-center align-middle">
                                        <a href="{{route('clients.show',$client)}}" class="btn_list_opt "
                                            title="Ver ficha completa"><i class="far fa-eye mr-2"></i></a>
                                        <a href="{{route('clients.edit',$client)}}"
                                            class="btn_list_opt btn_list_opt_edit" title="Editar"><i
                                                class="fas fa-pencil-alt mr-2"></i></a>

                                    </td>
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


                {{-- Dados pessoais --}}
                <div class="tab-pane font-weight-normal fade" id="documents" role="tabpanel" aria-labelledby="documents-tab" style="color: black">

                    <div class="row">

                        <div class="col">

                            <div class="mb-2">Número de identificação pessoal:</div>

                            <div class="border rounded bg-light p-3">
                                <div class="font-weight-bold">{{$agent->num_doc}}</div>
                            </div>

                            <br>

                            <div class="mb-2">Número de identificação fiscal:</div>

                            <div class="border rounded bg-light p-3">
                                <div class="font-weight-bold">{{$agent->NIF}}</div>
                            </div>

                            <br>

                        </div>

                        {{-- Documento de identificação --}}
                        <div class="col col-4 text-center" style="min-width: 240px">
                            <div class="card rounded shadow-sm m-2 p-3 h-100">
                                @if ($agent->img_doc)
                                <a class="name_link my-auto" target="_blank"
                                    href="{{url('/storage/agent-documents/'.$agent->idAgente.'/').$agent->img_doc}}">

                                    <i class="far fa-id-card" style="font-size:40px"></i><br>
                                    <div>Ver documento de identificação</div>
                                </a>
                                @else
                                <a href="{{route('agents.edit',$agent)}}" class="mt-2 name_link my-auto"><small
                                        class="text-danger mt-2">
                                        <i class="far fa-id-card" style="font-size:40px"></i><br>
                                        <strong>Sem documento de identificação</strong></small>
                                </a>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>






                {{-- Contactos --}}
                <div class="tab-pane fade font-weight-normal " id="contacts" role="tabpanel" aria-labelledby="documents-tab" style="color: black">
                    <div class="row">

                        <div class="col">
                            <div class="mb-2">E-mail:</div>

                            <div class="border rounded bg-light p-3">
                                <div class="font-weight-bold">{{$agent->email}}</div>
                            </div>

                        </div>
                    </div>

                    <br>


                    <div class="row">

                        <div class="col">

                            <div class="mb-2">País:</div>
                            <div class="border rounded bg-light p-3">
                                <div class="font-weight-bold">{{$agent->pais}}</div>
                            </div>

                            <br>

                            <div class=" mb-2">Morada:</div>
                            <div class="border rounded bg-light p-3">
                                <div class="font-weight-bold">{{$agent->morada}}</div>
                            </div>


                        </div>


                        <div class="col">

                            <div class="mb-2">Telefone principal:</div>
                            <div class="border rounded bg-light p-3">
                                <div class="font-weight-bold">{{$agent->telefone1}}</div>
                            </div>

                            <br>

                            @if ($telefone2)
                            <div class="mb-2">Telefone alternativo:</div>
                            <div class="border rounded bg-light p-3">
                                <div class="font-weight-bold">{{$telefone2}}</div>
                            </div>
                            <br>
                            @endif

                        </div>

                    </div>
                </div>



                {{-- Finaneiro --}}
                <div class="tab-pane fade font-weight-normal" id="financas" role="tabpanel" aria-labelledby="financas-tab" style="color: black">
                    <div class="row">

                        <div class="col">

                            <div class="mb-2">IBAN:</div>

                            <div class="border rounded bg-light p-3">
                                <div>
                                    @if ($IBAN)
                                        <div class="font-weight-bold">{{$IBAN}}</div>
                                    @else
                                        <div class="text-muted"><small>(sem dados para mostrar)</small></div>
                                    @endif
                                </div>
                            </div>

                            <br>




                            <div class="mb-2">Total de comissões:</div>

                            <div class="border rounded bg-light p-3">
                                <div>
                                    @if ($comissoes)
                                        <div class="font-weight-bold text-success">{{$comissoes}}€</div>
                                    @else
                                        <div class="text-muted"><small>(sem dados para mostrar)</small></div>
                                    @endif
                                </div>
                            </div>


                        </div>

                    </div>
                </div>

            </div>

        </div>

    </div>

</div>


@endsection

{{-- Scripts --}}
@section('scripts')
<script src="{{asset('/js/agent_show.js')}}"></script>
@endsection
