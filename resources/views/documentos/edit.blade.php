@extends('layout.master')

{{-- Titulo da Página --}}
@section('title', 'Edição de um documento')

{{-- Estilos de CSS --}}
@section('styleLinks')
<link href="{{asset('/css/providers.css')}}" rel="stylesheet">
@endsection

{{-- Conteudo da Página --}}
@section('content')
<div class="container-fluid">

    <div class="cards-navigation">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h4 mb-0 text-gray-800">Edição do {{$tipo}}</h1>
        </div>

    </div>

    <div class="card shadow mb-4">
        <div class="formulario-edicao shadow-sm"><br>
            @if($tipoPAT == 'Pessoal')
                <form action="{{route('documento-pessoal.update',$documento)}}" method="post" enctype="multipart/form-data">
            @elseif($tipoPAT == 'Academico')
                <form action="{{route('documento-academico.update',$documento)}}" method="post" enctype="multipart/form-data">
            @else
                <form action="{{route('documento-transacao.update', $documento)}}" method="post" enctype="multipart/form-data">
            @endif
                @csrf
                @method('PUT')
                <div style="padding-left: 30px;">
                    @if(strtolower($tipo) == "transacao")
                        <div class="row documento-transacao">
                            <div class="col-md-8">
                                <label for="descricao">Descrição</label>
                                <br>
                                <input value="{{old('descricao',$documento->descricao)}}" type="text" class="form-control" name="descricao" placeholder="Descrição" autocomplete="off" required><br>
                            </div>
                            <div class="col-md-4">
                                <div class="col text-center" style="max-width:380px;min-width:298px;">
                                    <div>
                                        <label for="img_doc">Imagem:</label>
                                        <input type='file' id="img_doc" name="img_doc" style="display:none"
                                            accept="application/pdf, image/*" />
                                    </div>

                                    <div class="card mx-auto p-4 rounded shadow-sm text-center "
                                        style="width:80%;min-width:118px;min-height:120px">
                                        <a style="display:none;cursor:pointer"
                                            title="Clique para adicionar o documento do passaporte" id="doc_preview"
                                            class="">
                                            <i class="far fa-id-card mt-2" style="font-size:50px"></i>
                                            <div id="name_doc_file" class="text-muted">
                                                {{$documento->img_doc}}
                                            </div>
                                        </a>
                                        <i id="passport_preview_file" class="fas fa-plus-circle mt-2"
                                            style="font-size:60px;cursor:pointer"
                                            title="Clique para adicionar o documento do passaporte"></i>

                                    </div>
                                    <small class="text-muted">(clique para mudar)</small>

                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="valorRecebido">Valor recebido</label>
                                <br>
                                <input value="{{old('valorRecebido',$documento->valorRecebido)}}" type="number" class="form-control" name="valorRecebido" placeholder="0,00" autocomplete="off">
                            </div>
                            <div class="col-md-4">
                                <label for="tipoPagamento">Tipo pagamento</label>
                                <br>
                                <input value="{{old('tipoPagamento',$documento->tipoPagamento)}}" type="text" class="form-control" name="tipoPagamento" placeholder="Tipo pagamento" autocomplete="off" required>
                            </div>
                            <div class="col-md-3">
                                <label for="dataOperacao">Data da operação:</label>
                                <br>
                                <input value="{{old('dataOperacao',$documento->dataOperacao)}}" type="date" class="form-control" name="dataOperacao"  style="width:250px" required><br>
                            </div>
                            <div class="col-md-3">
                                <label for="dataRecebido">Data recebido:</label>
                                <br>
                                <input value="{{old('dataRecebido',$documento->dataRecebido)}}" type="date" class="form-control" name="dataRecebido" style="width:250px" ><br>
                            </div>
                            <div class="col-md-12">
                                <label for="idConta">Conta:</label><br>
                                <select name="idConta" class="form-control" required>
                                    <option value="" selected></option>
                                    @foreach($Contas as $conta)
                                        @if($documento->idConta == $conta->idConta)
                                            <option {{old('idConta',$documento->idConta)}} value="{{$conta->idConta}}" selected>{{$conta->numConta.' => '.$conta->descricao}}</option>
                                        @else
                                            <option {{old('idConta',$documento->idConta)}} value="{{$conta->idConta}}">{{$conta->numConta.' => '.$conta->descricao}}</option>
                                        @endif
                                    @endforeach
                                </select><br>
                            </div>
                            <div class="col-md-12">
                                <label for="observacoes">Observações</label>
                                <br>
                                <textarea value="{{old('observacoes',$documento->observacoes)}}" name="observacoes" class="form-control" id="observacoes" rows="4" placeholder="Observações">
                                    {{$documento->observacoes}}
                                </textarea>
                            </div>
                        </div>
                    @elseif(strtolower($tipo) == "passaporte")
                        <div class="row para-clone documento-passaporte">
                            <span class="num" style="display: none;">2</span>

                            <div class="col-md-6">
                                <div class="col text-center" style="max-width:380px;min-width:298px;">
                                    <div>
                                        <label for="img_doc">Imagem:</label>
                                        <input type='file' id="img_doc" name="img_doc" style="display:none"
                                            accept="application/pdf, image/*" />
                                    </div>

                                    <div class="card mx-auto p-4 rounded shadow-sm text-center "
                                        style="width:80%;min-width:118px;min-height:120px">
                                        <a style="display:none;cursor:pointer"
                                            title="Clique para adicionar o documento do passaporte" id="doc_preview"
                                            class="">
                                            <i class="far fa-id-card mt-2" style="font-size:50px"></i>
                                            <div id="name_doc_file" class="text-muted">
                                                {{$documento->img_doc}}
                                            </div>
                                        </a>
                                        <i id="passport_preview_file" class="fas fa-plus-circle mt-2"
                                            style="font-size:60px;cursor:pointer"
                                            title="Clique para adicionar o documento do passaporte"></i>

                                    </div>
                                    <small class="text-muted">(clique para mudar)</small>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="numPassaporte">Nº Passaporte: </label>
                                <input value="{{old('idConta',$documento->numPassaporte)}}" type="text" class="form-control" name="numPassaporte" placeholder="Nº Passaporte" autocomplete="off" required>
                            </div>
                            <div class="col-md-6">
                                <label for="dataValidPP">Data de validade: </label>
                                <input value="{{old('idConta',$documento->dataValidPP)}}" type="month" class="form-control" name="dataValidPP" value="{{date('Y-m', strtotime($documento->dataValidade))}}" style="width:250px" required><br>
                            </div>
                            <div class="col-md-6">
                                <label for="passaportPaisEmi">País de Emissão: </label>

    {{--                        <select name="passaportePaisEmi" id="passaportePaisEmi" class="form-control select_style" required>
                                    @include('layout.partials.countries');
                                </select>
                                <script>
                                    $("#passaportePaisEmi").val()= {{old('passaportePaisEmi',$documento->passaportePaisEmi)}} ;
                                </script> --}}

                                <input value="{{old('idConta',$documento->passaportePaisEmi)}}" type="text" class="form-control" name="passaportePaisEmi" placeholder="País de emissão do passaporte" autocomplete="off" required>
                            </div>
                            <div class="col-md-6">
                                <label for="localEmissaoPP">Local de Emissão: </label>
                                <input value="{{old('idConta',$documento->localEmissaoPP)}}" type="text" class="form-control" name="localEmissaoPP" value="" style="width:250px" required ><br>
                            </div>

                            <div class="list-clones">
                                @php
                                    $i=0;
                                @endphp
                                @foreach($infoKeys as $key)
                                    @php
                                        $i++;
                                    @endphp
                                    <div class="row" id="documento-campo{{$i}}">
                                        <div class="col-md-5">
                                            <label for="nome-campo{{$i}}">Nome do Campo {{$i}}</label>
                                            <br>
                                            <input value="{{$key}}" id="nome-campo{{$i}}" type="text" class="form-control" name="nome-campo{{$i}}" placeholder="Inserir nome do campo" autocomplete="off" required>
                                        </div>
                                        <div class="col-md-5">
                                            <label for="valor-campo{{$i}}">Valor do Campo {{$i}}</label>
                                            <br>
                                            <input value="{{$infoDoc[$key]}}" id="valor-campo{{$i}}" type="text" class="form-control" name="valor-campo{{$i}}" placeholder="Inserir valor do campo" autocomplete="off" required>
                                        </div>
                                        <div class="col-md-2">
                                            <br><a id="button" style="color: white;" onclick="removeCampo({{$i}},$(this).closest('#documento-campo{{$i}}'))" class="btn btn-danger btn-icon-split btn-sm" title="remove">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-trash-alt"></i>
                                                </span>
                                                <span id="a_button" class="text">Remover 1</span>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div><br>
                                <a style="color: white;" onclick="addCampo($(this).closest('.para-clone'))" class="btn btn-primary btn-icon-split btn-sm" title="Editar">
                                    <span class="text">Adicionar campo</span>
                                </a><br><br>
                            </div>
                        </div>
                    @else
                        <div class="para-clone documento">
                            <span class="num" style="display: none;">2</span>
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="col text-center" style="max-width:380px;min-width:298px;">
                                        <div>
                                            <label for="img_doc">Imagem:</label>
                                            <input type='file' id="img_doc" name="img_doc" style="display:none"
                                                accept="application/pdf, image/*" />
                                        </div>

                                        <div class="card mx-auto p-4 rounded shadow-sm text-center "
                                            style="width:80%;min-width:118px;min-height:120px">
                                            <a style="display:none;cursor:pointer"
                                                title="Clique para adicionar o documento do passaporte" id="doc_preview"
                                                class="">
                                                <i class="far fa-id-card mt-2" style="font-size:50px"></i>
                                                <div id="name_doc_file" class="text-muted">
                                                    {{$documento->img_doc}}
                                                </div>
                                            </a>
                                            <i id="passport_preview_file" class="fas fa-plus-circle mt-2"
                                                style="font-size:60px;cursor:pointer"
                                                title="Clique para adicionar o documento do passaporte"></i>

                                        </div>
                                        <small class="text-muted">(clique para mudar)</small>

                                    </div>
                                </div>
                                @if($tipoPAT == "Academico")
                                    <div class="col-md-5">
                                        <label for="nome">Nome: </label>
                                        <input type="text" class="form-control" name="nome" placeholder="Nome" value="{{old('idConta',$documento->nome)}}" autocomplete="off" required>
                                    </div>
                                @else
                                    <div class="col-md-5">
                                        <label for="dataValidade">Data de validade: </label>
                                        <input type="month" class="form-control"  id="dataValidade" name="dataValidade" value="{{date('Y-m', strtotime($documento->dataValidade))}}" style="width:250px" required><br>
                                    </div>
                                @endif
                            </div>
                            <div class="list-clones">
                                @php
                                    $i=0;
                                @endphp
                                @foreach($infoKeys as $key)
                                    @php
                                        $i++;
                                    @endphp
                                    <div class="row" id="documento-campo{{$i}}">
                                        <div class="col-md-5">
                                            <label for="nome-campo{{$i}}">Nome do Campo {{$i}}</label>
                                            <br>
                                            <input value="{{$key}}" id="nome-campo{{$i}}" type="text" class="form-control" name="nome-campo{{$i}}" placeholder="Inserir nome do campo" autocomplete="off" required>
                                        </div>
                                        <div class="col-md-5">
                                            <label for="valor-campo{{$i}}">Valor do Campo {{$i}}</label>
                                            <br>
                                            <input value="{{$infoDoc[$key]}}" id="valor-campo{{$i}}" type="text" class="form-control" name="valor-campo{{$i}}" placeholder="Inserir valor do campo" autocomplete="off" required>
                                        </div>
                                        <div class="col-md-2">
                                            <br><a id="button" style="color: white;" onclick="removeCampo({{$i}},$(this).closest('#documento-campo{{$i}}'))" class="btn btn-danger btn-icon-split btn-sm" title="remove">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-trash-alt"></i>
                                                </span>
                                                <span id="a_button" class="text">Remover 1</span>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div><br>
                                <a style="color: white;" onclick="addCampo($(this).closest('.para-clone'))" class="btn btn-primary btn-icon-split btn-sm" title="Editar">
                                    <span class="text">Adicionar campo</span>
                                </a><br><br>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="row clones" id="clonar">
                <div class="col-md-5">
                    <br><label id="label1" for="nome-campo">Nome do Campo</label>
                    <br>
                    <input id="input1" type="text" class="form-control" name="nome-campo" placeholder="Inserir nome do campo" autocomplete="off" required>
                </div>
                <div class="col-md-5">
                    <br><label id="label2" for="valor-campo">Valor do Campo</label>
                    <br>
                    <input id="input2" type="text" class="form-control" name="valor-campo" placeholder="Inserir valor do campo" autocomplete="off" required>
                </div>
                <div class="col-md-2">
                    <br><br><a id="button" style="color: white;" onclick="" class="btn btn-danger btn-icon-split btn-sm" title="remove">
                        <span class="icon text-white-50">
                            <i class="fas fa-trash-alt"></i>
                        </span>
                        <span id="a_button" class="text">Remover 1</span>
                    </a>
                </div>
            </div>
            <div class="form-group text-right">
                <br>
                <button type="submit" class="btn btn-sm btn-success m-1 mr-2 px-3" name="submit"><i class="fas fa-check-circle mr-2"></i>Alterar documento</button>
                <a href="javascript:history.go(-1)" class="btn btn-sm btn-secondary px-3">Cancelar</a>
            </div>
        </form>
        <br>
    </div>
</div>

@section('scripts')
    <script type="text/javascript">
        var clones = $('#clonar').clone();
        $('#clonar').remove();

        function addCampo(closest){
            var num = parseInt(closest.find('.num').first().text());
            var clone = clones.clone();
            closest.find('.num').first().text(num+1);
            clone.attr('id','documento-campo'+num);
            $('#label1', clone).text("Nome do campo "+num+":");
            $('#label1', clone).attr('for','nome-campo'+num);
            $('#input1', clone).attr('name','nome-campo'+num);
            $('#input1', clone).attr('id','nome-campo'+num);
            $('#label2', clone).text("Valor do campo "+num+":");
            $('#label2', clone).attr('for','valor-campo'+num);
            $('#input2', clone).attr('name','valor-campo'+num);
            $('#input2', clone).attr('id','valor-campo'+num);
            $('#button', clone).attr('onclick','removeCampo('+num+',$(this).closest("#documento-campo'+num+'"))');
            $('#button', clone).attr('id','javascript-button');
            $('#a_button', clone).text('Remover '+num);
            closest.find('.list-clones').first().append(clone);
        }

        function removeCampo(num,closest){
            $('#nome-campo'+num).val(null);
            $('#valor-campo'+num).val(null);
            $("#nome-campo"+num).attr("required", false);
            $("#valor-campo"+num).attr("required", false);
            closest.css("display", "none");
        }

        //Preview do Passporte+++++++++++++++
        $('#passport_preview_file').on('click', function (e) {
            e.preventDefault();
            $('#img_doc').trigger('click');
        });

        $('#doc_preview').on('click', function (e) {
            e.preventDefault();
            $('#img_doc').trigger('click');
        });


        function readPassaPortImgURL(input) {
            if (input.files && input.files[0]) {
                var iddocumento = new FileReader();
                iddocumento.onload = function (e) {
                    iddocumento.fileName = img_doc.name;
                    $('#name_doc_file').text(input.files[0].name);
                }

                iddocumento.readAsDataURL(input.files[0]);
            }
        }

        $("#img_doc").change(function () {
            readPassaPortImgURL(this);
            $('#passport_preview_file').hide();
            $('#doc_preview').show();

        });
    </script>
@endsection

@endsection
