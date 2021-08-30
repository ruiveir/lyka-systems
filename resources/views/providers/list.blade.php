@extends('layout.master')
<!-- Page Title -->
@section('title', 'Fornecedores')
<!-- Page Content -->
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h4 mb-0 text-gray-800">Fornecedores</h1>
		<div>
			<a href="{{route('provider.create')}}" class="btn btn-primary btn-icon-split btn-sm" title="Adicionar">
				<span class="icon text-white-50">
					<i class="fas fa-plus"></i>
				</span>
				<span class="text">Adicionar fornecedor</span>
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
			<h6 class="m-0 font-weight-bold text-primary">Listagem - Fornecedores</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive p-1">
				<table class="table table-bordered table-striped" id="table" width="100%">
					<thead>
						<tr>
							<th>Nome</th>
							<th>Morada</th>
							<th>Contacto</th>
							<th style="max-width:100px; min-width:100px;">Opções</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($providers as $provider)
						<tr>
							<td>{{$provider->nome}}</td>
							<td>{{$provider->morada}}</td>
							<td>{{$provider->contacto}}</td>
							<td class="text-center align-middle">
								<a href="{{route("provider.show", $provider)}}" class="btn btn-sm btn-outline-primary" title="Ficha completa"><i class="far fa-eye"></i></a>
								<a href="{{route("provider.edit", $provider)}}" class="btn btn-sm btn-outline-warning" title="Editar"><i class="fas fa-pencil-alt"></i></a>
								<button data-toggle="modal" data-target="#deleteModal" data-slug="{{$provider->slug}}" class="btn btn-sm btn-outline-danger" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
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
				Nesta secção encontram-se as listagens dos fornecedores da Estudar Portugal. Pode acrescentar mais clicando no botão <b>Adicionar fornecedor</b>.
			</div>
			<div class="modal-footer mt-3">
				<a data-dismiss="modal" class="mr-4 font-weight-bold" id="close-option">Fechar</a>
				<button type="button" data-dismiss="modal" class="btn btn-primary font-weight-bold mr-2">Entendido!</button>
			</div>
		</div>
	</div>
</div>
<!-- End of Modal for more information  -->

<!-- Modal for delete report -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header pl-4 pb-1 pt-4">
				<h5 class="modal-title text-gray-800 font-weight-bold">Pretende eliminar o fornecedor?</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-button">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body text-gray-800 pl-4 pr-5">
				Ao apagar o registo de um fornecedor, <b>irá eliminar o mesmo para todo o sempre!</b> Pense duas vezes antes de proceder com a ação.
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
<!-- End of Modal for delete report -->

<!-- Begin of Scripts -->
@section('scripts')
	<script src="{{asset('/js/providers/list.js')}}"></script>
@endsection
<!-- End of Scripts -->
@endsection
<!-- End of Page Content -->
