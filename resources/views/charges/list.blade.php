@extends('layout.master')

{{-- Titulo da Página --}}
@section('title', 'Listagem de cobranças')

{{-- Estilos de CSS --}}
@section('styleLinks')

<link href="{{asset('/css/datatables_general.css')}}" rel="stylesheet">
<link href="{{asset('/css/inputs.css')}}" rel="stylesheet">

@endsection

{{-- Conteudo da Página --}}
@section('content')

<div class="container-fluid my-4">

    {{-- Conteúdo --}}
    <div class="bg-white shadow-sm mb-4 p-4 ">

        <div class="row">

            <div class="col">
                <div class="title">
                    <h4><strong>Listagem de cobranças de clientes</strong></h4>
                </div>
            </div>

            {{-- Opções --}}
            <div class="col text-right">
                {{-- ESPAÇO PARA BOTÔES --}}
            </div>

        </div>


        <hr class="my-3">



        <div class="row mt-4 mx-auto text-center">

            {{-- COBRANÇAS PENDENTES --}}
            <div class="col p-3 border bg-light shadow-sm m-2" style="min-width: 240px">
                @if($fasesPendentes)
                    <div><h1><strong>{{count($fasesPendentes)}}</strong></h1></div>
                @else
                    <div><h1><strong>0</strong></h1></div>
                @endif
                    <div class="text-uppercase" style="color:gray; font-weight:600">cobranças pendentes</div>
            </div>

            {{-- COBRANÇAS PAGAS --}}
            <div class="col p-3 border bg-light shadow-sm m-2" style="min-width: 240px">
                @if($fasesPagas)
                        <div style="color:#47BC00;"><h1><strong>{{count($fasesPagas)}}</h1></div>
                @else
                    <div style="color:#47BC00;"><h1><strong>0</h1></strong></div>
                @endif
                    <div class="text-uppercase" style="color:gray; font-weight:600">cobranças pagas</div>
            </div>


            {{-- COBRANÇAS EM DÍVIDA --}}
            <div class="col p-3 border bg-light shadow-sm m-2" style="min-width: 240px">
                @if($fasesPagas)
                    <div style="color:#FF3D00;"><h1><strong>{{count($fasesDivida)}}</div>
                @else
                    <div style="color:#FF3D00;"><h1><strong>0</strong></div>
                @endif
                    <div class="text-uppercase" style="color:gray; font-weight:600">cobranças em dívida</div>
            </div>

        </div>



        {{-- Input de procura nos resultados da dataTable --}}
        <div class="row mt-4">
            <div class="col">

            <input type="text" class="shadow-sm" id="customSearchBox" placeholder="Procurar nos resultados..."
                aria-label="Procurar" style="width:100%;">
            </div>
        </div>



        {{-- Tabela --}}
        <div class="row mt-4">
            <div class="col">

                @if ($products)
                <div class="table-responsive">
                    <table id="dataTable" class="table table-bordered table-hover " style="width:100%">

                        {{-- Cabeçalho da tabela --}}
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>Valor</th>
                                <th>Estado</th>
                                <th class="text-center">Opções</th>
                            </tr>
                        </thead>

                        {{-- Corpo da tabela --}}
                        <tbody>

                                @foreach ($products as $product)

                                    {{-- Linha modelo --}}

                                    <tr>

                                        {{-- Nome e apelido --}}
                                        <td>{{$product->cliente->nome.' '.$product->cliente->apelido}}</td>


                                        {{-- Descrição --}}
                                        <td>{{$product->descricao}}</td>


                                        {{-- Valor --}}
                                        <td>
                                            <?php
                                            $valorPago = 0;
                                            foreach ($product->fase as $fase) {
                                              if (count($fase->DocTransacao)) {
                                                foreach ($fase->DocTransacao as $document) {
                                                  $valorPago = $valorPago + $document->valorRecebido;
                                                }
                                              }
                                            }

                                            $valorDivida = 0;
                                            foreach ($product->fase as $fase) {
                                              if (count($fase->DocTransacao)) {
                                                foreach ($fase->DocTransacao as $document) {
                                                  if ($document->valorRecebido < $fase->valorFase) {
                                                    $valorDivida = $valorDivida + ($fase->valorFase - $document->valorRecebido);
                                                  }
                                                }
                                              }
                                            }

                                        ?>
                                          @if ($valorPago != 0)
                                            <div style="color:#47BC00;">{{number_format((float)$valorPago, 2, ',', '')}}€</div>
                                          @endif
                                          @if ($valorDivida != 0)
                                            <div style="color:#FF3D00;">{{number_format((float)$valorDivida, 2, ',', '')}}€</div>
                                          @endif
                                          <div>{{number_format((float)$product->valorTotal, 2, ',', '')}}€</div>

                                        </td>

                                        {{-- Estado --}}
                                        <td>
                                            @php
                                            switch ($product->estado) {
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
                                        </td>



                                        {{-- Opções --}}
                                        <td class="text-center">
                                            <a href="{{route('charges.show', $product)}}" class="btn btn-sm btn-outline-primary"
                                                title="Ver detalhes"><i class="far fa-eye"></i></a>
                                        </td>

                                    </tr>


                                @endforeach

                        </tbody>
                    </table>
                </div>

                @else
                    <div class="border rounded bg-light p-3 text-muted"><small>Não existem cobranças registadas.</small></div>
                @endif

            </div>
        </div>


    </div>

</div>


@section('scripts')

<script src="{{asset('/js/charges.js')}}"></script>

{{-- <script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script> --}}
@endsection
@endsection
