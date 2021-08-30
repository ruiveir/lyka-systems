@extends('layout.master')
<!-- Page Title -->
@section('title', 'Secção de cobranças')
<!-- Page Content -->
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h4 mb-0 text-gray-800">Secção de cobranças</h1>
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
			<h6 class="m-0 font-weight-bold text-primary">Listagem de fases com cobranças do cliente {{$product->cliente->nome.' '.$product->cliente->apelido}}.</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive p-1">
				<table class="table table-sm table-bordered table-striped" id="table" width="100%">
					<thead>
						<tr>
							<th class="align-middle">Descrição da fase</th>
							<th class="align-middle">Valor total</th>
							<th class="align-middle">Data de vencimento</th>
							<th class="align-middle" style="max-width:100px; min-width:100px;">Estado</th>
							<th class="align-middle" style="max-width:90px; min-width:90px;">Opções</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($fases as $fase)
						<tr>
							<td class="align-middle text-truncated" title="{{$fase->descricao}}">{{$fase->descricao}}</td>
							<td class="align-middle">{{str_replace('.', ',', $fase->valorFase)}}€</td>
							<td class="align-middle">{{date('d/m/Y', strtotime($fase->dataVencimento))}}</td>
							<td class="align-middle">
							@php
								switch ($fase->estado) {
									case 'Pendente':
										echo "<span class='font-weight-bold'>Pendente</span>";
									break;

									case 'Pago':
										echo "<span class='font-weight-bold text-success'>Pago</span>";
									break;

									case 'Dívida':
										echo "<span class='font-weight-bold text-danger'>Vencido</span>";
									break;

									case 'Crédito':
										echo "<span class='font-weight-bold text-warning'>Crédito</span>";
									break;
								}
							@endphp
							</td>
							<td class="text-center align-middle">
								@if (count($fase->docTransacao))
									<button class="btn btn-sm btn-outline-dark text-gray-900" title="Editar" disabled><i class="fas fa-check"></i></button>
									<a href="{{route("charges.show", [$product, $fase, $fase->docTransacao[0]])}}" class="btn btn-sm btn-outline-primary" title="Ver em detalhe"><i class="far fa-eye"></i></a>
									<a href="{{route("charges.edit", [$product, $fase, $fase->docTransacao[0]])}}" class="btn btn-sm btn-outline-warning" title="Editar"><i class="fas fa-pencil-alt"></i></a>
								@else
									<a href="{{route("charges.create", [$product, $fase])}}" class="btn btn-sm btn-outline-success" title="Registar"><i class="fas fa-check"></i></i></a>
									<button class="btn btn-sm btn-outline-dark text-gray-900" title="Ver em detalhe" disabled><i class="far fa-eye"></i></button>
									<button class="btn btn-sm btn-outline-dark text-gray-900" title="Editar" disabled><i class="fas fa-pencil-alt"></i></button>
								@endif
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
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
				Nesta secção encontra-se a listagem de cobranças de um produto de um cliente. Pode registar uma cobrança, e mais tarde, pode editar ou visualizar a mesma em detalhe.
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
	<script src="{{asset('/js/charges.list-fases.js')}}"></script>
@endsection
<!-- End of Scripts -->
@endsection
<!-- End of Page Content -->
