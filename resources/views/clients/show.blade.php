@extends('layout.master')
<!-- Page Title -->
@section('title', 'Visualizar estudante')
@section('style-links')
    <link href="{{asset("/css/clientes.css")}}" rel="stylesheet">
@endsection
<!-- Page Content -->
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row d-sm-flex align-items-top justify-content-between mb-4">
        <div class="col-md-6">
            <h1 class="h4 mb-0 text-gray-800">Visualização do(a) estudante {{$client->nome.' '.$client->apelido}}</h1>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{route('clients.edit', $client)}}" class="btn btn-success btn-icon-split btn-sm" title="Editar cliente">
                <span class="icon text-white-50">
                    <i class="fas fa-pencil-alt"></i>
                </span>
                <span class="text">Editar estudante</span>
            </a>
            @if ($produtos)
                <a href="#" data-toggle="modal" data-target="#printModal" data-slug="{{$client->slug}}" class="btn btn-primary btn-icon-split btn-sm" title="Imprimir ficha financeira">
                    <span class="icon text-white-50">
                        <i class="fas fa-print"></i>
                    </span>
                    <span class="text">Imprimir ficha financeira</span>
                </a>
            @endif
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
            <h6 class="m-0 font-weight-bold text-primary">Ficha do(a) estudante {{$client->nome.' '.$client->apelido}}.</h6>
        </div>
        <div class="card-body">
                <div class="row mt-2 container">
                    <div class="col col-2 col-md-12 text-center" style="min-width:195px; max-width:230px; max-height:295px; overflow:hidden">
                        @if($client->fotografia)
                            <img class="align-middle p-1 rounded bg-white shadow-sm border" src="{{url('/storage/client-documents/'.$client->idCliente.'/'.$client->fotografia)}}" style="width:100%;">
                        @elseif($client->genero == 'F')
                            <img class="align-middle p-1 rounded bg-white shadow-sm border" src="{{url('/storage/default-photos/F.jpg')}}" style="width:100%">
                        @else
                            <img class="align-middle p-1 rounded bg-white shadow-sm border" src="{{url('/storage/default-photos/M.jpg')}}" style="width:100%">
                        @endif
                    </div>

                    <div class="col col-3 mr-3" style="min-width:280px !important">
                        <div class="mb-3">
                            <span class="text-gray-900"><b>Género:</b></span>
                            @if ($client->genero == 'M')
                            <span class="text-gray-900">Masculino</span>
                            @else
                            <span class="text-gray-900">Feminino</span>
                            @endif
                        </div>

                        <div class="mb-3">
                            <span class="text-gray-900"><b>Naturalidade:</b></span>
                            <span class="text-gray-900">{{$client->paisNaturalidade}}</span>
                        </div>

                        <div class="mb-3">
                            <span class="text-gray-900"><b>Data de nascimento:</b></span>
                            @if ($client->dataNasc)
                                <span class="text-gray-900">{{date('d/m/Y', strtotime($client->dataNasc))}}</span>
                            @else
                                <span class="text-gray-900">N/A</span>
                            @endif
                        </div>

                        <div class="mb-3">
                            <span class="text-gray-900"><b>Telefone:</b></span>
                            @if ($client->telefone1)
                                <span class="text-gray-900">{{$client->telefone1}}</span>
                            @else
                                <span class="text-gray-900">N/A</span>
                            @endif
                        </div>

                        <div class="mb-3">
                            <span class="text-gray-900"><b>E-Mail:</b></span>
                            @if ($client->email)
                                <span class="text-gray-900">{{$client->email}}</span>
                            @else
                                <span class="text-gray-900">N/A</span>
                            @endif
                        </div>

                        @if (Auth::user()->tipo == "admin")
                        <div class="mb-3">
                            <span class="text-gray-900"><b>Referência cliente:</b></span>
                            @if ($client->refCliente)
                                <span class="text-gray-900">{{$client->refCliente}}</span>
                            @else
                                <span class="text-gray-900">N/A</span>
                            @endif
                        </div>
                        @endif
                    </div>

                    <div class="col pr-3 pb-3" style="min-width:300px !important">
                        @if (Auth::user()->tipo == "admin")
                        <div class="mb-3">
                            <span class="text-gray-900"><b>Agente:</b></span>
                            @if ($client->idAgente && $agente)
                                <a class="font-weight-bold" href="{{route('agents.show', $agente)}}">{{$agente->nome.' '.$agente->apelido}}</a>
                            @else
                                <span class="font-weight-bold">N/A</span>
                            @endif
                        </div>

                        <div class="mb-3">
                            <span class="text-gray-900"><b>Subagente:</b></span>
                            @if ($client->idSubAgente && $subAgente)
                                <a class="font-weight-bold" href="{{route('agents.show', $subAgente)}}">{{$subAgente->nome.' '.$subAgente->apelido}}</a>
                            @else
                                <span class="font-weight-bold">N/A</span>
                            @endif
                        </div>
                        @endif

                        @if (Auth::user()->tipo == "admin")
                        <div class="nav mt-3">
                            <span class="text-gray-900"><b>Ver observações:</b></span>
                            <a class="font-weight-bold active ml-2" id="obsPessoais-tab" data-toggle="tab" href="#obsPessoais" role="tab" aria-controls="obsPessoais" aria-selected="true">
                                Administrativas
                            </a>
                            <span class="mx-2">/</span>
                            <a class="font-weight-bold" id="obsAgentes-tab" data-toggle="tab" href="#obsAgentes" role="tab" aria-controls="obsAgentes" aria-selected="true">
                                Agente
                            </a>
                        </div>

                        <div class="tab-content" id="ObsTabs">
                            <div class="tab-pane fade active show mt-1" id="obsPessoais" role="tabpanel" aria-labelledby="obsPessoais-tab">
                                <div class="border rounded bg-light p-2 pl-3 text-gray-900" style="height:120px; overflow: auto;">
                                    @if ($client->obsPessoais == null)
                                    <span class="text-muted"><small>(sem dados para apresentar)</small></span>
                                    @else
                                    {{$client->obsPessoais}}
                                    @endif
                                </div>
                            </div>

                            <div class="tab-pane fade mt-1" id="obsAgentes" role="tabpanel" aria-labelledby="obsAgentes-tab">
                                <div class="border rounded bg-light p-2 pl-3 text-gray-900" style="height:120px; overflow: auto;">
                                    @if ($client->obsAgente==null)
                                    <span class="text-muted"><small>(sem dados para apresentar)</small></span>
                                    @else
                                    {{ $client->obsAgente }}
                                    @endif
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="nav ">Observações:</div>
                        <div class="border rounded bg-light p-2 " style="height:100%; overflow: auto">
                            @if ($client->obsAgente==null)
                            <span class="text-muted"><small>(sem dados para apresentar)</small></span>
                            @else
                            {{ $client->obsAgente }}
                            @endif
                        </div>
                        @endif
                    </div>
                </div>

                <div class="row nav nav-fill w-100 text-center mt-2 mx-auto p-3">
                    <a class="nav-item nav-link active border p-3 m-1 bg-primary text-white rounded shadow-sm name_link" id="produtos-tab" data-toggle="tab" href="#produtos" role="tab" aria-controls="produto" aria-selected="true">
                        <div class="col">
                            <i class="fas fa-th-large mr-2"></i>Produtos
                        </div>
                    </a>

                    <a class="nav-item nav-link border p-3 m-1 bg-white rounded shadow-sm name_link" id="documentation-tab" data-toggle="tab" href="#documentation" role="tab" aria-controls="documentation" aria-selected="false">
                        <div class="col">
                            <i class="far fa-id-card mr-2"></i>Documentos
                        </div>
                    </a>

                    <a class="nav-item nav-link border p-3 m-1 bg-white rounded shadow-sm name_link" id="academicos-tab" data-toggle="tab" href="#academicos" role="tab" aria-controls="contacts" aria-selected="false">
                        <div class="col" style="min-width: 197px"><i class="fas fa-graduation-cap mr-2"></i>Dados académicos
                        </div>
                    </a>

                    <a class="nav-item nav-link border p-3 m-1 bg-white rounded shadow-sm name_link" id="contacts-tab" data-toggle="tab" href="#contacts" role="tab" aria-controls="contacts" aria-selected="false">
                        <div class="col">
                            <i class="fas fa-comments mr-2"></i>Contactos
                        </div>
                    </a>

                    <a class="nav-item nav-link border p-3 m-1 bg-white rounded shadow-sm name_link" id="financas-tab" data-toggle="tab" href="#financas" role="tab" aria-controls="adresses" aria-selected="false">
                        <div class="col">
                            <i class="fas fa-chart-pie mr-2"></i>Financeiro
                        </div>
                    </a>
                </div>


                <div class="bg-white shadow-sm mb-4 p-4 border" style="margin-top:-30px">
                    <div class="tab-content" id="myTabContent">
                        {{-- Conteudo: Produtos --}}
                        <div class="tab-pane fade active show " id="produtos" role="tabpanel" aria-labelledby="produtos-tab" style="color: black;font-weight:normal !important">
                            @if($produtos)
                                <div class="row mt-2 pl-2">
                                    {{-- Botão para adicionar novo produto --}}
                                    @if (Auth::user()->tipo == "admin")
                                    <a class="name_link text-center m-2" href="{{route('produtos.list',$client)}}">
                                        <div class="col bg-light border border-info rounded shadow-sm p-4" style="height:143px; min-width: 160px">
                                            <div style="font-size:80px; line-height:60px "><strong>+</strong></div>
                                            <div class="mt-1">Adicionar Produto</div>
                                        </div>
                                    </a>
                                    @endif

                                    @foreach ($produtos as $produto)
                                        <a class="name_link text-center m-2" href="{{route('produtos.show',$produto)}}">
                                            <div class="col bg-light border rounded shadow-sm p-4" style="height:143px; min-width: 160px">
                                                <div class=""><i class="fas fa-database p-2 " style="font-size: 25px"></i>
                                                </div>
                                                <div>{{$produto->tipo}}</div>
                                                <div class="mt-1">{{$produto->valorTotal.'€'}}</div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>

                                {{-- Total dos produtos --}}
                                <div class="row border rounded bg-light p-3 mx-auto mt-3">
                                    <div class="col font-weight-bold">
                                        Valor total dos produtos: <span class="text-success">{{$totalprodutos}}€</span>
                                    </div>
                                </div>
                            @else
                                @if (Auth::user()->tipo == "admin")
                                <div class="row mt-2 pl-2">
                                    {{-- Botão para adicionar novo produto --}}
                                    <a class="name_link text-center m-2" href="{{route('produtos.list', $client)}}">
                                        <div class="col bg-light border border-info rounded shadow-sm p-4" style="height:143px; min-width: 160px">
                                            <div style="font-size:80px; line-height:60px "><strong>+</strong></div>
                                            <div class="mt-1">Adicionar Produto</div>
                                        </div>
                                    </a>
                                </div>
                                @endif

                                <div class="row">
                                    <div class="col border rounded bg-light p-3 m-3 font-weight-bold">
                                        Valor total de produtos: <span class="text-gray-900">0€</span>
                                    </div>
                                </div>
                            @endif
                        </div>

                    {{-- Conteudo: Documentação --}}
                    <div class="tab-pane fade text-gray-900" id="documentation" role="tabpanel" aria-labelledby="documentation-tab">
                        {{-- DADOS DE Passaporte --}}
                        <div class="row mt-2 pl-2 ">
                            <div class="col mr-3 ">
                                <div class="mb-2 font-weight-bold">Documento de identificação pessoal:</div>
                                <div class="border rounded bg-light p-3">
                                    {{-- CC IDENTIFICAÇÃO --}}
                                    <div>
                                        <span>Número do documento:</span>
                                        @if ($client->num_docOficial)
                                            <span class="text-gray-900 font-weight-bold">{{$client->num_docOficial}}</span>
                                        @else
                                            <span class="text-gray-900 font-weight-bold">N/A</span>
                                        @endif
                                    </div>
                                    <br>
                                    <div>
                                        <span>Número de identificação fiscal:</span>
                                        @if ($client->NIF)
                                            <span class="text-gray-900 font-weight-bold">{{$client->NIF}}</span>
                                        @else
                                            <span class="text-gray-900 font-weight-bold">N/A</span>
                                        @endif
                                    </div>
                                    <br>
                                    <div>
                                        <span>Data de validade:</span>
                                        @if ($client->validade_docOficial)
                                            <span class="text-gray-900 font-weight-bold">{{date('d/m/Y', strtotime($client->validade_docOficial))}}</span>
                                        @else
                                            <span class="text-gray-900 font-weight-bold">N/A</span>
                                        @endif
                                    </div>
                                </div>
                                <br><br>
                                <div class="mb-2 font-weight-bold">Passaporte:</div>
                                <div class="border rounded bg-light p-3">
                                    @if (isset($passaporteData) && $passaporteData != null)
                                    {{-- numPassaporte --}}
                                        <div>
                                            <span>Número do passaporte:</span>
                                            @if ($passaporteData->numPassaporte)
                                                <span class="text-gray-900 font-weight-bold">{{$passaporteData->numPassaporte}}</span>
                                            @else
                                                <span class="text-gray-900 font-weight-bold">N/A</span>
                                            @endif
                                        </div>
                                        <br>

                                        {{-- dataValidPP --}}
                                        <div>
                                            <span>Data de validade do passaporte:</span>
                                            @if ($passaporteData->dataValidPP)
                                                <span class="text-gray-900 font-weight-bold">{{date('M-Y', strtotime($passaporteData->dataValidPP))}}</span>
                                            @else
                                                <span class="text-gray-900 font-weight-bold">N/A</span>
                                            @endif
                                        </div>
                                        <br>

                                        {{-- passaportPaisEmi --}}
                                        <div>
                                            <span>País emissor do passaporte:</span>
                                            @if ($passaporteData->passaportPaisEmi)
                                                <span class="text-gray-900 font-weight-bold">{{$passaporteData->passaportPaisEmi}}</span>
                                            @else
                                                <span class="text-gray-900 font-weight-bold">N/A</span>
                                            @endif
                                        </div>
                                        <br>

                                        {{-- localEmissaoPP --}}
                                        <div>
                                            <span>Local de emissão do passaporte:</span>
                                            @if ($passaporteData->localEmissaoPP)
                                                <span class="text-gray-900 font-weight-bold">{{$passaporteData->localEmissaoPP}}</span>
                                            @else
                                                <span class="text-gray-900 font-weight-bold">N/A</span>
                                            @endif
                                        </div>
                                    @else
                                        <div class="text-muted"><small>(sem dados para apresentar)</small></div>
                                    @endif
                                </div>
                            </div>

                            {{-- DOCUMENTOS PESSOAIS --}}
                            <div class="col" style="min-width:250px">
                                <div class="mb-2 font-weight-bold">Ficheiros:</div>
                                @if($documentosPessoais)
                                    <ul class="border rounded bg-light pl-3" style="list-style-type:none;margin:0px;padding:0">
                                    @foreach ($documentosPessoais as $docpessoal)
                                        <li class="my-3">
                                            <i class="far fa-address-card mr-2"></i>
                                            <a class="font-weight-bold" target="_blank" href="{{route('documento-pessoal.show', $docpessoal)}}">{{$docpessoal->tipo}}</a>
                                            <span>
                                                <small>({{date('d/m/Y', strtotime($docpessoal->created_at))}})</small>
                                            </span>
                                            @if($docpessoal->verificacao == 0)
                                                <span class="text-danger"><small><i class="fas fa-exclamation ml-1 mr-2" title="Aguarda validação"></i></small></span>
                                            @else
                                            <span class="text-success"><small><i class="fas fa-check ml-1 mr-1" title="Ficheiro validado"></i></small></span>
                                            @endif
                                        </li>
                                    @endforeach
                                    </ul>
                                @else
                                <div class="border rounded bg-light p-3">
                                    <div class="text-muted"><small>(sem dados para apresentar)</small></div>
                                </div>
                                @endif

                                {{-- Adicionar Documento PESSOAL--}}
                                <div class="text-right mt-2">
                                    <a href="#" data-toggle="modal" data-target="#novoDocPessoal" class="btn btn-primary btn-icon-split btn-sm" title="Adicionar">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-plus"></i>
                                        </span>
                                        <span class="text">Adicionar documento pessoal</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Conteudo: DADOS ACADÉMICOS --}}
                    <div class="tab-pane fade text-gray-900" id="academicos" role="tabpanel" aria-labelledby="academicos-tab" style="color: black;font-weight:normal !important">
                        <div class="row mt-2 pl-2">
                            <div class="col">
                                {{-- Informações Escolares --}}
                                <div class="mb-2 font-weight-bold">Universidades:</div>
                                <div class="border rounded bg-light p-3">
                                    <div>
                                        <span>Principal:</span>
                                        @if ($client->universidade1)
                                            <span class="font-weight-bold">{{$client->universidade1}}</span>
                                        @else
                                            <span class="font-weight-bold">N/A</span>
                                        @endif
                                    </div>
                                    <br>
                                    <div>
                                        <span>Secundária:</span>
                                        @if ($client->universidade2)
                                            <span class="font-weight-bold">{{$client->universidade2}}</span>
                                        @else
                                            <span class="font-weight-bold">N/A</span>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <div class="mb-2 font-weight-bold">Cursos:</div>
                                <div class="border rounded bg-light p-3">
                                    <div>
                                        <span>Curso #1:</span>
                                        @if ($client->curso1)
                                            <span class="font-weight-bold">{{$client->curso1}}</span>
                                        @else
                                            <span class="font-weight-bold">N/A</span>
                                        @endif
                                    </div>
                                    <br>
                                    <div>
                                        <span>Curso #2:</span>
                                        @if ($client->curso2)
                                            <span class="font-weight-bold">{{$client->curso2}}</span>
                                        @else
                                            <span class="font-weight-bold">N/A</span>
                                        @endif
                                    </div>
                                    <br>
                                    <div>
                                        <span>Curso #3:</span>
                                        @if ($client->curso3)
                                            <span class="font-weight-bold">{{$client->curso3}}</span>
                                        @else
                                            <span class="font-weight-bold">N/A</span>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <div class="mb-2 font-weight-bold">Nível de estudos:</div>
                                <div class="border rounded bg-light p-3">
                                    @if($client->nivEstudoAtual)
                                        <span>{{$client->nivEstudoAtual}}</span>
                                    @else
                                        <div class="text-muted"><small>(sem dados para apresentar)</small></div>
                                    @endif
                                </div>
                                <br>
                                <div class="mb-2 font-weight-bold">Instituição de origem:</div>
                                <div class="border rounded bg-light p-3">
                                    <div>
                                        <span>Nome:</span>
                                        @if ($client->nomeInstituicaoOrigem)
                                            <span class="font-weight-bold">{{$client->nomeInstituicaoOrigem}}</span>
                                        @else
                                            <span class="font-weight-bold">N/A</span>
                                        @endif
                                    </div>
                                    <br>
                                    <div>
                                        <span>Local:</span>
                                        @if ($client->cidadeInstituicaoOrigem)
                                            <span class="font-weight-bold">{{$client->cidadeInstituicaoOrigem}}</span>
                                        @else
                                            <span class="font-weight-bold">N/A</span>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <div class="mb-2 font-weight-bold">Observações académicas:</div>
                                <div class="border rounded bg-light p-3">
                                    @if ($client->obsAcademicas)
                                        <div class="font-weight-bold">{{$client->obsAcademicas}}</div>
                                    @else
                                        <div class="text-muted"><small>(sem dados para apresentar)</small></div>
                                    @endif
                                </div>
                            </div>

                            {{-- DOCUMENTOS Académicos --}}
                            <div class="col" style="min-width:250px">
                                <div class="font-weight-bold mb-2">Ficheiros:</div>
                                @if ($documentosAcademicos)
                                    <ul class="border rounded bg-light pl-3" style="list-style-type:none;margin:0px;padding:0">
                                        @foreach ($documentosAcademicos as $docAcademico)
                                            <li class="my-3">
                                                <i class="far fa-address-card mr-2"></i>
                                                <a class="font-weight-bold" target="_blank" href="{{route('documento-academico.show', $docAcademico)}}">{{$docAcademico->tipo}}</a>
                                                <span>
                                                    <small>({{date('d/m/Y', strtotime($docAcademico->created_at))}})</small>
                                                </span>
                                                @if($docAcademico->verificacao == 0)
                                                    <span class="text-danger"><small><i class="fas fa-exclamation ml-1 mr-2" title="Aguarda validação"></i></small></span>
                                                @else
                                                    <span class="text-success"><small><i class="fas fa-check ml-1 mr-1" title="Ficheiro validado"></i></small></span>
                                                @endif
                                                </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <div class="border rounded bg-light p-3">
                                        <div class="text-muted"><small>(sem dados para apresentar)</small></div>
                                    </div>
                                @endif
                                {{-- Adicionar Documento Academico --}}
                                <div class="text-right mt-2">
                                    <a href="#" data-toggle="modal" data-target="#novoDocAcademico" class="btn btn-primary btn-icon-split btn-sm" title="Adicionar">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-plus"></i>
                                        </span>
                                        <span class="text">Adicionar documento académico</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>

                    {{-- Conteudo: Contactos --}}
                    <div class="tab-pane fade pl-2 text-gray-900" id="contacts" role="tabpanel" aria-labelledby="contacts-tab" style="color: black;font-weight:normal !important">
                        <div class="row mt-2">
                            <div class="col">
                                {{-- Contactos --}}
                                <div class="mb-2 font-weight-bold" style="min-width: 256px">Contactos:</div>
                                <div class="border rounded bg-light p-3">
                                    <div>
                                        <span class="mb-2">Telefone principal:</span>
                                        @if ($client->telefone1)
                                            <span class="font-weight-bold">{{$client->telefone1}}</span>
                                        @else
                                            <span class="font-weight-bold">N/A</span>
                                        @endif
                                    </div>
                                    <br>
                                    <div>
                                        <span class="mb-2">Telefone secundário:</span>
                                        @if ($client->telefone2)
                                            <span class="font-weight-bold">{{$client->telefone2}}</span>
                                        @else
                                            <span class="font-weight-bold">N/A</span>
                                        @endif
                                    </div>
                                    <br>
                                    <div>
                                        <span class="mb-2">E-Mail:</span>
                                        @if ($client->email)
                                            <span class="font-weight-bold">{{$client->email}}</span>
                                        @else
                                            <span class="font-weight-bold">N/A</span>
                                        @endif
                                    </div>
                                </div>
                                <br>
                            </div>

                            <div class="col">
                                {{-- Morada PT --}}
                                <div class="mb-2 font-weight-bold" style="min-width: 256px">Morada de residência em Portugal:</div>
                                <div class="border rounded bg-light p-3">
                                    @if($client->moradaResidencia)
                                        <span class="font-weight-bold">{{$client->moradaResidencia}}</span>
                                    @else
                                        <span class="text-muted"><small>(sem dados para apresentar)</small></span>
                                    @endif
                                </div>
                                <br>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                {{-- Morada de residência no pais de origem --}}
                                <div class="mb-2 font-weight-bold">Morada de origem:</div>
                                <div class="border rounded bg-light p-3">
                                    <div>
                                        <span>Cidade:</span>
                                        @if ($client->cidade)
                                            <span class="font-weight-bold">{{$client->cidade}}</span>
                                        @else
                                            <span class="font-weight-bold">N/A</span>
                                        @endif
                                    </div>
                                    <br>
                                    <div>
                                        <span>Morada:</span>
                                        @if ($client->morada)
                                            <span class="font-weight-bold">{{$client->morada}}</span>
                                        @else
                                            <span class="font-weight-bold">N/A</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <br>
                        </div>
                        <br>

                        {{-- Contactos dos PAIS --}}
                        <div class="row">
                            <div class="col">
                                <div class="mb-2 font-weight-bold">Identificação dos pais:</div>
                            </div>
                        </div>

                        <div class="border rounded bg-light p-3">
                            <div class="row">
                                <div class="col" style="min-width: 300px">
                                    <div>
                                        <span>Nome do pai:</span>
                                        @if ($client->nomePai)
                                            <span class="font-weight-bold">{{$client->nomePai}}</span>
                                        @else
                                            <span class="font-weight-bold">N/A</span>
                                        @endif
                                    </div>
                                    <br>
                                    <div>
                                        <span>Telefone do pai:</span>
                                        @if ($client->telefonePai)
                                            <span class="font-weight-bold">{{$client->telefonePai}}</span>
                                        @else
                                            <span class="font-weight-bold">N/A</span>
                                        @endif
                                    </div>
                                    <br>
                                    <div>
                                        <span>E-Mail do pai:</span>
                                        @if ($client->emailPai)
                                            <span class="font-weight-bold">{{$client->emailPai}}</span>
                                        @else
                                            <span class="font-weight-bold">N/A</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col" style="min-width: 300px">
                                    <div>
                                        <span>Nome da mãe:</span>
                                        @if ($client->nomeMae)
                                            <span class="font-weight-bold">{{$client->nomeMae}}</span>
                                        @else
                                            <span class="font-weight-bold">N/A</span>
                                        @endif
                                    </div>
                                    <br>
                                    <div>
                                        <span>Telefone da mãe:</span>
                                        @if ($client->telefoneMae)
                                            <span class="font-weight-bold">{{$client->telefoneMae}}</span>
                                        @else
                                            <span class="font-weight-bold">N/A</span>
                                        @endif
                                    </div>
                                    <br>
                                    <div>
                                        <span>E-Mail da mãe:</span>
                                        @if ($client->emailPai)
                                            <span class="font-weight-bold">{{$client->emailMae}}</span>
                                        @else
                                            <span class="font-weight-bold">N/A</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    {{-- DADOS FINANCEIROS --}}
                    <div class="tab-pane fade pl-2 text-gray-900" id="financas" role="tabpanel" aria-labelledby="financas-tab" style="font-weight:normal !important">
                        <div class="table-responsive p-1 mt-4">
                            <table class="table table-bordered table-striped" id="table" width="100%">
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
                                    {{-- Listagem das fases com pagamentos pendentes --}}
                                    @if ($fasesPendentes)
                                        @foreach ($fasesPendentes as $fase)
                                            <tr>
                                                <td>Cobrança</td>
                                                <td title="{{$fase->produto->descricao}}">{{$fase->produto->descricao}}</td>
                                                <td title="{{$fase->descricao}}">{{$fase->descricao}}</td>
                                                <td>{{number_format((float) $fase->valorFase, 2, ',', '').'€'}}</td>
                                                <td>{{date('d/m/Y', strtotime($fase->dataVencimento))}}</td>
                                                <td class="font-weight-bold">Pendente</td>
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
                                    @endif
                                    {{-- Listagem das fases com pagamentos pagos --}}
                                    @if ($fasesPagas)
                                        @foreach ($fasesPagas as $fase)
                                            <tr>
                                                <td>Cobrança</td>
                                                <td title="{{$fase->produto->descricao}}">{{$fase->produto->descricao}}</td>
                                                <td title="{{$fase->descricao}}">{{$fase->descricao}}</td>
                                                <td>{{number_format((float) $fase->valorFase, 2, ',', '').'€'}}</td>
                                                <td>{{date('d/m/Y', strtotime($fase->dataVencimento))}}</td>
                                                <td class="font-weight-bold text-success">Pago</td>
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
                                    @endif
                                    {{-- Listagem das fases com pagamentos vencidos --}}
                                    @if ($fasesDivida)
                                        @foreach ($fasesDivida as $fase)
                                            <tr>
                                                <td>Cobrança</td>
                                                <td title="{{$fase->produto->descricao}}">{{$fase->produto->descricao}}</td>
                                                <td title="{{$fase->descricao}}">{{$fase->descricao}}</td>
                                                <td>{{number_format((float) $fase->valorFase, 2, ',', '').'€'}}</td>
                                                <td>{{date('d/m/Y', strtotime($fase->dataVencimento))}}</td>
                                                <td class="font-weight-bold text-danger">Vencido</td>
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
                                    @endif
                                    @if ($responsabilidades)
                                        @foreach ($responsabilidades as $responsabilidade)
                                            @if ($responsabilidade->valorCliente != null && $responsabilidade->valorCliente != 0)
                                            <tr>
                                                <td class="tooltip-td" data-toggle="tooltip" data-placement="top" title="Pagamento sujeito ao cliente.">Pagamento</td>
                                                <td title="{{$responsabilidade->fase->produto->descricao}}">{{$responsabilidade->fase->produto->descricao}}</td>
                                                <td title="{{$responsabilidade->fase->descricao}}">{{$responsabilidade->fase->descricao}}</td>
                                                <td>{{number_format((float) $responsabilidade->valorCliente, 2, ',', '').'€'}}</td>
                                                <td>{{date('d/m/Y', strtotime($responsabilidade->dataVencimentoCliente))}}</td>
                                                <td class="@if(!$responsabilidade->verificacaoPagoCliente && $responsabilidade->dataVencimentoCliente < $currentdate) text-danger font-weight-bold @elseif ($responsabilidade->verificacaoPagoCliente) text-success font-weight-bold @else font-weight-bold text-gray @endif">
                                                @if (!$responsabilidade->verificacaoPagoCliente && $responsabilidade->dataVencimentoCliente < $currentdate)
                                                    Vencido
                                                @elseif (!$responsabilidade->verificacaoPagoCliente && $responsabilidade->dataVencimentoCliente > $currentdate)
                                                    Pendente
                                                @elseif ($responsabilidade->verificacaoPagoCliente)
                                                    Pago
                                                @endif
                                                </td>
                                                <td class="text-center align-middle">
                                                    @if($responsabilidade->pagoResponsabilidade && $responsabilidade->verificacaoPagoCliente)
                                                        <button class="btn btn-sm btn-outline-dark text-gray-900" disabled><i class="fas fa-check"></i></button>
                                                        <a href="{{route('payments.showcliente', [$responsabilidade->cliente, $responsabilidade->fase, $responsabilidade, $responsabilidade->pagoResponsabilidade])}}" class="btn btn-sm btn-outline-primary" title="Visualizar"><i class="far fa-eye"></i></a>
                                                        <a href="{{route('payments.editcliente', [$responsabilidade->cliente, $responsabilidade->fase, $responsabilidade, $responsabilidade->pagoResponsabilidade])}}" class="btn btn-sm btn-outline-warning" title="Editar"><i class="fas fa-pencil-alt"></i></a>
                                                    @else
                                                        <a href="{{route('payments.cliente', [$responsabilidade->cliente, $responsabilidade->fase, $responsabilidade])}}" class="btn btn-sm btn-outline-success" title="Registar"><i class="fas fa-check"></i></a>
                                                        <button class="btn btn-sm btn-outline-dark text-gray-900" disabled><i class="far fa-eye"></i></button>
                                                        <button class="btn btn-sm btn-outline-dark text-gray-900" disabled><i class="fas fa-pencil-alt"></i></button>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endif

                                            @if ($responsabilidade->valorAgente != null && $responsabilidade->valorAgente != 0)
                                            <tr>
                                                <td class="tooltip-td" data-toggle="tooltip" data-placement="top" title="Pagamento sujeito ao agente {{$responsabilidade->agente->nome.' '.$responsabilidade->agente->apelido}}.">Pagamento</td>
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
                                            @endif

                                            @if ($responsabilidade->valorSubAgente != null && $responsabilidade->valorSubAgente != 0)
                                            <tr>
                                                <td class="tooltip-td" data-toggle="tooltip" data-placement="top" title="Pagamento sujeito ao sub-agente {{$responsabilidade->subAgente->nome.' '.$responsabilidade->subAgente->apelido}}.">Pagamento</td>
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
                                            @endif

                                            @if ($responsabilidade->valorUniversidade1 != null && $responsabilidade->valorUniversidade1 != 0)
                                            <tr>
                                                <td class="tooltip-td" data-toggle="tooltip" data-placement="top" title="Pagamento sujeito a universidade {{$responsabilidade->universidade1->nome}}.">Pagamento</td>
                                                <td title="{{$responsabilidade->fase->produto->descricao}}">{{$responsabilidade->fase->produto->descricao}}</td>
                                                <td title="{{$responsabilidade->fase->descricao}}">{{$responsabilidade->fase->descricao}}</td>
                                                <td>{{number_format((float) $responsabilidade->valorUniversidade1, 2, ',', '').'€'}}</td>
                                                <td>{{date('d/m/Y', strtotime($responsabilidade->dataVencimentoUni1))}}</td>
                                                <td class="@if(!$responsabilidade->verificacaoPagoUni1 && $responsabilidade->dataVencimentoUni1 < $currentdate) text-danger font-weight-bold @elseif ($responsabilidade->verificacaoPagoUni1) text-success font-weight-bold @else font-weight-bold text-gray @endif">
                                                @if (!$responsabilidade->verificacaoPagoUni1 && $responsabilidade->dataVencimentoUni1 < $currentdate)
                                                    Vencido
                                                @elseif (!$responsabilidade->verificacaoPagoUni1 && $responsabilidade->dataVencimentoUni1 > $currentdate)
                                                    Pendente
                                                @elseif ($responsabilidade->verificacaoPagoUni1)
                                                    Pago
                                                @endif
                                                </td>
                                                <td class="text-center align-middle">
                                                    @if($responsabilidade->pagoResponsabilidade && $responsabilidade->verificacaoPagoUni1)
                                                        <button class="btn btn-sm btn-outline-dark text-gray-900" disabled><i class="fas fa-check"></i></button>
                                                        <a href="{{route('payments.showuni1', [$responsabilidade->universidade1, $responsabilidade->fase, $responsabilidade, $responsabilidade->pagoResponsabilidade])}}" class="btn btn-sm btn-outline-primary" title="Visualizar"><i class="far fa-eye"></i></a>
                                                        <a href="{{route('payments.edituni1', [$responsabilidade->universidade1, $responsabilidade->fase, $responsabilidade, $responsabilidade->pagoResponsabilidade])}}" class="btn btn-sm btn-outline-warning" title="Editar"><i class="fas fa-pencil-alt"></i></a>
                                                    @else
                                                        <a href="{{route('payments.uni1', [$responsabilidade->universidade1, $responsabilidade->fase, $responsabilidade])}}" class="btn btn-sm btn-outline-success" title="Registar"><i class="fas fa-check"></i></a>
                                                        <button class="btn btn-sm btn-outline-dark text-gray-900" disabled><i class="far fa-eye"></i></button>
                                                        <button class="btn btn-sm btn-outline-dark text-gray-900" disabled><i class="fas fa-pencil-alt"></i></button>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endif

                                            @if ($responsabilidade->valorUniversidade2 != null && $responsabilidade->valorUniversidade2 != 0)
                                            <tr>
                                                <td class="tooltip-td" data-toggle="tooltip" data-placement="top" title="Pagamento sujeito a universidade {{$responsabilidade->universidade2->nome}}.">Pagamento</td>
                                                <td title="{{$responsabilidade->fase->produto->descricao}}">{{$responsabilidade->fase->produto->descricao}}</td>
                                                <td title="{{$responsabilidade->fase->descricao}}">{{$responsabilidade->fase->descricao}}</td>
                                                <td>{{number_format((float) $responsabilidade->valorUniversidade2, 2, ',', '').'€'}}</td>
                                                <td>{{date('d/m/Y', strtotime($responsabilidade->dataVencimentoUni2))}}</td>
                                                <td class="@if(!$responsabilidade->verificacaoPagoUni2 && $responsabilidade->dataVencimentoUni2 < $currentdate) text-danger font-weight-bold @elseif ($responsabilidade->verificacaoPagoUni2) text-success font-weight-bold @else font-weight-bold text-gray @endif">
                                                @if (!$responsabilidade->verificacaoPagoUni2 && $responsabilidade->dataVencimentoUni2 < $currentdate)
                                                    Vencido
                                                @elseif (!$responsabilidade->verificacaoPagoUni2 && $responsabilidade->dataVencimentoUni2 > $currentdate)
                                                    Pendente
                                                @elseif ($responsabilidade->verificacaoPagoUni2)
                                                    Pago
                                                @endif
                                                </td>
                                                <td class="text-center align-middle">
                                                    @if($responsabilidade->pagoResponsabilidade && $responsabilidade->verificacaoPagoUni2)
                                                        <button class="btn btn-sm btn-outline-dark text-gray-900" disabled><i class="fas fa-check"></i></button>
                                                        <a href="{{route('payments.showuni2', [$responsabilidade->universidade2, $responsabilidade->fase, $responsabilidade, $responsabilidade->pagoResponsabilidade])}}" class="btn btn-sm btn-outline-primary" title="Visualizar"><i class="far fa-eye"></i></a>
                                                        <a href="{{route('payments.edituni2', [$responsabilidade->universidade2, $responsabilidade->fase, $responsabilidade, $responsabilidade->pagoResponsabilidade])}}" class="btn btn-sm btn-outline-warning" title="Editar"><i class="fas fa-pencil-alt"></i></a>
                                                    @else
                                                        <a href="{{route('payments.uni2', [$responsabilidade->universidade2, $responsabilidade->fase, $responsabilidade])}}" class="btn btn-sm btn-outline-success" title="Registar"><i class="fas fa-check"></i></a>
                                                        <button class="btn btn-sm btn-outline-dark text-gray-900" disabled><i class="far fa-eye"></i></button>
                                                        <button class="btn btn-sm btn-outline-dark text-gray-900" disabled><i class="fas fa-pencil-alt"></i></button>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endif
                                            @if ($responsabilidade->relacao)
                                                @foreach ($responsabilidade->relacao as $relacao)
                                                <tr>
                                                    <td class="tooltip-td" data-toggle="tooltip" data-placement="top" title="Pagamento sujeito ao fornecedor {{$relacao->fornecedor->nome}}.">Pagamento</td>
                                                    <td title="{{$relacao->responsabilidade->fase->produto->descricao}}">{{$relacao->responsabilidade->fase->produto->descricao}}</td>
                                                    <td title="{{$relacao->responsabilidade->fase->descricao}}">{{$relacao->responsabilidade->fase->descricao}}</td>
                                                    <td>{{number_format((float) $relacao->valor, 2, ',', '').'€'}}</td>
                                                    <td>{{date('d/m/Y', strtotime($relacao->dataVencimento))}}</td>
                                                    <td class="@if($relacao->verificacaoPago == false && $relacao->estado == "Dívida") text-danger font-weight-bold @elseif ($relacao->verificacaoPago == true) text-success font-weight-bold @else font-weight-bold text-gray @endif">
                                                    @if ($relacao->verificacaoPago == false && $relacao->estado == "Dívida")
                                                        Vencido
                                                    @elseif ($relacao->verificacaoPago == false && $relacao->estado == "Pendente")
                                                        Pendente
                                                    @elseif ($relacao->verificacaoPago == true && $relacao->estado == "Pago")
                                                        Pago
                                                    @endif
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        @if($responsabilidade->pagoResponsabilidade && $relacao->verificacaoPago)
                                                            <button class="btn btn-sm btn-outline-dark text-gray-900" disabled><i class="fas fa-check"></i></button>
                                                            <a href="{{route('payments.showfornecedor', [$relacao->fornecedor, $relacao->responsabilidade->fase, $relacao, $responsabilidade->pagoResponsabilidade])}}" class="btn btn-sm btn-outline-primary" title="Visualizar"><i class="far fa-eye"></i></a>
                                                            <a href="{{route('payments.editfornecedor', [$relacao->fornecedor, $relacao->responsabilidade->fase, $relacao, $responsabilidade->pagoResponsabilidade])}}" class="btn btn-sm btn-outline-warning" title="Editar"><i class="fas fa-pencil-alt"></i></a>
                                                        @else
                                                            <a href="{{route('payments.fornecedor', [$relacao->fornecedor, $relacao->responsabilidade->fase, $relacao])}}" class="btn btn-sm btn-outline-success" title="Registar"><i class="fas fa-check"></i></a>
                                                            <button class="btn btn-sm btn-outline-dark text-gray-900" disabled><i class="far fa-eye"></i></button>
                                                            <button class="btn btn-sm btn-outline-dark text-gray-900" disabled><i class="fas fa-pencil-alt"></i></button>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                            @endif
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
<!-- End of container-fluid -->

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
    <form class="form-group needs-validation" method="post" novalidate target="_blank">
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
                            <label for="produto">Escolha um produto para <b>imprimir a sua informação financeira</b> referente ao estudante <b>{{$client->nome.' '.$client->apelido}}</b> <sup class="text-danger small">&#10033;</sup></label>
                            <select id="produto" class="custom-select" name="produto" required>
                                <option disabled selected hidden>Escolha um produto...</option>
                                @if ($produtos)
                                    @foreach ($produtos as $produto)
                                        <option value="{{$produto->descricao}}">{{$produto->descricao}}</option>
                                    @endforeach
                                @endif
                            </select>
                            <div class="invalid-feedback">
                                Oops, parece que algo não está bem...
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

<!-- Modal for create new document -->
<form class="form-group needs-validation" id="Form-Documento-Pessoal" action="{{route('documento-pessoal.createFromClient', $client)}}" method="post" novalidate>
    @csrf
    <div class="modal fade" id="novoDocPessoal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header pl-4 pb-1 pt-4">
                    <h5 class="modal-title text-gray-800 font-weight-bold">Quer adicionar um novo documento?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-button">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-gray-800 pl-4 pr-5">
                    <div class="form-row p-2">
                        <label for="NomeDocumentoPessoal" class="text-gray-900">Nome do documento <sup class="text-danger small">&#10033;</sup></label>
                        <input class="form-control" id="NomeDocumentoPessoal" name="NomeDocumentoPessoal" placeholder="Insira um nome..." required>
                        <div class="invalid-feedback">
                            Oops, parece que algo não está bem...
                        </div>
                    </div>
                </div>
                <div class="modal-footer mt-3">
                    <a data-dismiss="modal" class="mr-4 font-weight-bold" id="close-option">Fechar</a>
                    <button type="submit" class="btn btn-primary font-weight-bold mr-2">Adicionar documento</button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Modal -->
<form class="form-group needs-validation" id="Form-Documento-Academico" action="{{route('documento-academico.createFromClient', $client)}}" method="post" novalidate>
    @csrf
    <div class="modal fade" id="novoDocAcademico" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header pl-4 pb-1 pt-4">
                    <h5 class="modal-title text-gray-800 font-weight-bold">Quer adicionar um novo documento?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-button">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-gray-800 pl-4 pr-5">
                    <div class="form-row p-2">
                        <label for="NomeDocumentoAcademico" class="text-gray-900">Nome do documento <sup class="text-danger small">&#10033;</sup></label>
                        <input class="form-control" id="NomeDocumentoAcademico" name="NomeDocumentoAcademico" placeholder="Insira um nome..." required>
                        <div class="invalid-feedback">
                            Oops, parece que algo não está bem...
                        </div>
                    </div>
                </div>
                <div class="modal-footer mt-3">
                    <a data-dismiss="modal" class="mr-4 font-weight-bold" id="close-option">Fechar</a>
                    <button type="submit" class="btn btn-primary font-weight-bold mr-2">Adicionar documento</button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Begin of Scripts -->
@section('scripts')
<script src="//cdn.datatables.net/plug-ins/1.10.11/sorting/date-eu.js" type="text/javascript"></script>
<script src="{{asset('/js/clients.js')}}"></script>
<script>
    // Truncate a string
    function strtrunc(str, max, add){
        add = add || '...';
        return (typeof str === 'string' && str.length > max ? str.substring(0, max) + add : str);
    };

    $(document).ready(function() {
        $('#table').DataTable({
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
                    "targets":4,
                    "type":"date-eu"
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
            {"option": document.getElementById("produtos-tab")},
            {"option": document.getElementById("documentation-tab")},
            {"option": document.getElementById("academicos-tab")},
            {"option": document.getElementById("contacts-tab")},
            {"option": document.getElementById("financas-tab")}
        ]

        $("#produtos-tab, #documentation-tab, #academicos-tab, #contacts-tab, #financas-tab").click(function(){
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

        $('#printModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var modal = $(this);
            modal.find("form").attr('action', '/clientes/imprimir-ficha-financeiro/' + button.data('slug'));
        });

        $("#submitPrint").click(function(){
            $('#printModal').modal('hide');
        })
    });
</script>
@endsection
<!-- End of Scripts -->
@endsection
<!-- End of Page Content -->
