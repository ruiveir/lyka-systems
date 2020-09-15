@extends('layout.master')
<!-- Page Title -->
@section('title', 'Visualização de uma cobrança')
<!-- Page Content -->
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800">Visualização de uma cobrança</h1>
        <div>
            <a href="{{route('charges.edit', [$product, $fase, $docTransacao])}}" class="btn btn-success btn-icon-split btn-sm" title="Editar">
                <span class="icon text-white-50">
                    <i class="fas fa-pencil-alt"></i>
                </span>
                <span class="text">Editar cobrança</span>
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
            <h6 class="m-0 font-weight-bold text-primary">Visualização da cobrança sobre a fase {{$fase->descricao}} do cliente {{$product->cliente->nome.' '.$product->cliente->apelido}}.</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p class="text-gray-800"><b>Descrição da cobrança:</b> @if($docTransacao->descricao != null) {{$docTransacao->descricao}} @else N/A @endif</p>
                </div>
                <div class="col-md-6">
                    <p class="text-gray-800"><b>Valor recebido:</b> @if($docTransacao->valorRecebido != null) {{number_format((float)$docTransacao->valorRecebido, 2, ',', '').'€'}} @else N/A @endif</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <p class="text-gray-800"><b>Data da operação:</b> @if($docTransacao->dataOperacao != null) {{date('d/m/Y', strtotime($docTransacao->dataOperacao))}} @else N/A @endif</p>
                </div>
                <div class="col-md-6">
                    <p class="text-gray-800"><b>Data de recebimento:</b> @if($docTransacao->dataRecebido != null) {{date('d/m/Y', strtotime($docTransacao->dataRecebido))}} @else N/A @endif</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <p class="text-gray-800"><b>Tipo de pagamento:</b> @if($docTransacao->tipoPagamento != null) {{$docTransacao->tipoPagamento}} @else N/A @endif</p>
                </div>
                <div class="col-md-6">
                    <p class="text-gray-800"><b>Comprovativo de pagamento:</b> @if($docTransacao->comprovativoPagamento != null) <a href="{{route("charges.download", $docTransacao)}}">{{$docTransacao->comprovativoPagamento}}</a> @else N/A @endif</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <p class="text-gray-800"><b>Conta bancária:</b> @if($docTransacao->idConta != null) {{$docTransacao->conta->descricao}} @else N/A @endif</p>
                </div>
                <div class="col-md-6">
                    <p class="text-gray-800"><b>Observações:</b> @if($docTransacao->observacoes != null) {{$docTransacao->observacoes}} @else N/A @endif</p>
                </div>
            </div>
            <hr>
            <p class="text-gray-800"><b>Data de registo:</b> {{date('d/m/Y', strtotime($docTransacao->created_at))}}</p>
            <p class="text-gray-800"><b>Última atualização:</b> @if($docTransacao->updated_at != null) {{date('d/m/Y', strtotime($docTransacao->updated_at))}} @else N/A @endif</p>
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
                Aqui apenas pode visualizar os detalhes da cobrança. Para editar os dados da cobrança, clique no botão <b>Editar cobrança</b>.
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
