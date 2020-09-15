@extends('layout.master')
<!-- Page Title -->
@section('title', 'Cobranças')
<!-- Page Content -->
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800">Listagem de cobranças</h1>
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
            <div class="row d-flex justify-content-between align-items-center">
                <div class="col-md-6">
                    <h6 class="m-0 font-weight-bold text-primary align-middle">Listagem de cobranças da Estudar Portugal.</h6>
                </div>
                @if (isset($products))
                    <div class="mr-3">
                        <span class="p-2 px-3 border bg-light">
                            <small>
                                <span class="mx-1">{{$fasesPendentes}} Pendente(s)</span><span class="mx-1">|</span>
                                <span class="mx-1">{{$fasesPagas}} Paga(s)</span><span class="mx-1">|</span>
                                <span class="mx-1">{{$fasesDivida}} Vencida(s)</span>
                            </small>
                        </span>
                    </div>
                @endif
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive p-1">
                <table class="table table-bordered table-striped" id="table" width="100%">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Descrição (Num. Fases)</th>
                            <th>Valor total</th>
                            <th style="max-width:130px; min-width:130px;">Estado</th>
                            <th style="max-width:70px; min-width:70px;">Opções</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        <tr>
                            <td>{{$product->cliente->nome.' '.$product->cliente->apelido}}</td>
                            <td>{{$product->descricao.' ('.$product->fase->count().')'}}</td>
                            <td>{{str_replace('.', ',', $product->valorTotal).'€'}}</td>
                            <td>
                            @php
                                switch ($product->estado) {
                                    case 'Pendente':
                                        echo "<span class='font-weight-bold'>Pendente</span>";
                                    break;

                                    case 'Pago':
                                        echo "<span class='font-weight-bold text-success'>Pago</span>";
                                    break;

                                    case 'Dívida':
                                        echo "<span class='font-weight-bold text-danger'>Vencido</span>";
                                    break;

                                    case 'Crédito':
                                        echo "<span class='font-weight-bold text-warning'>Crédito</span>";
                                    break;
                                }
                            @endphp
                            </td>
                            <td class="text-center align-middle">
                                <a href="{{route('charges.listfases', $product)}}" class="btn btn-sm btn-outline-primary" title="Ver em detalhe"><i class="far fa-eye"></i></a>
                            </td>
                        </tr>
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
                Nesta secção encontra-se a listagem das cobranças da Estudar Portugal. Pode visualizar em detalhe as cobranças de um produto clicando no botão <b>Ver em detalhe</b>.
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
            }
        });
    });
</script>
@endsection
<!-- End of Scripts -->
@endsection
<!-- End of Page Content -->
