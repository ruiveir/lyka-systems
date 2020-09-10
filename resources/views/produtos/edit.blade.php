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

    <div class="cards-navigation">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h4 mb-0 text-gray-800">Edição do produto</h1>
        </div>
        <br>
        
    </div>
    <!-- Approach -->
    <div class="card shadow mb-4">

            <form method="POST" action="{{route('produtos.update',$produto)}}" class="form-group needs-validation pt-3" id="form_produto"
                  enctype="multipart/form-data" novalidate>
                @csrf
                @method("PUT")
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Edição do produto do cliente {{$produto->cliente->nome.' '.$produto->cliente->apelido}}</h6>
                </div>
                <div class="card-body">
                    <div>
                        <div><p class="text-gray-800"><b>Produto</b></p></div>
                        <div class="row">

                        <div class="col-md-4">
                            <label for="tipo">Tipo:</label><br>
                            <input type="text" class="form-control" name="tipo" id="tipo"
                            value="{{old('tipo',$produto->tipo)}}" placeholder="Tipo" maxlength="20" readonly><br>
                        </div>
                        <div class="col-md-6">
                            <label for="descricao">Descrição:</label><br>
                            <input type="text" class="form-control" name="descricao" id="descricao"
                            value="{{old('descricao',$produto->descricao)}}" placeholder="Descricao" maxlength="20" readonly><br>
                        </div>
                        <div class="col-md-2">
                            <label for="anoAcademico">Ano académico: <span class="text-danger">*</span></label><br>
                            @if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null)
                                <input type="text" class="form-control" name="anoAcademico" id="anoAcademico"
                                value="{{old('anoAcademico',$produto->anoAcademico)}}" placeholder="Ano Academico" maxlength="20" required><br>
                            @else
                                <input type="text" class="form-control" name="anoAcademico" id="anoAcademico"
                                value="{{old('anoAcademico',$produto->anoAcademico)}}" placeholder="Ano Academico" maxlength="20" readonly><br>
                            @endIf
                        </div>
                        <div class="col-md-6">
                            <label for="agente">Agente: <span class="text-danger">*</span></label><br>
                            @if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null)
                                <select id="agente" name="agente" class="form-control" required>
                                    <option value="" selected></option>
                                    @foreach($Agentes as $agente)
                                        @if($agente->idAgente == $produto->idAgente)
                                            <option {{old('idAgente',$produto->idAgente)}} value="{{$agente->idAgente}}" selected>{{$agente->nome.' '.$agente->apelido.' -> '.$agente->email}}</option>
                                        @else
                                            <option {{old('idAgente',$produto->idAgente)}} value="{{$agente->idAgente}}">{{$agente->nome.' '.$agente->apelido.' -> '.$agente->email}}</option>
                                        @endif
                                    @endforeach
                                </select><br>
                            @else
                                @foreach($Agentes as $agente)
                                    @if($agente->idAgente == $produto->idAgente)
                                        <input type="text" class="form-control" name="agente" id="agente"
                                        value="{{$agente->nome.' '.$agente->apelido.' -> '.$agente->email}}" placeholder="" maxlength="20" readonly><br>
                                    @else
                                        <input type="text" class="form-control" name="agente" id="agente"
                                        value="" placeholder="" maxlength="20" readonly><br>
                                    @endif
                                @endforeach
                            @endIf
                        </div>
                        @if($produto->idSubAgente)
                            <div class="col-md-6">
                                <label for="subagente">Sub-Agente:</label><br>
                                <select id="subagente" name="subagente" class="form-control" readonly>
                                    @foreach($SubAgentes as $subagente)
                                        @if($subagente->idAgente == $produto->idSubAgente)
                                            <option {{old('idSubAgente',$produto->idSubAgente)}} value="{{$subagente->idAgente}}" selected>{{$subagente->nome.' '.$subagente->apelido.' -> '.$subagente->email}}</option>
                                        @endif
                                    @endforeach
                                </select><br>
                            </div>
                        @else
                            <div class="col-md-6">
                                <label for="subagente">Sub-Agente:</label><br>
                                <select id="subagente" name="subagente" class="form-control" onchange="AlteraInputSubAgente($(this))">
                                    <option value="" selected></option>
                                    @foreach($SubAgentes as $subagente)
                                        @if($subagente->idAgente == $produto->idSubAgente)
                                            <option {{old('idSubAgente',$produto->idSubAgente)}} value="{{$subagente->idAgente}}" selected>{{$subagente->nome.' '.$subagente->apelido.' -> '.$subagente->email}}</option>
                                        @else
                                            <option {{old('idSubAgente',$produto->idSubAgente)}} value="{{$subagente->idAgente}}">{{$subagente->nome.' '.$subagente->apelido.' -> '.$subagente->email}}</option>
                                        @endif
                                    @endforeach
                                </select><br>
                            </div>
                        @endif
                        <div class="col-md-6">
                            <label for="uni1">Universidade Principal: <span class="text-danger">*</span></label><br>
                            @if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null)
                                <select id="uni1" name="uni1" class="form-control" required>
                                    <option value="" selected></option>
                                    @foreach($Universidades as $uni)
                                        @if($uni->idUniversidade == $produto->idUniversidade1)
                                            <option {{old('idUniversidade1',$produto->idUniversidade1)}} value="{{$uni->idUniversidade}}" selected>{{$uni->nome.' -> '.$uni->email}}</option>
                                        @else
                                            <option {{old('idUniversidade1',$produto->idUniversidade1)}} value="{{$uni->idUniversidade}}">{{$uni->nome.' -> '.$uni->email}}</option>
                                        @endif
                                    @endforeach
                                </select><br>
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
                        <div class="col-md-6">
                            <label for="uni2">Universidade Secundária:</label><br>
                            @if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null)
                                <select id="uni2" name="uni2" class="form-control">
                                    <option value="" selected></option>
                                    @foreach($Universidades as $uni)
                                        @if($uni->idUniversidade == $produto->idUniversidade2)
                                            <option {{old('idUniversidade2',$produto->idUniversidade2)}} value="{{$uni->idUniversidade}}" selected>{{$uni->nome.' -> '.$uni->email}}</option>
                                        @else
                                            <option {{old('idUniversidade2',$produto->idUniversidade2)}} value="{{$uni->idUniversidade}}">{{$uni->nome.' -> '.$uni->email}}</option>
                                        @endif
                                    @endforeach
                                </select>
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

                        <div><p class="text-gray-800"><b>Fase {{$num}}</b></p></div>
                            <div class="row">

                                <div class="col-md-6">
                                    <label for="descricao-fase{{$fase->idFase}}">Descrição:</label><br>
                                    <input type="text" class="form-control" name="descricao-fase{{$fase->idFase}}" id="descricao-fase{{$fase->idFase}}"
                                    value="{{old('descricao',$fase->descricao)}}" placeholder="descricao" maxlength="20" readonly><br>
                                </div>
                                @if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null)
                                    <div class="col-md-3">
                                        <label for="valor-fase{{$fase->idFase}}">Valor da fase: <span class="text-danger">*</span></label><br>
                                        <input type="number" min="0" class="form-control" name="valor-fase{{$fase->idFase}}" id="valor-fase{{$fase->idFase}}"
                                        value="{{old('valorFase',$fase->valorFase)}}" style="width:250px" required><br>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="data-fase{{$fase->idFase}}">Data de vencimento: <span class="text-danger">*</span></label><br>
                                        <input type="date" class="form-control" name="data-fase{{$fase->idFase}}" id="data-fase{{$fase->idFase}}"
                                        value="{{date_create(old('dataVencimento',$fase->dataVencimento))->format('Y-m-d')}}" style="width:250px" required><br>
                                    </div>
                                @else
                                    <div class="col-md-3">
                                        <label for="valor-fase{{$fase->idFase}}">Valor da fase:</label><br>
                                        <input type="number" min="0" class="form-control" name="valor-fase{{$fase->idFase}}" id="valor-fase{{$fase->idFase}}"
                                        value="{{old('valorFase',$fase->valorFase)}}" style="width:250px" readonly/><br>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="data-fase{{$fase->idFase}}">Data de vencimento: <span class="text-danger">*</span></label><br>
                                        <input type="date" class="form-control" name="data-fase{{$fase->idFase}}" id="data-fase{{$fase->idFase}}"
                                        value="{{date_create(old('dataVencimento',$fase->dataVencimento))->format('Y-m-d')}}" style="width:250px" readonly><br>
                                    </div>
                                @endIf
                            </div>
                            <div><p class="text-gray-800"><b>Responsabilidades</b></p></div>
                            <div class="row" id="responsabilidades{{$responsabilidade->idResponsabilidade}}">
                                @if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null)
                                    <div class="col-md-6">
                                        <label for="resp-cliente-fase{{$fase->idFase}}">PickPocket para cliente: <span class="text-danger">*</span></label><br>
                                        <input type="number" class="form-control" name="resp-cliente-fase{{$fase->idFase}}" id="resp-cliente-fase{{$fase->idFase}}"
                                        value="{{old('valorCliente',$responsabilidade->valorCliente)}}" style="width:250px" required><br>

                                    </div>
                                    <div class="col-md-6">
                                        <label for="resp-data-cliente-fase{{$fase->idFase}}">Data de vencimento do pagamento ao cliente:</label><br>
                                        <input type="date" class="form-control" name="resp-data-cliente-fase{{$fase->idFase}}" id="resp-data-cliente-fase{{$fase->idFase}}"
                                        value="" style="width:250px" ><br>
                                    </div>
                                @else
                                    <div class="col-md-6">
                                        <label for="resp-cliente-fase{{$fase->idFase}}">PickPocket para cliente: <span class="text-danger">*</span></label><br>
                                        <input type="number" class="form-control" name="resp-cliente-fase{{$fase->idFase}}" id="resp-cliente-fase{{$fase->idFase}}"
                                        value="{{old('valorCliente',$responsabilidade->valorCliente)}}" style="width:250px" readonly><br>

                                    </div>
                                    <div class="col-md-6">
                                        <label for="resp-data-cliente-fase{{$fase->idFase}}">Data de vencimento do pagamento ao cliente:</label><br>
                                        <input type="date" class="form-control" name="resp-data-cliente-fase{{$fase->idFase}}" id="resp-data-cliente-fase{{$fase->idFase}}"
                                        value="" style="width:250px" readonly><br>
                                    </div>
                                @endIf

                                @if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null)
                                    <div class="col-md-6">
                                        <label for="resp-agente-fase{{$fase->idFase}}">Valor a pagar ao agente: <span class="text-danger">*</span></label><br>
                                        <input type="number" class="form-control valor-pagar-agente" name="resp-agente-fase{{$fase->idFase}}" id="resp-agente-fase{{$fase->idFase}}"
                                        value="{{old('valorAgente',$responsabilidade->valorAgente)}}" style="width:250px" required><br>

                                    </div>
                                    <div class="col-md-6">
                                        <label for="resp-data-agente-fase{{$fase->idFase}}">Data de vencimento do pagamento ao agente:</label><br>
                                        <input type="date" class="form-control" name="resp-data-agente-fase{{$fase->idFase}}" id="resp-data-agente-fase{{$fase->idFase}}"
                                        value="" style="width:250px" ><br>
                                    </div>
                                @else
                                    <div class="col-md-6">
                                        <label for="resp-agente-fase{{$fase->idFase}}">Valor a pagar ao agente: <span class="text-danger">*</span></label><br>
                                        <input type="number" class="form-control" name="resp-agente-fase{{$fase->idFase}}" id="resp-agente-fase{{$fase->idFase}}"
                                        value="{{old('valorAgente',$responsabilidade->valorAgente)}}" style="width:250px" readonly><br>

                                    </div>
                                    <div class="col-md-6">
                                        <label for="resp-data-agente-fase{{$fase->idFase}}">Data de vencimento do pagamento ao agente:</label><br>
                                        <input type="date" class="form-control" name="resp-data-agente-fase{{$fase->idFase}}" id="resp-data-agente-fase{{$fase->idFase}}"
                                        value="" style="width:250px" readonly><br>
                                    </div>
                                @endIf

                                @if($produto->idSubAgente)
                                    <div class="valor-responsabilidade-subagente">
                                @else
                                    <div class="valor-responsabilidade-subagente" style="display: none;">
                                @endif
                                    @if(Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null && (Auth()->user()->agente->tipo == "Agente" ||
                                        (Auth()->user()->agente->tipo == "Subagente" && $permissao_subagente)))
                                        <div class="col-md-6">
                                            <label for="resp-subagente-fase{{$fase->idFase}}">Valor a pagar ao sub-agente:</label><br>
                                            <input type="number" class="form-control valor-pagar-subagente" name="resp-subagente-fase{{$fase->idFase}}" id="resp-subagente-fase{{$fase->idFase}}"
                                            value="{{old('valorSubAgente',$responsabilidade->valorSubAgente)}}" style="width:250px"><br>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="resp-data-subagente-fase{{$fase->idFase}}">Data de vencimento do pagamento ao sub-agente:</label><br>
                                            <input type="date" class="form-control" name="resp-data-subagente-fase{{$fase->idFase}}" id="resp-data-subagente-fase{{$fase->idFase}}"
                                            value="" style="width:250px" ><br>
                                        </div>
                                    @else
                                        <div class="col-md-6">
                                            <label for="resp-subagente-fase{{$fase->idFase}}">Valor a pagar ao sub-agente:</label><br>
                                            @if(Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null)
                                                <input type="number" class="form-control" name="resp-subagente-fase{{$fase->idFase}}" id="resp-subagente-fase{{$fase->idFase}}"
                                                value="{{old('valorSubAgente',$responsabilidade->valorSubAgente)}}" style="width:250px"><br>
                                            @else
                                                <input type="number" class="form-control valor-pagar-subagente" name="resp-subagente-fase{{$fase->idFase}}" id="resp-subagente-fase{{$fase->idFase}}"
                                                value="{{old('valorSubAgente',$responsabilidade->valorSubAgente)}}" style="width:250px"
                                                onchange="adicionaValorSubAgente({{$responsabilidade->valorAgente}}, $(this).closest('#responsabilidades{{$responsabilidade->idResponsabilidade}}'),
                                                {{$responsabilidade->valorAgente + $responsabilidade->valorSubAgente}})"><br>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <label for="resp-data-subagente-fase{{$fase->idFase}}">Data de vencimento do pagamento ao sub-agente:</label><br>
                                            <input type="date" class="form-control" name="resp-data-subagente-fase{{$fase->idFase}}" id="resp-data-subagente-fase{{$fase->idFase}}"
                                            value="" style="width:250px"><br>
                                        </div>
                                    @endIf
                                </div>

                                
                                @if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null)
                                    <div class="col-md-6">
                                        <label for="resp-uni1-fase{{$fase->idFase}}">Valor a pagar á universidade principal: <span class="text-danger">*</span></label><br>
                                        <input type="number" class="form-control" name="resp-uni1-fase{{$fase->idFase}}" id="resp-uni1-fase{{$fase->idFase}}"
                                        value="{{old('valorUniversidade1',$responsabilidade->valorUniversidade1)}}" style="width:250px" required><br>

                                    </div>
                                    <div class="col-md-6">
                                        <label for="resp-data-uni1-fase{{$fase->idFase}}">Data de vencimento do pagamento à universidade principal:</label><br>
                                        <input type="date" class="form-control" name="resp-data-uni1-fase{{$fase->idFase}}" id="resp-data-uni1-fase{{$fase->idFase}}"
                                        value="" style="width:250px" ><br>
                                    </div>
                                @else
                                    <div class="col-md-6">
                                        <label for="resp-uni1-fase{{$fase->idFase}}">Valor a pagar á universidade principal: <span class="text-danger">*</span></label><br>
                                        <input type="number" class="form-control" name="resp-uni1-fase{{$fase->idFase}}" id="resp-uni1-fase{{$fase->idFase}}"
                                        value="{{old('valorUniversidade1',$responsabilidade->valorUniversidade1)}}" style="width:250px" readonly><br>

                                    </div>
                                    <div class="col-md-6">
                                        <label for="resp-data-uni1-fase{{$fase->idFase}}">Data de vencimento do pagamento à universidade principal:</label><br>
                                        <input type="date" class="form-control" name="resp-data-uni1-fase{{$fase->idFase}}" id="resp-data-uni1-fase{{$fase->idFase}}"
                                        value="" style="width:250px" readonly><br>
                                    </div>
                                @endIf

                                @if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null)
                                    <div class="col-md-6">
                                        <label for="resp-uni2-fase{{$fase->idFase}}">Valor a pagar á universidade secundária:</label><br>
                                        <input type="number" class="form-control" name="resp-uni2-fase{{$fase->idFase}}" id="resp-uni2-fase{{$fase->idFase}}"
                                        value="{{old('valorUniversidade2',$responsabilidade->valorUniversidade2)}}" style="width:250px"><br>

                                    </div>
                                    <div class="col-md-6">
                                        <label for="resp-data-uni2-fase{{$fase->idFase}}">Data de vencimento do pagamento à universidade secundária:</label><br>
                                        <input type="date" class="form-control" name="resp-data-uni2-fase{{$fase->idFase}}" id="resp-data-uni2-fase{{$fase->idFase}}"
                                        value="" style="width:250px" ><br>
                                    </div>
                                @else
                                    <div class="col-md-6">
                                        <label for="resp-uni2-fase{{$fase->idFase}}">Valor a pagar á universidade secundária:</label><br>
                                        <input type="number" class="form-control" name="resp-uni2-fase{{$fase->idFase}}" id="resp-uni2-fase{{$fase->idFase}}"
                                        value="{{old('valorUniversidade2',$responsabilidade->valorUniversidade2)}}" style="width:250px" readonly><br>

                                    </div>
                                    <div class="col-md-6">
                                        <label for="resp-data-uni2-fase{{$fase->idFase}}">Data de vencimento do pagamento à universidade secundária:</label><br>
                                        <input type="date" class="form-control" name="resp-data-uni2-fase{{$fase->idFase}}" id="resp-data-uni2-fase{{$fase->idFase}}"
                                        value="" style="width:250px" readonly><br>
                                    </div>
                                @endIf
                            </div>

                            <div class="list-fornecedores" style="min-width:225px">
                                <div><p class="text-gray-800"><b>Fornecedores</b></span></div>
                                <span class="numF" style="display: none;">{{count($relacoes->toArray())+1}}</span>
                                <div class="fornecedor">
                                    <div class="clones row" id="clonar">
                                        <div class="col-md-6">
                                            <label id="label1" for="fornecedor-fase{{$fase->idFase}}">Fornecedor 0:</label><br>
                                            <select id="fornecedor-fase{{$fase->idFase}}" name="fornecedor-fase{{$fase->idFase}}" class="form-control" required>
                                                <option value="" selected></option>
                                                @foreach($Fornecedores as $fornecedor)
                                                    <option {{old('idFornecedor',$relacao->idFornecedor)}} value="{{$fornecedor->idFornecedor}}">{{$fornecedor->nome.' -> '.$fornecedor->descricao}}</option>
                                                @endforeach
                                            </select><br>
                                        </div>
                                        <div class="col-md-6">
                                            <label id="label2" for="valor-fornecedor-fase{{$fase->idFase}}">Valor a pagar:</label><br>
                                            <input type="number" min="0" class="form-control" name="valor-fornecedor-fase{{$fase->idFase}}" id="valor-fornecedor-fase{{$fase->idFase}}"
                                            value="{{old('valor',$relacao->valor)}}" style="width:250px" required><br>
                                        </div>
                                        <div class="col-md-6">
                                            <label id="label3" for="data-fornecedor-fase{{$fase->idFase}}">Data de vencimento do pagamento ao fornecedor:</label><br>
                                            <input type="date" class="form-control" name="data-fornecedor-fase{{$fase->idFase}}" id="data-fornecedor-fase{{$fase->idFase}}"
                                            value="" style="width:250px"><br>
                                        </div>
                                        <div class="col-md-6">
                                            <br>
                                            <div class="float-left">
                                                <a id="button" style="color: white;" onclick="" class="btn btn-danger btn-icon-split btn-sm" title="remove">
                                                    <span class="icon text-white-50">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </span>
                                                    <span id="a_button" class="text">Remover fornecedor</span>
                                                </a>
                                                {{--<button type="button" onclick="" class="top-button">Remover fornecedor</button>--}}
                                            </div>
                                        </div>
                                    </div>
                                    @if($relacoes->toArray())
                                        @foreach ($relacoes as $relacao)
                                            @php
                                                $numF++;
                                            @endphp
                                            <div class="row" id="div-fornecedor{{$numF}}-fase{{$fase->idFase}}">
                                                <div class="col-md-6">
                                                    <label id="label1" for="fornecedor{{$numF}}-fase{{$fase->idFase}}">Fornecedor {{$numF}}:</label><br>
                                                    @if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null)
                                                        <select id="fornecedor{{$numF}}-fase{{$fase->idFase}}" name="fornecedor{{$numF}}-fase{{$fase->idFase}}" class="form-control" required>
                                                    @else
                                                        <select id="fornecedor{{$numF}}-fase{{$fase->idFase}}" name="fornecedor{{$numF}}-fase{{$fase->idFase}}" class="form-control" readonly>
                                                    @endIf
                                                        <option value="" selected></option>
                                                        @foreach($Fornecedores as $fornecedor)
                                                            @if($relacao->ifFornecedor == $fornecedor->ifFornecedor)
                                                            <option {{old('idFornecedor',$relacao->idFornecedor)}} value="{{$fornecedor->idFornecedor}}" selected>{{$fornecedor->nome.' -> '.$fornecedor->descricao}}</option>
                                                            @else
                                                            <option {{old('idFornecedor',$relacao->idFornecedor)}} value="{{$fornecedor->idFornecedor}}">{{$fornecedor->nome.' -> '.$fornecedor->descricao}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select><br>
                                                </div>
                                                <div class="col-md-6">
                                                    <label id="label2" for="valor-fornecedor{{$numF}}-fase{{$fase->idFase}}">Valor a pagar:</label><br>
                                                    <input type="number" min="0" class="form-control" name="valor-fornecedor{{$numF}}-fase{{$fase->idFase}}" id="valor-fornecedor{{$numF}}-fase{{$fase->idFase}}"
                                                    value="{{old('valor',$relacao->valor)}}" style="width:250px" required><br>
                                                </div>
                                                <div class="col-md-6">
                                                    <label id="label3" for="data-fornecedor{{$numF}}-fase{{$num}}">Data de vencimento do pagamento ao fornecedor:</label><br>
                                                    <input type="date" class="form-control" name="data-fornecedor{{$numF}}-fase{{$fase->idFase}}" id="data-fornecedor{{$numF}}-fase{{$fase->idFase}}"
                                                    value="{{date_create(old('dataVencimentoPagamento',$relacao->dataVencimentoPagamento))->format('Y-m-d')}}"
                                                    style="width:250px" required><br>
                                                </div>
                                                <div class="col-md-6">
                                                    <br>
                                                    <div class="float-left">
                                                        <a id="button" style="color: white;" onclick="removerFornecedor({{$numF}},{{$fase->idFase}},$(this).closest('#div-fornecedor{{$numF}}-fase{{$fase->idFase}}'))" class="btn btn-danger btn-icon-split btn-sm" title="remove">
                                                            <span class="icon text-white-50">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </span>
                                                            <span id="a_button" class="text">Remover fornecedor {{$numF}}</span>
                                                        </a>
                                                        {{--<button type="button" onclick="removerFornecedor({{$numF}},{{$fase->idFase}},$(this).closest('#div-fornecedor{{$numF}}-fase{{$fase->idFase}}'))" class="top-button">Remover fornecedor {{$numF}}</button>--}}
                                                    </div>
                                                </div>
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
                    <br><br>
                    <div class="col text-right" style="min-width:285px">
                        <button type="submit" class="btn btn-sm btn-success m-1 mr-2 px-3" name="submit"><i class="fas fa-check-circle mr-2"></i>Guardar produto</button>
                        <a href="javascript:history.go(-1)" class="btn btn-sm btn-secondary px-3">Cancelar</a>
                    </div>
                </div>
            </form>

        </div>

        </div>
    </div>
@endsection





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
                }/* else {
                    $("#cancelBtn").removeAttr("onclick");
                    button =
                        "<button class='btn btn-primary' type='submit' disabled><span class='spinner-border spinner-border-sm' role='status' aria-hidden='true' style='position:relative; bottom:4px; right:3px;'></span>A enviar...</button>";
                    $("#groupBtn").append(button);
                    $("#submitbtn").remove();
                }*/
                $(".needs-validation").addClass("was-validated");
            });
        });

        function addFornecedor(idFase, closest){
	        var numF = parseInt(closest.find('.numF').first().text());
			var clone = clones.clone();
	        closest.find('.numF').first().text(numF+1);
			clone.attr('id','div-fornecedor'+numF+'-fase'+idFase);
			$('#label1', clone).text("Fornecedor "+numF+":");
			$('#label1', clone).attr('for','fornecedor'+numF+'-fase'+idFase);
			$('select', clone).attr('id','fornecedor'+numF+'-fase'+idFase);
			$('select', clone).attr('name','fornecedor'+numF+'-fase'+idFase);
			$('#label2', clone).attr('for','valor-fornecedor'+numF+'-fase'+idFase);
			$('#valor-fornecedor-fase'+idFase, clone).attr('name','valor-fornecedor'+numF+'-fase'+idFase);
			$('#valor-fornecedor-fase'+idFase, clone).attr('id','valor-fornecedor'+numF+'-fase'+idFase);
			$('#label3', clone).text('Data de vencimento do pagamento ao fornecedor'+numF+':');
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
