@extends('layout.master')
<!-- Page Title -->
@section('title', 'Notificação detalhada')
<!-- Page Content -->
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800">Visualização de uma notificação</h1>
        <a href="#" data-toggle="modal" data-target="#infoModal" class="btn btn-secondary btn-icon-split btn-sm" title="Informações">
            <span class="icon text-white-50">
                <i class="fas fa-info-circle"></i>
            </span>
            <span class="text">Informações</span>
        </a>
    </div>
    <!-- Approach -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Visualização de uma notificação</h6>
        </div>
        <div class="card-body">
            @if($notification)
                <div class="row">
                    <div class="col-md-6">
                        <p class="text-gray-800"><b>Tipo de notificação:</b>
                            @if($notification->type == "App\Notifications\Aniversario")
                                Aniversário
                            @elseif($notification->type == "App\Notifications\Atraso")
                                Atraso
                            @elseif($notification->type == 'App\Notifications\AtrasoCliente')
                                AtrasoCliente
                            @else
                                Abertura
                            @endif
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <p class="text-gray-800"><b>Estado:</b>
                            @if($notification->data['urgencia'])
                                <span class="font-weight-bold text-danger">Urgente</span>
                            @else
                                <span>Regular</span>
                            @endif
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <p class="text-gray-800"><b>Assunto:</b> {{$notification->data['assunto']}}</p>
                    </div>
                </div>
                @if($notification->type == "App\Notifications\Aniversario")
                    @php
                        $descricoes = explode('*',str_replace(array("\\r\\n", "\\r", "\\n"), "*", $notification->data['descricao']));
                    @endphp
                        <p class="text-gray-800"><b>Mensagem:</b></p>
                        <p class="text-gray-800">
                        @foreach($descricoes as $descricao)
                            {{$descricao}}
                            <br>
                        @endforeach
                    </p>
                @elseif($notification->type == "App\Notifications\Atraso" || $notification->type == 'App\Notifications\AtrasoCliente')
                    @php
                        $descricoes = explode('*',str_replace(array("\\r\\n", "\\r", "\\n"), "*", $notification->data['descricao']));
                        $idCliente = explode('_',$notification->data['code']);
                        $num = 2;
                        $primeiraDescricao = true;
                    @endphp
                    <p class="text-gray-800"><b>Clientes com atraso:</b></p>
                    <div class="table-responsive p-1">
                        <table class="table table-bordered table-striped" id="table" width="100%">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>N.º Passaporte</th>
                                    <th>País</th>
                                    <th style="max-width:200px; min-width:200px;">Estado</th>
                                    <th style="max-width:100px; min-width:100px;">Opções</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($clientesNotificacao as $client)
                                    @if($client->idCliente == $idCliente[$num])
                                        @if ( $client->estado=="Ativo" || $client->estado=="Proponente")
                                        <tr>
                                            <td class="align-middle">{{$client->nome.' '.$client->apelido}}</td>
                                            <td class="align-middle">{{$client->numPassaporte}}</td>
                                            <td class="align-middle">{{$client->paisNaturalidade}}</td>
                                            <td class="align-middle">
                                                @if($client->estado == "Ativo")
                                                    <span class="font-weight-bold text-success">Ativo</span>
                                                @elseif($client->estado == "Inativo")
                                                    <span class="font-weight-bold text-danger">Inativo</span>
                                                @else
                                                    <span class="font-weight-bold text-info">Proponente</span>
                                                @endif
                                            </td>
                                            <td class="text-center align-middle">
                                                <a href="{{route('clients.show',$client)}}" class="btn btn-sm btn-outline-primary" title="Ver ficha completa"><i class="far fa-eye"></i></a>
                                            </td>
                                        </tr>
                                        @endif
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            @else
                <p class="text-gray-800"><b>Notificação Eliminada</b></p>
            @endif
        </div>
    </div>
</div>

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
                Nesta secção pode visualizar a notificação com mais detalhe. Caso a notificação for <span class="font-weight-bold text-danger">Urgente</span>, significa que há algum atraso relativo ao tipo de notificação.
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
            }
        });
    });
</script>
@endsection
<!-- End of Scripts -->
@endsection
<!-- End of Page Content -->
