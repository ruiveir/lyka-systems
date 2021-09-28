@extends('layout.master')
<!-- Page Title -->
@section('title', 'Edição de um produto')
<!-- Page Content -->
@section('content')

<?php
$isAdmin = Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null;
$numFase = 0;
$numFornecedor = 0;
?>

<!-- Begin Page Content -->
<div class="container-fluid">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h4 mb-0 text-gray-800">Edição de um produto</h1>
		<div>
			<button id="add-fase-button" class="btn btn-info btn-icon-split btn-sm" title="Adicionar fase">
				<span class="icon text-white-50">
					<i class="fas fa-plus"></i>
				</span>
				<span class="text">Adicionar fase</span>
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

		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Formulário de edição do produto "{{$produto->descricao}}" afeto ao cliente {{$produto->cliente->nome.' '.$produto->cliente->apelido}}.</h6>
		</div>
		<div class="card-body">
			<form method="POST" action="{{route('produtos.update', $produto)}}" class="form-group needs-validation" novalidate>
				@csrf
				@method("PUT")
				<div class="container-fluid">
					<div class="form-row mb-3">
						<div class="col-md-4 mb-3">
							<label class="text-gray-900" for="tipo">Tipo de produto</label><br>
							<input type="text" class="form-control" name="tipo" id="tipo" value="{{old('tipo',$produto->tipo)}}" placeholder="Tipo" maxlength="20" readonly>
						</div>
						<div class="col-md-4 mb-3">
							<label class="text-gray-900" for="descricao">Descrição do produto</label>
							<input type="text" class="form-control" name="descricao" id="descricao" value="{{old('descricao',$produto->descricao)}}" placeholder="Descricao" maxlength="20" readonly>
						</div>
						<div class="col-md-4 mb-3">
							<label class="text-gray-900" for="AnoAcademico">Ano académico <sup class="text-danger small">&#10033;</sup></label>
							@if($isAdmin)
							<select type="text" class="form-control custom-select" name="anoAcademico" id="anoAcademico" required>
								<option disabled hidden selected>Escolha um ano académico...</option>
								@foreach($anosAcademicos as $ano)
								<option {{old('anoAcademico',$produto->anoAcademico)==$ano?"selected":""}} value="{{$ano}}">{{$ano}}</option>
								@endforeach
							</select>
							<div class="invalid-feedback">
								Oops, parece que algo não está bem...
							</div>
							@else
							<input type="text" class="form-control" name="anoAcademico" id="anoAcademico" value="{{old('anoAcademico',$produto->anoAcademico)}}" placeholder="Ano Academico" maxlength="20" readonly>
							@endIf
						</div>
					</div>

					<div class="form-row mb-3">
						<div class="col-md-6 mb-3">
							<label class="text-gray-900" for="agente">Agente <sup class="text-danger small">&#10033;</sup></label>
							@if($isAdmin)
							<select id="agente" name="agente" class="form-control custom-select" required>
								<option value="" selected></option>
								@foreach($Agentes as $agente)
								@if($agente->idAgente == $produto->idAgente)
								<option {{old('idAgente',$produto->idAgente)}} value="{{$agente->idAgente}}" selected>{{$agente->nome.' '.$agente->apelido.' -> '.$agente->email}}</option>
								@else
								<option {{old('idAgente',$produto->idAgente)}} value="{{$agente->idAgente}}">{{$agente->nome.' '.$agente->apelido.' -> '.$agente->email}}</option>
								@endif
								@endforeach
							</select>
							<div class="invalid-feedback">
								Oops, parece que algo não está bem...
							</div><br>
							@else
							@foreach($Agentes as $agente)
							@if($agente->idAgente == $produto->idAgente)
							<input type="text" class="form-control" name="agente" id="agente" value="{{$agente->nome.' '.$agente->apelido.' -> '.$agente->email}}" placeholder="" maxlength="20" readonly><br>
							@endif
							@endforeach
							@endIf
						</div>
						<div class="col-md-6 mb-3">
							<label class="text-gray-900" for="uni1">Universidade principal <sup class="text-danger small">&#10033;</sup></label>
							@if($isAdmin)
							<select id="uni1" name="uni1" class="form-control custom-select" required>
								<option value="" selected></option>
								@foreach($Universidades as $uni)
								@if($uni->idUniversidade == $produto->idUniversidade1)
								<option {{old('idUniversidade1',$produto->idUniversidade1)}} value="{{$uni->idUniversidade}}" selected>{{$uni->nome.' -> '.$uni->email}}</option>
								@else
								<option {{old('idUniversidade1',$produto->idUniversidade1)}} value="{{$uni->idUniversidade}}">{{$uni->nome.' -> '.$uni->email}}</option>
								@endif
								@endforeach
							</select>
							<div class="invalid-feedback">
								Oops, parece que algo não está bem...
							</div><br>
							@else
							@foreach($Universidades as $uni)
							<input type="text" class="form-control" name="universidade1" id="universidade1" value="{{ $uni->idUniversidade == $produto->idUniversidade1 ? $uni->nome.' -> '.$uni->email : ''}}" placeholder="" maxlength="20" readonly><br>
							@endforeach
							@endIf

						</div>
					</div>

					<div class="tab-content mt-4" id="myTabContent">
						<ul class="nav nav-tabs mt-5 mb-4 fases" id="myTab" role="tablist">
							@foreach($fases as $fase)
							<?php
							$numFase++;
							?>
							<li class="nav-item" style="width:25%">
								<a class="nav-link {{ $numFase == 1 ? 'active' : '' }} text-truncate" id="fase{{$numFase}}-tab" data-toggle="tab" href="#fase{{$numFase}}" role="tab" aria-controls="fase{{$numFase}}" aria-selected="false">Fase {{$numFase}} - {{$fase->descricao}}</a>
							</li>
							@endforeach
						</ul>

						<?php
						$numFase = 0;
						?>
						@foreach($fases as $fase)
						<?php
						$numFase++;
						$responsabilidade = $fase->responsabilidade;
						$relacoes = $responsabilidade->relacao;
						$subagente = $responsabilidade->subagente;
						$permissao_subagente = $subagente && $subagente->exepcao;
						?>

						<div class="tab-pane fade show {{ $numFase == 1 ? 'active' : '' }}" data-num="{{$numFase}}" data-idFase="{{ $fase->idFase }}" id="fase{{$numFase}}" role="tabpanel" aria-labelledby="fase{{$numFase}}-tab">
							<input type="hidden" name="fase[{{$numFase}}][idFase]" value="{{ $fase->idFase }}" />
							<div class="form-row mb-3">
								<div class="col-md-4 mb-3">
									<label class="text-gray-900" for="fase[{{$numFase}}][descricao]">Descrição da fase</label>
									<input type="text" class="form-control" name="fase[{{$numFase}}][descricao]" value="{{old('descricao',$fase->descricao)}}" placeholder="descricao" maxlength="20" readonly>
								</div>

								<div class="col-md-4 mb-3">
									<label class="text-gray-900" for="fase[{{$numFase}}][valor]">Valor total da fase <sup class="text-danger small">&#10033;</sup></label>
									<div class="input-group">
										<input type="number" class="form-control @if ($isAdmin) form-required @endif" name="fase[{{$numFase}}][valor]" value="{{old('valorFase',$fase->valorFase)}}" placeholder="Inserir um valor..." {{ $isAdmin ? "required" : "readonly" }}>
										<div class="input-group-append">
											<span class="input-group-text">€</span>
										</div>
										<div class="invalid-feedback">
											Oops, parece que algo não está bem...
										</div>
									</div>
								</div>

								<div class="col-md-4 mb-3">
									<label class="text-gray-900" for="fase[{{$numFase}}][data]">Data de vencimento <sup class="text-danger small">&#10033;</sup></label>
									<div class="input-group">
										<input type="date" class="form-control" name="fase[{{$numFase}}][data]" value="{{date_create(old('dataVencimento',$fase->dataVencimento))->format('Y-m-d')}}" {{ $isAdmin ? "required" : "readonly" }}>
										<div class="input-group-append">
											<span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
										</div>
										<div class="invalid-feedback">
											Oops, parece que algo não está bem...
										</div>
									</div>
								</div>
							</div>

							<hr>
							<div class="mt-4 mb-4">
								<p class="text-gray-900 h5"><b>Responsabilidades</b></p>
							</div>

							<div class="form-row mb-3">
								<div class="col-md-6 mb-3">
									<label class="text-gray-900" for="fase[{{$numFase}}][responsabilidadeClienteValor]">Pocket Money para cliente</label>
									<div class="input-group">
										<input type="number" class="form-control" placeholder="Insira um valor..." value="{{$responsabilidade->valorAgente}}" name="fase[{{$numFase}}][responsabilidadeClienteValor]">
										<div class="input-group-append">
											<span class="input-group-text">€</span>
										</div>
									</div>

								</div>
								<div class="col-md-6 mb-3">
									<label class="text-gray-900" for="fase[{{$numFase}}][responsabilidadeClienteData]">Data de vencimento (Cliente)</label>
									<div class="input-group">
										<input type="date" class="form-control" name="fase[{{$numFase}}][responsabilidadeClienteData]" @if($responsabilidade->dataVencimentoAgente) value="{{date('Y-m-d', strtotime($responsabilidade->dataVencimentoAgente))}}" @endif {{ $isAdmin ? "" : "readonly" }}>
										<div class="input-group-append">
											<span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
										</div>
									</div>
								</div>
							</div>

							<div class="form-row mb-3">
								<div class="col-md-6 mb-3">
									<label class="text-gray-900" for="fase[{{$numFase}}][responsabilidadeAgenteValor]">Valor a pagar ao agente</label>
									<div class="input-group">
										<input type="number" class="form-control" placeholder="Insira um valor..." value="{{$responsabilidade->valorAgente}}" name="fase[{{$numFase}}][responsabilidadeAgenteValor]">
										<div class="input-group-append">
											<span class="input-group-text">€</span>
										</div>
									</div>

								</div>
								<div class="col-md-6 mb-3">
									<label class="text-gray-900" for="fase[{{$numFase}}][responsabilidadeAgenteData]">Data de vencimento (Agente)</label>
									<div class="input-group">
										<input type="date" class="form-control" name="fase[{{$numFase}}][responsabilidadeAgenteData]" @if($responsabilidade->dataVencimentoAgente) value="{{date('Y-m-d', strtotime($responsabilidade->dataVencimentoAgente))}}" @endif {{ $isAdmin ? "" : "readonly" }}>
										<div class="input-group-append">
											<span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
										</div>
									</div>
								</div>
							</div>

							<div class="form-row mb-3">
								<div class="col-md-6 mb-3">
									<label class="text-gray-900" for="fase[{{$numFase}}][responsabilidadeUniversidadeValor]">Valor a pagar à universidade principal</label>
									<div class="input-group">
										<input type="number" class="form-control" placeholder="Insira um valor..." name="fase[{{$numFase}}][responsabilidadeUniversidadeValor]" value="{{$responsabilidade->valorUniversidade1}}">
										<div class="input-group-append">
											<span class="input-group-text">€</span>
										</div>
									</div>

								</div>
								<div class="col-md-6 mb-3">
									<label class="text-gray-900" for="fase[{{$numFase}}][responsabilidadeUniversidadeData]">Data de vencimento (Universidade principal)</label>
									<div class="input-group">
										<input type="date" class="form-control" name="fase[{{$numFase}}][responsabilidadeUniversidadeData]" @if($responsabilidade->dataVencimentoUni1) value="{{date('Y-m-d', strtotime($responsabilidade->dataVencimentoUni1))}}" @endif>
										<div class="input-group-append">
											<span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
										</div>
									</div>
								</div>
							</div>

							<div class="list-fornecedores" style="min-width:225px">
								<hr>
								<div class="mt-4 mb-4">
									<p class="text-gray-900 h5"><b>Fornecedores</b></p>
								</div>
								<div class="fornecedor">
									@if($relacoes->toArray())
									@foreach ($relacoes as $relacao)
									<?php
									$numFornecedor++;
									?>
									<div class="form-row mb-3 align-items-end fornecedor-entry">
										<div class="col-md-4 mb-3">
											<label class="text-gray-900" for="fase[{{$numFase}}][fornecedor][{{ $numFornecedor }}][idFornecedor]">Fornecedor</label>

											<div class="invalid-feedback">
												Oops, parece que algo não está bem...
											</div>

											<select name="fase[{{$numFase}}][fornecedor][{{ $numFornecedor }}][idFornecedor]" class="form-control custom-select" {{ $isAdmin ? "required" : "readonly" }}>
												<option value="" selected></option>
												@foreach($Fornecedores as $fornecedor)
												@if($relacao->ifFornecedor == $fornecedor->ifFornecedor)
												<option {{old('idFornecedor',$relacao->idFornecedor)}} value="{{$fornecedor->idFornecedor}}" selected>
													{{$fornecedor->nome.' -> '.$fornecedor->descricao}}
												</option>
												@else
												<option {{old('idFornecedor',$relacao->idFornecedor)}} value="{{$fornecedor->idFornecedor}}">{{$fornecedor->nome.' -> '.$fornecedor->descricao}}
												</option>
												@endif
												@endforeach
											</select>
										</div>
										<div class="col-md-3 mb-3">
											<label class="text-gray-900" for="fase[{{$numFase}}][fornecedor][{{ $numFornecedor }}][valor]">Valor a pagar <sup class="text-danger small">&#10033;</sup></label>
											<div class="input-group">
												<input type="number" class="form-control" name="fase[{{$numFase}}][fornecedor][{{ $numFornecedor }}][valor]" value="{{old('valor',$relacao->valor)}}" placeholder="Insira um valor...">

												<div class="invalid-feedback">
													Oops, parece que algo não está bem...
												</div>

												<div class="input-group-append">
													<span class="input-group-text">€</span>
												</div>
											</div>
										</div>
										<div class="col-md-3 mb-3">
											<label class="text-gray-900" for="fase[{{$numFase}}][fornecedor][{{ $numFornecedor }}][data]">Data de vencimento</label>
											<div class="input-group">
												<input type="date" class="form-control" name="fase[{{$numFase}}][fornecedor][{{ $numFornecedor }}][data]" value="{{date('Y-m-d', strtotime($relacao->dataVencimento))}}">
												<div class="input-group-append">
													<span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
												</div>
											</div>
										</div>
										<div class="col-md-2 mb-3">
											<button type="button" class="btn btn-danger btn-icon-split fornecedor-del-button" title="Adicionar fornecedor">
												<span class="icon text-white-50">
													<i class="fas fa-trash-alt"></i>
												</span>
												<span class="text">Adicionar fornecedor</span>
											</button>
										</div>
									</div>
									@endforeach
									@endif
								</div>
							</div>
						</div>
						@endforeach
					</div>
					<div class="form-row">
						<div class="text-left col-md-6">
							@if($isAdmin)
							<button type="button" class="btn btn-primary btn-icon-split" id="fornecedor-add-button" title="Adicionar fornecedor">
								<span class="icon text-white-50">
									<i class="fas fa-plus"></i>
								</span>
								<span class="text">Adicionar fornecedor</span>
							</button>
							@endif
						</div>
						<div class="text-right col-md-6">
							<button type="button" class="btn btn-secondary mr-4 font-weight-bold" id="cancel-button">Cancelar</button>
							<button type="submit" name="button" class="btn btn-primary text-white font-weight-bold" id="submitbtn">Guardar produto</button>
						</div>
					</div>
				</div>
			</form>

		</div>

	</div>
</div>

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
				Ao preencher/editar o formulário irá alterar informação do produto associado ao cliente <b>{{$produto->cliente->nome.' '.$produto->cliente->apelido}}</b>, ter o cuidado que ao alterar irá perder os dados anteriores. Os campos com o
				asterisco de cor vermelha são de preenchimento obrigatório.
			</div>
			<div class="modal-footer mt-3">
				<a data-dismiss="modal" class="mr-4 font-weight-bold" id="close-option">Fechar</a>
				<button type="button" data-dismiss="modal" class="btn btn-primary font-weight-bold mr-2">Entendido!</button>
			</div>
		</div>
	</div>
</div>
<!-- End of Modal for more information  -->

<!-- Begin Templates -->
<template id="template-fase-tab">
	<li class="nav-item" style="width:25%">
		<a class="nav-link text-truncate" id="fase-tab${numFase}" data-toggle="tab" href="#fase${numFase}" role="tab" aria-controls="fase${numFase}" aria-selected="false">Fase ${numFase}</a>
	</li>
</template>

<template id="template-fase">
	<div class="tab-pane fade show" data-num="${numFase}" id="fase${numFase}" role="tabpanel" aria-labelledby="fase${numFase}-tab">
		<div class="form-row mb-3">
			<div class="col-md-4 mb-3">
				<label class="text-gray-900" for="fase[${numFase}][descricao]">Descrição da fase</label>
				<input type="text" class="form-control" name="fase[${numFase}][descricao]" placeholder="descricao" maxlength="20" required>
				<div class="invalid-feedback">
					Oops, parece que algo não está bem...
				</div>
			</div>

			<div class="col-md-4 mb-3">
				<label class="text-gray-900" for="fase[${numFase}][valor]">Valor total da fase <sup class="text-danger small">&#10033;</sup></label>
				<div class="input-group">
					<input type="number" class="form-control @if ($isAdmin) form-required @endif" name="fase[${numFase}][valor]" placeholder="Inserir um valor..." {{ $isAdmin ? "required" : "readonly" }}>
					<div class="input-group-append">
						<span class="input-group-text">€</span>
					</div>
					<div class="invalid-feedback">
						Oops, parece que algo não está bem...
					</div>
				</div>
			</div>

			<div class="col-md-4 mb-3">
				<label class="text-gray-900" for="fase[${numFase}][data]">Data de vencimento <sup class="text-danger small">&#10033;</sup></label>
				<div class="input-group">
					<input type="date" class="form-control" name="fase[${numFase}][data]" {{ $isAdmin ? "required" : "readonly" }}>
					<div class="input-group-append">
						<span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
					</div>
					<div class="invalid-feedback">
						Oops, parece que algo não está bem...
					</div>
				</div>
			</div>
		</div>

		<hr>
		<div class="mt-4 mb-4">
			<p class="text-gray-900 h5"><b>Responsabilidades</b></p>
		</div>

		<div class="form-row mb-3">
			<div class="col-md-6 mb-3">
				<label class="text-gray-900" for="fase[${numFase}][responsabilidadeClienteValor]">Pocket Money para cliente</label>
				<div class="input-group">
					<input type="number" class="form-control" placeholder="Insira um valor..." name="fase[${numFase}][responsabilidadeClienteValor]">
					<div class="input-group-append">
						<span class="input-group-text">€</span>
					</div>
				</div>

			</div>
			<div class="col-md-6 mb-3">
				<label class="text-gray-900" for="fase[${numFase}][responsabilidadeClienteData]">Data de vencimento (Cliente)</label>
				<div class="input-group">
					<input type="date" class="form-control" name="fase[${numFase}][responsabilidadeClienteData]" {{ $isAdmin ? "" : "readonly" }}>
					<div class="input-group-append">
						<span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
					</div>
				</div>
			</div>
		</div>

		<div class="form-row mb-3">
			<div class="col-md-6 mb-3">
				<label class="text-gray-900" for="fase[${numFase}][responsabilidadeAgenteValor]">Valor a pagar ao agente</label>
				<div class="input-group">
					<input type="number" class="form-control" placeholder="Insira um valor..." name="fase[${numFase}][responsabilidadeAgenteValor]">
					<div class="input-group-append">
						<span class="input-group-text">€</span>
					</div>
				</div>

			</div>
			<div class="col-md-6 mb-3">
				<label class="text-gray-900" for="fase[${numFase}][responsabilidadeAgenteData]">Data de vencimento (Agente)</label>
				<div class="input-group">
					<input type="date" class="form-control" name="fase[${numFase}][responsabilidadeAgenteData]" {{ $isAdmin ? "" : "readonly" }}>
					<div class="input-group-append">
						<span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
					</div>
				</div>
			</div>
		</div>

		<div class="form-row mb-3">
			<div class="col-md-6 mb-3">
				<label class="text-gray-900" for="fase[${numFase}][responsabilidadeUniversidadeValor]">Valor a pagar à universidade principal</label>
				<div class="input-group">
					<input type="number" class="form-control" placeholder="Insira um valor..." name="fase[${numFase}][responsabilidadeUniversidadeValor]">
					<div class="input-group-append">
						<span class="input-group-text">€</span>
					</div>
				</div>

			</div>
			<div class="col-md-6 mb-3">
				<label class="text-gray-900" for="fase[${numFase}][responsabilidadeUniversidadeData]">Data de vencimento (Universidade principal)</label>
				<div class="input-group">
					<input type="date" class="form-control" name="fase[${numFase}][responsabilidadeUniversidadeData]">
					<div class="input-group-append">
						<span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
					</div>
				</div>
			</div>
		</div>

		<div class="list-fornecedores" style="min-width:225px">
			<hr>
			<div class="mt-4 mb-4">
				<p class="text-gray-900 h5"><b>Fornecedores</b></p>
			</div>
			<div class="fornecedor"></div>
		</div>
	</div>
</template>

<template id="template-fornecedor">
	<div class="form-row align-items-end mb-3 fornecedor-entry">
		<div class="col-md-4 mb-3">
			<label class="text-gray-900" for="fase[${numFase}][fornecedor][${numFornecedor}][idFornecedor]">Fornecedor</label>

			<select name="fase[${numFase}][fornecedor][${numFornecedor}][idFornecedor]" class="form-control custom-select" {{ $isAdmin ? "required" : "readonly" }}>
				<option value="" selected></option>
				@foreach($Fornecedores as $fornecedor)
				<option {{old('idFornecedor',$relacao->idFornecedor)}} value="{{$fornecedor->idFornecedor}}">{{$fornecedor->nome.' -> '.$fornecedor->descricao}}</option>
				@endforeach
			</select>
		</div>
		<div class="col-md-3 mb-3">
			<label class="text-gray-900" for="fase[${numFase}][fornecedor][${numFornecedor}][valor]">Valor a pagar <sup class="text-danger small">&#10033;</sup></label>

			<div class="input-group">
				<input type="number" class="form-control" name="fase[${numFase}][fornecedor][${numFornecedor}][valor]" value="{{old('valor',$relacao->valor)}}" placeholder="Insira um valor...">
				<div class="input-group-append">
					<span class="input-group-text">€</span>
				</div>
			</div>
		</div>
		<div class="col-md-3 mb-3">
			<label class="text-gray-900" for="fase[${numFase}][fornecedor][${numFornecedor}][data]">Data de vencimento</label>
			<div class="input-group">
				<input type="date" class="form-control" name="fase[${numFase}][fornecedor][${numFornecedor}][data]" value="{{date('Y-m-d', strtotime($relacao->dataVencimento))}}">
				<div class="input-group-append">
					<span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
				</div>
			</div>
		</div>
		<div class="col-md-2 mb-3">
			<button type="button" class="btn btn-danger btn-icon-split fornecedor-del-button" title="Remover fornecedor">
				<span class="icon text-white-50">
					<i class="fas fa-trash-alt"></i>
				</span>
				<span class="text">Remover fornecedor</span>
			</button>
		</div>
	</div>
</template>
<!-- End of Templates -->

<!-- Begin of Scripts  -->
@section('scripts')
<script>
	var numFase = <?php echo $numFase; ?>;
	var numFornecedor = <?php echo $numFornecedor; ?>;
</script>
<script src="{{asset('/js/produtos/edit.js')}}"></script>
@endsection

@endsection