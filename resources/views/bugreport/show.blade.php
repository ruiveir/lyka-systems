@extends('layout.master')
<!-- Page Title -->
@section('title', 'Relatório de problemas')
<!-- Page Content -->
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h4 mb-0 text-gray-800">Relatório de erros</h1>
		<div>
			<a href="#" data-toggle="modal" data-target="#editModal" data-id="{{$bugreport->idRelatorioProblema}}" class="btn btn-success btn-icon-split btn-sm" title="Editar">
				<span class="icon text-white-50">
					<i class="fas fa-pencil-alt"></i>
				</span>
				<span class="text">Editar relatório</span>
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
			<h6 class="m-0 font-weight-bold text-primary">Visualização - Relatório de erros</h6>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-md-6">
					<p class="text-gray-800"><b>Nome:</b> {{$bugreport->nome}}</p>
				</div>
				<div class="col-md-6">
					<p class="text-gray-800"><b>Endereço eletrónico:</b> {{$bugreport->email}}</p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					@if ($bugreport->telemovel)
					<p class="text-gray-800"><b>Telemóvel:</b> {{$bugreport->telemovel}}</p>
					@else
					<p class="text-gray-800"><b>Telemóvel:</b>N/A</p>
					@endif
				</div>
				<div class="col-md-6">
					<p class="text-gray-800"><b>Estado:</b> <span @if($bugreport->estado == "Pendente") class="text-danger font-weight-bold" @elseif($bugreport->estado == "Resolvido") class="text-success font-weight-bold"
					@else class="text-warning font-weight-bold" @endif>{{$bugreport->estado}}</span></p>
				</div>
			</div>
			@if ($bugreport->screenshot)
			<p class="text-gray-800"><b>Imagem do erro:</b> <a href="{{route("bugreport.download", $bugreport)}}">{{$bugreport->screenshot}}</a></p>
			@endif
			<p class="text-gray-800"><b>Relatório:</b> {{$bugreport->relatorio}}</p>
		</div>
	</div>
</div>

<!-- Modal for edit report -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header pl-4 pb-1 pt-4">
				<h5 class="modal-title text-gray-800 font-weight-bold">Atualizar o estado do pedido.</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-button">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" class="needs-validation" novalidate>
				@csrf
				@method('PUT')
				<div class="modal-body text-gray-800 pl-4 pr-5">
					<p>Escolha a opção que pretende e clique em <b>confirmar</b>.</p>
					<select class="custom-select" id="estado" name="estado" required>
						<option selected disabled hidden>Escolha uma opção</option>
						<option value="Pendente">Pendente</option>
						<option value="Em curso">Em curso</option>
						<option value="Resolvido">Resolvido</option>
					</select>
					<div class="invalid-feedback">
						Oops, parece que algo não está bem...
					</div>
				</div>
				<div class="modal-footer">
					<a data-dismiss="modal" class="mr-4 font-weight-bold" id="close-option">Cancelar</a>
					<button type="submit" class="btn btn-primary font-weight-bold mr-2">Confirmar</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- End of Modal for edit report -->
@section('scripts')
	<script src="{{asset('/js/bugreport.show.js')}}"></script>
@endsection
<!-- End of container-fluid -->
@endsection
<!-- End of Page Content -->
