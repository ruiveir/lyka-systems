@extends('layout.master')

{{-- Page Title --}}
@section('title', 'Ficha de produto')

{{-- CSS Style Link --}}
@section('styleLinks')

@endsection



{{-- Page Content --}}
@section('content')

    <div class="container mt-2">
        {{-- Navegação --}}
        <div class="float-left">
            <a href="javascript:history.go(-1)" title="Voltar"><i
                    class="fas fa-arrow-left rounded-circle p-2 nav_btns mr-3"></i></a>
            <a href="javascript:window.history.forward();" title="Avançar"><i
                    class="fas fa-arrow-right rounded-circle p-2 nav_btns"></i></a>
        </div>
        <div class="float-right">
            @if((Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null)||
                (Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null &&
                (Auth()->user()->agente->tipo == "Agente" || Auth()->user()->agente->exepcao)))
                <a href="{{route('produtos.edit',$produto)}}" class="top-button mr-2">Editar Informação</a>
            @endif
            @if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null)
                <form method="POST" role="form" id="{{ $produto->idCliente }}" action="{{route('produtos.destroy',$produto)}}" class="d-inline-block form_produto_id">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="top-button mr-2" title="Eliminar Produto" data-toggle="modal" data-target="#deleteModal">Eliminar Produto</i></button>
                </form>
            @endif
            {{--<a href="{{route('produtos.print',$produto)}}" target="_blank" class="top-button">Imprimir</a>--}}
        </div>

        <br><br>

        <div class="cards-navigation">
            <div class="title">
                <h6>Ficha de produto</h6>
            </div>
            <br>



            <div class="row font-weight-bold border p-2 pt-3 pb-3" style="color:#6A74C9">

                <div class="col p-2">

                    <div><span class="text-secondary ">Tipo:</span> {{$produto->tipo}}</div><br>

                    <div><span class="text-secondary">Descrição:</span> {{$produto->descricao}}</div><br>

                    <div><span class="text-secondary ">Ano Académico: </span>{{$produto->anoAcademico}}</div><br>

                    <div><span class="text-secondary">Valor:</span> {{$produto->valorTotal.'€'}}</div>

                </div>

                <div class="col">
                    <div><span class="text-secondary">Cliente:
                        <a class="name_link" href="{{route('clients.show',$produto->cliente)}}">
                            {{$produto->cliente->nome.' '.$produto->cliente->apelido}}</span>
                        </a>
                    </div><br>

                    <div><span class="text-secondary">Universidade:
                        <a class="name_link" href="{{route('universities.show',$produto->universidade1)}}">
                            {{$produto->universidade1->nome}}</span>
                        </a>
                    </div><br>

                    @if($produto->idUniversidade2)
                        <div><span class="text-secondary">2ª Universidade:
                            <a class="name_link" href="{{route('universities.show',$produto->universidade2)}}">
                                {{$produto->universidade2->nome}}</span>
                            </a>
                        </div><br>
                    @endif

                    <div><span class="text-secondary">Agente:
                        <a class="name_link" href="{{route('agents.show',$produto->agente)}}">
                            {{$produto->agente->nome.' '.$produto->agente->apelido}}</span>
                        </a>
                    </div><br>

                    @if($produto->idSubAgente)
                        <div><span class="text-secondary">Sub-Agente:
                            <a class="name_link" href="{{route('agents.show',$produto->subAgente)}}">
                                {{$produto->subAgente->nome.' '.$produto->subAgente->apelido}}</span>
                            </a>
                        </div><br>
                    @endif

                    <div class="text-muted"><small>Adicionado: {{ date('d-M-y', strtotime($produto->created_at)) }}</small></div>

                    <div class="text-muted"><small>Ultima atualização: {{ date('d-M-y', strtotime($produto->updated_at)) }}</small></div>



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

                                <div><span class="text-secondary">Tipo:</span> {{$fase->descricao}}</div><br>

                                <div><span class="text-secondary">Data de vencimento:</span> {{date('d/m/Y', strtotime($fase->dataVencimento))}}</div><br>

                                <div><span class="text-secondary">Valor da fase:</span> {{$fase->valorFase.'€'}}</div><br>

                                <div><span><b>Responsabilidades</b></span></div><br>

                                <div><span class="text-secondary">PickPocket de cliente: </span>
                                    @if($responsabilidade->valorCliente)
                                        {{$responsabilidade->valorCliente.'€'}}
                                    @else
                                        {{'0.00€'}}
                                    @endif
                                </div><br>

                                @if($responsabilidade->valorCliente && $responsabilidade->valorCliente != 0)
                                    <div><span class="text-secondary"> - Estado:</span>
                                        @if($responsabilidade->verificacaoPagoCliente)
                                            <span class="text-success">Pago</span>
                                        @elseif(date("Y-m-d",strtotime($fase->dataVencimento))>=$Today)
                                            <span class="text-warning">Pendente</span>
                                        @else
                                            <span class="text-danger">Vencido</span>
                                        @endif
                                    </div><br>
                                @endif

                                <div><span class="text-secondary">Para agente: </span>
                                    @if($responsabilidade->valorAgente)
                                        {{$responsabilidade->valorAgente.'€'}}
                                    @else
                                        {{'0.00€'}}
                                    @endif
                                </div><br>

                                @if($responsabilidade->valorAgente && $responsabilidade->valorAgente != 0)
                                    <div><span class="text-secondary"> - Estado:</span>
                                        @if($responsabilidade->verificacaoPagoAgente)
                                        <span class="text-success">Pago</span>
                                        @elseif(date("Y-m-d",strtotime($fase->dataVencimento))>=$Today)
                                            <span class="text-warning">Pendente</span>
                                        @else
                                            <span class="text-danger">Vencido</span>
                                        @endif
                                    </div><br>
                                @endif

                                @if($responsabilidade->valorSubAgente)
                                    <div><span class="text-secondary">Para sub-agente: </span>
                                        @if($responsabilidade->valorSubAgente)
                                            {{$responsabilidade->valorSubAgente.'€'}}
                                        @else
                                            {{'0.00€'}}
                                        @endif
                                    </div><br>

                                    @if($responsabilidade->valorSubAgente && $responsabilidade->valorSubAgente != 0)
                                        <div><span class="text-secondary"> - Estado:</span>
                                            @if($responsabilidade->verificacaoPagoSubAgente)
                                            <span class="text-success">Pago</span>
                                            @elseif(date("Y-m-d",strtotime($fase->dataVencimento))>=$Today)
                                                <span class="text-warning">Pendente</span>
                                            @else
                                                <span class="text-danger">Vencido</span>
                                            @endif
                                        </div><br>
                                    @endif
                                @endif
                                <div><span class="text-secondary">Para universidade: </span>
                                    @if($responsabilidade->valorUniversidade1)
                                        {{$responsabilidade->valorUniversidade1.'€'}}
                                    @else
                                        {{'0.00€'}}
                                    @endif
                                </div><br>

                                @if($responsabilidade->valorUniversidade1 && $responsabilidade->valorUniversidade1 != 0)
                                    <div><span class="text-secondary"> - Estado:</span>
                                        @if($responsabilidade->verificacaoPagoUni1)
                                        <span class="text-success">Pago</span>
                                        @elseif(date("Y-m-d",strtotime($fase->dataVencimento))>=$Today)
                                            <span class="text-warning">Pendente</span>
                                        @else
                                            <span class="text-danger">Vencido</span>
                                        @endif
                                    </div><br>
                                @endif

                                @if($responsabilidade->valorUniversidade2)
                                    <div><span class="text-secondary">Para 2ª universidade: </span>
                                        @if($responsabilidade->valorUniversidade2)
                                            {{$responsabilidade->valorUniversidade2.'€'}}
                                        @else
                                            {{'0.00€'}}
                                        @endif
                                    </div><br>

                                    @if($responsabilidade->valorUniversidade2 && $responsabilidade->valorUniversidade2 != 0)
                                        <div><span class="text-secondary"> - Estado:</span>
                                            @if($responsabilidade->verificacaoPagoUni2)
                                            <span class="text-success">Pago</span>
                                            @elseif(date("Y-m-d",strtotime($fase->dataVencimento))>=$Today)
                                                <span class="text-warning">Pendente</span>
                                            @else
                                                <span class="text-danger">Vencido</span>
                                            @endif
                                        </div><br>
                                    @endif
                                @endif
                                @if($Relacoes)
                                    @foreach($Relacoes as $relacao)
                                        <div><span class="text-secondary">Fornecedor {{$relacao->fornecedor->nome}}: </span>
                                            @if($relacao->valor)
                                                {{$relacao->valor.'€'}}
                                            @else
                                                {{'0.00€'}}
                                            @endif
                                        </div><br>

                                        @if($relacao->valor && $relacao->valor != 0)
                                            <div><span class="text-secondary"> - Estado:</span>
                                                @if($relacao->verificacaoPago)
                                                <span class="text-success">Pago</span>
                                                @elseif(date("Y-m-d",strtotime($fase->dataVencimento))>=$Today)
                                                    <span class="text-warning">Pendente</span>
                                                @else
                                                    <span class="text-danger">Vencido</span>
                                                @endif
                                            </div><br>
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
                                            <div><span class="text-secondary">{{$documento->tipoDocumento}}: </span>
                                            @foreach($DocsPessoais as $docpessoal)
                                                @if($documento->tipoDocumento == $docpessoal->tipo && !$existe)
                                                    <a href="{{route('documento-pessoal.show',$docpessoal)}}" id="yui_3_17_2_1_1589215110643_49">
                                                        <img src="../../storage/default-photos/pdf.png" class="iconlarge activityicon" alt="" role="presentation" aria-hidden="true">
                                                        <span class="instancename">Abrir {{$docpessoal->tipo}}</span>
                                                    </a></div><br>
                                                    <div><span class="text-secondary"> - Estado:</span>
                                                        @if($docpessoal->verificacao)
                                                            <span class="text-success">Válido</span>
                                                        @else
                                                            <span class="text-danger">Inválido</span>
                                                        @endif
                                                    </div>
                                                    @if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && !$docpessoal->verificacao)
                                                        <div><br>
                                                            <a href="{{route('documento-pessoal.verify',$docpessoal)}}" class="top-button mr-2">Verificar {{$documento->tipoDocumento}}</a>
                                                        </div><br>
                                                    @else
                                                        <div><br>
                                                            <a href="{{route('documento-pessoal.edit',$docpessoal)}}" class="top-button mr-2">Editar {{$documento->tipoDocumento}}</a>
                                                        </div><br>
                                                    @endif
                                                    @php
                                                        $existe = true;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            @if(!$existe)
                                                @if(date("Y-m-d",strtotime($fase->dataVencimento))>=$Today)
                                                    <span class="text-warning">Pendente</span></div><br>
                                                @else
                                                    <span class="text-danger">Em falta</span></div><br>
                                                @endif
                                                <div><br>
                                                    <a href="{{route('documento-pessoal.create',[$fase,$documento])}}" class="top-button mr-2">Adicionar {{$documento->tipoDocumento}}</a>
                                                </div><br>
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
                                                <div><span class="text-secondary">{{$documento->tipoDocumento}}: <span class="text-warning">Pendente</span></span></div><br>
                                            @else
                                                <div><span class="text-secondary">{{$documento->tipoDocumento}}: <span class="text-danger">Em falta</span></span></div><br>
                                            @endif
                                            <div>
                                                <a href="{{route('documento-pessoal.create',[$fase,$documento])}}" class="top-button mr-2">Adicionar {{$documento->tipoDocumento}}</a>
                                            </div><br>
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
                                            <div><span class="text-secondary">{{$documento->tipoDocumento}}: </span>
                                            @foreach($DocsAcademicos as $docacademico)
                                                @if($documento->tipoDocumento == $docacademico->tipo && !$existe)
                                                    <a class="" href="{{route('documento-academico.show',$docacademico)}}" id="yui_3_17_2_1_1589215110643_49">
                                                        <img src="../../storage/default-photos/pdf.png" class="iconlarge activityicon" alt="" role="presentation" aria-hidden="true">
                                                        <span class="instancename">Abrir {{$docacademico->tipo}}</span>
                                                    </a></div><br>
                                                    <div><span class="text-secondary"> - Estado:</span>
                                                        @if($docacademico->verificacao)
                                                            <span class="text-success">Válido</span>
                                                        @else
                                                            <span class="text-danger">Inválido</span>
                                                        @endif
                                                    </div>
                                                    @if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && !$docacademico->verificacao)
                                                        <div><br>
                                                            <a href="{{route('documento-academico.verify',$docacademico)}}" class="top-button mr-2">Verificar {{$documento->tipoDocumento}}</a>
                                                        </div><br>
                                                    @else
                                                        <div><br>
                                                            <a href="{{route('documento-academico.edit',$docacademico)}}" class="top-button mr-2">Editar {{$documento->tipoDocumento}}</a>
                                                        </div><br>
                                                    @endif
                                                    @php
                                                        $existe = true;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            @if(!$existe)
                                                @if(date("Y-m-d",strtotime($fase->dataVencimento))>=$Today)
                                                    <span class="text-warning">Pendente</span></div><br>
                                                @else
                                                    <span class="text-danger">Em falta</span></div><br>
                                                @endif
                                                <div><br>
                                                    <a href="{{route('documento-academico.create',[$fase,$documento])}}" class="top-button mr-2">Adicionar {{$documento->tipoDocumento}}</a>
                                                </div>
                                            @endif
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
                                                <div><span class="text-secondary">{{$documento->tipoDocumento}}: <span class="text-warning">Pendente</span></span></div><br>
                                            @else
                                                <div><span class="text-secondary">{{$documento->tipoDocumento}}: <span class="text-danger">Em falta</span></span></div><br>
                                            @endif
                                            <div>
                                                <a href="{{route('documento-academico.create',[$fase,$documento])}}" class="top-button mr-2">Adicionar {{$documento->tipoDocumento}}</a>
                                            </div><br>
                                        @endif
                                    @endforeach
                                @endif


                                <br><div><span><b>Documentos Transações</b></span></div><br>
                                @if($DocsTransacao->toArray())
                                    @foreach($DocsTransacao as $documento)
                                        <div>
                                            <span class="text-secondary">{{$documento->descricao}}:</span>
                                            <a class="" href="#" id="yui_3_17_2_1_1589215110643_49">
                                                <img src="../../storage/default-photos/pdf.png" class="iconlarge activityicon" alt="" role="presentation" aria-hidden="true">
                                                <span class="instancename">Abrir Transação</span>
                                            </a>
                                        </div><br>
                                        <div><span class="text-secondary"> - Valor Recebido: </span>
                                            @if($documento->valorRecebido)
                                                {{$documento->valorRecebido.'€'}}
                                            @else
                                                {{'0.00€'}}
                                            @endif
                                        </div><br>
                                        <div><span class="text-secondary"> - Estado:</span>
                                            @if($documento->verificacao)
                                                <span class="text-success">Recebido</span>
                                            @elseif(date("Y-m-d",strtotime($fase->dataVencimento))>=$Today)
                                                <span class="text-warning">Pendente</span>
                                            @else
                                                <span class="text-danger">Não Recebido</span>
                                            @endif
                                        </div>
                                        @php
                                            $existe = true;
                                        @endphp
                                    @endforeach
                                @else
                                    <div><span class="text-secondary">Sem documentos de transação </span> </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection

{{-- Scripts --}}
@section('scripts')
    {{-- <script src="{{asset('/js/NOME_DO_FICHEIR.js')}}"></script> --}}
@endsection
