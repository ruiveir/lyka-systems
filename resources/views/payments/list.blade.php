@extends('layout.master')
<!-- Page Title -->
@section('title', 'Pagamentos')
<!-- Page Content -->
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h4 mb-0 text-gray-800">Listagem de pagamentos</h1>
		<div>
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
			<div class="row d-flex justify-content-between align-items-center">
				<div class="col-md-6">
					<h6 class="m-0 font-weight-bold text-primary align-middle">Listagem de pagamentos da Estudar Portugal</h6>
				</div>
				@if (isset($responsabilidades))
					<div class="mr-3">
						<span class="p-2 px-3 border bg-light">
							<small>
								<span class="mx-1">{{$responsabilidadesPendentes}} Pendente(s)</span><span class="mx-1">|</span>
								<span class="mx-1">{{$responsabilidadesPagas}} Pago(s)</span><span class="mx-1">|</span>
								<span class="mx-1">{{$responsabilidadesDivida}} Vencido(s)</span>
							</small>
						</span>
					</div>
				@endif
			</div>
		</div>
		<div class="card-body">
			<div class="table-responsive p-1">
				@if($responsabilidades)
				<table class="table table-sm table-bordered table-striped" id="table" width="100%">
					<thead>
						<tr>
							<th class="align-middle">Nome</th>
							<th class="align-middle">Tipo</th>
							<th class="align-middle">Valor</th>
							<th class="align-middle">Data de Vencimento</th>
							<th class="align-middle">Estado</th>
							<th class="align-middle" style="max-width:100px; min-width:100px;">Opções</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($responsabilidades as $responsabilidade)
						<!-- Begin of payments for CLIENTS -->
						@if ($responsabilidade->valorCliente != null)
						<tr>
							<td class="align-middle">{{$responsabilidade->cliente->nome.' '.$responsabilidade->cliente->apelido}}</td>
							<td class="align-middle">Estudante</td>
							<td class="align-middle">{{number_format((float) $responsabilidade->valorCliente, 2, ',', '').'€'}}</td>
							<td class="align-middle">{{date('d/m/Y', strtotime($responsabilidade->dataVencimentoCliente))}}</td>
							<td class="align-middle @if(!$responsabilidade->verificacaoPagoCliente && $responsabilidade->dataVencimentoCliente < $currentdate) text-danger font-weight-bold @elseif ($responsabilidade->verificacaoPagoCliente) text-success font-weight-bold @else font-weight-bold text-gray @endif">
							@if (!$responsabilidade->verificacaoPagoCliente && $responsabilidade->dataVencimentoCliente < $currentdate)
								Vencido
							@elseif (!$responsabilidade->verificacaoPagoCliente && $responsabilidade->dataVencimentoCliente > $currentdate)
								Pendente
							@elseif ($responsabilidade->verificacaoPagoCliente)
								Pago
							@endif
							</td>
							<td class="text-center align-middle">
								@if($responsabilidade->pagoResponsabilidade && $responsabilidade->verificacaoPagoCliente)
									<button class="btn btn-sm btn-outline-dark text-gray-900" disabled><i class="fas fa-check"></i></button>
									<a href="{{route('payments.showcliente', [$responsabilidade->cliente, $responsabilidade->fase, $responsabilidade, $responsabilidade->pagoResponsabilidade])}}" class="btn btn-sm btn-outline-primary" title="Visualizar"><i class="far fa-eye"></i></a>
									<a href="{{route('payments.editcliente', [$responsabilidade->cliente, $responsabilidade->fase, $responsabilidade, $responsabilidade->pagoResponsabilidade])}}" class="btn btn-sm btn-outline-warning" title="Editar"><i class="fas fa-pencil-alt"></i></a>
								@else
									<a href="{{route('payments.cliente', [$responsabilidade->cliente, $responsabilidade->fase, $responsabilidade])}}" class="btn btn-sm btn-outline-success" title="Registar"><i class="fas fa-check"></i></a>
									<button class="btn btn-sm btn-outline-dark text-gray-900" disabled><i class="far fa-eye"></i></button>
									<button class="btn btn-sm btn-outline-dark text-gray-900" disabled><i class="fas fa-pencil-alt"></i></button>
								@endif
							</td>
						</tr>
						@endif
						<!-- End of payments for CLIENTS -->

						<!-- Begin of payments for AGENTS -->
						@if ($responsabilidade->valorAgente != null)
						<tr>
							<td class="align-middle">{{$responsabilidade->agente->nome.' '.$responsabilidade->agente->apelido}}</td>
							<td class="align-middle">Agente</td>
							<td class="align-middle">{{number_format((float) $responsabilidade->valorAgente, 2, ',', '').'€'}}</td>
							<td class="align-middle">{{date('d/m/Y', strtotime($responsabilidade->dataVencimentoAgente))}}</td>
							<td class="align-middle @if($responsabilidade->verificacaoPagoAgente == false && $responsabilidade->dataVencimentoAgente < $currentdate) text-danger font-weight-bold @elseif ($responsabilidade->verificacaoPagoAgente == true) text-success font-weight-bold @else text-gray @endif">
							@if ($responsabilidade->verificacaoPagoAgente == false && $responsabilidade->dataVencimentoAgente < $currentdate)
								Vencido
							@elseif ($responsabilidade->verificacaoPagoAgente == false && $responsabilidade->dataVencimentoAgente > $currentdate)
								Pendente
							@elseif ($responsabilidade->verificacaoPagoAgente == true)
								Pago
							@endif
							</td>
							<td class="text-center align-middle">
								@if($responsabilidade->pagoResponsabilidade && $responsabilidade->verificacaoPagoAgente)
									<button class="btn btn-sm btn-outline-dark text-gray-900" disabled><i class="fas fa-check"></i></button>
									<a href="{{route('payments.showagente', [$responsabilidade->agente, $responsabilidade->fase, $responsabilidade, $responsabilidade->pagoResponsabilidade])}}" class="btn btn-sm btn-outline-primary" title="Visualizar"><i class="far fa-eye"></i></a>
									<a href="{{route('payments.editagente', [$responsabilidade->agente, $responsabilidade->fase, $responsabilidade, $responsabilidade->pagoResponsabilidade])}}" class="btn btn-sm btn-outline-warning" title="Editar"><i class="fas fa-pencil-alt"></i></a>
								@else
									<a href="{{route('payments.agente', [$responsabilidade->agente, $responsabilidade->fase, $responsabilidade])}}" class="btn btn-sm btn-outline-success" title="Registar"><i class="fas fa-check"></i></a>
									<button class="btn btn-sm btn-outline-dark text-gray-900" disabled><i class="far fa-eye"></i></button>
									<button class="btn btn-sm btn-outline-dark text-gray-900" disabled><i class="fas fa-pencil-alt"></i></button>
								@endif
							</td>
						</tr>
						@endif
						<!-- End of payments for AGENTS -->

						<!-- Begin of payments for UNI1 -->
						@if ($responsabilidade->valorUniversidade1 != null)
						<tr>
							<td class="align-middle">{{$responsabilidade->universidade1->nome.' '.$responsabilidade->universidade1->apelido}}</td>
							<td class="align-middle">Universidade</td>
							<td class="align-middle">{{number_format((float) $responsabilidade->valorUniversidade1, 2, ',', '').'€'}}</td>
							<td class="align-middle">{{date('d/m/Y', strtotime($responsabilidade->dataVencimentoUni1))}}</td>
							<td class="align-middle @if($responsabilidade->verificacaoPagoUni1 == false && $responsabilidade->dataVencimentoUni1 < $currentdate) text-danger font-weight-bold @elseif ($responsabilidade->verificacaoPagoUni1 == true) text-success font-weight-bold @else text-gray @endif">
							@if ($responsabilidade->verificacaoPagoUni1 == false && $responsabilidade->dataVencimentoUni1 < $currentdate)
								Vencido
							@elseif ($responsabilidade->verificacaoPagoUni1 == false && $responsabilidade->dataVencimentoUni1 > $currentdate)
								Pendente
							@elseif ($responsabilidade->verificacaoPagoUni1 == true)
								Pago
							@endif
							</td>
							<td class="text-center align-middle">
								@if($responsabilidade->pagoResponsabilidade && $responsabilidade->verificacaoPagoUni1)
									<button class="btn btn-sm btn-outline-dark text-gray-900" disabled><i class="fas fa-check"></i></button>
									<a href="{{route('payments.showuni1', [$responsabilidade->universidade1, $responsabilidade->fase, $responsabilidade, $responsabilidade->pagoResponsabilidade])}}" class="btn btn-sm btn-outline-primary" title="Visualizar"><i class="far fa-eye"></i></a>
									<a href="{{route('payments.edituni1', [$responsabilidade->universidade1, $responsabilidade->fase, $responsabilidade, $responsabilidade->pagoResponsabilidade])}}" class="btn btn-sm btn-outline-warning" title="Editar"><i class="fas fa-pencil-alt"></i></a>
								@else
									<a href="{{route('payments.uni1', [$responsabilidade->universidade1, $responsabilidade->fase, $responsabilidade])}}" class="btn btn-sm btn-outline-success" title="Registar"><i class="fas fa-check"></i></a>
									<button class="btn btn-sm btn-outline-dark text-gray-900" disabled><i class="far fa-eye"></i></button>
									<button class="btn btn-sm btn-outline-dark text-gray-900" disabled><i class="fas fa-pencil-alt"></i></button>
								@endif
							</td>
						</tr>
						@endif
						<!-- End of payments for UNI1 -->

						<!-- Begin of payments for PROVIDER -->
						@foreach ($responsabilidade->relacao as $relacao)
						<tr>
							<td class="align-middle">{{$relacao->fornecedor->nome}}</td>
							<td class="align-middle">Fornecedor</td>
							<td class="align-middle">{{number_format((float) $relacao->valor, 2, ',', '').'€'}}</td>
							<td class="align-middle">{{date('d/m/Y', strtotime($relacao->dataVencimento))}}</td>
							<td class="align-middle @if($relacao->verificacaoPago == false && $relacao->estado == "Dívida") text-danger font-weight-bold @elseif ($relacao->verificacaoPago == true) text-success font-weight-bold @else text-gray @endif">
							@if ($relacao->verificacaoPago == false && $relacao->estado == "Dívida")
								Vencido
							@elseif ($relacao->verificacaoPago == false && $relacao->estado == "Pendente")
								Pendente
							@elseif ($relacao->verificacaoPago == true && $relacao->estado == "Pago")
								Pago
							@endif
							</td>
							<td class="text-center align-middle">
								@if($responsabilidade->pagoResponsabilidade && $relacao->verificacaoPago)
									<button class="btn btn-sm btn-outline-dark text-gray-900" disabled><i class="fas fa-check"></i></button>
									<a href="{{route('payments.showfornecedor', [$relacao->fornecedor, $relacao->responsabilidade->fase, $relacao, $responsabilidade->pagoResponsabilidade])}}" class="btn btn-sm btn-outline-primary" title="Visualizar"><i class="far fa-eye"></i></a>
									<a href="{{route('payments.editfornecedor', [$relacao->fornecedor, $relacao->responsabilidade->fase, $relacao, $responsabilidade->pagoResponsabilidade])}}" class="btn btn-sm btn-outline-warning" title="Editar"><i class="fas fa-pencil-alt"></i></a>
								@else
									<a href="{{route('payments.fornecedor', [$relacao->fornecedor, $relacao->responsabilidade->fase, $relacao])}}" class="btn btn-sm btn-outline-success" title="Registar"><i class="fas fa-check"></i></a>
									<button class="btn btn-sm btn-outline-dark text-gray-900" disabled><i class="far fa-eye"></i></button>
									<button class="btn btn-sm btn-outline-dark text-gray-900" disabled><i class="fas fa-pencil-alt"></i></button>
								@endif
							</td>
						</tr>
						@endforeach
						<!-- End of payments for PROVIDER -->
						@endforeach
					</tbody>
				</table>
				@endif
			</div>
		</div>
	</div>
</div>
<!-- End of container-fluid -->

<!-- Modal for more information -->
<div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header pl-4 pb-1 pt-4">
				<h5 class="modal-title text-gray-800 font-weight-bold">Para que serve?</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-button">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body text-gray-800 pl-4 pr-5">
				Nesta secção encontra-se todos os pagamentos da Estudar Portugal. Pode registar um pagamento e mais tarde editá-lo ou visualizar os seus detalhes.
			</div>
			<div class="modal-footer mt-3">
				<a data-dismiss="modal" class="mr-4 font-weight-bold" id="close-option">Fechar</a>
				<button type="button" data-dismiss="modal" class="btn btn-primary font-weight-bold mr-2">Entendido!</button>
			</div>
		</div>
	</div>
</div>
<!-- End of Modal for more information  -->

<!-- Begin of Scripts -->
@section('scripts')
	<script src="{{asset('/js/date-eu.js')}}"></script>
	<script src="{{asset('/js/payments/add.js')}}"></script>
@endsection
<!-- End of Scripts -->
@endsection
