@extends('layout.master')
<!-- Page Title -->
@section('title', 'Edição de uma cobrança')
<!-- Page Content -->
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h4 mb-0 text-gray-800">Edição de uma cobrança</h1>
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
			<h6 class="m-0 font-weight-bold text-primary">Formulário de edição da cobrança sobre a fase {{$fase->descricao}} do cliente {{$product->cliente->nome.' '.$product->cliente->apelido}}.</h6>
		</div>
		<div class="card-body">
			<form class="form-group needs-validation" action="{{route('charges.update', [$product, $docTransacao])}}" method="POST" enctype="multipart/form-data" novalidate>
				@csrf
				@method("PUT")
				<div class="container-fluid">
					<div class="form-row mb-3">
						<div class="col-md-6 mb-3">
							<label for="valorRecebido" class="text-gray-900">Valor recebido <sup class="text-danger small">&#10033;</sup> </label>
							<div class="input-group">
								<input type="text" class="form-control" name="valorRecebido" id="valorRecebido" aria-describedby="validatedInputGroupPrepend" value="{{old('valorRecebido', str_replace('.', ',', $docTransacao->valorRecebido))}}" required>
								<div class="input-group-append">
									<span class="input-group-text">€</span>
								</div>
								<div class="invalid-feedback">
									Oops, parece que algo não está bem...
								</div>
							</div>
							<small class="form-text text-muted">Utilizar vírgula para separar decimais.</small>
						</div>
						<div class="col-md-6 mb-3">
							<label for="comprovativoPagamento" class="text-gray-900">Comprovativo de pagamento</label>
							<div class="custom-file mb-3">
								<input type="file" class="custom-file-input" name="comprovativoPagamento" id="comprovativoPagamento">
								<small class="form-text text-muted">O comprovativo não deve ultrupassar 2MB.</small>
								@if($docTransacao->comprovativoPagamento)
									<label class="custom-file-label" for="comprovativoPagamento" data-browse="Escolher">{{old("comprovativoPagamento", $docTransacao->comprovativoPagamento)}}</label>
								@else
									<label class="custom-file-label" for="comprovativoPagamento" data-browse="Escolher">Escolher um comprovativo...</label>
								@endif
							</div>
						</div>
					</div>
					<div class="form-row mb-3">
						<div class="col-md-6 mb-3">
							<label for="tipoPagamento" class="text-gray-900">Tipo de pagamento <sup class="text-danger small">&#10033;</sup></label>
							<select class="custom-select" name="tipoPagamento" id="tipoPagamento" value="{{old('tipoPagamento', $docTransacao->tipoPagamento)}}" required>
								<option value="Multibanco" @if ($docTransacao->tipoPagamento == "Multibanco") selected @endif>Multibanco</option>
								<option value="Paypal" @if ($docTransacao->tipoPagamento == "Paypal") selected @endif>Paypal</option>
								<option value="Outro" @if ($docTransacao->tipoPagamento == "Outro") selected @endif>Outro</option>
							</select>
							<div class="invalid-feedback">
								Oops, parece que algo não está bem...
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<label for="conta" class="text-gray-900">Conta bancária <sup class="text-danger small">&#10033;</sup></label>
							<select class="custom-select" name="conta" id="conta" value="{{old('idConta', $docTransacao->idConta)}}" required>
								@if ($docTransacao->idConta == null)
									@foreach ($contas as $conta)
										<option value="{{$conta->idConta}}">{{$conta->descricao}}</option>
									@endforeach
									<option selected disabled hidden>Escolher conta bancária</option>
								@else
									@foreach ($contas as $conta)
										<option value="{{$conta->idConta}}">{{$conta->descricao}}</option>
									@endforeach
									<option selected value="{{$docTransacao->conta->idConta}}">{{old('conta', $docTransacao->conta->descricao)}}</option>
								@endif
							</select>
							<div class="invalid-feedback">
								Oops, parece que algo não está bem...
							</div>
						</div>
					</div>
					<div class="form-row mb-3">
						<div class="col-md-6 mb-3">
							<label for="dataOperacao" class="text-gray-900">Data de pagamento <sup class="text-danger small">&#10033;</sup></label>
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
								</div>
								<input type="date" class="form-control" name="dataOperacao" id="dataOperacao" value="{{old('dataOperacao', $docTransacao->dataOperacao)}}" required>
								<div class="invalid-feedback">
									Oops, parece que algo não está bem...
								</div>
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<label for="dataRecebido" class="text-gray-900">Data de registo <sup class="text-danger small">&#10033;</sup></label>
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
								</div>
								<input type="date" class="form-control" name="dataRecebido" id="dataRecebido" value="{{old('dataRecebido', $docTransacao->dataRecebido)}}" required>
								<div class="invalid-feedback">
									Oops, parece que algo não está bem...
								</div>
							</div>
						</div>
					</div>
					<div class="form-row mb-3">
						<div class="col mb-3">
							<label for="observacoes" class="text-gray-900">Observações</label>
							<textarea class="form-control" name="observacoes" id="observacoes" rows="3" placeholder="Inserir uma observação..." value="{{old('dataRecebido', $docTransacao->observacoes)}}"></textarea>
							<div class="invalid-feedback">
								Oops, parece que algo não está bem...
							</div>
						</div>
					</div>
					<div class="text-right mt-3" id="groupBtn">
						<span class="mr-4 font-weight-bold" onclick="window.history.back();" id="cancelBtn" style="cursor:pointer;">Cancelar</span>
						<button type="submit" name="button" class="btn btn-primary text-white font-weight-bold" id="submitbtn">Editar cobrança</button>
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
				Ao preencher o formulário irá editar uma cobrança. Os campos com o asterisco de cor vermelha são de preenchimento obrigatório.
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
	<script src="{{asset('/js/charges.edit.js')}}"></script>
@endsection
<!-- End of Scripts -->
@endsection
<!-- End of Page Content -->
