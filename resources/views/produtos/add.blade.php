@extends('layout.master')
<!-- Page Title -->
@section('title', 'Criação de um produto')
<!-- Page Content -->
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800">Criação de um produto</h1>
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
            <h6 class="m-0 font-weight-bold text-primary">Formulário de criação de um produto para o cliente {{$cliente->nome.' '.$cliente->apelido}}.</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('produtos.store', $produtoStock)}}" class="form-group needs-validation" novalidate>
                @csrf
                <div class="container-fluid">
                    <input type="text" class="form-control" name="idCliente" id="idCliente" value="{{old('idCliente',$cliente->idCliente)}}" readonly hidden>
                    <div class="form-row mb-3">
                        <div class="col-md-4 mb-3">
                            <label class="text-gray-900" for="tipo">Tipo de produto</label>
                            <input type="text" class="form-control" name="tipo" id="tipo" value="{{old('tipo', $produto->tipo)}}" readonly>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="text-gray-900" for="descricao">Descrição do produto</label>
                            <input type="text" class="form-control" name="descricao" id="descricao" value="{{old('descricao', $produto->descricao)}}" readonly>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="text-gray-900" for="AnoAcademico">Ano académico <sup class="text-danger small">&#10033;</sup></label>
                            <select type="text" class="form-control custom-select" name="anoAcademico" id="anoAcademico" required>
                                <option disabled hidden selected>Escolha um ano académico...</option>
                                @foreach($anosAcademicos as $ano)
                                    <option {{old('anoAcademico',$produto->anoAcademico)==$ano?"selected":""}} value="{{$ano}}">{{$ano}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Oops, parece que algo não está bem...
                            </div>
                        </div>
                    </div>

                    <div class="form-row mb-3">
                        <div class="col-md-6 mb-3">
                            <label class="text-gray-900" for="agente">Agente <sup class="text-danger small">&#10033;</sup></label>
                            <select id="agente" name="agente" class="form-control custom-select" required>
                                <option hidden disabled selected>Escolha um agente...</option>
                                @foreach($Agentes as $agente)
                                <option {{old('idAgente',$produto->idAgente)}} value="{{$agente->idAgente}}">{{$agente->nome.' '.$agente->apelido.' ('.$agente->email.')'}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Oops, parece que algo não está bem...
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="text-gray-900" for="subagente">Sub-agente</label>
                            <select id="subagente" name="subagente" class="form-control custom-select">
                                <option hidden selected value="">Escolha um sub-agente...</option>
                                @foreach($SubAgentes as $subagente)
                                <option {{old('idSubAgente',$produto->idSubAgente)}} value="{{$subagente->idAgente}}">{{$subagente->nome.' '.$subagente->apelido.' ('.$subagente->email.')'}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-row mb-3">
                        <div class="col-md-6 mb-3">
                            <label class="text-gray-900" for="uni1">Universidade principal <sup class="text-danger small">&#10033;</sup></label>
                            <select id="uni1" name="uni1" class="form-control custom-select" required>
                                <option hidden disabled selected>Escolha um universidade...</option>
                                @foreach($Universidades as $uni)
                                <option {{old('idUniversidade1',$produto->idUniversidade1)}} value="{{$uni->idUniversidade}}">{{$uni->nome.' ('.$uni->email.')'}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Oops, parece que algo não está bem...
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="text-gray-900" for="uni2">Universidade secundária</label>
                            <select id="uni2" name="uni2" class="form-control custom-select">
                                <option hidden selected value="">Escolha um universidade...</option>
                                @foreach($Universidades as $uni)
                                <option {{old('idUniversidade2',$produto->idUniversidade2)}} value="{{$uni->idUniversidade}}">{{$uni->nome.' ('.$uni->email.')'}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div id="formulario-fases">
                        <div class="tab-content mt-4" id="myTabContent">
                            <ul class="nav nav-tabs mt-5 mb-4" id="myTab" role="tablist">
                                @php
                                $num = 0;
                                @endphp
                                @foreach($Fases as $fase)
                                @php
                                $num++;
                                @endphp
                                @if($num == 1)
                                <li class="nav-item" id="fase{{$num}}-li" style="width:25%; min-width:110px">
                                    <a class="nav-link active" id="fase{{$num}}-tab" data-toggle="tab" href="#fase{{$num}}" role="tab" aria-controls="fase{{$num}}" aria-selected="false">Fase {{$num}} - {{$fase->descricao}}</a>
                                </li>
                                @else
                                <li class="nav-item" id="fase{{$num}}-li" style="width:25%; min-width:144px">
                                    <a class="nav-link" id="fase{{$num}}-tab" data-toggle="tab" href="#fase{{$num}}" role="tab" aria-controls="fase{{$num}}" aria-selected="false">Fase {{$num}} - {{$fase->descricao}}</a>
                                </li>
                                @endif
                                @endforeach
                            </ul>

                            @php
                            $num = 0;
                            @endphp
                            @foreach ($Fases as $fase)
                            @php
                            $num++;
                            @endphp
                            @if($num==1)
                            <div class="tab-pane fade active show" id="fase{{$num}}" role="tabpanel" aria-labelledby="fase{{$num}}-tab">
                                @else
                                <div class="tab-pane fade" id="fase{{$num}}" role="tabpanel" aria-labelledby="fase{{$num}}-tab">
                                    @endif

                                    <div class="form-row mb-3">
                                        <div class="col-md-4 mb-3">
                                            <label class="text-gray-900" for="descricao-fase{{$num}}">Descrição da fase</label>
                                            <input type="text" class="form-control" name="descricao-fase{{$num}}" id="descricao-fase{{$num}}" value="{{old('descricao',$fase->descricao)}}" readonly>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="text-gray-900" for="valor-fase{{$num}}">Valor total da fase <sup class="text-danger small">&#10033;</sup></label>
                                            <div class="input-group">
                                                <input type="number" class="form-control form-required" name="valor-fase{{$num}}" id="valor-fase{{$num}}" value="{{old('valorFase',$fase->valorFase)}}" placeholder="Inserir um valor..." required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">€</span>
                                                </div>
                                            </div>
                                            <div class="invalid-feedback">
                                                Oops, parece que algo não está bem...
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="text-gray-900" for="data-fase{{$num}}">Data de vencimento <sup class="text-danger small">&#10033;</sup></label>
                                            <input type="date" class="form-control" name="data-fase{{$num}}" id="data-fase{{$num}}" value="{{date_create(old('dataVencimento',$fase->dataVencimento))->format('Y-m-d')}}" required>
                                            <div class="invalid-feedback">
                                                Oops, parece que algo não está bem...
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="mt-4 mb-4">
                                        <p class="text-gray-900 h5"><b>Responsabilidades</b></p>
                                    </div>
                                    <div class="form-row mb-3">
                                        <div class="col-md-6 mb-3">
                                            <label class="text-gray-900" for="resp-cliente-fase{{$num}}">Pocket Money para cliente</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control" name="resp-cliente-fase{{$num}}" id="resp-cliente-fase{{$num}}" value="{{old('valorCliente',$Responsabilidades[$num-1]->valorCliente)}}"
                                                    placeholder="Inserir um valor...">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">€</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="text-gray-900" for="resp-data-cliente-fase{{$num}}">Data de vencimento (Cliente)</label>
                                            <div class="input-group">
                                                <input type="date" class="form-control" name="resp-data-cliente-fase{{$num}}" id="resp-data-cliente-fase{{$num}}">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row mb-3">
                                        <div class="col-md-6 mb-3">
                                            <label class="text-gray-900" for="resp-agente-fase{{$num}}">Valor a pagar ao agente</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control" name="resp-agente-fase{{$num}}" id="resp-agente-fase{{$num}}" value="{{old('valorAgente',$Responsabilidades[$num-1]->valorAgente)}}"
                                                    placeholder="Inserir um valor...">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">€</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="text-gray-900" for="resp-data-agente-fase{{$num}}">Data de vencimento (Agente)</label>
                                            <div class="input-group">
                                                <input type="date" class="form-control" name="resp-data-agente-fase{{$num}}" id="resp-data-agente-fase{{$num}}">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row mb-3">
                                        <div class="col-md-6 mb-3">
                                            <label class="text-gray-900" for="resp-subagente-fase{{$fase->idFase}}">Valor a pagar ao sub-agente</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control" name="resp-subagente-fase{{$fase->idFase}}" id="resp-subagente-fase{{$fase->idFase}}"
                                                    value="{{old('valorSubAgente',$Responsabilidades[$num-1]->valorSubAgente)}}" placeholder="Inserir um valor...">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">€</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="text-gray-900" for="resp-data-subagente-fase{{$num}}">Data de vencimento (Sub-agente)</label>
                                            <div class="input-group">
                                                <input type="date" class="form-control" name="resp-data-subagente-fase{{$num}}" id="resp-data-subagente-fase{{$num}}">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row mb-3">
                                        <div class="col-md-6 mb-3">
                                            <label class="text-gray-900" for="resp-uni1-fase{{$num}}">Valor a pagar á universidade principal</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control" name="resp-uni1-fase{{$num}}" id="resp-uni1-fase{{$num}}" value="{{old('valorUniversidade1',$Responsabilidades[$num-1]->valorUniversidade1)}}"
                                                    placeholder="Inserir um valor...">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">€</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="text-gray-900" for="resp-data-uni1-fase{{$num}}">Data de vencimento (Universidade principal)</label>
                                            <div class="input-group">
                                                <input type="date" class="form-control" name="resp-data-uni1-fase{{$num}}" id="resp-data-uni1-fase{{$num}}">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row mb-3">
                                        <div class="col-md-6 mb-3">
                                            <label class="text-gray-900" for="resp-uni2-fase{{$num}}">Valor a pagar á universidade secundária</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control" name="resp-uni2-fase{{$num}}" id="resp-uni2-fase{{$num}}" value="{{old('valorUniversidade2',$Responsabilidades[$num-1]->valorUniversidade2)}}"
                                                    placeholder="Inserir um valor...">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">€</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="text-gray-900" for="resp-data-uni2-fase{{$num}}">Data de vencimento (Universidade secundária)</label>
                                            <div class="input-group">
                                                <input type="date" class="form-control" name="resp-data-uni2-fase{{$num}}" id="resp-data-uni2-fase{{$num}}">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="mt-4 mb-4">
                                        <p class="text-gray-900 h5"><b>Fornecedores</b></p>
                                    </div>
                                    <div class="list-fornecedores">
                                        <span class="numF" style="display: none;">1</span>
                                        <div class="fornecedor">
                                            <div id="clonar" class="mb-5">
                                                <div class="form-row mb-3">
                                                    <div class="col-md-4 mb-3">
                                                        {{-- <p>{{$num}}</p> --}}
                                                        <label class="text-gray-900" id="label1" for="fornecedor-fase{{$num}}">Fornecedor #1</label>
                                                        <select id="fornecedor-fase{{$num}}" name="fornecedor-fase{{$num}}" class="form-control custom-select" required>
                                                            <option selected disabled hidden>Escolha um fornecedor...</option>
                                                            @foreach($Fornecedores as $fornecedor)
                                                            <option {{old('idFornecedor',$relacao->idFornecedor)}} value="{{$fornecedor->idFornecedor}}">{{$fornecedor->nome.' ('.$fornecedor->descricao.')'}}</option>
                                                            @endforeach
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            Oops, parece que algo não está bem...
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <label class="text-gray-900" id="label2" for="">Valor a pagar <sup class="text-danger small">&#10033;</sup></label>
                                                        <div class="input-group">
                                                            <input type="number" class="form-control" name="valor-fornecedor-fase{{$num}}" id="valor-fornecedor-fase{{$num}}" value="{{old('valor',$relacao->valor)}}" placeholder="Insira um valor...">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">€</span>
                                                            </div>
                                                            <div class="invalid-feedback">
                                                                Oops, parece que algo não está bem...
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <label class="text-gray-900" id="label3" for="data-fornecedor-fase{{$num}}">Data de vencimento (Fornecedor)</label>
                                                        <div class="input-group">
                                                            <input type="date" class="form-control" name="data-fornecedor-fase{{$num}}" id="data-fornecedor-fase{{$num}}">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-right mt-3">
                                                    <a id="button" style="color: white;" onclick="" class="btn btn-danger btn-icon-split btn-sm" title="Remover">
                                                        <span class="icon text-white-50">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </span>
                                                        <span id="a_button" class="text">Remover fornecedor</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <a style="color: white;" onclick="addFornecedor({{$num}},$(this).closest('.list-fornecedores'))" class="btn btn-primary btn-icon-split btn-sm" title="Adicionar">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-plus"></i>
                                                </span>
                                                <span class="text">Adicionar fornecedor</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="text-right mt-3 mr-4" id="groupBtn">
                        <a href="javascript:history.go(-1)" class="mr-4 font-weight-bold" id="cancelBtn" style="cursor:pointer;">Cancelar</a>
                        <button type="submit" name="button" class="btn btn-primary text-white font-weight-bold" id="submitbtn">Atribuir produto</button>
                    </div>
                </div>
            </form>
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
                    Ao preencher o formulário irá criar um novo produto associado ao cliente <b>{{$cliente->nome.' '.$cliente->apelido}}</b>. Os campos com o asterisco de cor vermelha são de preenchimento obrigatório.
                </div>
                <div class="modal-footer mt-3">
                    <a data-dismiss="modal" class="mr-4 font-weight-bold" id="close-option">Fechar</a>
                    <button type="button" data-dismiss="modal" class="btn btn-primary font-weight-bold mr-2">Entendido!</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Modal for more information  -->

    <!-- Begin of Scripts -->
    @section('scripts')
    <script>
        var clones = $('#clonar').clone();
        $('.fornecedor').html('');

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

        function addFornecedor(idFase, closest) {
            var numF = parseInt(closest.find('.numF').first().text());
            var clone = clones.clone();
            var sup = "<sup class='text-danger small'>&#10033;</sup>";
            closest.find('.numF').first().text(numF + 1);
            clone.attr('id', 'div-fornecedor' + numF + '-fase' + idFase);
            $('#label1', clone).text("Fornecedor #" + numF);
            $('#label1', clone).append(" " + sup);
            $('#label1', clone).attr('for', 'fornecedor' + numF + '-fase' + idFase);
            $('select', clone).attr('id', 'fornecedor' + numF + '-fase' + idFase);
            $('select', clone).attr('name', 'fornecedor' + numF + '-fase' + idFase);
            $('#label2', clone).attr('for', 'valor-fornecedor' + numF + '-fase' + idFase);
            $('#valor-fornecedor-fase' + idFase, clone).attr('name', 'valor-fornecedor' + numF + '-fase' + idFase);
            $('#valor-fornecedor-fase' + idFase, clone).attr('id', 'valor-fornecedor' + numF + '-fase' + idFase);
            $('#label3', clone).text('Data de vencimento (Fornecedor #' + numF + ")");
            $('#label3', clone).attr('for', 'data-fornecedor' + numF + '-fase' + idFase);
            $('#data-fornecedor-fase' + idFase, clone).attr('name', 'data-fornecedor' + numF + '-fase' + idFase);
            $('#data-fornecedor-fase' + idFase, clone).attr('id', 'data-fornecedor' + numF + '-fase' + idFase);
            $('#button', clone).attr('onclick', 'removerFornecedor(' + numF + ',' + idFase + ',$(this).closest("#div-fornecedor' + numF + '-fase' + idFase + '"))');
            $('#a_button', clone).text('Remover fornecedor #' + numF);
            closest.find('.fornecedor').first().append(clone);
        }

        function removerFornecedor(numF, idFase, fornecedor) {
            $('#fornecedor' + numF + '-fase' + idFase).val($('#fornecedor' + numF + '-fase' + idFase + ' > option:first').val());
            $("#fornecedor" + numF + "-fase" + idFase).attr("required", false);
            $("#valor-fornecedor" + numF + "-fase" + idFase).attr("required", false);
            fornecedor.css("display", "none");
        }
    </script>
    @endsection
    <!-- End of Scripts -->
    @endsection
    <!-- End of Page Content -->
