@extends('layout.master')

{{-- Titulo da Página --}}
@section('title', 'Lista de pagamentos')

{{-- Estilos de CSS --}}
@section('styleLinks')
<link href="{{asset('/css/datatables_general.css')}}" rel="stylesheet">
<link href="{{asset('/css/payment.css')}}" rel="stylesheet">
@endsection

{{-- Conteudo da Página --}}
@section('content')

<div class="container mt-2 ">

    {{-- Navegação --}}
    <div class="float-left buttons">
        <a href="javascript:history.go(-1)" title="Voltar">
            <ion-icon name="arrow-back-outline" class="button-back"></ion-icon>
        </a>
        <a href="javascript:window.history.forward();" title="Avançar">
            <ion-icon name="arrow-forward-outline" class="button-foward"></ion-icon>
        </a>
    </div>

    <br><br>

    <div class="cards-navigation">
        <div class="title row">
            <div class="col-md-6">
                <h6>Listagem de pagamentos gerais</h6>
            </div>
            <div class="col-md-6" style="bottom:5px; height:32px;">
                <div class="input-group pl-0 float-right search-section" style="width:250px">
                    <input class="shadow-sm" type="text" id="customSearchBox" placeholder="Secção de procura" aria-label="Procurar">
                    <div class="search-button input-group-append">
                        <ion-icon name="search-outline" class="search-icon"></ion-icon>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row cards-group mt-3">
            <div class="col-md-4">
                <div class="card-navigation">
                    <div class="help-button" id="tooltipClient" data-toggle="tooltip" data-placement="top" title="O número apresentado neste cartão representa o número total de fases pendentes registados no sistema.">
                        <span>
                            ?
                        </span>
                    </div>
                    <div class="info">
                        <p class="number">{{$valorTotalPendente}}</p>
                        <p class="word">pagamentos pendentes</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-navigation">
                    <div class="help-button" id="tooltipUni" data-toggle="tooltip" data-placement="top" title="O número apresentado neste cartão representa o número total de fases pagas registadas no sistema.">
                        <span>
                            ?
                        </span>
                    </div>
                    <div class="info">
                        <p class="number" style="color:#47BC00;">{{$valorTotalPago}}</p>
                        <p class="word">pagamentos efectuados</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-navigation">
                    <div class="help-button" id="tooltipAgent" data-toggle="tooltip" data-placement="top" title="O número apresentado neste cartão representa o número de fases em dívida registados no sistema.">
                        <span>
                            ?
                        </span>
                    </div>
                    <div class="info">
                        <p class="number" style="color:#FF3D00;">{{$valorTotalDivida}}</p>
                        <p class="word">pagamentos em dívida</p>
                    </div>
                </div>
            </div>
        </div>
        <br>

        @if (count($responsabilidades))
        <div class="container">
            <div class="row">
                <div class="col">
                    <div id="filter-icon-div" class="ml-auto" onclick="showCloseIcon()" data-toggle="collapse" href="#search-collapse" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <ion-icon id="icon-funnel" name="funnel" title="Filtragem"></ion-icon>
                    </div>
                    <div id="close-icon-div" class="ml-auto" onclick="showFunnelIcon()" data-toggle="collapse" href="#search-collapse" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <ion-icon id="icon-close" name="close" title="Fechar filtragem"></ion-icon>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="filters-div collapse" id="search-collapse">
                        <div class="payment-card shadow-sm">
                            <div id="div-options">
                                <div class="row">
                                    <p>Secção de filtragem &nbsp;</p>
                                    <div class="help-button" id="tooltipValor" data-toggle="tooltip" data-placement="top"
                                        title="Nesta secção pode filtrar as suas pesquisas mediante a sua vontade e necessidade. Apenas pode fazer a pesquisa usando um elemento e a escolha de um intervalo de datas.">
                                        <span>
                                            ?
                                        </span>
                                    </div>
                                </div>
                                <br>
                                <form method="post" id="search-form">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="estudante">Estudantes</label>
                                            <br>
                                            <select name="estudante" id="estudantes" onchange="selected()">
                                                <option selected disabled hidden class="text-truncate" value="default">Selecionar estudante</option>
                                                <option class="text-truncate" value="todos">(Todos)</option>
                                                @foreach ($estudantes as $estudante)
                                                <option class="text-truncate" value="{{$estudante->idCliente}}">{{$estudante->nome.' '.$estudante->apelido}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="agente">Agentes</label>
                                            <br>
                                            <select name="agente" id="agentes" onchange="selected()">
                                                <option selected disabled hidden class="text-truncate" value="default">Selecionar agente</option>
                                                <option class="text-truncate" value="todos">(Todos)</option>
                                                @foreach ($agentes as $agente)
                                                <option class="text-truncate" value="{{$agente->idAgente}}">{{$agente->nome.' '.$agente->apelido}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="agente">SubAgentes</label>
                                            <br>
                                            <select name="subagente" id="subagentes" onchange="selected()">
                                                <option selected disabled hidden class="text-truncate" value="default">Selecionar subagente</option>
                                                <option class="text-truncate" value="todos">(Todos)</option>
                                                @foreach ($subagentes as $subagente)
                                                <option class="text-truncate" value="{{$subagente->idAgente}}">{{$subagente->nome.' '.$subagente->apelido}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <br><br>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="universidade">Universidade principal</label>
                                            <br>
                                            <select name="universidade" id="universidades" onchange="selected()" class="text-truncate">
                                                <option selected disabled hidden class="text-truncate" value="default">Selecionar universidade</option>
                                                <option class="text-truncate" value="todos">(Todas)</option>
                                                @foreach ($universidades as $universidade)
                                                <option class="text-truncate" value="{{$universidade->idUniversidade}}">{{$universidade->nome}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="universidade">Universidade secundária</label>
                                            <br>
                                            <select name="universidadesec" id="universidadesec" onchange="selected()">
                                                <option selected disabled hidden class="text-truncate" value="default">Selecionar universidade</option>
                                                <option class="text-truncate" value="todos">(Todas)</option>
                                                @foreach ($universidades as $universidade)
                                                <option class="text-truncate" value="{{$universidade->idUniversidade}}">{{$universidade->nome}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="fornecedor">Fornecedores</label>
                                            <br>
                                            <select name="fornecedor" id="fornecedores" onchange="selected()" class="text-truncate">
                                                <option selected disabled hidden class="text-truncate" value="default">Selecionar fornecedor</option>
                                                <option class="text-truncate" value="todos">(Todos)</option>
                                                @foreach ($fornecedores as $fornecedor)
                                                <option class="text-truncate" value="{{$fornecedor->idFornecedor}}">{{$fornecedor->nome}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <br><br>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="dataInicio">De (Data de início)</label>
                                            <br>
                                            <input id="dataInicio" type="date" name="dataInicio">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="dataFim">Até (Data de fim)</label>
                                            <br>
                                            <input id="dataFim" type="date" name="dataFim">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row mt-3">
                                        <div class="col text-right">
                                            <button class="mr-2" id="cleanButton">limpar</button>
                                            <button type="submit" name="button" id="searchButton">filtrar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="container" id="append-payment">
            <div class="payments">
                @if (count($responsabilidades))
                @foreach ($responsabilidades as $responsabilidade)
                {{-- Pagamentos aos CLIENTES --}}
                @if ($responsabilidade->valorCliente != null)
                <a href="{{route('payments.cliente', [$responsabilidade->cliente, $responsabilidade->fase, $responsabilidade])}}">
                    <div class="row charge-div">
                        <div class="col-md-1 align-self-center">
                            <div class="white-circle">
                                <img src="{{Storage::disk('public')->url('default-photos/M.jpg')}}" width="100%" class="mx-auto">
                            </div>
                        </div>
                        <div class="col-md-3 text-truncate align-self-center ml-4">
                            <p class="text-truncate" title="{{$responsabilidade->cliente->nome.' '.$responsabilidade->cliente->apelido}}">{{$responsabilidade->cliente->nome.' '.$responsabilidade->cliente->apelido}}</p>
                        </div>
                        <div class="col-md-2 text-truncate align-self-center">
                            <p class="text-truncate">{{number_format((float) $responsabilidade->valorCliente, 2, ',', '').'€'}}</p>
                        </div>
                        <div class="col-md-2 align-self-center ml-4">
                            <p class="text-truncate" title="{{date('d/m/Y', strtotime($responsabilidade->dataVencimentoCliente))}}">{{date('d/m/Y', strtotime($responsabilidade->dataVencimentoCliente))}}</p>
                        </div>
                        <div class="col-md-2 text-truncate align-self-center ml-auto">
                            <p class="text-truncate" @if($responsabilidade->verificacaoPagoCliente == true) style="color:#47BC00;" @elseif($responsabilidade->verificacaoPagoCliente == false &&
                                    $responsabilidade->dataVencimentoCliente < $currentdate) style="color:#FF3D00;" @endif>
                                        @if ($responsabilidade->verificacaoPagoCliente == false && $responsabilidade->dataVencimentoCliente
                                        < $currentdate) Dívida @elseif ($responsabilidade->verificacaoPagoCliente == false && $responsabilidade->dataVencimentoCliente > $currentdate)
                                        Pendente
                                        @elseif ($responsabilidade->verificacaoPagoCliente == true)
                                        Pago
                                        @endif
                            </p>
                        </div>
                    </div>
                </a>
                @endif

                {{-- Pagamentos aos AGENTES --}}
                @if ($responsabilidade->valorAgente != null)
                <a href="{{route('payments.agente', [$responsabilidade->agente, $responsabilidade->fase, $responsabilidade])}}">
                    <div class="row charge-div">
                        <div class="col-md-1 align-self-center">
                            <div class="white-circle">
                                <img src="{{Storage::disk('public')->url('default-photos/M.jpg')}}" width="100%" class="mx-auto">
                            </div>
                        </div>
                        <div class="col-md-3 text-truncate align-self-center ml-4">
                            <p class="text-truncate" title="{{$responsabilidade->agente->nome.' '.$responsabilidade->agente->apelido}}">{{$responsabilidade->agente->nome.' '.$responsabilidade->agente->apelido}}</p>
                        </div>
                        <div class="col-md-2 text-truncate align-self-center">
                            <p class="text-truncate">{{number_format((float) $responsabilidade->valorAgente, 2, ',', '').'€'}}</p>
                        </div>
                        <div class="col-md-2 align-self-center ml-4">
                            <p class="text-truncate" title="{{date('d/m/Y', strtotime($responsabilidade->dataVencimentoAgente))}}">{{date('d/m/Y', strtotime($responsabilidade->dataVencimentoAgente))}}</p>
                        </div>
                        <div class="col-md-2 text-truncate align-self-center ml-auto">
                            <p class="text-truncate" @if($responsabilidade->verificacaoPagoAgente == true) style="color:#47BC00;" @elseif($responsabilidade->verificacaoPagoAgente == false && $responsabilidade->dataVencimentoAgente <
                                        $currentdate) style="color:#FF3D00;" @endif>
                                        @if ($responsabilidade->verificacaoPagoAgente == false && $responsabilidade->dataVencimentoAgente
                                        < $currentdate) Dívida @elseif ($responsabilidade->verificacaoPagoAgente == false && $responsabilidade->dataVencimentoAgente > $currentdate)
                                        Pendente
                                        @elseif ($responsabilidade->verificacaoPagoAgente == true)
                                        Pago
                                        @endif
                            </p>
                        </div>
                    </div>
                </a>
                @endif

                {{-- Pagamentos aos SUBAGENTES --}}
                @if ($responsabilidade->valorSubAgente != null)
                <a href="{{route('payments.subagente', [$responsabilidade->subAgente, $responsabilidade->fase, $responsabilidade])}}">
                    <div class="row charge-div">
                        <div class="col-md-1 align-self-center">
                            <div class="white-circle">
                                <img src="{{Storage::disk('public')->url('default-photos/M.jpg')}}" width="100%" class="mx-auto">
                            </div>
                        </div>
                        <div class="col-md-3 text-truncate align-self-center ml-4">
                            <p class="text-truncate" title="{{$responsabilidade->subAgente->nome.' '.$responsabilidade->subAgente->apelido}}">{{$responsabilidade->subAgente->nome.' '.$responsabilidade->subAgente->apelido}}</p>
                        </div>
                        <div class="col-md-2 text-truncate align-self-center">
                            <p class="text-truncate">{{number_format((float) $responsabilidade->valorSubAgente, 2, ',', '').'€'}}</p>
                        </div>
                        <div class="col-md-2 align-self-center ml-4">
                            <p class="text-truncate" title="{{$responsabilidade->dataVencimentoSubAgente->format('d/m/Y')}}">{{date('d/m/Y', strtotime($responsabilidade->dataVencimentoSubAgente))}}</p>
                        </div>
                        <div class="col-md-2 text-truncate align-self-center ml-auto">
                            <p class="text-truncate" @if($responsabilidade->verificacaoPagoSubAgente == true) style="color:#47BC00;" @elseif($responsabilidade->verificacaoPagoSubAgente == false &&
                                    $responsabilidade->dataVencimentoSubAgente < $currentdate) style="color:#FF3D00;" @endif>
                                        @if ($responsabilidade->verificacaoPagoSubAgente == false && $responsabilidade->dataVencimentoSubAgente
                                        < $currentdate) Dívida @elseif ($responsabilidade->verificacaoPagoSubAgente == false && $responsabilidade->dataVencimentoSubAgente > $currentdate)
                                        Pendente
                                        @elseif ($responsabilidade->verificacaoPagoSubAgente == true)
                                        Pago
                                        @endif
                            </p>
                        </div>
                    </div>
                </a>
                @endif

                {{-- Pagamentos as UNIVERSIDADES PRINCIPAIS--}}
                @if ($responsabilidade->valorUniversidade1 != null)
                <a href="{{route('payments.uni1', [$responsabilidade->universidade1, $responsabilidade->fase, $responsabilidade])}}">
                    <div class="row charge-div">
                        <div class="col-md-1 align-self-center">
                            <div class="white-circle">
                                <img src="{{Storage::disk('public')->url('default-photos/M.jpg')}}" width="100%" class="mx-auto">
                            </div>
                        </div>
                        <div class="col-md-3 text-truncate align-self-center ml-4">
                            <p class="text-truncate" title="{{$responsabilidade->universidade1->nome}}">{{$responsabilidade->universidade1->nome}}</p>
                        </div>
                        <div class="col-md-2 text-truncate align-self-center">
                            <p class="text-truncate">{{number_format((float) $responsabilidade->valorUniversidade1, 2, ',', '').'€'}}</p>
                        </div>
                        <div class="col-md-2 align-self-center ml-4">
                            <p class="text-truncate" title="{{date('d/m/Y', strtotime($responsabilidade->dataVencimentoUni1))}}">{{date('d/m/Y', strtotime($responsabilidade->dataVencimentoUni1))}}</p>
                        </div>
                        <div class="col-md-2 text-truncate align-self-center ml-auto">
                            <p class="text-truncate" @if($responsabilidade->verificacaoPagoUni1 == true) style="color:#47BC00;" @elseif($responsabilidade->verificacaoPagoUni1 == false && $responsabilidade->dataVencimentoUni1 <
                                        $currentdate) style="color:#FF3D00;" @endif>
                                        @if ($responsabilidade->verificacaoPagoUni1 == false && $responsabilidade->dataVencimentoUni1
                                        < $currentdate) Dívida @elseif ($responsabilidade->verificacaoPagoUni1 == false && $responsabilidade->dataVencimentoUni1 > $currentdate)
                                        Pendente
                                        @elseif ($responsabilidade->verificacaoPagoUni1 == true)
                                        Pago
                                        @endif
                            </p>
                        </div>
                    </div>
                </a>
                @endif

                {{-- Pagamentos as UNIVERSIDADES SECUNDÁRIAS --}}
                @if ($responsabilidade->valorUniversidade2 != null)
                <a href="{{route('payments.uni2', [$responsabilidade->universidade2, $responsabilidade->fase, $responsabilidade])}}">
                    <div class="row charge-div">
                        <div class="col-md-1 align-self-center">
                            <div class="white-circle">
                                <img src="{{Storage::disk('public')->url('default-photos/M.jpg')}}" width="100%" class="mx-auto">
                            </div>
                        </div>
                        <div class="col-md-3 text-truncate align-self-center ml-4">
                            <p class="text-truncate" title="{{$responsabilidade->universidade2->nome}}">{{$responsabilidade->universidade2->nome}}</p>
                        </div>
                        <div class="col-md-2 text-truncate align-self-center">
                            <p class="text-truncate">{{number_format((float) $responsabilidade->valorUniversidade2, 2, ',', '').'€'}}</p>
                        </div>
                        <div class="col-md-2 align-self-center ml-4">
                            <p class="text-truncate" title="{{$responsabilidade->dataVencimentoUni2->format('d/m/Y')}}">{{date('d/m/Y', strtotime($responsabilidade->dataVencimentoUni2))}}</p>
                        </div>
                        <div class="col-md-2 text-truncate align-self-center ml-auto">
                            <p class="text-truncate" @if($responsabilidade->verificacaoPagoUni2 == true) style="color:#47BC00;" @elseif($responsabilidade->verificacaoPagoUni2 == false && $responsabilidade->dataVencimentoUni2 <
                                        $currentdate) style="color:#FF3D00;" @endif>
                                        @if ($responsabilidade->verificacaoPagoUni2 == false && $responsabilidade->dataVencimentoUni2
                                        < $currentdate) Dívida @elseif ($responsabilidade->verificacaoPagoUni2 == false && $responsabilidade->dataVencimentoUni2 > $currentdate)
                                        Pendente
                                        @elseif ($responsabilidade->verificacaoPagoUni2 == true)
                                        Pago
                                        @endif
                            </p>
                        </div>
                    </div>
                </a>
                @endif

                {{-- Pagamentos aos FORNECEDORES EXTERNOS --}}
                @foreach ($responsabilidade->relacao as $relacao)
                <a href="{{route('payments.fornecedor', [$relacao->fornecedor, $relacao->responsabilidade->fase, $relacao])}}">
                    <div class="row charge-div">
                        <div class="col-md-1 align-self-center">
                            <div class="white-circle">
                                <img src="{{Storage::disk('public')->url('default-photos/M.jpg')}}" width="100%" class="mx-auto">
                            </div>
                        </div>
                        <div class="col-md-3 text-truncate align-self-center ml-4">
                            <p class="text-truncate" title="{{$relacao->fornecedor->nome}}">{{$relacao->fornecedor->nome}}</p>
                        </div>
                        <div class="col-md-2 text-truncate align-self-center">
                            <p class="text-truncate">{{number_format((float) $relacao->valor, 2, ',', '').'€'}}</p>
                        </div>
                        <div class="col-md-2 align-self-center ml-4">
                            <p class="text-truncate" title="{{$relacao->dataVencimento->format('d/m/Y')}}">{{date('d/m/Y', strtotime($relacao->dataVencimento))}}</p>
                        </div>
                        <div class="col-md-2 text-truncate align-self-center ml-auto">
                            <p class="text-truncate" @if($relacao->verificacaoPago == true) style="color:#47BC00;" @elseif($relacao->verificacaoPago == false && $relacao->estado == "Dívida") style="color:#FF3D00;" @endif>
                                        @if ($relacao->verificacaoPago == false && $relacao->estado == "Dívida")
                                        Dívida
                                        @elseif ($relacao->verificacaoPago == false && $relacao->estado == "Pendente")
                                        Pendente
                                        @elseif ($relacao->verificacaoPago == true)
                                        Pago
                                        @endif
                            </p>
                        </div>
                    </div>
                </a>
                @endforeach
                @endforeach
                @else
                <div class="row" style="padding: 0px 18px;">
                    <div class="container no-data-div text-center mt-3">
                        <p style="color:#252525;">Não existem pagamentos registados.</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script src="{{asset('/js/payments.js')}}"></script>
@endsection
@endsection
