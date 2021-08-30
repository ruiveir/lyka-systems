@extends('layout.master')
<!-- Page Title -->
@section('title', 'Edição de um documento')
<!-- Page Content -->
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h4 mb-0 text-gray-800">Edição do documento {{strtolower($tipoPAT)}} "{{$tipo}}"</h1>
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
			<h6 class="m-0 font-weight-bold text-primary">Formulário de edição do documento {{strtolower($tipoPAT)}} "{{$tipo}}" afeto ao cliente {{$client->nome.' '.$client->apelido}}.</h6>
		</div>
		<div class="card-body">
			@if($tipoPAT == 'Pessoal')
			<form action="{{route('documento-pessoal.update',$documento)}}" method="post" enctype="multipart/form-data">
				@elseif($tipoPAT == 'Academico')
				<form action="{{route('documento-academico.update',$documento)}}" method="post" enctype="multipart/form-data">
					@else
					<form action="{{route('documento-transacao.update', $documento)}}" method="post" enctype="multipart/form-data">
						@endif
						@csrf
						@method('PUT')
						<div class="container-fluid">
							@if(strtolower($tipo) == "passaporte")
							<div class="para-clone documento-passaporte">
								<div class="form-row mb-3">
									<div class="col-md-6 mb-3">
										<label for="img_doc" class="text-gray-900">Documento <sup class="text-danger small">&#10033;</sup></label>
										<div class="custom-file mb-3">
											<input type="file" class="custom-file-input" name="img_doc" id="img_doc" accept="application/pdf, image/*">
											<div class="invalid-feedback">
												Oops, parece que algo não está bem...
											</div>
											<small class="form-text text-muted">O documento não deve ultrupassar 2MB.</small>
											@if ($documento->imagem)
											<label class="custom-file-label text-truncate" for="img_doc" data-browse="Escolher">{{$documento->imagem}}</label>
											@else
											<label class="custom-file-label" for="img_doc" data-browse="Escolher">Escolher documento...</label>
											@endif
										</div>
									</div>
									<div class="col-md-6 mb-3">
										<label for="numPassaporte" class="text-gray-900">Número do passaporte <sup class="text-danger small">&#10033;</sup></label>
										<input value="{{old('numPassaporte', $infoDoc['numPassaporte'])}}" type="text" class="form-control" name="numPassaporte" placeholder="Inserir número de passaporte..." required>
										<div class="invalid-feedback">
											Oops, parece que algo não está bem...
										</div>
									</div>
								</div>

								<div class="form-row mb-3">
									<div class="col-md-4 mb-3">
										<label for="dataValidPP" class="text-gray-900">Data de validade</label>
										<div class="input-group">
											<input value="{{old('dataValidPP', $infoDoc['dataValidPP'])}}" type="date" class="form-control" name="dataValidPP">
											<div class="input-group-append">
												<div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
											</div>
										</div>
									</div>
									<div class="col-md-4 mb-3">
										<label for="passaportPaisEmi" class="text-gray-900">País de emissão</label>
										<input value="{{old('passaportPaisEmi', $infoDoc['passaportPaisEmi'])}}" type="text" class="form-control" name="passaportPaisEmi" placeholder="Inserir o país de emissão...">
									</div>
									<div class="col-md-4 mb-3">
										<label for="localEmissaoPP" class="text-gray-900">Local do emissão</label>
										<input value="{{old('localEmissaoPP', $infoDoc['localEmissaoPP'])}}" type="text" class="form-control" name="localEmissaoPP" placeholder="Inserir o local de emissão...">
									</div>
								</div>
							</div>
							@else
							<div class="para-clone documento">
								<span class="num" style="display: none;">{{sizeof($infoDoc)+1}}</span>
								<div class="form-row mb-3">
									<div class="col-md-6 mb-3">
										<label for="img_doc" class="text-gray-900">Documento <sup class="text-danger small">&#10033;</sup></label>
										<div class="custom-file mb-3">
											<input type="file" class="custom-file-input" name="img_doc" id="img_doc" accept="application/pdf, image/*">
											<div class="invalid-feedback">
												Oops, parece que algo não está bem...
											</div>
											<small class="form-text text-muted">O documento não deve ultrupassar 2MB.</small>
											@if ($documento->imagem)
											<label class="custom-file-label text-truncate" for="img_doc" data-browse="Escolher">{{$documento->imagem}}</label>
											@else
											<label class="custom-file-label" for="img_doc" data-browse="Escolher">Escolher documento...</label>
											@endif
										</div>
									</div>
									@if($tipoPAT == "Academico")
									<div class="col-md-6 mb-3">
										<label for="nome" class="text-gray-900">Nome do documento <sup class="text-danger small">&#10033;</sup></label>
										<input value="{{old('nome', $documento->nome)}}" type="text" class="form-control" name="nome" placeholder="Inserir um nome..." required>
										<div class="invalid-feedback">
											Oops, parece que algo não está bem...
										</div>
									</div>
									@else
									<div class="col-md-6 mb-3">
										<label for="dataValidade" class="text-gray-900">Data de validade <sup class="text-danger small">&#10033;</sup></label>
										<div class="input-group">
											<input value="{{old('dataValidade', $documento->dataValidade)}}" type="date" class="form-control" name="dataValidade" required>
											<div class="input-group-append">
												<div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
											</div>
										</div>
										<div class="invalid-feedback">
											Oops, parece que algo não está bem...
										</div>
									</div>
									@endif
								</div>
								<hr>
								<div class="mt-4 mb-4">
									<p class="text-gray-900 h5"><b>Campos adicionais</b></p>
								</div>
								<div class="list-clones">
									@php
									$i=0;
									@endphp
									@foreach($infoKeys as $key)
									@php
									$i++;
									@endphp
									<div id="documento-campo{{$i}}">
										<div class="form-row">
											<div class="col-md-6 mb-3">
												<label for="nome-campo{{$i}}" class="text-gray-900">Nome do campo n.º{{$i}}</label>
												<input value="{{$key}}" type="text" class="form-control" name="nome-campo{{$i}}" id="nome-campo{{$i}}" placeholder="Insira um nome...">
											</div>
											<div class="col-md-6 mb-3">
												<label for="valor-campo{{$i}}" class="text-gray-900">Valor do campo n.º{{$i}}</label>
												<input value="{{$infoDoc[$key]}}" type="text" class="form-control" name="valor-campo{{$i}}" id="valor-campo{{$i}}" placeholder="Insira um valor...">
											</div>
										</div>
										<div class="text-right">
											<a href="" id="button" onclick="removeCampo({{$i}},$(this).closest('#documento-campo{{$i}}'))" class="btn btn-danger btn-icon-split btn-sm" title="Remover">
												<span class="icon text-white-50">
													<i class="fas fa-trash-alt"></i>
												</span>
												<span id="a_button" class="text">Remover campo n.º{{$i}}</span>
											</a>
										</div>
									</div>
									@endforeach
								</div>
								<div>
									<a style="color: white;" onclick="addCampo($(this).closest('.para-clone'))" class="btn btn-primary btn-icon-split btn-sm" title="Adicionar">
										<span class="icon text-white-50">
											<i class="fas fa-plus"></i>
										</span>
										<span class="text">Adicionar campo</span>
									</a>
								</div>
							</div>
							@endif
						</div>

						<div id="clonar">
							<div class="form-row clones">
								<div class="col-md-6 mb-3">
									<label id="label1" for="nome-campo" class="text-gray-900">Nome do campo n.º</label>
									<input type="text" class="form-control" name="nome-campo" id="input1" placeholder="Insira um nome...">
								</div>
								<div class="col-md-6 mb-3">
									<label id="label2" for="valor-campo" class="text-gray-900">Valor do campo n.º</label>
									<input type="text" class="form-control" name="valor-campo" id="input2" placeholder="Insira um valor...">
								</div>
							</div>
							<div class="text-right">
								<a href="" id="button" onclick="" class="btn btn-danger btn-icon-split btn-sm" title="Remover">
									<span class="icon text-white-50">
										<i class="fas fa-trash-alt"></i>
									</span>
									<span id="a_button" class="text">Remover campo</span>
								</a>
							</div>
						</div>

						<div class="text-right mt-5 mr-4 mb-3" id="groupBtn">
							<span class="mr-4 font-weight-bold" onclick="window.history.back();" id="cancelBtn" style="cursor:pointer;">Cancelar</span>
							<button type="submit" name="button" class="btn btn-primary text-white font-weight-bold" id="submitbtn">Alterar documento</button>
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
				Ao preencher o formulário irá editar o <b>documento {{strtolower($tipoPAT)}} "{{$tipo}}"</b>. Os campos com o asterisco de cor vermelha são de preenchimento obrigatório.
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
	<script src="{{asset('/js/documentos/edit.js')}}"></script>
@endsection
<!-- End of Scripts -->
@endsection
<!-- End of Page Content -->
