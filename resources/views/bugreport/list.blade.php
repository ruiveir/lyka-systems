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
			<h6 class="m-0 font-weight-bold text-primary">Listagem - Relatórios de erros</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive p-1">
				<table class="table table-bordered table-striped" id="table" width="100%">
					<thead>
						<tr>
							<th>Utilizador</th>
							<th>E-mail</th>
							<th>Data de recção</th>
							<th>Estado</th>
							<th style="max-width:100px; min-width:100px;">Opções</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($bugreports as $bugreport)
						<tr>
							<td>{{$bugreport->nome}}</td>
							<td>{{$bugreport->email}}</td>
							<td>{{date('d/m/Y', strtotime($bugreport->created_at))}}</td>
							<td @if($bugreport->estado == "Pendente") class="text-danger font-weight-bold" @elseif($bugreport->estado == "Resolvido") class="text-success font-weight-bold"
									@else class="text-warning font-weight-bold" @endif>{{$bugreport->estado}}</td>
							<td class="text-center align-middle">
								<a href="{{route("bugreport.show", $bugreport)}}" class="btn btn-sm btn-outline-primary" title="Relatório completo"><i class="far fa-eye"></i></a>
								<button data-toggle="modal" data-target="#editModal" data-id="{{$bugreport->idRelatorioProblema}}" class="btn btn-sm btn-outline-warning" title="Editar"><i class="fas fa-pencil-alt"></i></button>
								<button data-toggle="modal" data-target="#deleteModal" data-id="{{$bugreport->idRelatorioProblema}}" class="btn btn-sm btn-outline-danger" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
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
				Nesta secção encontram-se os pedidos de ajuda que os utilizadores enviaram com problemas na aplicação. Deve-se ler e mudar o seu estado aquando resolvidos.
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
				<h5 class="modal-title text-gray-800 font-weight-bold">Pretende eliminar o relatório?</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-button">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body text-gray-800 pl-4 pr-5">
				Ao apagar o relatório de ajuda ao erro, <b>irá eliminar o mesmo para todo o sempre!</b> Pense duas vezes antes de proceder com a ação.
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

<!-- Begin of Scripts -->
@section('scripts')
	<script src="{{asset('/js/bugreport.list.js')}}"></script>
@endsection
<!-- End of Scripts -->
@endsection
<!-- End of Page Content -->
