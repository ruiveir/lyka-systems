@extends('layout.master')
<!-- Page Title -->
@section('title', 'Edição de um pagamento')
<!-- Page Content -->
@section('content')
<!-- Begin Page Content -->
<!-- Begin of container-fluid -->
<div class="container-fluid">
	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h4 mb-0 text-gray-800">Edição de um pagamento</h1>
		<div>
			<button data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-icon-split btn-sm" title="Anular pagamento">
				<span class="icon text-white-50">
					<i class="fas fa-trash-alt"></i>
				</span>
				<span class="text">Anular pagamento</span>
			</button>
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
		@if (isset($cliente))
		<!-- Registar pagamento CLIENTE -->
		@include('payments.partials.edit.edit-cliente')
		@elseif (isset($agente))
		<!-- Registar pagamento AGENTE -->
		@include('payments.partials.edit.edit-agente')
		@elseif (isset($universidade1))
		<!-- Registar pagamento UNIVERSIDADE1 -->
		@include('payments.partials.edit.edit-uniprincipal')
		@elseif (isset($fornecedor))
		<!-- Registar pagamento FORNECEDOR -->
		@include('payments.partials.edit.edit-fornecedor')
		@endif

		<!-- Mensagens informativas - MODAL -->
		@include('payments.partials.modal.modal-success')
		@include('payments.partials.modal.modal-error')
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
				Aqui, basta preencher o formulário para fazer a edição de um pagamento. Após submeter o formulário poderá ficar com uma nota de pagamento na sua posse.
			</div>
			<div class="modal-footer mt-3">
				<a data-dismiss="modal" class="mr-4 font-weight-bold" id="close-option">Fechar</a>
				<button type="button" data-dismiss="modal" class="btn btn-primary font-weight-bold mr-2">Entendido!</button>
			</div>
		</div>
	</div>
</div>
<!-- End of Modal Info -->

<!-- Modal Info -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header pl-4 pb-1 pt-4">
				<h5 class="modal-title text-gray-800 font-weight-bold">Pretende anular o pagamento?</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-button">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body text-gray-800 pl-4 pr-5">
				Ao anular o registo deste pagamento, <b>irá anulá-lo o mesmo para todo o sempre!</b> Pense duas vezes antes de proceder com a ação.
			</div>
			<div class="modal-footer mt-3">
				<form method="post">
					@csrf
					@method('DELETE')
					<a data-dismiss="modal" class="mr-4 font-weight-bold" id="close-option">Cancelar</a>
					<button type="submit" class="btn btn-danger font-weight-bold mr-2">Eliminar</button>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- End of Modal Info -->


<!-- Begin of Scripts -->
@section('scripts')
	<script>
		var idResponsabilidade = {!! $responsabilidade->idResponsabilidade !!};
		var idPagoResp = {!! $pagoResponsabilidade->idPagoResp !!};
	</script>
	<script src="{{asset('/js/payments/edit.js')}}"></script>
@endsection
<!-- End of Scripts -->
@endsection
<!-- End of Page Content -->
