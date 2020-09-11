@extends('layout.master')
<!-- Page Title -->
@section('title', 'Estudantes')
<!-- Page Content -->
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800">Listagem de estudantes</h1>
        <div>
            @if (Auth::user()->tipo == "admin")
                <a href="{{route('clients.searchIndex')}}" class="btn btn-success btn-icon-split btn-sm" title="Adicionar">
                    <span class="icon text-white-50">
                        <i class="fas fa-search"></i>
                    </span>
                    <span class="text">Pesquisa avançada</span>
                </a>
                <a href="{{route('clients.create')}}" class="btn btn-primary btn-icon-split btn-sm" title="Adicionar">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Adicionar estudante</span>
                </a>
            @endif
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
                    <h6 class="m-0 font-weight-bold text-primary align-middle">Listagem de estudantes</h6>
                </div>
                <div class="mr-3">
                    <span class="p-2 px-3 border bg-light">
                        <small>
                            <span class="mx-1">{{ $clients->where("estado", "Ativo")->count() }} Ativos</span><span class="mx-1">|</span>
                            <span class="mx-1">{{ $clients->where("estado", "Proponente")->count() }} Proponentes</span><span class="mx-1">|</span>
                            <span class="mx-1">{{ $clients->where("estado", "Inativo")->count() }} Inativos</span>
                        </small>
                    </span>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive p-1">
                <table class="table table-bordered table-striped" id="table" width="100%">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>E-Mail</th>
                            <th>Telefone</th>
                            <th>País</th>
                            <th style="max-width:200px; min-width:200px;">Estado</th>
                            <th style="max-width:100px; min-width:100px;">Opções</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clients as $client)
                            @if ($client->estado == "Ativo" || $client->estado == "Proponente")
                                <tr>
                                    <td>{{$client->nome.' '.$client->apelido}}</td>
                                    <td>{{$client->email}}</td>
                                    <td>{{$client->telefone1}}</td>
                                    <td>{{$client->paisNaturalidade}}</td>
                                    <td class="font-weight-bold @if($client->estado == "Ativo") text-success @else text-danger @endif">@if($client->estado) Ativo @else Proponente @endif</td>
                                    <td class="text-center align-middle">
                                        <a href="{{route("clients.show", $client)}}" class="btn btn-sm btn-outline-primary" title="Ficha completa"><i class="far fa-eye"></i></a>
                                        @if(Auth::user()->tipo == "admin" || Auth::user()->tipo == "agente" && $client->editavel == 1)
                                            <a href="{{route("clients.edit", $client)}}" class="btn btn-sm btn-outline-warning" title="Editar"><i class="fas fa-pencil-alt"></i></a>
                                        @else
                                            <button disabled href="{{route("clients.edit", $client)}}" class="btn btn-sm btn-outline-dark text-gray-900" title="Editar"><i class="fas fa-pencil-alt"></i></button>
                                        @endif
                                        @if (Auth::user()->tipo == "admin")
                                            <button data-toggle="modal" data-target="#deleteModal" data-slug="{{$client->slug}}" class="btn btn-sm btn-outline-danger" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
                                        @else
                                            <button disabled class="btn btn-sm btn-outline-dark text-gray-900" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
                                        @endif
                                    </td>
                                </tr>
                            @endif
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
                Nesta secção encontram-se a listagem dos estudantes da Estudar Portugal. Pode acrescentar mais, clique no botão <b>Adicionar estudante</b>.
            </div>
            <div class="modal-footer mt-3">
                <a data-dismiss="modal" class="mr-4 font-weight-bold" id="close-option">Fechar</a>
                <button type="button" data-dismiss="modal" class="btn btn-primary font-weight-bold mr-2">Entendido!</button>
            </div>
        </div>
    </div>
</div>
<!-- End of Modal for more information  -->

<!-- Modal for delete admin -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header pl-4 pb-1 pt-4">
                <h5 class="modal-title text-gray-800 font-weight-bold">Pretende eliminar o estudante?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-gray-800 pl-4 pr-5">
                Ao apagar o registo do estudante, <b>irá eliminar o mesmo para todo o sempre!</b> Pense duas vezes antes de proceder com a ação.
            </div>
            <div class="modal-footer mt-3">
                <form method="post">
                    @csrf
                    @method('DELETE')
                    <a data-dismiss="modal" class="mr-4 font-weight-bold" id="close-option">Cancelar</a>
                    <button type="submit" class="btn btn-danger font-weight-bold mr-2">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End of Modal for delete report -->

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
            },
            "order": [ 3, 'asc' ]
        });

        // Modal for DELETE
        $('#deleteModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var modal = $(this);
            modal.find("form").attr('action', '/estudantes/' + button.data('slug'));
        });
    });
</script>
@endsection
<!-- End of Scripts -->
@endsection
<!-- End of Page Content -->
