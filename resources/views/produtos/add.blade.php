@extends('layout.master')

{{-- Page Title --}}
@section('title', 'Adicionar produto')

{{-- CSS Style Link --}}
@section('styleLinks')
    <link href="{{asset('css/produtos.css')}}" rel="stylesheet">
@endsection

{{-- Page Content --}}
@section('content')

<div class="container mt-2">
    {{-- Navegação --}}
    <div class="float-left">
        <a href="javascript:history.go(-1)" title="Voltar"><i
                class="fas fa-arrow-left rounded-circle p-2 nav_btns mr-3"></i></a>
        <a href="javascript:window.history.forward();" title="Avançar"><i
                class="fas fa-arrow-right rounded-circle p-2 nav_btns"></i></a>
    </div>

    <br><br>
    <div class="cards-navigation">
        <div class="title">
            <h6>Adicionar produto</h6>
        </div>
        <br>
        <form method="POST" action="{{route('produtos.store', $produtoStock)}}" class="form-group needs-validation pt-3" id="form_produto"
            enctype="multipart/form-data" novalidate>
            @csrf<div class="tab-content p-2 mt-3" id="myTabContent">

                {{-- Conteudo: Informação pessoal --}}
                <div>
                    <div class="row">
                        <div class="col">
                            {{-- INPUT nome --}}
                            <label for="nome">Cliente:
                                <a class="name_link" href="{{route('clients.show',$cliente)}}">
                                    {{$cliente->nome.' '.$cliente->apelido}}
                                </a>
                                <input type="text" class="form-control" name="idCliente" id="idCliente"
                                value="{{$cliente->idCliente}}"  maxlength="20"
                                style="display:none;" readonly><br>
                            </label>
                        </div>
                    </div>
                    <br>
                    {{--<div class="row">
                        <div class="col">
                            <label for="nome">Escolha o produto: <span class="text-danger">*</span></label>
                            <select class="form-control" id="produto" onchange="AtualizaProduto(this.value, $(this).closest('#form_produto'))" required>
                                <option value="0" selected></option>
                                @foreach($produtoStock as $prodS)
                                    @php
                                        $faseS = $prodS->faseStock->toArray();
                                    @endphp
                                    <option value="{{$prodS->idProdutoStock}}">{{$prodS->tipo."\t".$prodS->descricao."\t".count($faseS).' fases'}}</option>
                                @endforeach
                            </select><br><br>
                        </div>
                    </div>--}}
                    <div class="row" id="formulario-produto">
                        <div class="col">
                            <div><span><b>Produto</b></span></div><br>

                            <label for="tipo">Tipo:</label><br>
                            <input type="text" class="form-control" name="tipo" id="tipo"
                            value="{{old('tipo',$produto->tipo)}}" placeholder="Tipo" maxlength="20" readonly><br>

                            <label for="descricao">Descrição:</label><br>
                            <input type="text" class="form-control" name="descricao" id="descricao"
                            value="{{old('descricao',$produto->descricao)}}" placeholder="Descricao" maxlength="20" readonly><br>

                            <label for="AnoAcademico">Ano académico: <span class="text-danger">*</span></label><br>
                            <input type="text" class="form-control" name="anoAcademico" id="anoAcademico"
                            value="{{old('anoAcademico',$produto->anoAcademico)}}" placeholder="Ano Academico" maxlength="20" required><br>

                            <label for="agente">Agente: <span class="text-danger">*</span></label><br>
                            <select id="agente" name="agente" class="form-control" required>
                                <option value="" selected></option>
                                @foreach($Agentes as $agente)
                                    <option {{old('idAgente',$produto->idAgente)}} value="{{$agente->idAgente}}">{{$agente->nome.' '.$agente->apelido.' -> '.$agente->email}}</option>
                                @endforeach
                            </select><br>
                            <label for="subagente">Sub-Agente:</label><br>
                            <select id="subagente" name="subagente" class="form-control">
                                <option value="" selected></option>
                                @foreach($SubAgentes as $subagente)
                                    <option {{old('idSubAgente',$produto->idSubAgente)}} value="{{$subagente->idAgente}}">{{$subagente->nome.' '.$subagente->apelido.' -> '.$subagente->email}}</option>
                                @endforeach
                            </select><br>
                            <label for="uni1">Universidade Principal: <span class="text-danger">*</span></label><br>
                            <select id="uni1" name="uni1" class="form-control" required>
                                <option value="" selected></option>
                                @foreach($Universidades as $uni)
                                    <option {{old('idUniversidade1',$produto->idUniversidade1)}} value="{{$uni->idUniversidade}}">{{$uni->nome.' -> '.$uni->email}}</option>
                                @endforeach
                            </select><br>

                            <label for="uni2">Universidade Secundária:</label><br>
                            <select id="uni2" name="uni2" class="form-control">
                                <option value="" selected></option>
                                @foreach($Universidades as $uni)
                                    <option {{old('idUniversidade2',$produto->idUniversidade2)}} value="{{$uni->idUniversidade}}">{{$uni->nome.' -> '.$uni->email}}</option>
                                @endforeach
                            </select><br>

                        </div>
                    </div>
                </div>
                <div id="formulario-fases">
                    <div class="tab-content p-2 mt-3" id="myTabContent">
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
                                        <a class="nav-link active" id="fase{{$num}}-tab" data-toggle="tab" href="#fase{{$num}}" role="tab"
                                            aria-controls="fase{{$num}}" aria-selected="false">Fase {{$num}}</a>
                                    </li>
                                @else
                                    <li class="nav-item" id="fase{{$num}}-li" style="width:25%; min-width:144px">
                                        <a class="nav-link" id="fase{{$num}}-tab" data-toggle="tab" href="#fase{{$num}}" role="tab"
                                            aria-controls="fase{{$num}}" aria-selected="false">Fase {{$num}}</a>
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
                                <div class="row">
                                    <div class="row col-md-12">

                                        <div><span><b>Fase {{$num}}</b></span></div><br><br>

                                        <div class="col-md-12">
                                            <label for="descricao-fase{{$num}}">Descrição:</label><br>
                                            <input type="text" class="form-control" name="descricao-fase{{$num}}" id="descricao-fase{{$num}}"
                                            value="{{old('descricao',$fase->descricao)}}" placeholder="descricao" maxlength="20" readonly><br>
                                        </div>

                                        <div class="col-md-5">
                                            <label for="data-fase{{$num}}">Data de vencimento: <span class="text-danger">*</span></label><br>
                                            <input type="date" class="form-control" name="data-fase{{$num}}" id="data-fase{{$num}}"
                                            value="{{date_create(old('dataVencimento',$fase->dataVencimento))->format('Y-m-d')}}" style="width:250px" required/><br>
                                        </div>
                                        <div class="col-md-5">
                                            <label for="valor-fase{{$num}}">Valor total da fase: <span class="text-danger">*</span></label><br>
                                            <input type="number" min="0" class="form-control form-required" name="valor-fase{{$num}}" id="valor-fase{{$num}}"
                                            value="{{old('valorFase',$fase->valorFase)}}" style="width:250px" required/><br>
                                        </div>
                                    </div>

                                    <div class="col mr-3">
                                        <div><span><b>Responsabilidades</b></span></div><br>
                                        <label for="resp-cliente-fase{{$num}}">PickPocket para cliente: <span class="text-danger">*</span></label><br>
                                        <input type="number" min="0" class="form-control" name="resp-cliente-fase{{$num}}" id="resp-cliente-fase{{$num}}"
                                        value="{{old('valorCliente',$Responsabilidades[$num-1]->valorCliente)}}" style="width:250px" required><br>

                                        <label for="resp-data-cliente-fase{{$num}}">Data de vencimento do pagamento ao cliente:</label><br>
                                        <input type="date" class="form-control" name="resp-data-cliente-fase{{$num}}" id="resp-data-cliente-fase{{$num}}"
                                        value="" style="width:250px" ><br>

                                        <label for="resp-agente-fase{{$num}}">Valor a pagar ao agente: <span class="text-danger">*</span></label><br>
                                        <input type="number" min="0" class="form-control" name="resp-agente-fase{{$num}}" id="resp-agente-fase{{$num}}"
                                        value="{{old('valorAgente',$Responsabilidades[$num-1]->valorAgente)}}" style="width:250px" required><br>

                                        <label for="resp-data-agente-fase{{$num}}">Data de vencimento do pagamento ao agente:</label><br>
                                        <input type="date" class="form-control" name="resp-data-agente-fase{{$num}}" id="resp-data-agente-fase{{$num}}"
                                        value="" style="width:250px" ><br>

                                        <label for="resp-subagente-fase{{$fase->idFase}}">Valor a pagar ao sub-agente:</label><br>
                                        <input type="number" class="form-control valor-pagar-subagente" name="resp-subagente-fase{{$fase->idFase}}" id="resp-subagente-fase{{$fase->idFase}}"
                                        value="{{old('valorSubAgente',$Responsabilidades[$num-1]->valorSubAgente)}}" style="width:250px"><br>

                                        <label for="resp-data-subagente-fase{{$num}}">Data de vencimento do pagamento ao subagente:</label><br>
                                        <input type="date" class="form-control" name="resp-data-subagente-fase{{$num}}" id="resp-data-subagente-fase{{$num}}"
                                        value="" style="width:250px" ><br>

                                        <label for="resp-uni1-fase{{$num}}">Valor a pagar á universidade principal: <span class="text-danger">*</span></label><br>
                                        <input type="number" min="0" class="form-control" name="resp-uni1-fase{{$num}}" id="resp-uni1-fase{{$num}}"
                                        value="{{old('valorUniversidade1',$Responsabilidades[$num-1]->valorUniversidade1)}}" style="width:250px" required><br>

                                        <label for="resp-data-uni1-fase{{$num}}">Data de vencimento do pagamento à universidade principal:</label><br>
                                        <input type="date" class="form-control" name="resp-data-uni1-fase{{$num}}" id="resp-data-uni1-fase{{$num}}"
                                        value="" style="width:250px" ><br>

                                        <label for="resp-uni2-fase{{$num}}">Valor a pagar á universidade secundária:</label><br>
                                        <input type="number" min="0" class="form-control" name="resp-uni2-fase{{$num}}" id="resp-uni2-fase{{$num}}"
                                        value="{{old('valorUniversidade2',$Responsabilidades[$num-1]->valorUniversidade2)}}" style="width:250px"><br>

                                        <label for="resp-data-uni2-fase{{$num}}">Data de vencimento do pagamento à universidade secundária:</label><br>
                                        <input type="date" class="form-control" name="resp-data-uni2-fase{{$num}}" id="resp-data-uni2-fase{{$num}}"
                                        value="" style="width:250px" ><br>
                                    </div>

                                    <div class="col list-fornecedores" style="min-width:225px">
                                        <div><span><b>Fornecedores</b></span></div><br>
                                        <span class="numF" style="display: none;">1</span>
                                        <div class="fornecedor">
                                            <div id="clonar">
                                                <label id="label1" for="fornecedor-fase{{$num}}">Fornecedor 1:</label><br>
                                                <select id="fornecedor-fase{{$num}}" name="fornecedor-fase{{$num}}" class="form-control" required>
                                                    <option value="" selected></option>
                                                    @foreach($Fornecedores as $fornecedor)
                                                        <option {{old('idFornecedor',$relacao->idFornecedor)}} value="{{$fornecedor->idFornecedor}}">{{$fornecedor->nome.' -> '.$fornecedor->descricao}}</option>
                                                    @endforeach
                                                </select><br>
                                                <label id="label2" for="valor-fornecedor-fase{{$num}}">Valor a pagar:</label><br>
                                                <input type="number" min="0" class="form-control" name="valor-fornecedor-fase{{$num}}" id="valor-fornecedor-fase{{$num}}"
                                                value="{{old('valor',$relacao->valor)}}" style="width:250px" required><br>

                                                <label id="label3" for="data-fornecedor-fase{{$num}}">Data de vencimento do pagamento ao fornecedor:</label><br>
                                                <input type="date" class="form-control" name="data-fornecedor-fase{{$num}}" id="data-fornecedor-fase{{$num}}"
                                                value="" style="width:250px" ><br>
                                                <div class="float-right">
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
                                        <div>
                                            <a style="color: white;" onclick="addFornecedor({{$num}},$(this).closest('.list-fornecedores'))" class="btn btn-primary btn-icon-split btn-sm" title="Editar">
                                                <span class="text">Adicionar fornecedor</span>
                                            </a>
                                            {{--<button type="button" onclick="addFornecedor({{$num}},$(this).closest('.list-fornecedores'))" class="top-button">Adicionar fornecedor</button>--}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="form-group text-right">
                <br><br>
                <div class="col text-right" style="min-width:285px">
                    <button type="submit" class="btn btn-sm btn-success m-1 mr-2 px-3" name="submit"><i class="fas fa-check-circle mr-2"></i>Adicionar produto</button>
                    <a href="javascript:history.go(-2)" class="btn btn-sm btn-secondary px-3">Cancelar</a>
                </div>
            </div>
        </form>
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
        $('.fornecedor').html('');
        /*$("#formulario-produto").css("display", "none");
        $("#formulario-fases").css("display", "none");/**/


        $(document).ready(function() {
            bsCustomFileInput.init();
            $(".needs-validation").submit(function(event) {
                if (this.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                } /*else {
                    $("#cancelBtn").removeAttr("onclick");
                    button =
                        "<button class='btn btn-primary' type='submit' disabled><span class='spinner-border spinner-border-sm' role='status' aria-hidden='true' style='position:relative; bottom:4px; right:3px;'></span>A enviar...</button>";
                    $("#groupBtn").append(button);
                    $("#submitbtn").remove();
                }/**/
                $(".needs-validation").addClass("was-validated");
            });
        });/**/
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

    </script>

@endsection
