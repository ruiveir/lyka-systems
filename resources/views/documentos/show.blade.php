@extends('layout.master')
<!-- Page Title -->
@section('title', 'Visualização de um documento')
<!-- Page Content -->
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h4 mb-0 text-gray-800">Visualização de um documento</h1>
		<div>
			@if($tipoPAT == 'Pessoal')
				<a href="#" data-toggle="modal" data-target="#deleteModal" data-slug="{{$documento->slug}}" data-tipo="pessoal" class="btn btn-danger btn-icon-split btn-sm" title="Informações">
					<span class="icon text-white-50">
						<i class="fas fa-trash-alt"></i>
					</span>
					<span class="text">Eliminar documento</span>
				</a>
				<a href="{{route('documento-pessoal.edit', [$documento, $documento->cliente])}}" class="btn btn-success btn-icon-split btn-sm" title="Editar">
					<span class="icon text-white-50">
						<i class="fas fa-pencil-alt"></i>
					</span>
					<span class="text">Editar documento</span>
				</a>
			@elseif($tipoPAT == 'Academico')
				<a href="#" data-toggle="modal" data-target="#deleteModal" data-slug="{{$documento->slug}}" data-tipo="academico" class="btn btn-danger btn-icon-split btn-sm" title="Informações">
					<span class="icon text-white-50">
						<i class="fas fa-trash-alt"></i>
					</span>
					<span class="text">Eliminar documento</span>
				</a>
				<a href="{{route('documento-academico.edit', [$documento, $documento->cliente])}}" class="btn btn-success btn-icon-split btn-sm" title="Editar">
					<span class="icon text-white-50">
						<i class="fas fa-pencil-alt"></i>
					</span>
					<span class="text">Editar documento</span>
				</a>
			@endif
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
			<h6 class="m-0 font-weight-bold text-primary">Visualização do documento "{{strtolower($tipo)}}" afeto ao cliente {{$documento->cliente->nome.' '.$documento->cliente->apelido}}.</h6>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-md-6">
					<p class="text-gray-800"><b>Documento:</b>
						<a class="text-truncate" onclick="window.open('{{url('/storage/client-documents/'.$documento->idCliente .'/'. $documento->imagem)}}', '', 'width=620,height=450,toolbar=no,location=no,menubar=no,copyhistory=no,status=no,directories=no,scrollbars=yes,resizable=yes'); return false;"
							href="{{url('/storage/client-documents/'.$documento->idCliente .'/'. $documento->imagem)}}"> {{$documento->imagem}} </a>
					</p>
				</div>
				@if(strtolower($tipo) == "passaport")
				<div class="col-md-6">
					<p class="text-gray-800"><b>Número de passaporte:</b> {{$documento->numPassaport}}</p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<p class="text-gray-800"><b>Data de validade:</b> {{date("d/m/Y",strtotime($documento->dataValidPP))}}</p>
				</div>
				<div class="col-md-6">
					<p class="text-gray-800"><b>País de emissão:</b> {{$documento->passaportPaisEmi}}</p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<p class="text-gray-800"><b>Local de emissão:</b> {{$documento->localEmissaoPP}}</p>
				</div>
			</div>
			@foreach($infoKeys as $key)
			<div class="row">
				<div class="col-md-6">
					<p class="text-gray-800"><b>{{$key}}:</b>
						@if ($infoDoc[$key] != null) {{$infoDoc[$key]}}
						@else N/A @endif</p>
				</div>
			</div>
			@endforeach
			@elseif($tipoPAT == "Academico")
			<div class="col-md-6">
				<p class="text-gray-800"><b>Nome do documento:</b> {{$documento->nome}}</p>
			</div>
			@foreach($infoKeys as $key)
				<div class="col-md-6">
					<p class="text-gray-800"><b>{{$key}}:</b>
						@if ($infoDoc[$key] != null) {{$infoDoc[$key]}}
						@else N/A @endif</p>
				</div>
			@endforeach
		</div>
		@else
		<div class="col-md-6">
			<p class="text-gray-800"><b>Data de validade:</b> {{date("d/m/Y", strtotime($documento->dataValidade))}}</p>
		</div>
	</div>
	@foreach($infoKeys as $key)
	<div class="row">
		<div class="col-md-6">
			<p class="text-gray-800"><b>{{$key}}:</b>
				@if ($infoDoc[$key] != null) {{$infoDoc[$key]}}
				@else N/A @endif</p>
		</div>
	</div>
	@endforeach
	@endif
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
				Aqui apenas pode visualizar os detalhes de um documento. Para editar os dados do documento, clique no botão <b>Editar documento</b>.
			</div>
			<div class="modal-footer mt-3">
				<a data-dismiss="modal" class="mr-4 font-weight-bold" id="close-option">Fechar</a>
				<button type="button" data-dismiss="modal" class="btn btn-primary font-weight-bold mr-2">Entendido!</button>
			</div>
		</div>
	</div>
</div>
<!-- End of Modal Info -->

<!-- Modal for delete admin -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header pl-4 pb-1 pt-4">
				<h5 class="modal-title text-gray-800 font-weight-bold">Pretende eliminar o documento?</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-button">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body text-gray-800 pl-4 pr-5">
				Ao apagar o registo do documento, <b>irá eliminar o mesmo para todo o sempre!</b> Pense duas vezes antes de proceder com a ação.
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
	<script src="{{asset('/js/documentos/show.js')}}"></script>
@endsection

@endsection
<!-- End of Page Content -->
