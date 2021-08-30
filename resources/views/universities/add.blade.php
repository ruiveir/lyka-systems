@extends('layout.master')
<!-- Page Title -->
@section('title', 'Adicionar universidade')
<!-- Page Content -->
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h4 mb-0 text-gray-800">Novo registo de universidade</h1>
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
			<h6 class="m-0 font-weight-bold text-primary">Formulário de criação de uma universidade</h6>
		</div>
		<div class="card-body">
			<form class="form-group needs-validation" action="{{route('universities.store')}}" method="POST" novalidate>
				@csrf
				<div class="container-fluid">
					@include('universities.partials.add-edit')
					<div class="text-right mt-3" id="groupBtn">
						<span class="mr-4 font-weight-bold" onclick="window.history.back();" id="cancelBtn" style="cursor:pointer;">Cancelar</span>
						<button type="submit" name="button" class="btn btn-primary text-white font-weight-bold" id="submitbtn">Registar universidade</button>
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
				Ao preencher o formulário irá criar uma nova universidade. Os campos com o asterisco de cor vermelha são de preenchimento obrigatório.
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
	<script src="{{asset('/js/universities/add.js')}}"></script>
@endsection
<!-- End of Scripts -->
@endsection
<!-- End of Page Content -->
