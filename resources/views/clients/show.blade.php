@extends('layout.master')

{{-- Page Title --}}
@section('title', 'Ficha de estudante')

{{-- CSS Style Link --}}
@section('styleLinks')
<link href="{{asset('css/datatables_general.css')}}" rel="stylesheet">

@endsection



{{-- Page Content --}}
@section('content')

<div class="container-fluid my-4">


    {{-- Conteúdo --}}
    <div class="bg-white shadow-sm mb-4 p-4 ">

        <div class="row">

            <div class="col">
                <div class="title">
                    <h4><strong>Ficha de estudante de <span class="active">{{$client->nome}} {{$client->apelido}}</span></strong></h4>
                    <small>
                        <div>
                            <span>Estado do cliente:</span>
                            @if ( $client->estado == "Ativo")
                            <strong><span class="text-success">ATIVO</span></strong>
                            @elseif( $client->estado == "Inativo")
                            <strong><span class="text-danger">INATIVO</span></strong>
                            @else
                            <strong><span class="text-info">PROPONENTE</span></strong>
                            @endif
                            <span><span class="mx-2">|</span> Ultima atualização:
                                <strong>{{ date('d-M-y', strtotime($client->updated_at)) }}</strong></span>
                        </div>
                    </small>
                </div>
            </div>

            {{-- Opções --}}
            <div class="col text-right">
                {{-- Permissões para editar --}}
                @if (Auth::user()->tipo == "admin" || Auth::user()->tipo == "agente" && $client->editavel == 1)
                <a href="{{route('clients.edit',$client)}}" class="btn btn-sm btn-success m-1 mr-2 px-3 "><i class="fas fa-pencil-alt mr-2"></i>Editar Informação</a>
                @endif

                <a href="{{route('clients.print',$client)}}" target="_blank" class="btn btn-sm btn-light border m-1 mr-2"><i class="fas fa-print mr-2"></i>Imprimir</a>
            </div>

        </div>

        <hr class="my-3">

        <div class="row mt-4">
            <div class="col col-2 col-md-12 text-center" style="min-width:195px; max-width:230px; max-height:295px; overflow:hidden">

                @if($client->fotografia)
                    <img class="align-middle p-1 rounded bg-white shadow-sm border" src="{{url('/storage/client-documents/'.$client->idCliente.'/'.$client->fotografia)}}" style="width:100%; ">
                    @elseif($client->genero == 'F')
                        <img class="align-middle p-1 rounded bg-white shadow-sm border" src="{{url('/storage/default-photos/F.jpg')}}" style="width:100%">
                        @else
                        <img class="align-middle p-1 rounded bg-white shadow-sm border" src="{{url('/storage/default-photos/M.jpg')}}" style="width:100%">
                        @endif

            </div>

            <div class="col col-3 p-2 mr-3" style="min-width:280px !important">

                {{-- Informações Pessoais --}}
                <div><span>Género: </span>
                    @if ($client->genero == 'M')
                    <span class="font-weight-bold">Masculino</span>
                    @else
                    <span class="font-weight-bold">Feminino</span>
                    @endif
                </div><br>

                <div>Naturalidade: <span class="font-weight-bold">{{$client->paisNaturalidade}}</span></div><br>

                <div>Data de nascimento:
                    <span class="font-weight-bold">{{ date('d-M-y', strtotime($client->dataNasc)) }}</span>
                </div>
                <br>

                <div>Telefone (principal): <span class="font-weight-bold">{{$client->telefone1}}</span></div><br>

                <div>E-mail: <span class="font-weight-bold">{{$client->email}}</span></div>

            </div>

            <div class="col p-2 pr-3 pb-3" style="min-width:300px !important">

                {{-- AGENTES --}}
                @if (Auth::user()->tipo == "admin")

                @if ($agente!=null )
                <div class="mb-3">Agente: <a class="font-weight-bold" href="{{route('agents.show',$agente)}}">{{$agente->nome}} {{$agente->apelido}}</a></div>
                @endif

                @if ($associados!=null )
                <div class="mb-3">Agente(s) associados:

                    @foreach ($associados as $agent)
                    <a class="font-weight-bold" href="{{route('agents.show',$agent)}}">{{$agent->nome}}
                        {{$agent->apelido}}</a>,
                    @endforeach

                </div>

                @endif

                @endif


                {{--Referências do cliente --}}
                @if (Auth::user()->tipo == "admin")
                <div class="mb-3">Referências do cliente: <span class="font-weight-bold">{{ $client->refCliente }}</span></div>
                @endif


                {{-- Separadores com obs do Agente / Admin --}}

                @if (Auth::user()->tipo == "admin")

                <div class="nav mt-3">Ver observações:

                    <a class="font-weight-bold active ml-2 " id="obsPessoais-tab" data-toggle="tab" href="#obsPessoais" role="tab" aria-controls="obsPessoais" aria-selected="true">Pessoais</a>
                    <span class="mx-2">|</span>
                    <a class="font-weight-bold" id="obsAgentes-tab" data-toggle="tab" href="#obsAgentes" role="tab" aria-controls="obsAgentes" aria-selected="true">Do Agente</a>
                </div>

                {{-- Tab das ObsPessoais (ADMINS ONLY) --}}
                <div class="tab-content " id="ObsTabs">
                    <div class="tab-pane fade active show mt-1" id="obsPessoais" role="tabpanel" aria-labelledby="obsPessoais-tab">
                        <div class="border rounded bg-light p-2" style="height:120px; overflow: auto; color:black">
                            @if ($client->obsPessoais==null)
                            <span class="text-muted"><small>(sem dados para mostrar)</small></span>
                            @else
                            {{ $client->obsPessoais }}
                            @endif
                        </div>
                    </div>


                    {{-- Tab das Obs dos Agentes --}}
                    <div class="tab-pane fade mt-1" id="obsAgentes" role="tabpanel" aria-labelledby="obsAgentes-tab">
                        <div class="border rounded bg-light p-2" style="height:120px; overflow: auto; color:black">
                            @if ($client->obsAgente==null)
                            <span class="text-muted"><small>(sem dados para mostrar)</small></span>
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
                    <span class="text-muted"><small>(sem dados para mostrar)</small></span>
                    @else
                    {{ $client->obsAgente }}
                    @endif
                </div>

                @endif


            </div>

        </div>



        <div class="row nav nav-fill w-100 text-center mt-2 mx-auto p-3">


            <a class="nav-item nav-link active border p-3 m-1 bg-white rounded shadow-sm name_link" id="produtos-tab" data-toggle="tab" href="#produtos" role="tab" aria-controls="produto" aria-selected="true">
                <div class="col"><i class="fas fa-th-large mr-2"></i>Produtos</div>
            </a>


            <a class="nav-item nav-link border p-3 m-1 bg-white rounded shadow-sm name_link" id="documentation-tab" data-toggle="tab" href="#documentation" role="tab" aria-controls="documentation" aria-selected="false">
                <div class="col"><i class="far fa-id-card mr-2"></i>Documentos</div>
            </a>


            <a class="nav-item nav-link border p-3 m-1 bg-white rounded shadow-sm name_link" id="academicos-tab" data-toggle="tab" href="#academicos" role="tab" aria-controls="contacts" aria-selected="false">
                <div class="col" style="min-width: 197px"><i class="fas fa-graduation-cap mr-2"></i>Dados académicos
                </div>
            </a>


            <a class="nav-item nav-link border p-3 m-1 bg-white rounded shadow-sm name_link" id="contacts-tab" data-toggle="tab" href="#contacts" role="tab" aria-controls="contacts" aria-selected="false">
                <div class="col"><i class="fas fa-comments mr-2"></i>Contactos</div>
            </a>


            <a class="nav-item nav-link border p-3 m-1 bg-white rounded shadow-sm name_link" id="adresses-tab" data-toggle="tab" href="#adresses" role="tab" aria-controls="adresses" aria-selected="false">
                <div class="col"><i class="fas fa-chart-pie mr-2"></i>Financeiro</div>
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
                        {{-- <div class="col">
                            Produtos registados: <span class="active">{{count($produtos)}}</span>
                    </div> --}}
                    <div class="col font-weight-bold">
                        Total dos protudos: <span class="text-success ">{{$totalprodutos}}€</span>
                    </div>
                </div>

                @else

                {{-- Sem produtos --}}
                {{-- <div class="row ">
                        <div class="col border rounded bg-light p-3 m-3">
                            <div class="text-muted"><small>(sem registos)</small></div>
                        </div>
                    </div> --}}


                @if (Auth::user()->tipo == "admin")
                <div class="row mt-2 pl-2">
                    {{-- Botão para adicionar novo produto --}}

                    <a class="name_link text-center m-2" href="{{route('produtos.list',$client)}}">
                        <div class="col bg-light border border-info rounded shadow-sm p-4" style="height:143px; min-width: 160px">
                            <div style="font-size:80px; line-height:60px "><strong>+</strong></div>
                            <div class="mt-1">Adicionar Produto</div>
                        </div>
                    </a>

                </div>
                @endif

                <div class="row ">
                    <div class="col border rounded bg-light p-3 m-3 font-weight-bold">
                        Total dos protudos: <span class="text-success ">0 €</span>
                    </div>
                </div>

                @endif

            </div>


            {{-- Conteudo: Documentação --}}
            <div class="tab-pane fade " id="documentation" role="tabpanel" aria-labelledby="documentation-tab" style="color: black;font-weight:normal !important">

                {{-- DADOS DE Passaporte --}}
                <div class="row mt-2 pl-2 ">

                    <div class="col mr-3 ">
                        <div class=" mb-2 ">Documento de identificação pessoal:</div>

                        <div class="border rounded bg-light p-3">
                            {{-- CC IDENTIFICAÇÃO --}}
                            <div>Número do documento: <span class="font-weight-bold">{{$client->num_docOficial}}</span>
                            </div>
                            <br>
                            <div>Número de identificação fiscal: <span class="font-weight-bold">{{$client->NIF}}</span>
                            </div>
                            <br>
                            <div>Data de validade: <span class="font-weight-bold">{{ date('M-Y', strtotime($client->validade_docOficial)) }}</span>
                            </div>
                        </div>

                        <br><br>

                        <div class=" mb-2">Passaporte:</div>

                        <div class="border rounded bg-light p-3">
                            @if ( isset($passaporteData) && $passaporteData!=null)
                            {{-- numPassaporte --}}
                            <div>Número do passaporte: <span class="font-weight-bold my-3">{{$passaporteData->numPassaporte}}</span></div>
                            <br>

                            {{-- dataValidPP --}}
                            <div>Data de validade do passaporte: <span class="font-weight-bold my-3">{{ date('M-Y', strtotime($passaporteData->dataValidPP)) }}</span>
                            </div><br>

                            {{-- passaportPaisEmi --}}
                            <div>Pais emissor do passaporte: <span class="font-weight-bold my-3">{{$passaporteData->passaportPaisEmi}}</span></div><br>

                            {{-- localEmissaoPP --}}
                            <div>Local de emissão do passaporte: <span class="font-weight-bold my-3">{{$passaporteData->localEmissaoPP}}</span></div>
                            @else
                            <div class=""><small>(sem informação)</small></div>
                            @endif


                        </div>

                        <br>


                    </div>

                    {{-- DOCUMENTOS PESSOAIS --}}
                    <div class="col" style="min-width:250px">
                        <div class=" mb-2">Ficheiros:</div>
                        @if ($documentosPessoais!=null )
                        <ul class="border rounded bg-light pl-3" style="list-style-type:none;margin:0px;padding:0">
                            @foreach ($documentosPessoais as $docpessoal)
                            <li class="my-3">

                                @if ($docpessoal->imagem != null)

                                <i class="far fa-address-card mr-2"></i>

                                <a class="font-weight-bold" target="_blank" href="{{route('documento-pessoal.show',$docpessoal)}}">{{$docpessoal->tipo}}</a>

                                <span class=""><small>({{ date('d-M-y', strtotime($docpessoal->created_at)) }})</small></span>

                                @if($docpessoal->verificacao==0)
                                    <span class="text-danger"><small><i class="fas fa-exclamation ml-1 mr-2" title="Aguarda validação"></i></small></span>
                                    @else
                                    <span class="text-success"><small><i class="fas fa-check ml-1 mr-1" title="Ficheiro validado"></i></small></span>
                                    @endif

                                    @endif

                            </li>
                            @endforeach
                        </ul>
                        @else
                        <div class="border rounded bg-light p-3">
                            <div class="text-muted"><small>(sem registos)</small></div>
                        </div>
                        @endif

                        {{-- Adicionar Documento PESSOAL--}}

                        <div class="col text-left">
                            <a href="#" class="btn btn-sm btn-primary m-1 mr-2 px-3 " data-toggle="modal" data-target="#novoDocPessoal"><i class="fas fa-plus mr-2 "></i>Adicionar Documento Pessoal</a>
                        </div>

                    </div>

                </div>

            </div>





            {{-- Conteudo: DADOS ACADÉMICOS --}}
            <div class="tab-pane fade" id="academicos" role="tabpanel" aria-labelledby="academicos-tab" style="color: black;font-weight:normal !important">
                <div class="row mt-2 pl-2">
                    <div class="col">

                        {{-- Informações Escolares --}}
                        <div class=" mb-2">Nível de estudos:</div>

                        <div class="border rounded bg-light p-3">

                            @if ($client->nivEstudoAtual !=null)
                            <span class="font-weight-bold">{{$client->nivEstudoAtual}}</span>
                            @else
                            <span class=""><small>(Aguarda dados...)</small></span>
                            @endif

                        </div>

                        <br>

                        <div class=" mb-2">Instituição de origem</div>
                        <div class="border rounded bg-light p-3">
                            <div>Nome: <span class="font-weight-bold">{{$client->nomeInstituicaoOrigem}}</span></div>
                            <br>
                            <div>Local: <span class="font-weight-bold">{{$client->cidadeInstituicaoOrigem}}</span></div>
                        </div>

                        <br>



                        <div class=" mb-2 ">Observações académicas:</div>
                        <div class="border rounded bg-light p-3">
                            @if ($client->obsAcademicas==null)
                            <div class="text-muted "><small>(sem dados para mostrar)</small></div>
                            @else
                            <div class="font-weight-bold"> {{$client->obsAcademicas}}</div>
                            @endif
                        </div>


                    </div>

                    {{-- DOCUMENTOS Académicos --}}
                    <div class="col" style="min-width:250px">
                        <div class=" mb-2">Ficheiros:</div>
                        @if ($documentosAcademicos!=null)
                        <ul class="border rounded bg-light pl-3" style="list-style-type:none;margin:0px;padding:0">
                            @foreach ($documentosAcademicos as $docAcademico)
                            @if ($docAcademico->imagem != null)
                            <li class="my-3">

                                @if ($docAcademico->imagem != null)
                                <i class="far fa-address-card mr-2"></i>
                                <a class="font-weight-bold" target="_blank" href="{{route('documento-academico.show',$docacademico)}}">{{$docAcademico->tipo}}</a>
                                <span class=""><small>({{ date('d-M-y', strtotime($docAcademico->created_at)) }})</small></span>

                                @if($docAcademico->verificacao==0)
                                    <span class="text-danger"><small><i class="fas fa-exclamation ml-1 mr-2" title="Aguarda validação"></i></small></span>
                                    @else
                                    <span class="text-success"><small><i class="fas fa-check ml-1 mr-1" title="Ficheiro validado"></i></small></span>
                                    @endif

                                    @endif

                            </li>
                            @endif
                            @endforeach

                        </ul>
                        @else
                        <div class="border rounded bg-light p-3">
                            <div class="text-muted"><small>(sem registos)</small></div>
                        </div>
                        @endif

                        {{-- Adicionar Documento Academico --}}
                        <div class="col text-left">
                            <a href="#" class="btn btn-sm btn-primary m-1 mr-2 px-3" data-toggle="modal" data-target="#novoDocAcademico"><i class="fas fa-plus mr-2 "></i>Adicionar Documento Academico</a>
                        </div>

                    </div>

                </div>

                <br>

            </div>


            {{-- Conteudo: Contactos --}}
            <div class="tab-pane fade pl-2" id="contacts" role="tabpanel" aria-labelledby="contacts-tab" style="color: black;font-weight:normal !important">

                <div class="row mt-2">
                    <div class="col">

                        {{-- Contactos --}}
                        <div class=" mb-2" style="min-width: 256px">Contactos:</div>

                        <div class="border rounded bg-light p-3">
                            <div>Telefone (principal): <span class="font-weight-bold">{{$client->telefone1}}</span>
                            </div>
                            <br>
                            @if ($client->telefone2!=null)
                            <div>Telefone (secundário): <span class="font-weight-bold">{{$client->telefone2}}</span>
                            </div>
                            <br>
                            @endif
                            <div>E-mail: <span class="font-weight-bold">{{$client->email}}</span> </div>
                        </div>
                        <br>
                    </div>



                    <div class="col">

                        {{-- Morada PT --}}
                        <div class=" mb-2" style="min-width: 256px">Morada de residência em Portugal:
                        </div>
                        <div class="border rounded bg-light p-3">
                            @if ($client->moradaResidencia==null)
                            <span class="text-muted"><small>(sem dados para mostrar)</small></span>
                            @else
                            <span class="font-weight-bold">{{$client->moradaResidencia}}</span>
                            @endif
                            <div></div>
                        </div>
                        <br>
                    </div>

                </div>


                <div class="row">
                    <div class="col">
                        {{-- Morada de residência no pais de origem --}}
                        <div class="mb-2">Morada de origem:</div>
                        <div class="border rounded bg-light p-3">
                            <div>Cidade (origem): <span class="font-weight-bold">{{$client->cidade}}</span></div><br>
                            <div>Morada (origem): <span class="font-weight-bold">{{$client->morada}}</span></div>
                        </div>
                    </div>
                    <br>
                </div>


                <br>

                {{-- Contactos dos PAIS --}}
                <div class="row">
                    <div class="col">
                        <div class="mb-2">Identificação dos pais:</div>
                    </div>
                </div>

                <div class="border rounded bg-light p-3">
                    <div class="row">
                        <div class="col " style="min-width: 300px">
                            <div>Nome do pai: <span class="font-weight-bold">{{$client->nomePai}}</span></div><br>
                            <div>Telefone do pai: <span class="font-weight-bold">{{$client->telefonePai}}</span></div>
                            <br>
                            <div>E-mail do pai: <span class="font-weight-bold">{{$client->emailPai}}</span></div>
                            <br>
                        </div>
                        <div class="col" style="min-width: 300px">
                            <div>Nome da mãe: <span class="font-weight-bold">{{$client->nomeMae}}</span></div><br>
                            <div>Telefone da mãe: <span class="font-weight-bold">{{$client->telefoneMae}}</span></div>
                            <br>
                            <div>E-mail da mãe: <span class="font-weight-bold">{{$client->emailMae}}</span></div>
                        </div>
                    </div>
                </div>

            </div>





            {{-- DADOS FINANCEIROS --}}
            <div class="tab-pane fade" id="adresses" role="tabpanel" aria-labelledby="adresses-tab" style="color: black;font-weight:normal !important">

                <div class="row mt-2 pl-2">
                    <div class="col">

                        <div class="mb-2">IBAN:</div>
                        <div class="border rounded bg-light p-3">
                            @if ($client->IBAN==null)
                            <span class="text-muted"><small>(sem dados para mostrar)</small></span>
                            @else
                            <span class="font-weight-bold">{{$client->IBAN}}</span>
                            @endif
                        </div>

                        <br>

                        <div class=" mb-2">Observações Financeiras:</div>
                        <div class="border rounded bg-light p-3">
                            @if ($client->obsFinanceiras==null)
                            <span class="text-muted"><small>(sem dados para mostrar)</small></span>
                            @else
                            <span class="font-weight-bold">{{$client->obsFinanceiras}}</span>
                            @endif
                        </div>


                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

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
<form class="form-group needs-validation" id="Form-Documento-Academico" action="{{route('documento-academico.createFromClient', $client)}}" method="post" id="form_fase" enctype="multipart/form-data" novalidate>
    @csrf

    <div class="modal fade" id="novoDocAcademico" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Novo Documento Pessoal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <br>

                    {{-- INPUT tipoDocumento --}}
                    <label for="NomeDocumentoAcademico" class="font-weight-bold">Nome do Documento:</label>
                    <input class="form-control" id="NomeDocumentoAcademico" style="width: 100%;" name="NomeDocumentoAcademico" required>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-success px-2"><i class="fas fa-plus mr-2 "></i>Adicionar
                        Documento</button>
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancelar</button>

                </div>
            </div>
        </div>
    </div>

</form>

@endsection

{{-- Scripts --}}
@section('scripts')
<script>
    $(document).ready(function() {
        bsCustomFileInput.init();
        $(".needs-validation").submit(function(event) {
            if (this.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
            } else {
                $("#cancelBtn").removeAttr("onclick");
                button =
                    "<button class='btn btn-primary' type='submit' disabled><span class='spinner-border spinner-border-sm' role='status' aria-hidden='true' style='position:relative; bottom:4px; right:3px;'></span>A enviar...</button>";
                $("#groupBtn").append(button);
                $("#submitbtn").remove();
            }
            $(".needs-validation").addClass("was-validated");
        });
    });
</script>
@endsection
