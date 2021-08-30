@extends('layout.master')
<!-- Page Title -->
@section('title', 'Adicionar conta bancária')
<!-- Page Content -->
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h4 mb-0 text-gray-800">Nova conta bancária</h1>
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
			<h6 class="m-0 font-weight-bold text-primary">Formulário - Criação de uma conta bancária</h6>
		</div>
		<div class="card-body">
			<form class="form-group needs-validation" novalidate action="{{route('conta.store')}}" method="POST">
				@csrf
				<div class="container-fluid">
					<div class="form-row mb-3">
						<div class="col-md-6 mb-3">
							<label for="instituicao" class="text-gray-900">Insituição bancária <sup class="text-danger small">&#10033;</sup> </label>
							<input type="text" class="form-control" name="instituicao" id="instituicao" placeholder="Inserir uma instituição..." value="{{old('instituicao', $conta->instituicao)}}" required>
							<div class="invalid-feedback">
								Oops, parece que algo não está bem...
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<label for="descricao" class="text-gray-900">Descrição da conta <sup class="text-danger small">&#10033;</sup> </label>
							<input type="text" class="form-control" name="descricao" id="descricao" placeholder="Inserir uma descrição..." value="{{old('descricao', $conta->descricao)}}" required>
							<div class="invalid-feedback">
								Oops, parece que algo não está bem...
							</div>
						</div>
					</div>
					<div class="form-row mb-3">
						<div class="col-md-6 mb-3">
							<label for="titular" class="text-gray-900">Titular da conta <sup class="text-danger small">&#10033;</sup></label>
							<input type="text" class="form-control" name="titular" id="titular" placeholder="Inserir um titular..." value="{{old('titular', $conta->titular)}}" required>
							<div class="invalid-feedback">
								Oops, parece que algo não está bem...
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<label for="morada" class="text-gray-900">Morada da instituição</label>
							<input type="text" class="form-control" name="morada" id="morada" placeholder="Inserir uma morada..." value="{{old('morada', $conta->morada)}}">
							<div class="invalid-feedback">
								Oops, parece que algo não está bem...
							</div>
						</div>
					</div>
					<div class="form-row mb-3">
						<div class="col-md-6 mb-3">
							<label for="contacto" class="text-gray-900">Contacto da instituição <sup class="text-danger small">&#10033;</sup></label>
							<input type="text" class="form-control" name="contacto" id="contacto" placeholder="Inserir um contacto..." value="{{old('contacto', $conta->contacto)}}" required>
							<div class="invalid-feedback">
								Oops, parece que algo não está bem...
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<label for="numConta" class="text-gray-900">Número de conta <sup class="text-danger small">&#10033;</sup></label>
							<input type="text" class="form-control" name="numConta" id="numConta" placeholder="Inserir número de conta..." value="{{old('numConta', $conta->numConta)}}" required>
							<div class="invalid-feedback">
								Oops, parece que algo não está bem...
							</div>
						</div>
					</div>
					<div class="form-row mb-3">
						<div class="col-md-6 mb-3">
							<label for="IBAN" class="text-gray-900">Código IBAN <sup class="text-danger small">&#10033;</sup></label>
							<input type="text" class="form-control" name="IBAN" id="IBAN" placeholder="Inserir código IBAN..." value="{{old('IBAN', $conta->IBAN)}}" required>
							<div class="invalid-feedback">
								Oops, parece que algo não está bem...
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<label for="SWIFT" class="text-gray-900">Código SWIFT <sup class="text-danger small">&#10033;</sup></label>
							<input type="text" class="form-control" name="SWIFT" id="SWIFT" placeholder="Inserir código SWIFT..." value="{{old('SWIFT', $conta->SWIFT)}}" required>
							<div class="invalid-feedback">
								Oops, parece que algo não está bem...
							</div>
						</div>
					</div>
					<div class="form-row mb-3">
						<div class="col mb-3">
							<label for="obsConta" class="text-gray-900">Observações da conta bancária</label>
							<textarea class="form-control" name="obsConta" id="obsConta" rows="3" placeholder="Inserir uma observação..." value="{{old('obsConta', $conta->obsConta)}}"></textarea>
							<div class="invalid-feedback">
								Oops, parece que algo não está bem...
							</div>
						</div>
					</div>
					<div class="text-right mt-3" id="groupBtn">
						<span class="mr-4 font-weight-bold" onclick="window.history.back();" id="cancelBtn" style="cursor:pointer;">Cancelar</span>
						<button type="submit" name="button" class="btn btn-primary text-white font-weight-bold" id="submitbtn">Registar conta bancária</button>
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
				Ao preencher o formulário irá criar uma nova conta bancária. Os campos com o asterisco de cor vermelha são de preenchimento obrigatório.
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
	<script src="{{asset('/js/conta/add.js')}}"></script>
@endsection
<!-- End of Scripts -->
@endsection
<!-- End of Page Content -->
