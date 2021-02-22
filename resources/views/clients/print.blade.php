<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ficha financeira - Lyka Systems</title>
    <link href="{{asset('/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>
    <style media="screen">
        body {
            padding: 3px 33px;
            font-family: 'Lato', sans-serif;
            font-size: 10pt;
        }

        img {
            width: 130px;
        }

        #text-beneficiario {
            position: relative;
            top: -10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
          padding: 5px 10px;
          text-align: left;
        }

        table, th, td {
            border: 1px solid black;
        }
    </style>
    <br>
    <div class="row">
        <div class="col-md-6">
            <img src="{{asset('/media/logo.png')}}" alt="Logótipo - Estudar Portugal">
        </div>
        <div class="col-md-6">
            <div class="text-right" id="text-beneficiario">
                <p class="mb-0 font-weight-bold text-grey-900">Ficha Financeira do Cliente: <span class="font-weight-normal">{{$cliente->nome.' '.$cliente->apelido}}</span></p>
                <p class="mb-0 font-weight-bold">Produto Associado: <span class="font-weight-normal">{{$produto->descricao}}</span></p>
                <p class="font-weight-bold">Agente Associado: <span class="font-weight-normal">{{$produto->agente->nome.' '.$produto->agente->apelido}}</span></p>
            </div>
        </div>
    </div>
    <p class="font-weight-bold">Listagem das Cobranças</p>
    <table>
        <thead>
            <tr>
                <th>Fase</th>
                <th>Valor</th>
                <th>Data de Vencimento</th>
                <th>Estado</th>
                <th>Observações</th>
            </tr>
        </thead>
        <tbody>
            @if (count($fases))
                @foreach ($fases as $fase)
                    <tr>
                        <td>{{$fase->descricao}}</td>
                        <td>{{number_format((float) $fase->valorFase, 2, ',', '')}}&euro;</td>
                        <td>{{date('d/m/Y', strtotime($fase->dataVencimento))}}</td>
                        <td>{{$fase->estado}}</td>
                        <td>N/A</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5" style="text-align: center; padding:10px !important;"><i>Nada a apresentar</i></td>
                </tr>
            @endif
        </tbody>
    </table>

    <p class="font-weight-bold mt-5">Listagem dos Pagamentos</p>
    <table>
        <thead>
            <tr>
                <th>Beneficiário</th>
                <th>Fase</th>
                <th>Valor</th>
                <th>Data de Vencimento</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @if (count($responsabilidades))
                @foreach ($responsabilidades as $responsabilidade)
                    @if ($responsabilidade->valorCliente != null)
                    <tr>
                        <td>{{$responsabilidade->cliente->nome.' '.$responsabilidade->cliente->apelido}} (Cliente)</td>
                        <td>{{$responsabilidade->fase->descricao}}</td>
                        <td>{{number_format((float) $responsabilidade->valorCliente, 2, ',', '')}}&euro;</td>
                        <td>{{date('d/m/Y', strtotime($responsabilidade->dataVencimentoCliente))}}</td>
                        <td>
                        @if (!$responsabilidade->verificacaoPagoCliente && $responsabilidade->dataVencimentoCliente < $currentdate)
                            Vencido
                        @elseif (!$responsabilidade->verificacaoPagoCliente && $responsabilidade->dataVencimentoCliente > $currentdate)
                            Pendente
                        @elseif ($responsabilidade->verificacaoPagoCliente)
                            Pago
                        @endif
                        </td>
                    </tr>
                    @endif

                    @if ($responsabilidade->valorAgente != null)
                    <tr>
                        <td>{{$responsabilidade->agente->nome.' '.$responsabilidade->agente->apelido}} (Agente)</td>
                        <td>{{$responsabilidade->fase->descricao}}</td>
                        <td>{{number_format((float) $responsabilidade->valorAgente, 2, ',', '')}}&euro;</td>
                        <td>{{date('d/m/Y', strtotime($responsabilidade->dataVencimentoAgente))}}</td>
                        <td>
                        @if (!$responsabilidade->verificacaoPagoAgente && $responsabilidade->dataVencimentoAgente < $currentdate)
                            Vencido
                        @elseif (!$responsabilidade->verificacaoPagoAgente && $responsabilidade->dataVencimentoAgente > $currentdate)
                            Pendente
                        @elseif ($responsabilidade->verificacaoPagoAgente)
                            Pago
                        @endif
                        </td>
                    </tr>
                    @endif

                    @if ($responsabilidade->valorSubAgente != null)
                    <tr>
                        <td>{{$responsabilidade->subAgente->nome.' '.$responsabilidade->subAgente->apelido}} (Sub-Agente)</td>
                        <td>{{$responsabilidade->fase->descricao}}</td>
                        <td>{{number_format((float) $responsabilidade->valorSubAgente, 2, ',', '')}}&euro;</td>
                        <td>{{date('d/m/Y', strtotime($responsabilidade->dataVencimentoSubAgente))}}</td>
                        <td>
                        @if (!$responsabilidade->verificacaoPagoSubAgente && $responsabilidade->dataVencimentoSubAgente < $currentdate)
                            Vencido
                        @elseif (!$responsabilidade->verificacaoPagoSubAgente && $responsabilidade->dataVencimentoSubAgente > $currentdate)
                            Pendente
                        @elseif ($responsabilidade->verificacaoPagoSubAgente)
                            Pago
                        @endif
                        </td>
                    </tr>
                    @endif

                    @if ($responsabilidade->valorUniversidade1 != null)
                    <tr>
                        <td>{{$responsabilidade->universidade1->nome}}</td>
                        <td>{{$responsabilidade->fase->descricao}}</td>
                        <td>{{number_format((float) $responsabilidade->valorUniversidade1, 2, ',', '')}}&euro;</td>
                        <td>{{date('d/m/Y', strtotime($responsabilidade->dataVencimentoUni1))}}</td>
                        <td>
                        @if (!$responsabilidade->verificacaoPagoUni1 && $responsabilidade->dataVencimentoUni1 < $currentdate)
                            Vencido
                        @elseif (!$responsabilidade->verificacaoPagoUni1 && $responsabilidade->dataVencimentoUni1 > $currentdate)
                            Pendente
                        @elseif ($responsabilidade->verificacaoPagoUni1)
                            Pago
                        @endif
                        </td>
                    </tr>
                    @endif

                    @if ($responsabilidade->valorUniversidade2 != null)
                    <tr>
                        <td>{{$responsabilidade->universidade2->nome}}</td>
                        <td>{{$responsabilidade->fase->descricao}}</td>
                        <td>{{number_format((float) $responsabilidade->valorUniversidade2, 2, ',', '')}}&euro;</td>
                        <td>{{date('d/m/Y', strtotime($responsabilidade->dataVencimentoUni2))}}</td>
                        <td>
                        @if (!$responsabilidade->verificacaoPagoUni2 && $responsabilidade->dataVencimentoUni2 < $currentdate)
                            Vencido
                        @elseif (!$responsabilidade->verificacaoPagoUni2 && $responsabilidade->dataVencimentoUni2 > $currentdate)
                            Pendente
                        @elseif ($responsabilidade->verificacaoPagoUni2)
                            Pago
                        @endif
                        </td>
                    </tr>
                    @endif
                    @foreach ($responsabilidade->relacao as $relacao)
                    <tr>
                        <td>{{$relacao->fornecedor->nome}}</td>
                        <td>{{$relacao->responsabilidade->fase->descricao}}</td>
                        <td>{{number_format((float) $relacao->valor, 2, ',', '')}}&euro;</td>
                        <td>{{date('d/m/Y', strtotime($relacao->dataVencimento))}}</td>
                        <td>
                        @if ($relacao->verificacaoPago == false && $relacao->estado == "Dívida")
                            Vencido
                        @elseif ($relacao->verificacaoPago == false && $relacao->estado == "Pendente")
                            Pendente
                        @elseif ($relacao->verificacaoPago == true && $relacao->estado == "Pago")
                            Pago
                        @endif
                        </td>
                    </tr>
                    @endforeach
                @endforeach
            @else
                <tr>
                    <td colspan="5" style="text-align: center; padding:10px !important;"><i>Nada a apresentar</i></td>
                </tr>
            @endif
        </tbody>
    </table>
</body>
</html>
