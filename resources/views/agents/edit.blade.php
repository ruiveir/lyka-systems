@extends('layout.master')
<!-- Page Title -->
@section('title', 'Editar agente')
<!-- Page Content -->
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800">Edição de um agente e/ou subagente</h1>
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
            @if ($agent->tipo == "Agente")
                <h6 class="m-0 font-weight-bold text-primary">Formulário de edição do agente {{$agent->nome.' '.$agent->apelido}}</h6>
            @else
                <h6 class="m-0 font-weight-bold text-primary">Formulário de edição do subagente {{$agent->nome.' '.$agent->apelido}}</h6>
            @endif
        </div>
        <div class="card-body">
            <form class="form-group needs-validation" action="{{route('agents.update', $agent)}}" method="POST" novalidate enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <div class="container-fluid">
                    @include('agents.partials.add-edit')
                    <div class="text-right mt-3" id="groupBtn">
                        <span class="mr-4 font-weight-bold" onclick="window.history.back();" id="cancelBtn" style="cursor:pointer;">Cancelar</span>
                        <button type="submit" name="button" class="btn btn-primary text-white font-weight-bold" id="submitbtn">Editar agente</button>
                    </div>
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
                Ao preencher o formulário irá editar um agente. Os campos com o asterisco de cor vermelha são de preenchimento obrigatório.
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
        $(".needs-validation").submit(function(event) {var nif = $('#NIF').val();
            if (this.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
            } else {
                $("#cancelBtn").removeAttr("onclick");
                button = "<button class='btn btn-primary' type='submit' disabled><span class='spinner-border spinner-border-sm' role='status' aria-hidden='true' style='position:relative; bottom:4px; right:3px;'></span>A fazer o registo...</button>";
                $("#groupBtn").append(button);
                $("#submitbtn").remove();
            }
            $(".needs-validation").addClass("was-validated");
        });

        if ($("#aux_idAgenteAssociado").val() != "") {
            $("#idAgenteAssociado").val($("#aux_idAgenteAssociado").val());
            $("#div_subagente").show();
            $("#div_execao").show();
        }

        if ($("#tipo").val() == "Agente") {
            $("#div_subagente").hide();
            $("#div_execao").hide();
            $("#idAgenteAssociado").prop("disabled", true);
            $("#idAgenteAssociado").val(null);
            $("#div_infos_agente").show();
            $("#div_infos_subagente").hide();
        }else{
            $("#div_infos_agente").hide();
            $("#div_infos_subagente").show();
        }

        $('#tipo').change(function () {
            if ($("#tipo").val() == "Subagente") {
                $("#div_subagente").show();
                $("#div_execao").show();
                $("#div_infos_subagente").show();
                $("#div_infos_agente").hide();
                $("#idAgenteAssociado").prop("disabled", false);
                $("#idAgenteAssociado").val(null);
                $("#idAgenteAssociado").focus();

            } else {
                $('#checkbox_exepcao').prop('checked', false);
                $("#exepcao").val("0");
                $("#div_subagente").hide();
                $("#div_execao").hide();
                $("#div_infos_subagente").hide();
                $("#div_infos_agente").show();
                $("#idAgenteAssociado").prop("disabled", true);
                $("#idAgenteAssociado").val(null);
                $("#idAgenteAssociado").prop("disabled", true);
                $("#idAgenteAssociado").val(null);
                $("#idAgenteAssociado").removeClass("was-validated");
                $("#idAgenteAssociado").removeClass("is-invalid");
                $("#idAgenteAssociado").addClass(":invalid");
            }
        });

        $('#idAgenteAssociado').change(function () {
            $("#idAgenteAssociado").removeClass("is-invalid");
            $("#idAgenteAssociado").addClass("invalid");
            $("#agent-type-tab").removeClass("border-danger text-danger");
        });
    });
</script>
@endsection
<!-- End of Scripts -->
@endsection
<!-- End of Page Content -->
