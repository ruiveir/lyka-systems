@extends('layout.master')
<!-- Page Title -->
@section('title', 'Biblioteca')
<!-- Page Content -->
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800">Biblioteca de ficheiros</h1>
        <div>
            @if (Auth()->user()->tipo == "admin")
                <a href="{{route('libraries.create')}}" class="btn btn-primary btn-icon-split btn-sm" title="Adicionar">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Adicionar ficheiro</span>
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
                    <h6 class="m-0 font-weight-bold text-primary align-middle">Listagem de ficheiros disponíveis na biblioteca.</h6>
                </div>
                @if (isset($size))
                    <div class="mr-3">
                        @if (Auth::user()->tipo == "admin")
                            <span class="p-2 px-3 border bg-light">
                            <small><strong>Espaço ocupado: {{$size}}</strong></small>
                            </span>
                        @endif
                    </div>
                @endif
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive p-1">
                <table class="table table-bordered table-striped" id="table" width="100%">
                    <thead>
                        <tr>
                            <th>Descrição</th>
                            <th>Tamanho</th>
                            <th>Tipo</th>
                            <th>Data de <i>upload</i></th>
                            @if (Auth()->user()->tipo == "admin")
                            <th>Acesso</th>
                            @endif
                            <th style="max-width:100px; min-width:100px;">Opções</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($files as $library)
                        <tr>
                            <td title="{{$library->descricao}}">{{\Illuminate\Support\Str::limit($library->descricao, 25, $end='...')}}</td>
                            <td>@if($library->tamanho) {{$library->tamanho}} @else N/A @endif</td>
                            <td>@if($library->tipo) {{$library->tipo}} @else N/A @endif</td>
                            <td>{{date('d/m/Y', strtotime($library->updated_at))}}</td>
                            @if (Auth()->user()->tipo == "admin")
                            <td>@if($library->acesso == "Privado") <span class="text-danger font-weight-bold">Privado</span> @else <span class="text-success font-weight-bold">Público</span> @endif</td>
                            @endif
                            <td class="text-center align-middle">
                                <a download href="{{url('/storage/library/'.$library->ficheiro)}}" class="btn btn-sm btn-outline-primary " title="Download"><i class="fas fa-download"></i></a>
                                @if (Auth()->user()->tipo == "admin")
                                    <a href="{{route("libraries.edit", $library)}}" class="btn btn-sm btn-outline-warning" title="Editar"><i class="fas fa-pencil-alt"></i></a>
                                    <button data-toggle="modal" data-target="#deleteModal" data-slug="{{$library->slug}}" class="btn btn-sm btn-outline-danger" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
                                @else
                                    <button class="btn btn-sm btn-outline-dark text-gray-900" disabled><i class="fas fa-pencil-alt"></i></button>
                                    <button class="btn btn-sm btn-outline-dark text-gray-900" disabled><i class="fas fa-trash-alt"></i></button>
                                @endif
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
                Nesta secção encontra-se as listagens dos ficheiros da Estudar Portugal. Pode acrescentar mais clicando no botão <b>Adicionar ficheiro</b>.
            </div>
            <div class="modal-footer mt-3">
                <a data-dismiss="modal" class="mr-4 font-weight-bold" id="close-option">Fechar</a>
                <button type="button" data-dismiss="modal" class="btn btn-primary font-weight-bold mr-2">Entendido!</button>
            </div>
        </div>
    </div>
</div>
<!-- End of Modal for more information  -->

<!-- Modal for delete report -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header pl-4 pb-1 pt-4">
                <h5 class="modal-title text-gray-800 font-weight-bold">Pretende eliminar o ficheiro?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-gray-800 pl-4 pr-5">
                Ao apagar o ficheiro do sistema, <b>irá eliminar o mesmo para todo o sempre!</b> Pense duas vezes antes de proceder com a ação.
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
            }
        });

        // Delete report modal
        $('#deleteModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var modal = $(this);
            modal.find("form").attr('action', '/biblioteca/' + button.data('slug'));
        });
    });
</script>
@endsection
<!-- End of Scripts -->
@endsection
<!-- End of Page Content -->
