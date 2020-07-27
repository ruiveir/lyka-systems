@extends('layout.master')
<!-- Page Title -->
@section('title', 'Lista de Pagamentos')
<!-- Page Content -->
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800">Pagamentos</h1>
        <div>
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
            <h6 class="m-0 font-weight-bold text-primary">Listagem - Pagamentos</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive p-1">
                <table class="table table-bordered table-striped" id="table" width="100%">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Tipo</th>
                            <th>Valor</th>
                            <th>Data de Vencimento</th>
                            <th>Estado</th>
                            <th style="max-width:100px; min-width:100px;">Opções</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($responsabilidades as $responsabilidade)
                        <!-- Begin of payments for CLIENTS -->
                        @if ($responsabilidade->valorCliente != null)
                        <tr>
                            <td>{{$responsabilidade->cliente->nome.' '.$responsabilidade->cliente->apelido}}</td>
                            <td>Estudante</td>
                            <td>{{number_format((float) $responsabilidade->valorCliente, 2, ',', '').'€'}}</td>
                            <td>{{date('d/m/Y', strtotime($responsabilidade->dataVencimentoCliente))}}</td>
                            <td class="@if($responsabilidade->verificacaoPagoCliente == false && $responsabilidade->dataVencimentoCliente < $currentdate) text-danger font-weight-bold @elseif ($responsabilidade->verificacaoPagoCliente == true) text-success font-weight-bold @else text-gray @endif">
                            @if ($responsabilidade->verificacaoPagoCliente == false && $responsabilidade->dataVencimentoCliente < $currentdate)
                                Vencido
                            @elseif ($responsabilidade->verificacaoPagoCliente == false && $responsabilidade->dataVencimentoCliente > $currentdate)
                                Pendente
                            @elseif ($responsabilidade->verificacaoPagoCliente == true)
                                Pago
                            @endif
                            </td>
                            <td class="text-center align-middle">
                                <a href="{{route('payments.cliente', [$responsabilidade->cliente, $responsabilidade->fase, $responsabilidade])}}" class="btn btn-sm btn-outline-warning" title="Editar"><i class="fas fa-pencil-alt"></i></a>
                                <button data-toggle="modal" data-target="#deleteModal" data-id="{{$responsabilidade->idResponsabilidade}}" class="btn btn-sm btn-outline-danger" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
                            </td>
                        </tr>
                        @endif
                        <!-- End of payments for CLIENTS -->

                        <!-- Begin of payments for AGENTS -->
                        @if ($responsabilidade->valorAgente != null)
                        <tr>
                            <td>{{$responsabilidade->agente->nome.' '.$responsabilidade->agente->apelido}}</td>
                            <td>Agente</td>
                            <td>{{number_format((float) $responsabilidade->valorAgente, 2, ',', '').'€'}}</td>
                            <td>{{date('d/m/Y', strtotime($responsabilidade->dataVencimentoAgente))}}</td>
                            <td class="@if($responsabilidade->verificacaoPagoAgente == false && $responsabilidade->dataVencimentoAgente < $currentdate) text-danger font-weight-bold @elseif ($responsabilidade->verificacaoPagoAgente == true) text-success font-weight-bold @else text-gray @endif">
                            @if ($responsabilidade->verificacaoPagoAgente == false && $responsabilidade->dataVencimentoAgente < $currentdate)
                                Vencido
                            @elseif ($responsabilidade->verificacaoPagoAgente == false && $responsabilidade->dataVencimentoAgente > $currentdate)
                                Pendente
                            @elseif ($responsabilidade->verificacaoPagoAgente == true)
                                Pago
                            @endif
                            </td>
                            <td class="text-center align-middle">
                                <a href="{{route('payments.agente', [$responsabilidade->agente, $responsabilidade->fase, $responsabilidade])}}" class="btn btn-sm btn-outline-warning" title="Editar"><i class="fas fa-pencil-alt"></i></a>
                                <button data-toggle="modal" data-target="#deleteModal" data-id="{{$responsabilidade->idResponsabilidade}}" class="btn btn-sm btn-outline-danger" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
                            </td>
                        </tr>
                        @endif
                        <!-- End of payments for AGENTS -->

                        <!-- Begin of payments for SUGAGENTS -->
                        @if ($responsabilidade->valorSubAgente != null)
                        <tr>
                            <td>{{$responsabilidade->subAgente->nome.' '.$responsabilidade->subAgente->apelido}}</td>
                            <td>Subagente</td>
                            <td>{{number_format((float) $responsabilidade->valorSubAgente, 2, ',', '').'€'}}</td>
                            <td>{{date('d/m/Y', strtotime($responsabilidade->dataVencimentoSubAgente))}}</td>
                            <td class="@if($responsabilidade->verificacaoPagoSubAgente == false && $responsabilidade->dataVencimentoSubAgente < $currentdate) text-danger font-weight-bold @elseif ($responsabilidade->verificacaoPagoSubAgente == true) text-success font-weight-bold @else text-gray @endif">
                            @if ($responsabilidade->verificacaoPagoSubAgente == false && $responsabilidade->dataVencimentoSubAgente < $currentdate)
                                Vencido
                            @elseif ($responsabilidade->verificacaoPagoSubAgente == false && $responsabilidade->dataVencimentoSubAgente > $currentdate)
                                Pendente
                            @elseif ($responsabilidade->verificacaoPagoSubAgente == true)
                                Pago
                            @endif
                            </td>
                            <td class="text-center align-middle">
                                <a href="{{route('payments.subagente', [$responsabilidade->subAgente, $responsabilidade->fase, $responsabilidade])}}" class="btn btn-sm btn-outline-warning" title="Editar"><i class="fas fa-pencil-alt"></i></a>
                                <button data-toggle="modal" data-target="#deleteModal" data-id="{{$responsabilidade->idResponsabilidade}}" class="btn btn-sm btn-outline-danger" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
                            </td>
                        </tr>
                        @endif
                        <!-- End of payments for SUGAGENTS -->

                        <!-- Begin of payments for UNI1 -->
                        @if ($responsabilidade->valorUniversidade1 != null)
                        <tr>
                            <td>{{$responsabilidade->universidade1->nome.' '.$responsabilidade->universidade1->apelido}}</td>
                            <td>Universidade</td>
                            <td>{{number_format((float) $responsabilidade->valorUniversidade1, 2, ',', '').'€'}}</td>
                            <td>{{date('d/m/Y', strtotime($responsabilidade->dataVencimentoUni1))}}</td>
                            <td class="@if($responsabilidade->verificacaoPagoUni1 == false && $responsabilidade->dataVencimentoUni1 < $currentdate) text-danger font-weight-bold @elseif ($responsabilidade->verificacaoPagoUni1 == true) text-success font-weight-bold @else text-gray @endif">
                            @if ($responsabilidade->verificacaoPagoUni1 == false && $responsabilidade->dataVencimentoUni1 < $currentdate)
                                Vencido
                            @elseif ($responsabilidade->verificacaoPagoUni1 == false && $responsabilidade->dataVencimentoUni1 > $currentdate)
                                Pendente
                            @elseif ($responsabilidade->verificacaoPagoUni1 == true)
                                Pago
                            @endif
                            </td>
                            <td class="text-center align-middle">
                                <a href="{{route('payments.uni1', [$responsabilidade->universidade1, $responsabilidade->fase, $responsabilidade])}}" class="btn btn-sm btn-outline-warning" title="Editar"><i class="fas fa-pencil-alt"></i></a>
                                <button data-toggle="modal" data-target="#deleteModal" data-id="{{$responsabilidade->idResponsabilidade}}" class="btn btn-sm btn-outline-danger" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
                            </td>
                        </tr>
                        @endif
                        <!-- End of payments for UNI1 -->

                        <!-- Begin of payments for UNI2 -->
                        @if ($responsabilidade->valorUniversidade2 != null)
                        <tr>
                            <td>{{$responsabilidade->universidade2->nome.' '.$responsabilidade->universidade2->apelido}}</td>
                            <td>Universidade</td>
                            <td>{{number_format((float) $responsabilidade->valorUniversidade2, 2, ',', '').'€'}}</td>
                            <td>{{date('d/m/Y', strtotime($responsabilidade->dataVencimentoUni2))}}</td>
                            <td class="@if($responsabilidade->verificacaoPagoUni2 == false && $responsabilidade->dataVencimentoUni2 < $currentdate) text-danger font-weight-bold @elseif ($responsabilidade->verificacaoPagoUni2 == true) text-success font-weight-bold @else text-gray @endif">
                            @if ($responsabilidade->verificacaoPagoUni2 == false && $responsabilidade->dataVencimentoUni2 < $currentdate)
                                Vencido
                            @elseif ($responsabilidade->verificacaoPagoUni2 == false && $responsabilidade->dataVencimentoUni2 > $currentdate)
                                Pendente
                            @elseif ($responsabilidade->verificacaoPagoUni2 == true)
                                Pago
                            @endif
                            </td>
                            <td class="text-center align-middle">
                                <a href="{{route('payments.uni2', [$responsabilidade->universidade2, $responsabilidade->fase, $responsabilidade])}}" class="btn btn-sm btn-outline-warning" title="Editar"><i class="fas fa-pencil-alt"></i></a>
                                <button data-toggle="modal" data-target="#deleteModal" data-id="{{$responsabilidade->idResponsabilidade}}" class="btn btn-sm btn-outline-danger" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
                            </td>
                        </tr>
                        @endif
                        <!-- End of payments for UNI2 -->

                        <!-- Begin of payments for PROVIDER -->
                        @foreach ($responsabilidade->relacao as $relacao)
                        <tr>
                            <td>{{$relacao->fornecedor->nome}}</td>
                            <td>Fornecedor</td>
                            <td>{{number_format((float) $relacao->valor, 2, ',', '').'€'}}</td>
                            <td>{{date('d/m/Y', strtotime($relacao->dataVencimento))}}</td>
                            <td class="@if($relacao->verificacaoPago == false && $relacao->estado == "Dívida") text-danger font-weight-bold @elseif ($relacao->verificacaoPago == true) text-success font-weight-bold @else text-gray @endif">
                            @if ($relacao->verificacaoPago == false && $relacao->estado == "Dívida")
                                Vencido
                            @elseif ($relacao->verificacaoPago == false && $relacao->estado == "Pendente")
                                Pendente
                            @elseif ($relacao->verificacaoPago == true)
                                Pago
                            @endif
                            </td>
                            <td class="text-center align-middle">
                                <a href="{{route('payments.fornecedor', [$relacao->fornecedor, $relacao->responsabilidade->fase, $relacao])}}" class="btn btn-sm btn-outline-warning" title="Editar"><i class="fas fa-pencil-alt"></i></a>
                                <button data-toggle="modal" data-target="#deleteModal" data-id="{{$responsabilidade->idResponsabilidade}}" class="btn btn-sm btn-outline-danger" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
                            </td>
                        </tr>
                        @endforeach
                        <!-- End of payments for PROVIDER -->
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- End of container-fluid -->

<!-- Modal for more information -->
<div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header pl-4 pb-1 pt-4">
                <h5 class="modal-title text-gray-800 font-weight-bold">Para que serve?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-gray-800 pl-4 pr-5">
                Nesta secção pode encontrar os todos os pagamentos da Estudar Portugal. Pode editá-los de modo a mudar o seu estado.
            </div>
            <div class="modal-footer mt-3">
                <a data-dismiss="modal" class="mr-4 font-weight-bold" id="close-option">Fechar</a>
                <button type="button" data-dismiss="modal" class="btn btn-primary font-weight-bold mr-2">Entendido!</button>
            </div>
        </div>
    </div>
</div>
<!-- End of Modal for more information  -->

<!-- Begin of Scripts -->
@section('scripts')
<script>
    $(document).ready(function() {
        $('#table').DataTable({
            "language": {
                "sEmptyTable": "Não foi encontrado nenhum registo",
                "sLoadingRecords": "A carregar...",
                "sProcessing": "A processar...",
                "sLengthMenu": "Mostrar _MENU_ registos",
                "sZeroRecords": "Não foram encontrados resultados",
                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registos",
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
            "order": [[ 4, 'desc' ], [ 3, 'desc' ]]
        });
    });
</script>
@endsection
<!-- End of Scripts -->
@endsection
