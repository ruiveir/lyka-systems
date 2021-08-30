@extends('layout.master')
<!-- Page Title -->
@section('title', 'Visualização da conta bancária')
<!-- Page Content -->
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h4 mb-0 text-gray-800">Visualização de uma conta bancária</h1>
		<div>
			<a href="{{route('conta.edit', $conta)}}" class="btn btn-success btn-icon-split btn-sm" title="Editar">
				<span class="icon text-white-50">
					<i class="fas fa-pencil-alt"></i>
				</span>
				<span class="text">Editar conta bancária</span>
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
			<h6 class="m-0 font-weight-bold text-primary">Visualização da conta bancária: {{$conta->descricao}}</h6>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-md-6">
					<p class="text-gray-800"><b>Instituição bancária:</b> @if($conta->instituicao != null) {{$conta->instituicao}} @else N/A @endif</p>
				</div>
				<div class="col-md-6">
					<p class="text-gray-800"><b>Descrição de conta:</b> @if($conta->descricao != null) {{$conta->descricao}} @else N/A @endif</p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<p class="text-gray-800"><b>Titular de conta:</b> @if($conta->titular != null) {{$conta->titular}} @else N/A @endif</p>
				</div>
				<div class="col-md-6">
					<p class="text-gray-800"><b>Morada da instituição:</b> @if($conta->morada != null) {{$conta->morada}} @else N/A @endif</p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<p class="text-gray-800"><b>Número de conta:</b> @if($conta->numConta != null) {{$conta->numConta}} @else N/A @endif</p>
				</div>
				<div class="col-md-6">
					<p class="text-gray-800"><b>Código IBAN:</b> @if($conta->IBAN != null) {{$conta->IBAN}} @else N/A @endif</p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<p class="text-gray-800"><b>Código SWIFT:</b> @if($conta->SWIFT != null) {{$conta->SWIFT}} @else N/A @endif</p>
				</div>
				<div class="col-md-6">
					<p class="text-gray-800"><b>Contacto:</b> @if($conta->contacto != null) {{$conta->contacto}} @else N/A @endif</p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<p class="text-gray-800"><b>Observações:</b> @if($conta->obsConta != null) {{$conta->obsConta}} @else N/A @endif</p>
				</div>
			</div>
			<hr>
			<p class="text-gray-800"><b>Data de registo:</b> {{date('d/m/Y', strtotime($conta->created_at))}}</p>
			<p class="text-gray-800"><b>Última atualização:</b> @if($conta->updated_at != null) {{date('d/m/Y', strtotime($conta->updated_at))}} @else N/A @endif</p>
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
				Aqui apenas pode visualizar os detalhes da conta bancária. Para editar os dados da conta, clique no botão <b>Editar conta bancária</b>.
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
