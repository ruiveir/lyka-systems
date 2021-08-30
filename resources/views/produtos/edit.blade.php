@extends('layout.master')
<!-- Page Title -->
@section('title', 'Edição de um produto')
<!-- Page Content -->
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h4 mb-0 text-gray-800">Edição de um produto</h1>
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
							@if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null)
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
							@if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null)
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
							@if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null)
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
								@if($uni->idUniversidade == $produto->idUniversidade1)
									<input type="text" class="form-control" name="universidade1" id="universidade1" value="{{$uni->nome.' -> '.$uni->email}}" placeholder="" maxlength="20" readonly><br>
									@else
									<input type="text" class="form-control" name="universidade1" id="universidade1" value="" placeholder="" maxlength="20" readonly><br>
									@endif
									@endforeach
									@endIf

						</div>
					</div>

					<div class="tab-content mt-4" id="myTabContent">
						<ul class="nav nav-tabs mt-5 mb-4 fases" id="myTab" role="tablist">
							@php
							$num=0;
							@endphp
							@foreach($fases as $fase)
							@php
							$num++;
							@endphp
							@if($num == 1)
							<li class="nav-item" style="width:25%">
								<a class="nav-link active text-truncate" id="fase{{$num}}-tab" data-toggle="tab" href="#fase{{$num}}" role="tab" aria-controls="fase{{$num}}" aria-selected="false">Fase {{$num}} - {{$fase->descricao}}</a>
							</li>
							@else
							<li class="nav-item" style="width:25%">
								<a class="nav-link text-truncate" id="fase{{$num}}-tab" data-toggle="tab" href="#fase{{$num}}" role="tab" aria-controls="fase{{$num}}" aria-selected="false">Fase {{$num}} - {{$fase->descricao}}</a>
							</li>
							@endif
							@endforeach
						</ul>

						@php
						$num=0;
						@endphp
						@foreach($fases as $fase)
						@php
						$num++;
						$numF = 0;
						$responsabilidade = $fase->responsabilidade;
						$relacoes = $responsabilidade->relacao;
						$subagente = $responsabilidade->subagente;
						$permissao_subagente = false;
						if($subagente){
						if($subagente->exepcao){
						$permissao_subagente = true;
						}
						}
						@endphp
						@if($num == 1)
						<div class="tab-pane fade show active" id="fase{{$num}}" role="tabpanel" aria-labelledby="fase{{$num}}-tab">
							@else
							<div class="tab-pane fade" id="fase{{$num}}" role="tabpanel" aria-labelledby="fase{{$num}}-tab">
								@endif
								<div class="form-row mb-3">
									<div class="col-md-4 mb-3">
										<label class="text-gray-900" for="descricao-fase{{$fase->idFase}}">Descrição da fase</label>
										<input type="text" class="form-control" name="descricao-fase{{$fase->idFase}}" id="descricao-fase{{$fase->idFase}}" value="{{old('descricao',$fase->descricao)}}" placeholder="descricao" maxlength="20" readonly>
									</div>
									@if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null)
										<div class="col-md-4 mb-3">
											<label class="text-gray-900" for="valor-fase{{$fase->idFase}}">Valor total da fase <sup class="text-danger small">&#10033;</sup></label>
											<div class="input-group">
												<input type="number" class="form-control form-required" name="valor-fase{{$fase->idFase}}" id="valor-fase{{$fase->idFase}}" value="{{old('valorFase',$fase->valorFase)}}"
													placeholder="Inserir um valor..." required>
												<div class="input-group-append">
													<span class="input-group-text">€</span>
												</div>
											</div>
										</div>

										<div class="col-md-4 mb-3">
											<label class="text-gray-900" for="data-fase{{$fase->idFase}}">Data de vencimento <sup class="text-danger small">&#10033;</sup></label>
											<input type="date" class="form-control" name="data-fase{{$fase->idFase}}" id="data-fase{{$fase->idFase}}" value="{{date_create(old('dataVencimento',$fase->dataVencimento))->format('Y-m-d')}}" required>
											<div class="invalid-feedback">
												Oops, parece que algo não está bem...
											</div>
										</div>
										@else
										<div class="col-md-4 mb-3">
											<label class="text-gray-900" for="valor-fase{{$fase->idFase}}">Valor total da fase <sup class="text-danger small">&#10033;</sup></label>
											<div class="input-group">
												<input type="number" class="form-control" name="valor-fase{{$fase->idFase}}" id="valor-fase{{$fase->idFase}}" value="{{old('valorFase',$fase->valorFase)}}" placeholder="Inserir um valor..." readonly>
												<div class="input-group-append">
													<span class="input-group-text">€</span>
												</div>
												<div class="invalid-feedback">
													Oops, parece que algo não está bem...
												</div>
											</div>
										</div>
										<div class="col-md-4 mb-3">
											<label class="text-gray-900" for="data-fase{{$fase->idFase}}">Data de vencimento <sup class="text-danger small">&#10033;</sup></label>
											<input type="date" class="form-control" name="data-fase{{$fase->idFase}}" id="data-fase{{$fase->idFase}}" value="{{date_create(old('dataVencimento',$fase->dataVencimento))->format('Y-m-d')}}" readonly>
											<div class="invalid-feedback">
												Oops, parece que algo não está bem...
											</div>
										</div>
										@endIf
								</div>
								<hr>
								<div class="mt-4 mb-4">
									<p class="text-gray-900 h5"><b>Responsabilidades</b></p>
								</div>
								<div class="form-row mb-3" id="responsabilidades{{$responsabilidade->idResponsabilidade}}">
									@if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null)
										<div class="col-md-6 mb-3">
											<label class="text-gray-900" for="resp-cliente-fase{{$fase->idFase}}">Pocket Money para cliente</label>
											<div class="input-group">
												<input type="number" class="form-control" placeholder="Insira um valor..." value="{{$responsabilidade->valorCliente}}" name="resp-cliente-fase{{$fase->idFase}}" id="resp-cliente-fase{{$fase->idFase}}">
												<div class="input-group-append">
													<span class="input-group-text">€</span>
												</div>
											</div>
										</div>

										<div class="col-md-6 mb-3">
											<label class="text-gray-900" for="resp-data-cliente-fase{{$fase->idFase}}">Data de vencimento (Cliente)</label>
											<div class="input-group">
												<input type="date" class="form-control" name="resp-data-cliente-fase{{$fase->idFase}}" id="resp-data-cliente-fase{{$fase->idFase}}" @if($responsabilidade->dataVencimentoCliente)
												value="{{date('Y-m-d', strtotime($responsabilidade->dataVencimentoCliente))}}" @endif>
													<div class="input-group-append">
														<span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
													</div>
											</div>
										</div>
										@else
										<div class="col-md-6 mb-3">
											<label class="text-gray-900" for="resp-cliente-fase{{$fase->idFase}}">Pocket Money para cliente</label>
											<div class="input-group">
												<input type="number" class="form-control" placeholder="Insira um valor..." name="resp-cliente-fase{{$fase->idFase}}" id="resp-cliente-fase{{$fase->idFase}}" readonly>
												<div class="input-group-append">
													<span class="input-group-text">€</span>
												</div>
											</div>

										</div>
										<div class="col-md-6 mb-3">
											<label class="text-gray-900" for="resp-data-cliente-fase{{$fase->idFase}}">Data de vencimento (Cliente)</label>
											<div class="input-group">
												<input type="date" class="form-control" name="resp-data-cliente-fase{{$fase->idFase}}" id="resp-data-cliente-fase{{$fase->idFase}}" readonly>
												<div class="input-group-append">
													<span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
												</div>
											</div>
										</div>
										@endIf

								</div>
								<div class="form-row mb-3">
									@if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null)
										<div class="col-md-6 mb-3">
											<label class="text-gray-900" for="resp-agente-fase{{$fase->idFase}}">Valor a pagar ao agente</label>
											<div class="input-group">
												<input type="number" class="form-control" placeholder="Insira um valor..." value="{{$responsabilidade->valorAgente}}" name="resp-agente-fase{{$fase->idFase}}" id="resp-agente-fase{{$fase->idFase}}">
												<div class="input-group-append">
													<span class="input-group-text">€</span>
												</div>
											</div>

										</div>
										<div class="col-md-6 mb-3">
											<label class="text-gray-900" for="resp-data-agente-fase{{$fase->idFase}}">Data de vencimento (Agente)</label>
											<div class="input-group">
												<input type="date" class="form-control" name="resp-data-agente-fase{{$fase->idFase}}" id="resp-data-agente-fase{{$fase->idFase}}" @if($responsabilidade->dataVencimentoAgente)
												value="{{date('Y-m-d', strtotime($responsabilidade->dataVencimentoAgente))}}" @endif>
												<div class="input-group-append">
													<span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
												</div>
											</div>
										</div>
										@else
										<div class="col-md-6 mb-3">
											<label class="text-gray-900" for="resp-agente-fase{{$fase->idFase}}">Valor a pagar ao agente</label>
											<div class="input-group">
												<input type="number" class="form-control" placeholder="Insira um valor..." name="resp-agente-fase{{$fase->idFase}}" id="resp-agente-fase{{$fase->idFase}}" readonly>
												<div class="input-group-append">
													<span class="input-group-text">€</span>
												</div>
											</div>

										</div>
										<div class="col-md-6 mb-3">
											<label class="text-gray-900" for="resp-data-agente-fase{{$fase->idFase}}">Data de vencimento (Agente)</label>
											<div class="input-group">
												<input type="date" class="form-control" name="resp-data-agente-fase{{$fase->idFase}}" id="resp-data-agente-fase{{$fase->idFase}}" readonly>
												<div class="input-group-append">
													<span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
												</div>
											</div>
										</div>
										@endIf

								</div>
								<div class="form-row mb-3">
									@if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null)
										<div class="col-md-6 mb-3">
											<label class="text-gray-900" for="resp-uni1-fase{{$fase->idFase}}">Valor a pagar à universidade principal</label>
											<div class="input-group">
												<input type="number" class="form-control" placeholder="Insira um valor..." name="resp-uni1-fase{{$fase->idFase}}" id="resp-uni1-fase{{$fase->idFase}}" value="{{$responsabilidade->valorUniversidade1}}">
												<div class="input-group-append">
													<span class="input-group-text">€</span>
												</div>
											</div>

										</div>
										<div class="col-md-6 mb-3">
											<label class="text-gray-900" for="resp-data-uni1-fase{{$fase->idFase}}">Data de vencimento (Universidade principal)</label>
											<div class="input-group">
												<input type="date" class="form-control" name="resp-data-uni1-fase{{$fase->idFase}}" id="resp-data-uni1-fase{{$fase->idFase}}" @if($responsabilidade->dataVencimentoUni1)
												value="{{date('Y-m-d', strtotime($responsabilidade->dataVencimentoUni1))}}" @endif>
												<div class="input-group-append">
													<span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
												</div>
											</div>
										</div>
										@else
										<div class="col-md-6 mb-3">
											<label class="text-gray-900" for="resp-uni1-fase{{$fase->idFase}}">Valor a pagar á universidade principal</label>

											<div class="input-group">
												<input type="number" class="form-control" placeholder="Insira um valor..." name="resp-uni1-fase{{$fase->idFase}}" id="resp-uni1-fase{{$fase->idFase}}" readonly>
												<div class="input-group-append">
													<span class="input-group-text">€</span>
												</div>
											</div>

										</div>
										<div class="col-md-6 mb-3">
											<label class="text-gray-900" for="resp-data-uni1-fase{{$fase->idFase}}">Data de vencimento (Universidade principal)</label>
											<div class="input-group">
												<input type="date" class="form-control" name="resp-data-uni1-fase{{$fase->idFase}}" id="resp-data-uni1-fase{{$fase->idFase}}" readonly>
												<div class="input-group-append">
													<span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
												</div>
											</div>
										</div>
										@endIf
								</div>

								<div class="list-fornecedores" style="min-width:225px">
									<hr>
									<div class="mt-4 mb-4">
										<p class="text-gray-900 h5"><b>Fornecedores</b></p>
									</div>
									<span class="numF" style="display: none;">{{count($relacoes->toArray())+1}}</span>
									<div class="fornecedor">
										<div class="clones mb-5" id="clonar">
											<div class="form-row mb-3" id="clonar">
												<div class="col-md-4 mb-3">
													<label class="text-gray-900" id="label1" for="fornecedor-fase{{$fase->idFase}}">Fornecedor #1</label>
													<select id="fornecedor-fase{{$fase->idFase}}" name="fornecedor-fase{{$fase->idFase}}" class="form-control custom-select" required>
														<option hidden disabled selected>Escolha um fornecedor...</option>
														@foreach($Fornecedores as $fornecedor)
														<option {{old('idFornecedor',$relacao->idFornecedor)}} value="{{$fornecedor->idFornecedor}}">{{$fornecedor->nome.' -> '.$fornecedor->descricao}}</option>
														@endforeach
													</select>
													<div class="invalid-feedback">
														Oops, parece que algo não está bem...
													</div><br>
												</div>
												<div class="col-md-4 mb-3">
													<label class="text-gray-900" id="label2" for="valor-fornecedor-fase{{$fase->idFase}}">Valor a pagar <sup class="text-danger small">&#10033;</sup></label>
													<div class="input-group">
														<input type="number" class="form-control" name="valor-fornecedor-fase{{$fase->idFase}}" id="valor-fornecedor-fase" value="{{old('valor', $relacao->valor)}}" placeholder="Insira um valor...">
														<div class="input-group-append">
															<span class="input-group-text">€</span>
														</div>
														<div class="invalid-feedback">
															Oops, parece que algo não está bem...
														</div>
													</div>
												</div>
												<div class="col-md-4 mb-3">
													<label class="text-gray-900" id="label3" for="data-fornecedor-fase{{$fase->idFase}}">Data de vencimento (Fornecedor)</label>
													<div class="input-group">
														<input type="date" class="form-control" name="data-fornecedor-fase{{$fase->idFase}}" id="data-fornecedor-fase{{$fase->idFase}}">
														<div class="input-group-append">
															<span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
														</div>
													</div>
												</div>
											</div>
											<div class="text-right mt-3">
												<a id="button" style="color: white;" onclick="" class="btn btn-danger btn-icon-split btn-sm" title="remove">
													<span class="icon text-white-50">
														<i class="fas fa-trash-alt"></i>
													</span>
													<span id="a_button" class="text">Remover fornecedor</span>
												</a>
												{{--<button type="button" onclick="" class="top-button">Remover fornecedor</button>--}}
											</div>
										</div>
										@if($relacoes->toArray())
											@foreach ($relacoes as $relacao)
											@php
											$numF++;
											@endphp
											<div class="form-row mb-3" id="div-fornecedor{{$numF}}-fase{{$fase->idFase}}">
												<div class="col-md-4 mb-3">
													<label class="text-gray-900" id="label1" for="fornecedor{{$numF}}-fase{{$fase->idFase}}">Fornecedor #{{$numF}}</label>
													@if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null)
														<select id="fornecedor{{$numF}}-fase{{$fase->idFase}}" name="fornecedor{{$numF}}-fase{{$fase->idFase}}" class="form-control custom-select" required>
															@else
															<select id="fornecedor{{$numF}}-fase{{$fase->idFase}}" name="fornecedor{{$numF}}-fase{{$fase->idFase}}" class="form-control custom-select" readonly>
																@endIf
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
															<div class="invalid-feedback">
																Oops, parece que algo não está bem...
															</div><br>
												</div>
												<div class="col-md-4 mb-3">
													<label class="text-gray-900" id="label2" for="valor-fornecedor{{$numF}}-fase{{$fase->idFase}}">Valor a pagar <sup class="text-danger small">&#10033;</sup></label>
													<div class="input-group">
														<input type="number" class="form-control" name="valor-fornecedor{{$numF}}-fase{{$fase->idFase}}" id="valor-fornecedor-fase" value="{{old('valor',$relacao->valor)}}"
															placeholder="Insira um valor...">
														<div class="input-group-append">
															<span class="input-group-text">€</span>
														</div>
														<div class="invalid-feedback">
															Oops, parece que algo não está bem...
														</div>
													</div>
												</div>
												<div class="col-md-4 mb-3">
													<label class="text-gray-900" id="label3" for="data-fornecedor{{$numF}}-fase{{$fase->idFase}}">Data de vencimento (Fornecedor #{{$numF}})</label>
													<div class="input-group">
														<input type="date" class="form-control" name="data-fornecedor{{$numF}}-fase{{$fase->idFase}}" id="data-fornecedor{{$numF}}-fase{{$fase->idFase}}" value="{{date('Y-m-d', strtotime($relacao->dataVencimento))}}">
														<div class="input-group-append">
															<span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
														</div>
													</div>
												</div>
											</div>
											<div class="text-right mt-3 mb-5">
												<a id="button" style="color: white;" onclick="removerFornecedor({{$numF}},{{$fase->idFase}},$(this).closest('#div-fornecedor{{$numF}}-fase{{$fase->idFase}}'))"
													class="btn btn-danger btn-icon-split btn-sm" title="remove">
													<span class="icon text-white-50">
														<i class="fas fa-trash-alt"></i>
													</span>
													<span id="a_button" class="text">Remover fornecedor {{$numF}}</span>
												</a>
												{{--<button type="button" onclick="removerFornecedor({{$numF}},{{$fase->idFase}},$(this).closest('#div-fornecedor{{$numF}}-fase{{$fase->idFase}}'))"
												class="top-button">Remover fornecedor {{$numF}}</button>--}}
											</div>
											@endforeach
											@endif
									</div>
									@if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null)
										<div>
											<a style="color: white;" onclick="addFornecedor({{$num}},$(this).closest('.list-fornecedores'))" class="btn btn-primary btn-icon-split btn-sm" title="Editar">
												<span class="text">Adicionar fornecedor</span>
											</a>
											{{--<button type="button" onclick="addFornecedor({{$fase->idFase}},$(this).closest('.list-fornecedores'))" class="top-button ">Adicionar fornecedor</button>--}}
										</div>
										@endif
								</div>
							</div>
							@endforeach
						</div>
						<div class="form-group text-right">
							<div class="text-right mt-3" id="groupBtn">
								<span class="mr-4 font-weight-bold" onclick="window.history.back();" id="cancelBtn" style="cursor:pointer;">Cancelar</span>
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

<!-- Begin of Scripts  -->
@section('scripts')
		<script src="{{asset('/js/produtos/edit.js')}}"></script>
@endsection

@endsection
