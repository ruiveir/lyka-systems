@extends('layout.master')
<!-- Page Title -->
@section('title', 'Registo do pagamento')
<!-- Page Content -->
@section('content')
<!-- Begin Page Content -->
<!-- Begin of container-fluid -->
<div class="container-fluid">
    @if (isset($cliente))
    <!-- Registar pagamento CLIENTE -->
    @include('payments.partials.show.add-cliente')
    @elseif (isset($agente))
    <!-- Registar pagamento AGENTE -->
    @include('payments.partials.show.show-agente')
    @elseif (isset($subagente))
    <!-- Registar pagamento SUBAGENTE -->
    @include('payments.partials.show.show-subagente')
    @elseif (isset($universidade1))
    <!-- Registar pagamento UNIVERSIDADE1 -->
    @include('payments.partials.show.show-uniprincipal')
    @elseif (isset($universidade2))
    <!-- Registar pagamento UNIVERSIDADE2 -->
    @include('payments.partials.show.show-unisecundaria')
    @elseif (isset($fornecedor))
    <!-- Registar pagamento FORNECEDOR -->
    @include('payments.partials.show.show-fornecedor')
    @endif
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
                Aqui pode visualizar os detalhes de um registo de pagamento. Pode, igualmente, transferir uma <b>nota de pagamento</b> e/ou o <b>comprovativo</b> do mesmo.
            </div>
            <div class="modal-footer mt-3">
                <a data-dismiss="modal" class="mr-4 font-weight-bold" id="close-option">Fechar</a>
                <button type="button" data-dismiss="modal" class="btn btn-primary font-weight-bold mr-2">Entendido!</button>
            </div>
        </div>
    </div>
</div>
<!-- End of Modal Info -->
@endsection
<!-- End of Page Content -->
