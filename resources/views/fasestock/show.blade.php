@extends('layout.master')
<!-- Page Title -->
@section('title', 'Ficha da fase')
<!-- Page Content -->
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800">Ficha da fase <b>{{$fasestock->descricao}}</b></h1>
        <div>
            <a href="#" data-toggle="modal" data-target="#addDocument" class="btn btn-primary btn-icon-split btn-sm" title="Adicionar">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Adicionar documento</span>
            </a>
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
            <h6 class="m-0 font-weight-bold text-primary">Listagem das fases associadas ao produto "{{$fasestock->descricao}}"</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive p-1">
                <table class="table table-bordered table-striped" id="table" width="100%">
                    <thead>
                        <tr>
                            <th>Descrição</th>
                            <th>Tipo de documento</th>
                            <th style="max-width:80px; min-width:80px;">Opções</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($docstocks as $docstock)
                        <tr>
                            <td>{{$docstock->tipoDocumento}}</td>
                            <td>{{$docstock->tipo}}</td>
                            <td class="text-center align-middle">
                                <button data-toggle="modal" data-target="#editDocument" data-slug="{{$docstock->slug}}" data-tipo="{{$docstock->tipo}}" data-name="{{$docstock->tipoDocumento}}" class="btn btn-sm btn-outline-warning" title="Editar"><i class="fas fa-pencil-alt"></i></button>
                                <button data-toggle="modal" data-target="#deleteModal" data-slug="{{$docstock->slug}}" class="btn btn-sm btn-outline-danger" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
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
                Nesta secção encontra-se a listagem dos documentos para a fase <b>{{$fasestock->descricao}}</b>. Pode acrescentar documentos a esta fase clicando no botão <b>Adicionar documento</b>.
            </div>
            <div class="modal-footer mt-3">
                <a data-dismiss="modal" class="mr-4 font-weight-bold" id="close-option">Fechar</a>
                <button type="button" data-dismiss="modal" class="btn btn-primary font-weight-bold mr-2">Entendido!</button>
            </div>
        </div>
    </div>
</div>
<!-- End of Modal for more information  -->

<!-- Modal for delete document -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header pl-4 pb-1 pt-4">
                <h5 class="modal-title text-gray-800 font-weight-bold">Pretende eliminar o documento?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-gray-800 pl-4 pr-5">
                Ao apagar o registo do documento, <b>irá eliminar o mesmo para todo o sempre!</b> Pense duas vezes antes de proceder com a ação.
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
<!-- End of Modal for delete document -->

<!-- Modal for add new document -->
<div class="modal fade" id="addDocument" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header pl-4 pb-1 pt-4">
                <h5 class="modal-title text-gray-800 font-weight-bold">Pretende adicionar um documento?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-group needs-validation mb-0" action="{{route('documentostock.store', $fasestock)}}" method="post" novalidate>
                @csrf
                <div class="modal-body text-gray-800 pl-4 pr-5">
                    <div class="form-row mt-2 mb-3">
                        <div class="col-12">
                            <label for="tipo" class="text-gray-900">Tipo de documento <sup class="text-danger small">&#10033;</sup></label>
                            <select class="custom-select" name="tipo" id="tipo" required>
                                <option selected hidden disabled>Escolha um tipo de documento...</option>
                                <option value="Pessoal">Pessoal</option>
                                <option value="Academico">Academico</option>
                            </select>
                            <div class="invalid-feedback">
                                Oops, parece que algo não está bem...
                            </div>
                        </div>
                    </div>
                    <div class="form-row mb-3">
                        <div class="col-12">
                            <label for="tipoDocumento">Nome do documento <sup class="text-danger small">&#10033;</sup></label>
                            <input type="text" class="form-control" id="tipoDocumento" name="tipoDocumento" placeholder="Insira um nome..." required>
                            <div class="invalid-feedback">
                                Oops, parece que algo não está bem...
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer mt-3">
                    <a data-dismiss="modal" class="mr-4 font-weight-bold" id="close-option">Cancelar</a>
                    <button type="submit" class="btn btn-primary font-weight-bold mr-2">Registar documento</button>
            </form>
        </div>
    </div>
</div>
</div>
<!-- End of Modal for add new document -->

<!-- Modal for edit document -->
<div class="modal fade" id="editDocument" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header pl-4 pb-1 pt-4">
                <h5 class="modal-title text-gray-800 font-weight-bold">Pretende editar um documento?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-group needs-validation mb-0" method="post" novalidate>
                @csrf
                @method("PUT")
                <div class="modal-body text-gray-800 pl-4 pr-5">
                    <div class="form-row mt-2 mb-3">
                        <div class="col-12">
                            <label for="tipo" class="text-gray-900">Tipo de documento <sup class="text-danger small">&#10033;</sup></label>
                            <select class="custom-select" name="tipo" id="tipo" required>
                                <option selected hidden disabled>Escolha um tipo de documento...</option>
                                <option value="Pessoal">Pessoal</option>
                                <option value="Academico">Academico</option>
                            </select>
                            <div class="invalid-feedback">
                                Oops, parece que algo não está bem...
                            </div>
                        </div>
                    </div>
                    <div class="form-row mb-3">
                        <div class="col-12">
                            <label for="tipoDocumento">Nome do documento <sup class="text-danger small">&#10033;</sup></label>
                            <input type="text" class="form-control" id="tipoDocumento" name="tipoDocumento" placeholder="Insira um nome..." required>
                            <div class="invalid-feedback">
                                Oops, parece que algo não está bem...
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer mt-3">
                    <a data-dismiss="modal" class="mr-4 font-weight-bold" id="close-option">Cancelar</a>
                    <button type="submit" class="btn btn-primary font-weight-bold mr-2">Editar documento</button>
            </form>
        </div>
    </div>
</div>
</div>
<!-- End of Modal for edit document -->

<!-- Begin of Scripts -->
@section('scripts')
<script>
    $(document).ready(function() {
        bsCustomFileInput.init();
        $(".needs-validation").submit(function(event) {
            if (this.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
            } else {
                $("#cancelBtn").removeAttr("onclick");
                button =
                    "<button class='btn btn-primary' type='submit' disabled><span class='spinner-border spinner-border-sm' role='status' aria-hidden='true' style='position:relative; bottom:4px; right:3px;'></span>A fazer o registo...</button>";
                $("#groupBtn").append(button);
                $("#submitbtn").remove();
            }
            $(".needs-validation").addClass("was-validated");
        });

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

        // Modal for DELETE
        $('#deleteModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var modal = $(this);
            modal.find("form").attr('action', '/documentostock/' + button.data('slug'));
        });

        // Modal for EDIT
        $('#editDocument').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var modal = $(this);
            modal.find("form").attr('action', '/documentostock/' + button.data('slug'));
            modal.find("form #tipoDocumento").val(button.data('name'));
            option = "<option selected hidden disabled value='"+button.data('tipo')+"'>"+button.data('tipo')+"</option>";
            modal.find("form #tipo").prepend(option);
        });
    });
</script>
@endsection
<!-- End of Scripts -->
@endsection
<!-- End of Page Content -->
