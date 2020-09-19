@extends('layout.master')

{{-- Page Title --}}
@section('title', 'Editar informações')

{{-- CSS Style Link --}}
@section('styleLinks')
    <link href="{{asset('css/produtos.css')}}" rel="stylesheet">
@endsection

{{-- Page Content --}}
@section('content')

<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800">Edição do produto</h1>
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
            <h6 class="m-0 font-weight-bold text-primary">Edição do produto do cliente {{$produto->cliente->nome.' '.$produto->cliente->apelido}}.</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('produtos.update',$produto)}}" class="form-group needs-validation pt-3" id="form_produto"
                  enctype="multipart/form-data" novalidate>
                @csrf
                @method("PUT")
                    <div class="container-fluid">
                        <div class="form-row mb-3">

                        <div class="col-md-4 mb-3">
                            <label class="text-gray-900" for="tipo">Tipo de produto</label><br>
                            <input type="text" class="form-control" name="tipo" id="tipo"
                            value="{{old('tipo',$produto->tipo)}}" placeholder="Tipo" maxlength="20" readonly><br>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="text-gray-900" for="descricao">Descrição do produto</label>
                            <input type="text" class="form-control" name="descricao" id="descricao"
                            value="{{old('descricao',$produto->descricao)}}" placeholder="Descricao" maxlength="20" readonly><br>
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
                                <input type="text" class="form-control" name="anoAcademico" id="anoAcademico"
                                value="{{old('anoAcademico',$produto->anoAcademico)}}" placeholder="Ano Academico" maxlength="20" readonly><br>
                            @endIf
                        </div>
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
                                        <input type="text" class="form-control" name="agente" id="agente"
                                        value="{{$agente->nome.' '.$agente->apelido.' -> '.$agente->email}}" placeholder="" maxlength="20" readonly><br>
                                    @endif
                                @endforeach
                            @endIf
                        </div>
                        @if($produto->idSubAgente)
                            <div class="col-md-6 mb-3">
                                <label class="text-gray-900" for="subagente">Sub-agente</label>
                                <select id="subagente" name="subagente" class="form-control custom-select" readonly>
                                    @foreach($SubAgentes as $subagente)
                                        @if($subagente->idAgente == $produto->idSubAgente)
                                            <option {{old('idSubAgente',$produto->idSubAgente)}} value="{{$subagente->idAgente}}" selected>{{$subagente->nome.' '.$subagente->apelido.' -> '.$subagente->email}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Oops, parece que algo não está bem...
                                </div><br>
                            </div>
                        @else
                            <div class="col-md-6 mb-3">
                                <label class="text-gray-900" for="subagente">Sub-agente</label>
                                <select id="subagente" name="subagente" class="form-control custom-select" onchange="AlteraInputSubAgente($(this))">
                                    <option value="" selected></option>
                                    @foreach($SubAgentes as $subagente)
                                        @if($subagente->idAgente == $produto->idSubAgente)
                                            <option {{old('idSubAgente',$produto->idSubAgente)}} value="{{$subagente->idAgente}}" selected>{{$subagente->nome.' '.$subagente->apelido.' -> '.$subagente->email}}</option>
                                        @else
                                            <option {{old('idSubAgente',$produto->idSubAgente)}} value="{{$subagente->idAgente}}">{{$subagente->nome.' '.$subagente->apelido.' -> '.$subagente->email}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Oops, parece que algo não está bem...
                                </div><br>
                            </div>
                        @endif
                        <br><br><br><br>
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
                                        <input type="text" class="form-control" name="universidade1" id="universidade1"
                                        value="{{$uni->nome.' -> '.$uni->email}}" placeholder="" maxlength="20" readonly><br>
                                    @else
                                        <input type="text" class="form-control" name="universidade1" id="universidade1"
                                        value="" placeholder="" maxlength="20" readonly><br>
                                    @endif
                                @endforeach
                            @endIf

                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="text-gray-900" for="uni2">Universidade secundária</label>
                            @if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null)
                                <select id="uni2" name="uni2" class="form-control custom-select">
                                    <option value="" selected></option>
                                    @foreach($Universidades as $uni)
                                        @if($uni->idUniversidade == $produto->idUniversidade2)
                                            <option {{old('idUniversidade2',$produto->idUniversidade2)}} value="{{$uni->idUniversidade}}" selected>{{$uni->nome.' -> '.$uni->email}}</option>
                                        @else
                                            <option {{old('idUniversidade2',$produto->idUniversidade2)}} value="{{$uni->idUniversidade}}">{{$uni->nome.' -> '.$uni->email}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Oops, parece que algo não está bem...
                                </div>
                            @else
                                @foreach($Universidades as $uni)
                                    @if($uni->idUniversidade == $produto->idUniversidade2)
                                        <input type="text" class="form-control" name="universidade2" id="universidade2"
                                        value="{{$uni->nome.' -> '.$uni->email}}" placeholder="" maxlength="20" readonly><br>
                                    @else
                                        <input type="text" class="form-control" name="universidade2" id="universidade2"
                                        value="" placeholder="" maxlength="20" readonly><br>
                                    @endif
                                @endforeach
                            @endIf
                        </div>
                </div>
                <div class="tab-content p-2 mt-3" id="myTabContent">
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
                                    <a class="nav-link active" id="fase{{$num}}-tab" data-toggle="tab" href="#fase{{$num}}" role="tab"
                                    aria-controls="fase{{$num}}" aria-selected="false">Fase {{$num}} - {{$fase->descricao}}</a>
                                </li>
                            @else
                                <li class="nav-item" style="width:25%">
                                    <a class="nav-link" id="fase{{$num}}-tab" data-toggle="tab" href="#fase{{$num}}" role="tab"
                                    aria-controls="fase{{$num}}" aria-selected="false">Fase {{$num}} - {{$fase->descricao}}</a>
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
                                    <input type="text" class="form-control" name="descricao-fase{{$fase->idFase}}" id="descricao-fase{{$fase->idFase}}"
                                    value="{{old('descricao',$fase->descricao)}}" placeholder="descricao" maxlength="20" readonly><br>
                                </div>
                                @if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null)
                                    <div class="col-md-4 mb-3">
                                        <label class="text-gray-900" for="valor-fase{{$fase->idFase}}">Valor total da fase <sup class="text-danger small">&#10033;</sup></label>
                                        <div class="input-group">
                                            <input type="number" class="form-control form-required" name="valor-fase{{$fase->idFase}}" id="valor-fase{{$fase->idFase}}" value="{{old('valorFase',$fase->valorFase)}}" placeholder="Inserir um valor..." required>
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
                                        <input type="date" class="form-control" name="data-fase{{$fase->idFase}}" id="data-fase{{$fase->idFase}}" value="{{date_create(old('dataVencimento',$fase->dataVencimento))->format('Y-m-d')}}" required>
                                        <div class="invalid-feedback">
                                            Oops, parece que algo não está bem...
                                        </div>
                                    </div>
                                @else
                                    <div class="col-md-4 mb-3">
                                        <label class="text-gray-900" for="valor-fase{{$fase->idFase}}">Valor total da fase <sup class="text-danger small">&#10033;</sup></label>
                                        <div class="input-group">
                                            <input type="number" class="form-control form-required" name="valor-fase{{$fase->idFase}}" id="valor-fase{{$fase->idFase}}" value="{{old('valorFase',$fase->valorFase)}}" placeholder="Inserir um valor..." readonly>
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
                                        <label class="text-gray-900" for="resp-cliente-fase{{$fase->idFase}}">PickPocket para cliente <sup class="text-danger small">&#10033;</sup></label>
                                        <div class="input-group">
                                            <input type="number" class="form-control form-required" name="resp-cliente-fase{{$fase->idFase}}" id="resp-cliente-fase{{$fase->idFase}}">
                                            <div class="input-group-append">
                                                <span class="input-group-text">€</span>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="text-gray-900" for="resp-data-cliente-fase{{$fase->idFase}}">Data de vencimento (Cliente)</label>
                                        <div class="input-group">
                                            <input type="date" class="form-control form-required" name="resp-data-cliente-fase{{$fase->idFase}}" id="resp-data-cliente-fase{{$fase->idFase}}">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-md-6 mb-3">
                                        <label class="text-gray-900" for="resp-cliente-fase{{$fase->idFase}}">PickPocket para cliente <sup class="text-danger small">&#10033;</sup></label>
                                        <div class="input-group">
                                            <input type="number" class="form-control form-required" name="resp-cliente-fase{{$fase->idFase}}" id="resp-cliente-fase{{$fase->idFase}}" readonly>
                                            <div class="input-group-append">
                                                <span class="input-group-text">€</span>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="text-gray-900" for="resp-data-cliente-fase{{$fase->idFase}}">Data de vencimento (Cliente)</label>
                                        <div class="input-group">
                                            <input type="date" class="form-control form-required" name="resp-data-cliente-fase{{$fase->idFase}}" id="resp-data-cliente-fase{{$fase->idFase}}"readonly>
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
                                        <label class="text-gray-900" for="resp-agente-fase{{$fase->idFase}}">Valor a pagar ao agente <sup class="text-danger small">&#10033;</sup></label>
                                        <div class="input-group">
                                            <input type="number" class="form-control form-required" name="resp-agente-fase{{$fase->idFase}}" id="resp-agente-fase{{$fase->idFase}}">
                                            <div class="input-group-append">
                                                <span class="input-group-text">€</span>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="text-gray-900" for="resp-data-agente-fase{{$fase->idFase}}">Data de vencimento (Agente)</label>
                                        <div class="input-group">
                                            <input type="date" class="form-control form-required" name="resp-data-agente-fase{{$fase->idFase}}" id="resp-data-agente-fase{{$fase->idFase}}">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-md-6 mb-3">
                                        <label class="text-gray-900" for="resp-agente-fase{{$fase->idFase}}">Valor a pagar ao agente <sup class="text-danger small">&#10033;</sup></label>
                                        <div class="input-group">
                                            <input type="number" class="form-control form-required" name="resp-agente-fase{{$fase->idFase}}" id="resp-agente-fase{{$fase->idFase}}" readonly>
                                            <div class="input-group-append">
                                                <span class="input-group-text">€</span>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="text-gray-900" for="resp-data-agente-fase{{$fase->idFase}}">Data de vencimento (Agente)</label>
                                        <div class="input-group">
                                            <input type="date" class="form-control form-required" name="resp-data-agente-fase{{$fase->idFase}}" id="resp-data-agente-fase{{$fase->idFase}}"readonly>
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                @endIf

                                </div>
                                <div class="form-row mb-3">
                                    @if(Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null && (Auth()->user()->agente->tipo == "Agente" ||
                                        (Auth()->user()->agente->tipo == "Subagente" && $permissao_subagente)))
                                        @if($produto->idSubAgente)
                                            <div class="col-md-6 valor-responsabilidade-subagente mb-3">
                                        @else
                                            <div class="col-md-6 valor-responsabilidade-subagente mb-3" style="display: none;">
                                        @endif
                                            <label class="text-gray-900" for="resp-subagente-fase{{$fase->idFase}}">Valor a pagar ao sub-agente</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control form-required" name="resp-subagente-fase{{$fase->idFase}}" id="resp-subagente-fase{{$fase->idFase}}">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">€</span>
                                                </div>
                                            </div>
                                        </div>
                                        @if($produto->idSubAgente)
                                            <div class="col-md-6 valor-responsabilidade-subagente mb-3">
                                        @else
                                            <div class="col-md-6 valor-responsabilidade-subagente mb-3" style="display: none;">
                                        @endif
                                        <label class="text-gray-900" for="resp-data-subagente-fase{{$fase->idFase}}">Data de vencimento (Sub-agente)</label>
                                        <div class="input-group">
                                            <input type="date" class="form-control form-required" name="resp-data-subagente-fase{{$fase->idFase}}" id="resp-data-subagente-fase{{$fase->idFase}}">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                            </div>
                                        </div>
                                        </div>
                                    @else
                                        @if($produto->idSubAgente)
                                            <div class="col-md-6 valor-responsabilidade-subagente mb-3">
                                        @else
                                            <div class="col-md-6 valor-responsabilidade-subagente mb-3" style="display: none;">
                                        @endif
                                        <label class="text-gray-900" for="resp-subagente-fase{{$fase->idFase}}">Valor a pagar ao sub-agente</label>
                                            @if(Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null)
                                                <div class="input-group">
                                                    <input type="number" class="form-control form-required" name="resp-subagente-fase{{$fase->idFase}}" id="resp-subagente-fase{{$fase->idFase}}">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">€</span>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="input-group">
                                                    <input type="number" class="form-control form-required" name="resp-subagente-fase{{$fase->idFase}}" id="resp-subagente-fase{{$fase->idFase}}"
                                                    onchange="adicionaValorSubAgente({{$responsabilidade->valorAgente}}, $(this).closest('#responsabilidades{{$responsabilidade->idResponsabilidade}}'),
                                                    {{$responsabilidade->valorAgente + $responsabilidade->valorSubAgente}})">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">€</span>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        @if($produto->idSubAgente)
                                            <div class="col-md-6 valor-responsabilidade-subagente mb-3">
                                        @else
                                            <div class="col-md-6 valor-responsabilidade-subagente mb-3" style="display: none;">
                                        @endif
                                        <label class="text-gray-900" for="resp-data-subagente-fase{{$fase->idFase}}">Data de vencimento (Sub-agente)</label>
                                        <div class="input-group">
                                            <input type="date" class="form-control form-required" name="resp-data-subagente-fase{{$fase->idFase}}" id="resp-data-subagente-fase{{$fase->idFase}}">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                            </div>
                                        </div>
                                        </div>
                                    @endif

                                </div>
                                <div class="form-row mb-3">
                                
                                @if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null)
                                    <div class="col-md-6 mb-3">
                                        <label class="text-gray-900" for="resp-uni1-fase{{$fase->idFase}}">Valor a pagar á universidade principal <sup class="text-danger small">&#10033;</sup></label>
                                        <div class="input-group">
                                            <input type="number" class="form-control form-required" name="resp-uni1-fase{{$fase->idFase}}" id="resp-uni1-fase{{$fase->idFase}}">
                                            <div class="input-group-append">
                                                <span class="input-group-text">€</span>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="text-gray-900" for="resp-data-uni1-fase{{$fase->idFase}}">Data de vencimento (Universidade principal)</label>
                                        <div class="input-group">
                                            <input type="date" class="form-control form-required" name="resp-data-uni1-fase{{$fase->idFase}}" id="resp-data-uni1-fase{{$fase->idFase}}">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-md-6 mb-3">
                                        <label class="text-gray-900" for="resp-uni1-fase{{$fase->idFase}}">Valor a pagar á universidade principal <sup class="text-danger small">&#10033;</sup></label>
                                        
                                        <div class="input-group">
                                            <input type="number" class="form-control form-required" name="resp-uni1-fase{{$fase->idFase}}" id="resp-uni1-fase{{$fase->idFase}}" readonly>
                                            <div class="input-group-append">
                                                <span class="input-group-text">€</span>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="text-gray-900" for="resp-data-uni1-fase{{$fase->idFase}}">Data de vencimento (Universidade principal)</label>
                                        <div class="input-group">
                                            <input type="date" class="form-control form-required" name="resp-data-uni1-fase{{$fase->idFase}}" id="resp-data-uni1-fase{{$fase->idFase}}"readonly>
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
                                        <label class="text-gray-900" for="resp-uni2-fase{{$fase->idFase}}">Valor a pagar á universidade secundária</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control form-required" name="resp-uni2-fase{{$fase->idFase}}" id="resp-uni2-fase{{$fase->idFase}}">
                                            <div class="input-group-append">
                                                <span class="input-group-text">€</span>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="text-gray-900" for="resp-data-uni2-fase{{$fase->idFase}}">Data de vencimento (Universidade secundária)</label>
                                        <div class="input-group">
                                            <input type="date" class="form-control form-required" name="resp-data-uni2-fase{{$fase->idFase}}" id="resp-data-uni2-fase{{$fase->idFase}}">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-md-6 mb-3">
                                        <label class="text-gray-900" for="resp-uni2-fase{{$fase->idFase}}">Valor a pagar á universidade secundária</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control form-required" name="resp-uni2-fase{{$fase->idFase}}" id="resp-uni2-fase{{$fase->idFase}}" readonly>
                                            <div class="input-group-append">
                                                <span class="input-group-text">€</span>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="text-gray-900" for="resp-data-uni2-fase{{$fase->idFase}}">Data de vencimento (Universidade secundária)</label>
                                        <div class="input-group">
                                            <input type="date" class="form-control form-required" name="resp-data-uni2-fase{{$fase->idFase}}" id="resp-data-uni2-fase{{$fase->idFase}}"readonly>
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
                                    <div class="clones" id="clonar">
                                        <div class="form-row mb-3" id="clonar">
                                            <div class="col-md-4 mb-3">
                                                <label class="text-gray-900" id="label1" for="fornecedor-fase{{$fase->idFase}}">Fornecedor #1</label>
                                                <select id="fornecedor-fase{{$fase->idFase}}" name="fornecedor-fase{{$fase->idFase}}" class="form-control custom-select" required>
                                                    <option value="" selected></option>
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
                                                    <input type="number" class="form-control" name="valor-fornecedor-fase{{$fase->idFase}}" id="valor-fornecedor-fase{{$fase->idFase}}" value="{{old('valor',$relacao->valor)}}" placeholder="Insira um valor...">
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
                                                            <option {{old('idFornecedor',$relacao->idFornecedor)}} value="{{$fornecedor->idFornecedor}}" selected>{{$fornecedor->nome.' -> '.$fornecedor->descricao}}</option>
                                                            @else
                                                            <option {{old('idFornecedor',$relacao->idFornecedor)}} value="{{$fornecedor->idFornecedor}}">{{$fornecedor->nome.' -> '.$fornecedor->descricao}}</option>
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
                                                        <input type="number" class="form-control" name="valor-fornecedor{{$numF}}-fase{{$fase->idFase}}" id="valor-fornecedor{{$numF}}-fase{{$fase->idFase}}" value="{{old('valor',$relacao->valor)}}" placeholder="Insira um valor...">
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
                                                        <input type="date" class="form-control" name="data-fornecedor{{$numF}}-fase{{$fase->idFase}}" id="data-fornecedor{{$numF}}-fase{{$fase->idFase}}">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-right mt-3">
                                                <a id="button" style="color: white;" onclick="removerFornecedor({{$numF}},{{$fase->idFase}},$(this).closest('#div-fornecedor{{$numF}}-fase{{$fase->idFase}}'))" class="btn btn-danger btn-icon-split btn-sm" title="remove">
                                                    <span class="icon text-white-50">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </span>
                                                    <span id="a_button" class="text">Remover fornecedor {{$numF}}</span>
                                                </a>
                                                {{--<button type="button" onclick="removerFornecedor({{$numF}},{{$fase->idFase}},$(this).closest('#div-fornecedor{{$numF}}-fase{{$fase->idFase}}'))" class="top-button">Remover fornecedor {{$numF}}</button>--}}
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                @if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null)
                                    <div>
                                        <a style="color: white;" onclick="addFornecedor({{$fase->idFase}},$(this).closest('.list-fornecedores'))" class="btn btn-primary btn-icon-split btn-sm" title="Editar">
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
                    <div class="text-right mt-3 mr-4" id="groupBtn">
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
                    Ao preencher/editar o formulário irá alterar informação do produto associado ao cliente <b>{{$produto->cliente->nome.' '.$produto->cliente->apelido}}</b>, ter o cuidado que ao alterar irá perder os dados anteriores. Os campos com o asterisco de cor vermelha são de preenchimento obrigatório.
                </div>
                <div class="modal-footer mt-3">
                    <a data-dismiss="modal" class="mr-4 font-weight-bold" id="close-option">Fechar</a>
                    <button type="button" data-dismiss="modal" class="btn btn-primary font-weight-bold mr-2">Entendido!</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Modal for more information  -->





{{-- Scripts --}}
@section('scripts')

    {{-- script contem: datatable configs, input configs, validações --}}
    <script src="{{asset('/js/produtos.js')}}"></script>

    {{-- script permite definir se um input recebe só numeros OU so letras --}}
    <script src="{{asset('/js/jquery-key-restrictions.min.js')}}"></script>

    <script>
        var clones = $('#clonar').clone();
        $(".clones").remove();
        $("#formulario-produto").css("display", "none");
        $("#formulario-fases").css("display", "none");


        $(document).ready(function() {
            bsCustomFileInput.init();
            $(".needs-validation").submit(function(event) {
                if (this.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                } else {
                    $("#cancelBtn").removeAttr("onclick");
                    button =
                        "<button class='btn btn-primary' type='submit' disabled><span class='spinner-border spinner-border-sm' role='status' aria-hidden='true' style='position:relative; bottom:4px; right:3px;'></span>A enviar...</button>";
                    $("#groupBtn").append(button);
                    $("#submitbtn").remove();
                }
                $(".needs-validation").addClass("was-validated");
            });
        });

        function addFornecedor(idFase, closest){
	        var numF = parseInt(closest.find('.numF').first().text());
			var clone = clones.clone();
	        closest.find('.numF').first().text(numF+1);
			clone.attr('id','div-fornecedor'+numF+'-fase'+idFase);
			$('#label1', clone).text("Fornecedor #"+numF+":");
			$('#label1', clone).attr('for','fornecedor'+numF+'-fase'+idFase);
			$('select', clone).attr('id','fornecedor'+numF+'-fase'+idFase);
			$('select', clone).attr('name','fornecedor'+numF+'-fase'+idFase);
			$('#label2', clone).attr('for','valor-fornecedor'+numF+'-fase'+idFase);
			$('#valor-fornecedor-fase'+idFase, clone).attr('name','valor-fornecedor'+numF+'-fase'+idFase);
			$('#valor-fornecedor-fase'+idFase, clone).attr('id','valor-fornecedor'+numF+'-fase'+idFase);
            $('#label3', clone).text('Data de vencimento (Fornecedor #' + numF + ")");
			$('#label3', clone).attr('for','data-fornecedor'+numF+'-fase'+idFase);
			$('#data-fornecedor-fase'+idFase, clone).attr('name','data-fornecedor'+numF+'-fase'+idFase);
			$('#data-fornecedor-fase'+idFase, clone).attr('id','data-fornecedor'+numF+'-fase'+idFase);
			$('#button', clone).attr('onclick','removerFornecedor('+numF+','+idFase+',$(this).closest("#div-fornecedor'+numF+'-fase'+idFase+'"))');
			$('#a_button', clone).text('Remover fornecedor '+numF);
	        closest.find('.fornecedor').first().append(clone);
        }
        function removerFornecedor(numF,idFase,fornecedor){
            $('#fornecedor'+numF+'-fase'+idFase).val($('#fornecedor'+numF+'-fase'+idFase+' > option:first').val());
            $("#fornecedor"+numF+"-fase"+idFase).attr("required", false);
            $("#valor-fornecedor"+numF+"-fase"+idFase).attr("required", false);
            fornecedor.css("display", "none");
        }
        function AlteraInputSubAgente(input){
            var valueInput = input.val();
            if(valueInput){
                $(".valor-responsabilidade-subagente").css("display", "block");
                $(".valor-responsabilidade-subagente").find(input).first().attr("required", true);
            }else{
                $(".valor-responsabilidade-subagente").css("display", "none");
                $(".valor-responsabilidade-subagente").find(input).first().attr("required", false);
            }
        }
        function adicionaValorSubAgente(valorAgente, formulario, valorTotal){
            var inputAgente = formulario.find('.valor-pagar-agente').first();
            var inputSubAgente = formulario.find('.valor-pagar-subagente').first();
            var valorSubAgente = parseFloat(inputSubAgente.text());
            var novoValorAgente = valorTotal - valorSubAgente;
            if(novoValorAgente==0){
			    inputAgente.text(0);
                inputSubAgente.text(valorAgente);
            }else{
                if(novoValorAgente<0){
                    inputAgente.text(0);
                    inputSubAgente.text(valorTotal);
                }else{
                    inputAgente.text(novoValorAgente);
                }
            }
        }
    </script>

@endsection

@endsection