@extends('layout.master')
<!-- Page Title -->
@section('title', 'Edição do Pagamento')
<!-- Page Content -->
@section('content')
<!-- Begin Page Content -->
<!-- Begin of container-fluid -->
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
            @if (isset($cliente))
            {{-- Registar pagamento CLIENTE --}}
            @include('payments.partials.create.add-cliente')
            @elseif (isset($agente))
            {{-- Registar pagamento AGENTE --}}
            @include('payments.partials.create.add-agente')
            @elseif (isset($subagente))
            {{-- Registar pagamento SUBAGENTE --}}
            @include('payments.partials.create.add-subagente')
            @elseif (isset($universidade1))
            {{-- Registar pagamento UNIVERSIDADE1 --}}
            @include('payments.partials.create.add-uniprincipal')
            @elseif (isset($universidade2))
            {{-- Registar pagamento UNIVERSIDADE2 --}}
            @include('payments.partials.create.add-unisecundaria')
            @elseif (isset($fornecedor))
            {{-- Registar pagamento FORNECEDOR --}}
            @include('payments.partials.create.add-fornecedor')
            @endif

            {{-- Mensagens informativas - MODAL --}}
            @include('payments.partials.modal.modal-success')
            @include('payments.partials.modal.modal-error')
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
