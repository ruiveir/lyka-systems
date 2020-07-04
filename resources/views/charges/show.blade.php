@extends('layout.master')

{{-- Titulo da Página --}}
@section('title', 'Lista de cobranças')

{{-- Estilos de CSS --}}
@section('styleLinks')
<link href="{{asset('/css/charges.css')}}" rel="stylesheet">
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
                <h6>Secção de cobrança - {{$product->cliente->nome.' '.$product->cliente->apelido}}</h6>
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
        @foreach ($fases as $fase)
        <div class="container">
            @if (count($fase->DocTransacao))
            @foreach ($fase->DocTransacao as $document)
            @if ($document->valorRecebido != null)
            <a href="{{route('charges.edit', [$product, $fase, $document])}}">
                @else
                <a href="{{route('charges.showcharge', [$product, $fase])}}">
                    @endif
                    @endforeach
                    @else
                    <a href="{{route('charges.showcharge', [$product, $fase])}}">
                        @endif
                        <div class="row charge-div">
                            <div class="col-md-1 align-self-center">
                                <div class="white-circle">
                                    <ion-icon name="{{$fase->icon}}" id="icon"></ion-icon>
                                </div>
                            </div>
                            <div class="col-md-3 text-truncate align-self-center ml-4">
                                <p>{{$fase->descricao}}</p>
                            </div>
                            <div class="col-md-2 text-truncate align-self-center">
                                <p @if (count($fase->DocTransacao))
                                @foreach ($fase->DocTransacao as $document)
                                @if ($fase->valorFase > $document->valorRecebido)
                                style="color:#FF3D00;"
                                @elseif ($fase->valorFase == $document->valorRecebido)
                                style="color:#47BC00;"
                                @else
                                style="color:#FF3D00;"
                                @endif
                                @endforeach
                                @endif
                                >
                                @if (count($fase->DocTransacao))
                                @foreach ($fase->DocTransacao as $document)
                                @if ($document->valorRecebido != null && $fase->estado != 'Pago' && $fase->estado != 'Pendente')
                                {{number_format((float) $valorTotal = $document->valorRecebido - $fase->valorFase, 2, ',', '')}}€
                                @else
                                {{number_format((float)$fase->valorFase, 2, ',', '')}}€
                                @endif
                                @endforeach
                                @else
                                {{number_format((float)$fase->valorFase, 2, ',', '')}}€
                                @endif
                                </p>
                            </div>
                            <div class="col-md-2 text-truncate align-self-center ml-auto">
                                <?php
                                $currentdate = date_create(date('d-m-Y'));
                                $paymentdate = date_create(date('d-m-Y', strtotime($fase->dataVencimento)));
                                $datediff = (date_diff($currentdate,$paymentdate))->days;
                              ?>
                                <p @if ($datediff <= 7 && $fase->verificacaoPago == 0) style="color:#FF3D00;" @endif>
                                        <?=date('d/m/Y', strtotime($fase->dataVencimento))?>
                                        </p>
                            </div>
                            <div class="col-md-2 text-truncate align-self-center ml-auto">
                                <p>
                                  @php
                                    switch ($fase->estado) {
                                      case 'Pendente':
                                      printf('Pendente');
                                      break;

                                      case 'Pago':
                                      printf('Pago');
                                      break;

                                      case 'Dívida':
                                      printf('Dívida');
                                      break;

                                      case 'Crédito':
                                      printf('Crédito');
                                      break;
                                    }
                                  @endphp
                                </p>
                            </div>
                        </div>
                    </a>
        </div>
        @endforeach
    </div>
</div>
@section('scripts')
<script src="{{asset('/js/charges.js')}}"></script>
@endsection
@endsection
