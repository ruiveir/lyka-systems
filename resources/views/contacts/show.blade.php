@extends('layout.master')
<!-- Page Title -->
@section('title', 'Visualização de um contacto')
<!-- Page Content -->
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		@if (isset($university))
			<h1 class="h4 mb-0 text-gray-800">Visualização de um contacto ({{$university->nome}})</h1>
		@else
			<h1 class="h4 mb-0 text-gray-800">Visualização de um contacto</h1>
		@endif
		<div>
			<a href="{{route('contacts.edit', $contact)}}" class="btn btn-success btn-icon-split btn-sm" title="Editar">
				<span class="icon text-white-50">
					<i class="fas fa-pencil-alt"></i>
				</span>
				<span class="text">Editar contacto</span>
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
			@if (isset($university))
				<h6 class="m-0 font-weight-bold text-primary">Visualização do contacto do(a) "{{$contact->nome}}" associado a universidade "{{$university->nome}}".</h6>
			@else
				<h6 class="m-0 font-weight-bold text-primary">Visualização do contacto do(a) "{{$contact->nome}}".</h6>
			@endif
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-md-6">
					<p class="text-gray-800"><b>Nome:</b> @if($contact->nome != null) {{$contact->nome}} @else N/A @endif</p>
				</div>
				<div class="col-md-6">
					<p class="text-gray-800"><b>E-Mail:</b> @if($contact->email != null) {{$contact->email}} @else N/A @endif</p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<p class="text-gray-800"><b>Contacto principal:</b> @if($contact->telefone1 != null) {{$contact->telefone1}} @else N/A @endif</p>
				</div>
				<div class="col-md-6">
					<p class="text-gray-800"><b>Contacto secundário:</b> @if($contact->telefone2 != null) {{$contact->telefone2}} @else N/A @endif</p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<p class="text-gray-800"><b>Fax:</b> @if($contact->fax != null) {{$contact->fax}} @else N/A @endif</p>
				</div>
				<div class="col-md-6">
					<p class="text-gray-800"><b>Favorito:</b> @if($contact->favorito == 1) <span class="font-weight-bold text-success">Sim</span> @else <span class="font-weight-bold text-danger">Não</span> @endif</p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<p class="text-gray-800"><b>Observações:</b> @if($contact->observacao != null) {{$contact->observacao}} @else N/A @endif</p>
				</div>
			</div>
			<hr>
			<p class="text-gray-800"><b>Data de registo:</b> {{date('d/m/Y', strtotime($contact->created_at))}}</p>
			<p class="text-gray-800"><b>Última atualização:</b> @if($contact->updated_at != null) {{date('d/m/Y', strtotime($contact->updated_at))}} @else N/A @endif</p>
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
				Aqui apenas pode visualizar os detalhes do contacto. Para editar os dados do contacto, clique no botão <b>Editar contacto</b>.
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
