@extends('layout.master')
<!-- Page Title -->
@section('title', 'Reportar Problema')
<!-- Page Content -->
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800">Reportar problema</h1>
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
            <h6 class="m-0 font-weight-bold text-primary">Formulário - Reportar problema</h6>
        </div>
        <div class="card-body">
            <form class="form-group needs-validation" novalidate action="{{route('report.send')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="container-fluid">
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="nome" class="text-gray-900">Nome completo <sup class="text-danger small">&#10033;</sup> </label>
                            <input type="text" class="form-control" name="nome" id="nome" value="{{$user->nome.' '.$user->apelido}}" required>
                            <div class="invalid-feedback">
                                Oops, parece que algo não está bem...
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="text-gray-900">Endereço eletrónico <sup class="text-danger small">&#10033;</sup> </label>
                            <input type="email" class="form-control" name="email" id="email" value="{{$user->email}}" required>
                            <div class="invalid-feedback">
                                Oops, parece que algo não está bem...
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="telemovel" class="text-gray-900">Número de telemóvel</label>
                            <input type="text" class="form-control" name="telemovel" id="telemovel" value="{{$user->telefone1}}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="screenshot" class="text-gray-900">Captura de ecrã</label>
                            <div class="custom-file mb-3">
                                <input type="file" class="custom-file-input" name="screenshot" id="screenshot">
                                <small class="form-text text-muted">A imagem não deve ultrupassar 2MB.</small>
                                <label class="custom-file-label" for="screenshot" data-browse="Escolher">Escolher ficheiro...</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col mb-3">
                            <label for="relatorio" class="text-gray-900">Descrição do problema <sup class="text-danger small">&#10033;</sup></label>
                            <textarea class="form-control" name="relatorio" id="relatorio" rows="5" required placeholder="Qual é o problema?"></textarea>
                            <div class="invalid-feedback">
                                Oops, parece que algo não está bem...
                            </div>
                        </div>
                    </div>
                    <div class="text-right mt-3" id="groupBtn">
                        <span class="mr-4 font-weight-bold" onclick="window.history.back();" id="cancelBtn" style="cursor:pointer;">Cancelar</span>
                        <button type="submit" name="button" class="btn btn-primary text-white font-weight-bold" id="submitbtn">Enviar relatório</button>
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
                O formulário preenchido será enviado aos administradores para saberem que há problemas com a aplicação. Pedimos que aguarde até uma resposta da nossa parte.
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
                    "<button class='btn btn-primary' type='submit' disabled><span class='spinner-border spinner-border-sm' role='status' aria-hidden='true' style='position:relative; bottom:4px; right:3px;'></span>A enviar...</button>";
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
