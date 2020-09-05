@extends('layout.master')

{{-- Page Title --}}
@section('title', 'Ficha de produto')

{{-- CSS Style Link --}}
@section('styleLinks')

@endsection



{{-- Page Content --}}
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800">Visualização do produto</h1>
        <div>
            @if((Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null)||
                (Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null &&
                (Auth()->user()->agente->tipo == "Agente" || Auth()->user()->agente->exepcao)))
            <a href="{{route('produtos.edit',$produto)}}" class="btn btn-success btn-icon-split btn-sm" title="Editar">
                <span class="icon text-white-50">
                    <i class="fas fa-pencil-alt"></i>
                </span>
                <span class="text">Editar produto</span>
            </a>
            @endif
            @if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null)
                <form method="POST" role="form" id="{{ $produto->idCliente }}" action="{{route('produtos.destroy',$produto)}}" class="d-inline-block form_produto_id">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-icon-split btn-sm" title="Eliminar Produto" data-toggle="modal" data-target="#deleteModal">
                        <span class="icon text-white-50">
                            <i class="fas fa-trash-alt"></i>
                        </span>
                        <span class="text">Eliminar Produto</span>
                        
                    </button>
                </form>
            @endif
        </div>
    </div>
    <!-- Approach -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Visualização do produto do cliente {{$produto->cliente->nome.' '.$produto->cliente->apelido}}</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p class="text-gray-800"><b>Tipo: </b>{{$produto->tipo}}</p>
                </div>
                <div class="col-md-6">
                    <p class="text-gray-800"><b>Cliente: </b>
                        <a class="name_link" href="{{route('clients.show',$produto->cliente)}}">
                            {{$produto->cliente->nome.' '.$produto->cliente->apelido}}</span>
                        </a>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <p class="text-gray-800"><b>Descrição: </b>{{$produto->descricao}}</p>
                </div>
                <div class="col-md-6">
                    <p class="text-gray-800"><b>Universidade: </b>
                        <a class="name_link" href="{{route('universities.show',$produto->universidade1)}}">
                            {{$produto->universidade1->nome}}</span>
                        </a>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <p class="text-gray-800"><b>Ano Académico: </b> @if($produto->anoAcademico != null) {{$produto->anoAcademico}} @else N/A @endif</p>
                </div>
                <div class="col-md-6">
                    <p class="text-gray-800"><b>Agente: </b> 
                        <a class="name_link" href="{{route('agents.show',$produto->agente)}}">
                            {{$produto->agente->nome.' '.$produto->agente->apelido}}</span>
                        </a>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    @if($produto->idUniversidade2)
                        <p class="text-gray-800"><b>2ª Universidade: </b> 
                            <a class="name_link" href="{{route('universities.show',$produto->universidade2)}}">
                                {{$produto->universidade2->nome}}</span>
                            </a>
                        </p>
                    @endif
                </div>
                <div class="col-md-6">
                    @if($produto->idSubAgente)
                        <p class="text-gray-800"><b>Sub-Agente: </b> 
                            <a class="name_link" href="{{route('agents.show',$produto->subAgente)}}">
                                {{$produto->subAgente->nome.' '.$produto->subAgente->apelido}}</span>
                            </a>
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <p class="text-gray-800"><b>Valor: </b> @if($produto->valorTotal != null) {{$produto->valorTotal.'€'}} @else 0€ @endif</p>
                </div>
                <div class="col-md-6">
                    <p class="text-gray-800"><b>Data de registo: </b> {{date('d/m/Y', strtotime($produto->created_at))}}</p>
                    <p class="text-gray-800"><b>Última atualização: </b> @if($produto->updated_at != null) {{date('d/m/Y', strtotime($produto->updated_at))}} @else N/A @endif</p>
                </div>
            </div>

            <ul class="nav nav-tabs mt-5 mb-4" id="myTab" role="tablist">
                @php
                    $numfase = 1;
                @endphp
                @foreach($Fases as $fase)
                    <li class="nav-item " style="width:25%">
                        @if($numfase == 1)
                            <a class="nav-link active" id="{{'fase'.$numfase.'-tab'}}" data-toggle="tab" href="#{{'fase'.$numfase}}" role="tab"
                            aria-controls="{{'fase'.$numfase}}" aria-selected="false">{{'Fase '.$numfase}}</a>
                        @else
                            <a class="nav-link" id="{{'fase'.$numfase.'-tab'}}" data-toggle="tab" href="#{{'fase'.$numfase}}" role="tab"
                            aria-controls="{{'fase'.$numfase}}" aria-selected="false">{{'Fase '.$numfase}}</a>
                        @endif
                    </li>
                    @php
                        $numfase++;
                    @endphp
                @endforeach
            </ul>

            <div class="tab-content p-2 " id="myTabContent">
                @php
                    $numfase = 0;
                @endphp
                @foreach($Fases as $fase)
                    @php
                        $numfase++;
                        $Relacoes = $fase->responsabilidade->relacao;
                        $DocsAcademicos = $fase->docAcademico;
                        $DocsPessoais = $fase->docPessoal;
                        $DocsTransacao = $fase->docTransacao;
                        $DocsNecessarios = $fase->docNecessario;
                        $responsabilidade = $fase->responsabilidade;
                    @endphp
                    @if($numfase == 1)
                        <div class="tab-pane fade active show" id="{{'fase'.$numfase}}" role="tabpanel" aria-labelledby="{{'fase'.$numfase.'-tab'}}">
                    @else
                        <div class="tab-pane fade" id="{{'fase'.$numfase}}" role="tabpanel" aria-labelledby="{{'fase'.$numfase.'-tab'}}">
                    @endif

                    <div class="row">
                        <div class="col">
                            <div><span><b>Info</b></span></div><br>

                            <div><p class="text-gray-800"><b>Tipo: </b>{{$fase->descricao}}</p></div>

                            <div><p class="text-gray-800"><b>Data de vencimento:</b> {{date('d/m/Y', strtotime($fase->dataVencimento))}}</p></div>

                            <div><p class="text-gray-800"><b>Valor da fase:</b> {{$fase->valorFase.'€'}}</p></div>

                            <br><div><span><b>Responsabilidades</b></span></div><br>

                            <div>
                                <p class="text-gray-800"><b>PickPocket de cliente: </b>
                                    @if($responsabilidade->valorCliente)
                                        {{$responsabilidade->valorCliente.'€'}}
                                    @else
                                        {{'0.00€'}}
                                    @endif
                                </p>
                            </div>

                            @if($responsabilidade->valorCliente && $responsabilidade->valorCliente != 0)
                                <div>
                                    <p class="text-gray-800"><b> - Estado:</b>
                                        @if($responsabilidade->verificacaoPagoCliente)
                                            <span class="text-success">Pago</span>
                                        @elseif(date("Y-m-d",strtotime($fase->dataVencimento))>=$Today)
                                            <span class="text-warning">Pendente</span>
                                        @else
                                            <span class="text-danger">Vencido</span>
                                        @endif
                                    </p>
                                </div>
                            @endif

                            <div>
                                <p class="text-gray-800"><b>Para agente: </b>
                                    @if($responsabilidade->valorAgente)
                                        {{$responsabilidade->valorAgente.'€'}}
                                    @else
                                        {{'0.00€'}}
                                    @endif
                                </p>
                            </div>

                            @if($responsabilidade->valorAgente && $responsabilidade->valorAgente != 0)
                                <div>
                                    <p class="text-gray-800"><b> - Estado:</b>
                                        @if($responsabilidade->verificacaoPagoAgente)
                                        <span class="text-success">Pago</span>
                                        @elseif(date("Y-m-d",strtotime($fase->dataVencimento))>=$Today)
                                            <span class="text-warning">Pendente</span>
                                        @else
                                            <span class="text-danger">Vencido</span>
                                        @endif
                                    </p>
                                </div>
                            @endif

                            @if($responsabilidade->valorSubAgente)
                                <div>
                                    <p class="text-gray-800"><b>Para sub-agente: </b>
                                        @if($responsabilidade->valorSubAgente)
                                            {{$responsabilidade->valorSubAgente.'€'}}
                                        @else
                                            {{'0.00€'}}
                                        @endif
                                    <p>
                                </div>

                                @if($responsabilidade->valorSubAgente && $responsabilidade->valorSubAgente != 0)
                                    <div>
                                        <p class="text-gray-800"><b> - Estado:</b>
                                            @if($responsabilidade->verificacaoPagoSubAgente)
                                            <span class="text-success">Pago</span>
                                            @elseif(date("Y-m-d",strtotime($fase->dataVencimento))>=$Today)
                                                <span class="text-warning">Pendente</span>
                                            @else
                                                <span class="text-danger">Vencido</span>
                                            @endif
                                        </p>
                                    </div>
                                @endif
                            @endif

                            <div>
                                <p class="text-gray-800"><b>Para universidade: </b>
                                    @if($responsabilidade->valorUniversidade1)
                                        {{$responsabilidade->valorUniversidade1.'€'}}
                                    @else
                                        {{'0.00€'}}
                                    @endif
                                </p>
                            </div>

                            @if($responsabilidade->valorUniversidade1 && $responsabilidade->valorUniversidade1 != 0)
                                <div>
                                    <p class="text-gray-800"><b> - Estado:</b>
                                        @if($responsabilidade->verificacaoPagoUni1)
                                            <span class="text-success">Pago</span>
                                        @elseif(date("Y-m-d",strtotime($fase->dataVencimento))>=$Today)
                                            <span class="text-warning">Pendente</span>
                                        @else
                                            <span class="text-danger">Vencido</span>
                                        @endif
                                    </p>
                                </div>
                            @endif

                            @if($responsabilidade->valorUniversidade2)
                                <div>
                                    <p class="text-gray-800"><b>Para 2ª universidade: </b>
                                        @if($responsabilidade->valorUniversidade2)
                                            {{$responsabilidade->valorUniversidade2.'€'}}
                                        @else
                                            {{'0.00€'}}
                                        @endif
                                    </p>
                                </div>

                                @if($responsabilidade->valorUniversidade2 && $responsabilidade->valorUniversidade2 != 0)
                                    <div>
                                        <p class="text-gray-800"><b> - Estado:</b>
                                            @if($responsabilidade->verificacaoPagoUni2)
                                            <span class="text-success">Pago</span>
                                            @elseif(date("Y-m-d",strtotime($fase->dataVencimento))>=$Today)
                                                <span class="text-warning">Pendente</span>
                                            @else
                                                <span class="text-danger">Vencido</span>
                                            @endif
                                        </p>
                                    </div>
                                @endif
                            @endif
                            @if($Relacoes)
                                @foreach($Relacoes as $relacao)
                                    <div>
                                        <p class="text-gray-800"><b>Fornecedor {{$relacao->fornecedor->nome}}: </b>
                                            @if($relacao->valor)
                                                {{$relacao->valor.'€'}}
                                            @else
                                                {{'0.00€'}}
                                            @endif
                                        </p>
                                    </div>

                                    @if($relacao->valor && $relacao->valor != 0)
                                        <div>
                                            <p class="text-gray-800"><b> - Estado:</b>
                                                @if($relacao->verificacaoPago)
                                                <span class="text-success">Pago</span>
                                                @elseif(date("Y-m-d",strtotime($fase->dataVencimento))>=$Today)
                                                    <span class="text-warning">Pendente</span>
                                                @else
                                                    <span class="text-danger">Vencido</span>
                                                @endif
                                            </p>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        </div>

                        <div class="col">
                            @if($DocsPessoais->toArray())
                                <div><span><b>Documentos Pessoais</b></span></div><br>
                                @foreach($DocsNecessarios as $documento)
                                    @if($documento->tipo == 'Pessoal')
                                        @php
                                            $existe = false;
                                        @endphp
                                        <div><p class="text-gray-800"><b>{{$documento->tipoDocumento}}: </b>
                                        @foreach($DocsPessoais as $docpessoal)
                                            @if($documento->tipoDocumento == $docpessoal->tipo && !$existe)
                                                <a href="{{route('documento-pessoal.show',$docpessoal)}}" id="yui_3_17_2_1_1589215110643_49">
                                                    <img src="../../storage/default-photos/pdf.png" class="iconlarge activityicon" alt="" role="presentation" aria-hidden="true">
                                                    <span class="instancename">Abrir {{$docpessoal->tipo}}</span>
                                                </a></p></div>
                                                <div>
                                                    <p class="text-gray-800"><b> - Estado:</b>
                                                        @if($docpessoal->verificacao)
                                                            <span class="text-success">Válido</span>
                                                        @else
                                                            <span class="text-danger">Inválido</span>
                                                        @endif
                                                    </p>
                                                </div>
                                                @if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && !$docpessoal->verificacao)
                                                    <div>
                                                        <p class="text-gray-800">
                                                            <a href="{{route('documento-pessoal.verify',$docpessoal)}}" class="top-button mr-2">Verificar {{$documento->tipoDocumento}}</a>
                                                        </p>
                                                    </div>
                                                @else
                                                    <div>
                                                        <p class="text-gray-800">
                                                            <a href="{{route('documento-pessoal.edit',$docpessoal)}}" class="top-button mr-2">Editar {{$documento->tipoDocumento}}</a>
                                                        </p>
                                                    </div>
                                                @endif
                                                @php
                                                    $existe = true;
                                                @endphp
                                            @endif
                                        @endforeach
                                        @if(!$existe)
                                            @if(date("Y-m-d",strtotime($fase->dataVencimento))>=$Today)
                                                <span class="text-warning">Pendente</span></p></div>
                                            @else
                                                <span class="text-danger">Em falta</span></p></div>
                                            @endif
                                            <div>
                                                <p class="text-gray-800">
                                                    <a href="{{route('documento-pessoal.create',[$fase,$documento])}}" class="top-button mr-2">Adicionar {{$documento->tipoDocumento}}</a>
                                                </p>
                                            </div>
                                        @endif
                                    @endif
                                @endforeach
                            @else
                                @php
                                    $num = 0;
                                @endphp
                                @foreach($DocsNecessarios as $documento)
                                    @if($documento->tipo == 'Pessoal')
                                        @if($num==0)
                                            <div><span><b>Documentos Pessoais</b></span></div><br>
                                        @endif
                                        @php
                                            $num++;
                                        @endphp
                                        @if(date("Y-m-d",strtotime($fase->dataVencimento))>=$Today)
                                            <div><p class="text-gray-800"><b>{{$documento->tipoDocumento}}:</b> <span class="text-warning">Pendente</span></p></div><br>
                                        @else
                                            <div><p class="text-gray-800"><b>{{$documento->tipoDocumento}}:</b> <span class="text-danger">Em falta</span></p></div><br>
                                        @endif
                                        <div>
                                            <p class="text-gray-800">
                                                <a href="{{route('documento-pessoal.create',[$fase,$documento])}}" class="top-button mr-2">Adicionar {{$documento->tipoDocumento}}</a>
                                            </p>
                                        </div>
                                    @endif
                                @endforeach
                            @endif


                            @if($DocsAcademicos->toArray())
                                <br><div><span><b>Documentos Académicos</b></span></div><br>
                                @foreach($DocsNecessarios as $documento)
                                    @if($documento->tipo == 'Academico')
                                        @php
                                            $existe = false;
                                        @endphp
                                        <div>
                                            <p class="text-gray-800"><b>{{$documento->tipoDocumento}}: </b>
                                                @foreach($DocsAcademicos as $docacademico)
                                                    @if($documento->tipoDocumento == $docacademico->tipo && !$existe)
                                                        <a class="" href="{{route('documento-academico.show',$docacademico)}}" id="yui_3_17_2_1_1589215110643_49">
                                                            <img src="../../storage/default-photos/pdf.png" class="iconlarge activityicon" alt="" role="presentation" aria-hidden="true">
                                                            <span class="instancename">Abrir {{$docacademico->tipo}}</span>
                                                        </a></p></div>
                                                        <div>
                                                            <p class="text-gray-800"><b> - Estado:</b>
                                                                @if($docacademico->verificacao)
                                                                    <span class="text-success">Válido</span>
                                                                @else
                                                                    <span class="text-danger">Inválido</span>
                                                                @endif
                                                            </p>
                                                        </div>
                                                        @if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && !$docacademico->verificacao)
                                                            <div>
                                                                <p class="text-gray-800">
                                                                    <a href="{{route('documento-academico.verify',$docacademico)}}" class="top-button mr-2">Verificar {{$documento->tipoDocumento}}</a>
                                                                </p>
                                                            </div>
                                                        @else
                                                            <div>
                                                                <p class="text-gray-800">
                                                                    <a href="{{route('documento-academico.edit',$docacademico)}}" class="top-button mr-2">Editar {{$documento->tipoDocumento}}</a>
                                                                </p>
                                                            </div>
                                                        @endif
                                                        @php
                                                            $existe = true;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                @if(!$existe)
                                                    @if(date("Y-m-d",strtotime($fase->dataVencimento))>=$Today)
                                                        <span class="text-warning">Pendente</span></p></div>
                                                    @else
                                                        <span class="text-danger">Em falta</span></p></div>
                                                    @endif
                                                    <div>
                                                        <p class="text-gray-800">
                                                            <a href="{{route('documento-academico.create',[$fase,$documento])}}" class="top-button mr-2">Adicionar {{$documento->tipoDocumento}}</a>
                                                        </p>
                                                    </div>
                                                @endif
                                            </p>
                                    @endif
                                @endforeach
                            @else
                                @php
                                    $num = 0;
                                @endphp
                                @foreach($DocsNecessarios as $documento)
                                    @if($documento->tipo == 'Academico')
                                        @if($num==0)
                                            <br><div><span><b>Documentos Académicos</b></span></div><br>
                                            @php
                                                $num++;
                                            @endphp
                                        @endif
                                        @if(date("Y-m-d",strtotime($fase->dataVencimento))>=$Today)
                                            <div><p class="text-gray-800"><b>{{$documento->tipoDocumento}}: </b><span class="text-warning">Pendente</span></p></div>
                                        @else
                                            <div><p class="text-gray-800"><b>{{$documento->tipoDocumento}}: </b><span class="text-danger">Em falta</span></p></div>
                                        @endif
                                        <div>
                                            <p class="text-gray-800">
                                                <a href="{{route('documento-academico.create',[$fase,$documento])}}" class="top-button mr-2">Adicionar {{$documento->tipoDocumento}}</a>
                                            </p>
                                        </div>
                                    @endif
                                @endforeach
                            @endif


                            <br><div><span><b>Documentos Transações</b></span></div><br>
                            @if($DocsTransacao->toArray())
                                @foreach($DocsTransacao as $documento)
                                    <div>
                                        <p class="text-gray-800"><b>{{$documento->descricao}}:</b>
                                            <a class="" href="{{route('charges.show',[$produto,$fase,$documento])}}" id="yui_3_17_2_1_1589215110643_49">
                                                <img src="../../storage/default-photos/pdf.png" class="iconlarge activityicon" alt="" role="presentation" aria-hidden="true">
                                                <span class="instancename">Abrir Transação</span>
                                            </a>
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-gray-800"><b> - Valor Recebido: </b>
                                            @if($documento->valorRecebido)
                                                {{$documento->valorRecebido.'€'}}
                                            @else
                                                {{'0.00€'}}
                                            @endif
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-gray-800"><b> - Estado: </b>
                                            @if($documento->verificacao)
                                                <span class="text-success">Recebido</span>
                                            @elseif(date("Y-m-d",strtotime($fase->dataVencimento))>=$Today)
                                                <span class="text-warning">Pendente</span>
                                            @else
                                                <span class="text-danger">Não Recebido</span>
                                            @endif
                                        </p>
                                    </div>
                                    @php
                                        $existe = true;
                                    @endphp
                                @endforeach
                            @else
                                <div><p class="text-gray-800">Sem documentos de transação </p> </div>
                            @endif
                        </div>
                    </div>

                    @if($numfase == 1)
                        </div>
                    @else
                        </div>
                    @endif
                @endforeach
            </div>
            <hr>
        </div>
    </div>
</div>
<!-- End of container-fluid -->
@endsection

{{-- Scripts --}}
@section('scripts')
    {{-- <script src="{{asset('/js/NOME_DO_FICHEIR.js')}}"></script> --}}
@endsection
