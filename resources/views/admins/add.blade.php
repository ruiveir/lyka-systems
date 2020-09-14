@extends('layout.master')
<!-- Page Title -->
@section('title', 'Adicionar administrador')
<!-- Page Content -->
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800">Novo administrador</h1>
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
            <h6 class="m-0 font-weight-bold text-primary">Formulário de criação de um administrador</h6>
        </div>
        <div class="card-body">
            <form class="form-group needs-validation" action="{{route('admin.store')}}" method="POST" novalidate>
                @csrf
                <div class="container-fluid">
                    <div class="form-row mb-3">
                        <div class="col-md-6 mb-3">
                            <label for="nome" class="text-gray-900">Nome próprio <sup class="text-danger small">&#10033;</sup> </label>
                            <input type="text" class="form-control" name="nome" id="nome" placeholder="Inserir uma nome..." value="{{old('nome', $admin->nome)}}" required>
                            <div class="invalid-feedback">
                                Oops, parece que algo não está bem...
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="apelido" class="text-gray-900">Apelido <sup class="text-danger small">&#10033;</sup> </label>
                            <input type="text" class="form-control" name="apelido" id="apelido" placeholder="Inserir uma apelido..." value="{{old('apelido', $admin->apelido)}}" required>
                            <div class="invalid-feedback">
                                Oops, parece que algo não está bem...
                            </div>
                        </div>
                    </div>
                    <div class="form-row mb-3">
                        <div class="col-md-6 mb-3">
                            <label for="email" class="text-gray-900">Endereço eletrónico <sup class="text-danger small">&#10033;</sup></label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Inserir um email..." value="{{old('email', $admin->email)}}" required>
                            <div class="invalid-feedback">
                                Oops, parece que algo não está bem...
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="dataNasc" class="text-gray-900">Data de nascimento <sup class="text-danger small">&#10033;</sup></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                </div>
                                <input type="date" class="form-control" name="dataNasc" id="dataNasc" value="{{old('dataNasc', $admin->dataNasc)}}" required>
                                <div class="invalid-feedback">
                                    Oops, parece que algo não está bem...
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row mb-3">
                        <div class="col-md-6 mb-3">
                            <label for="telefone1" class="text-gray-900">Número de telemóvel <sup class="text-danger small">&#10033;</sup></label>
                            <input type="text" class="form-control" name="telefone1" id="telefone1" placeholder="Inserir um número..." value="{{old('telefone1', $admin->telefone1)}}" required>
                            <div class="invalid-feedback">
                                Oops, parece que algo não está bem...
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="telefone2" class="text-gray-900">Número de tel. secundário</label>
                            <input type="text" class="form-control" name="telefone2" id="telefone2" placeholder="Inserir número secundário..." value="{{old('telefone2', $admin->telefone2)}}">
                            <div class="invalid-feedback">
                                Oops, parece que algo não está bem...
                            </div>
                        </div>
                    </div>
                    <div class="form-row mb-3">
                        <div class="col-md-6 mb-3">
                            <label for="genero" class="text-gray-900">Género do administrador <sup class="text-danger small">&#10033;</sup></label>
                            <select class="custom-select" name="genero" id="genero" value="{{old('genero', $admin->genero)}}" required>
                                <option selected disabled hidden>Escolher género...</option>
                                <option value="M">Masculino</option>
                                <option value="F">Feminino</option>
                            </select>
                            <div class="invalid-feedback">
                                Oops, parece que algo não está bem...
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="superAdmin" class="text-gray-900">Cargo do administrador <sup class="text-danger small">&#10033;</sup></label>
                            <select class="custom-select" name="superAdmin" id="superAdmin" value="{{old('superAdmin', $admin->superAdmin)}}" required>
                                <option selected disabled hidden>Escolher cargo...</option>
                                <option value="0">Regular</option>
                                <option value="1">Total</option>
                            </select>
                            <div class="invalid-feedback">
                                Oops, parece que algo não está bem...
                            </div>
                        </div>
                    </div>
                    <div class="text-right mt-3" id="groupBtn">
                        <span class="mr-4 font-weight-bold" onclick="window.history.back();" id="cancelBtn" style="cursor:pointer;">Cancelar</span>
                        <button type="submit" name="button" class="btn btn-primary text-white font-weight-bold" id="submitbtn">Registar administrador</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of container-fluid -->

<!-- Modal Info -->
<div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header pl-4 pb-1 pt-4">
                <h5 class="modal-title text-gray-800 font-weight-bold">Para que serve?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-gray-800 pl-4 pr-5">
                Ao preencher o formulário irá criar um novo administrador. Os campos com o asterisco de cor vermelha são de preenchimento obrigatório.
            </div>
            <div class="modal-footer mt-3">
                <a data-dismiss="modal" class="mr-4 font-weight-bold" id="close-option">Fechar</a>
                <button type="button" data-dismiss="modal" class="btn btn-primary font-weight-bold mr-2">Entendido!</button>
            </div>
        </div>
    </div>
</div>
<!-- End of Modal Info -->

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
    });
</script>
@endsection
<!-- End of Scripts -->
@endsection
<!-- End of Page Content -->
