@extends('layout.master')
<!-- Page Title -->
@section('title', 'Visualização do fornecedor')
<!-- Page Content -->
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800">Visualização de um fornecedor</h1>
        <div>
            <a href="{{route('provider.edit', $provider)}}" class="btn btn-success btn-icon-split btn-sm" title="Editar">
                <span class="icon text-white-50">
                    <i class="fas fa-pencil-alt"></i>
                </span>
                <span class="text">Editar fornecedor</span>
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
            <h6 class="m-0 font-weight-bold text-primary">Visualização do fornecedor: {{$provider->nome}}</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p class="text-gray-800"><b>Nome do fornecedor:</b> @if($provider->nome != null) {{$provider->nome}} @else N/A @endif</p>
                </div>
                <div class="col-md-6">
                    <p class="text-gray-800"><b>Descrição do fornecedor:</b> @if($provider->descricao != null) {{$provider->descricao}} @else N/A @endif</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <p class="text-gray-800"><b>Contacto:</b> @if($provider->contacto != null) {{$provider->contacto}} @else N/A @endif</p>
                </div>
                <div class="col-md-6">
                    <p class="text-gray-800"><b>Morada:</b> @if($provider->morada != null) {{$provider->morada}} @else N/A @endif</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <p class="text-gray-800"><b>Observações:</b> @if($provider->observacoes != null) {{$provider->observacoes}} @else N/A @endif</p>
                </div>
            </div>
            <hr>
            <p class="text-gray-800"><b>Data de registo:</b> {{date('d/m/Y', strtotime($provider->created_at))}}</p>
            <p class="text-gray-800"><b>Última atualização:</b> @if($provider->updated_at != null) {{date('d/m/Y', strtotime($provider->updated_at))}} @else N/A @endif</p>
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
                Aqui apenas pode visualizar os detalhes do fornecedor. Para editar os dados da conta, clique no botão <b>Editar fornecedor</b>.
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
