@extends('layout.master')
<!-- Page Title -->
@section('title', 'Adicionar um documento')
<!-- Page Content -->
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800">Registo de um documento {{strtolower($tipoPAT)}}</h1>
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
            <h6 class="m-0 font-weight-bold text-primary">Formulário de registo do documento {{strtolower($tipoPAT)}} "{{$tipo}}" afeto ao cliente {{$client->nome.' '.$client->apelido}}.</h6>
        </div>
        <div class="card-body">
            @if($fase)
            @if($tipoPAT == 'Pessoal')
            <form class="needs-validation" novalidate action="{{route('documento-pessoal.store', [$fase,$docnecessario])}}" method="post" enctype="multipart/form-data">
                @elseif($tipoPAT == 'Academico')
                <form class="needs-validation" novalidate action="{{route('documento-academico.store', [$fase,$docnecessario])}}" method="post" enctype="multipart/form-data">
                    @else
                    <form class="needs-validation" novalidate action="{{route('documento-transacao.store', $fase)}}" method="post" enctype="multipart/form-data">
                        @endif
                        @else
                        @if($tipoPAT == 'Pessoal')
                        <form class="needs-validation" novalidate action="{{route('documento-pessoal.storeFromClient', [$client,$docnome])}}" method="post" enctype="multipart/form-data">
                            @else
                            <form class="needs-validation" novalidate action="{{route('documento-academico.storeFromClient', [$client,$docnome])}}" method="post" enctype="multipart/form-data">
                                @endif
                                @endif
                                @csrf
                                <div class="container-fluid">
                                    @if(strtolower($tipo) == "passaporte")
                                    <div class="row para-clone documento-passaporte">
                                        <span class="num" style="display: none;">2</span>

                                        <div class="col-md-6">
                                            <div class="col text-center" style="max-width:380px;min-width:298px;">
                                                <div>
                                                    <label for="img_doc">Imagem:</label>
                                                    <input type='file' id="img_doc" name="img_doc" style="display:none" accept="application/pdf, image/*" required />
                                                </div>

                                                <div class="card mx-auto p-4 rounded shadow-sm text-center " style="width:80%;min-width:118px;min-height:120px">
                                                    <a style="display:none;cursor:pointer" title="Clique para adicionar o documento do passaporte" id="doc_preview" class="">
                                                        <i class="far fa-id-card mt-2" style="font-size:50px"></i>
                                                        <div id="name_doc_file" class="text-muted">

                                                        </div>
                                                    </a>
                                                    <i id="passport_preview_file" class="fas fa-plus-circle mt-2" style="font-size:60px;cursor:pointer" title="Clique para adicionar o documento do passaporte"></i>

                                                </div>
                                                <small class="text-muted">(clique para mudar)</small>

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="numPassaporte">Nº Passaporte: </label>
                                            <input type="text" class="form-control" name="numPassaporte" placeholder="Nº Passaporte" autocomplete="off" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="dataValidPP">Data de validade: </label>
                                            <input type="month" class="form-control" name="dataValidPP" value="" style="width:250px" required><br>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="passaportPaisEmi">País de Emissão: </label>
                                            <select name="passaportPaisEmi" id="passaportePaisEmi" class="form-control select_style" required>
                                                @include('layout.partials.countries');
                                            </select>
                                            {{-- <input type="text" class="form-control" name="passaportPaisEmi" placeholder="Tipo pagamento" autocomplete="off" required> --}}
                                        </div>
                                        <div class="col-md-6">
                                            <label for="localEmissaoPP">Local de Emissão: </label>
                                            <input type="text" class="form-control" name="localEmissaoPP" value="" style="width:250px" required><br>
                                        </div>

                                        <div class="list-clones">
                                            <div class="row" id="documento-campo1">
                                                <div class="col-md-6">
                                                    <label for="nome-campo1">Nome do Campo</label>
                                                    <br>
                                                    <input id="nome-campo1" type="text" class="form-control" name="nome-campo1" placeholder="Inserir nome do campo" autocomplete="off" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="valor-campo1">Valor do Campo</label>
                                                    <br>
                                                    <input id="valor-campo1" type="text" class="form-control" name="valor-campo1" placeholder="Inserir valor do campo" autocomplete="off" required>
                                                </div>
                                                <div class="col-md-2">
                                                    <br><br><a id="button" style="color: white;" onclick="removeCampo(1,$(this).closest('#documento-campo1'))" class="btn btn-danger btn-icon-split btn-sm" title="remove">
                                                        <span class="icon text-white-50">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </span>
                                                        <span id="a_button" class="text">Remover 1</span>
                                                    </a>
                                                </div>
                                            </div>
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
                                        <div class="form-row mb-3">
                                            <div class="col-md-6 mb-3">
                                                <label for="img_doc" class="text-gray-900">Documento pessoal <sup class="text-danger small">&#10033;</sup></label>
                                                <div class="custom-file mb-3">
                                                    <input type="file" class="custom-file-input" name="img_doc" id="img_doc" accept="application/pdf, image/*" required>
                                                    <div class="invalid-feedback">
                                                        Oops, parece que algo não está bem...
                                                    </div>
                                                    <small class="form-text text-muted">O documento não deve ultrupassar 2MB.</small>
                                                    <label class="custom-file-label" for="screenshot" data-browse="Escolher">Escolher documento...</label>
                                                </div>
                                            </div>
                                            @if ($tipoPAT == "Academico")
                                            <div class="col-md-6 mb-3">
                                                <label for="nome" class="text-gray-900">Nome do documento <sup class="text-danger small">&#10033;</sup></label>
                                                <input type="text" class="form-control" name="nome" id="nome" placeholder="Insira um nome..." required>
                                                <div class="invalid-feedback">
                                                    Oops, parece que algo não está bem...
                                                </div>
                                            </div>
                                            @else
                                            <div class="col-md-6 mb-3">
                                                <label for="dataValidade" class="text-gray-900">Data de validade do documento <sup class="text-danger small">&#10033;</sup></label>
                                                <div class="input-group">
                                                    <input type="date" class="form-control" name="dataValidade" id="dataValidade" required>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Oops, parece que algo não está bem...
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                        <hr>
                                        <div class="mt-4 mb-4">
                                            <p class="text-gray-900 h5"><b>Campos adicionais</b></p>
                                        </div>
                                        <div class="list-clones">
                                            <div class="form-row" id="documento-campo1">
                                                <div class="col-md-6 mb-3">
                                                    <label for="nome-campo1" class="text-gray-900">Nome do campo #1 <sup class="text-danger small">&#10033;</sup></label>
                                                    <input type="text" class="form-control" name="nome-campo1" id="nome-campo1" placeholder="Insira um nome..." required>
                                                    <div class="invalid-feedback">
                                                        Oops, parece que algo não está bem...
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="valor-campo1" class="text-gray-900">Valor do campo #1 <sup class="text-danger small">&#10033;</sup></label>
                                                    <input type="text" class="form-control" name="valor-campo1" id="valor-campo1" placeholder="Insira um valor..." required>
                                                    <div class="invalid-feedback">
                                                        Oops, parece que algo não está bem...
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <a href="" id="button" onclick="removeCampo(1,$(this).closest('#documento-campo1'))" class="btn btn-danger btn-icon-split btn-sm" title="Remover">
                                                    <span class="icon text-white-50">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </span>
                                                    <span id="a_button" class="text">Remover campo #1</span>
                                                </a>
                                            </div>
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
                                            <label id="label1" for="nome-campo" class="text-gray-900">Nome do campo <sup class="text-danger small">&#10033;</sup></label>
                                            <input type="text" class="form-control" name="nome-campo" id="input1" placeholder="Insira um nome..." required>
                                            <div class="invalid-feedback">
                                                Oops, parece que algo não está bem...
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label id="label2" for="valor-campo" class="text-gray-900">Valor do campo <sup class="text-danger small">&#10033;</sup></label>
                                            <input type="text" class="form-control" name="valor-campo" id="input2" placeholder="Insira um valor..." required>
                                            <div class="invalid-feedback">
                                                Oops, parece que algo não está bem...
                                            </div>
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
                                    <button type="submit" name="button" class="btn btn-primary text-white font-weight-bold" id="submitbtn">Adicionar documento</button>
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
                Ao preencher o formulário irá criar um novo <b>documento {{strtolower($tipoPAT)}}</b>. Os campos com o asterisco de cor vermelha são de preenchimento obrigatório.
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
<script>
    $(document).ready(function() {
        bsCustomFileInput.init();
        $(".needs-validation").submit(function(event) {
            if (this.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
            } else {
                $("#cancelBtn").removeAttr("onclick");
                button =
                    "<button class='btn btn-primary' type='submit' disabled><span class='spinner-border spinner-border-sm' role='status' aria-hidden='true' style='position:relative; bottom:4px; right:3px;'></span>A fazer o registo...</button>";
                $("#groupBtn").append(button);
                $("#submitbtn").remove();
            }
            $(".needs-validation").addClass("was-validated");
        });
    });


    var clones = $('#clonar').clone();
    $('#clonar').remove();

    function addCampo(closest) {
        var num = parseInt(closest.find('.num').first().text());
        var clone = clones.clone();
        var sup = "<sup class='text-danger small'>&#10033;</sup>";
        closest.find('.num').first().text(num + 1);
        clone.attr('id', 'documento-campo' + num);
        $('#label1', clone).text("Nome do campo #" + num);
        $('#label1', clone).append(" " + sup);
        $('#label1', clone).attr('for', 'nome-campo' + num);
        $('#input1', clone).attr('name', 'nome-campo' + num);
        $('#input1', clone).attr('id', 'nome-campo' + num);
        $('#label2', clone).text("Valor do campo #" + num);
        $('#label2', clone).append(" " + sup);
        $('#label2', clone).attr('for', 'valor-campo' + num);
        $('#input2', clone).attr('name', 'valor-campo' + num);
        $('#input2', clone).attr('id', 'valor-campo' + num);
        $('#button', clone).attr('onclick', 'removeCampo(' + num + ',$(this).closest("#documento-campo' + num + '"))');
        $('#button', clone).attr('id', 'javascript-button');
        $('#a_button', clone).text('Remover campo #' + num);
        closest.find('.list-clones').first().append(clone);
    }

    function removeCampo(num, closest) {
        $('#nome-campo' + num).val(null);
        $('#valor-campo' + num).val(null);
        $("#nome-campo" + num).attr("required", false);
        $("#valor-campo" + num).attr("required", false);
        closest.css("display", "none");
    }


    //Preview do Passporte+++++++++++++++
    $('#passport_preview_file').on('click', function(e) {
        e.preventDefault();
        $('#img_doc').trigger('click');
    });

    $('#doc_preview').on('click', function(e) {
        e.preventDefault();
        $('#img_doc').trigger('click');
    });


    function readPassaPortImgURL(input) {
        if (input.files && input.files[0]) {
            var iddocumento = new FileReader();
            iddocumento.onload = function(e) {
                iddocumento.fileName = img_doc.name;
                $('#name_doc_file').text(input.files[0].name);
            }

            iddocumento.readAsDataURL(input.files[0]);
        }
    }

    $("#img_doc").change(function() {
        readPassaPortImgURL(this);
        $('#passport_preview_file').hide();
        $('#doc_preview').show();

    });
</script>
@endsection
<!-- End of Scripts -->
@endsection
<!-- End of Page Content -->
