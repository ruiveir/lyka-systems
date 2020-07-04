@extends('layout.master')

{{-- Page Title --}}
@section('title', 'Reportar Problema')

{{-- CSS Style Link --}}
@section('styleLinks')
<link href="{{asset('/css/report.css')}}" rel="stylesheet">
@endsection

{{-- Page Content --}}
@section('content')
<div class="container mt-2">
    <?php
      if (Auth()->user()->tipo == 'admin') {
        $user = Auth()->user()->admin;
      }elseif (Auth()->user()->tipo == 'agente') {
        $user = Auth()->user()->agente;
      }else {
        $user = Auth()->user()->cliente;
      }
    ?>

    <div class="cards-navigation">
        <div class="title">
            <h6>Reportar um problema</h6>
            <div class="alert alert-warning alert-dismissible fade show shadow-sm mt-4" role="alert">
                <strong>Olá {{$user->nome.' '.$user->apelido}}!</strong>
                <p class="mt-1 mb-1">Para reportar um problema basta preencher o formulário abaixo disponível que será enviado para um administrador.</p>
                <p>O administrador irá ler o seu problema e responder-lhe-á o mais depressa possível com uma solução.</p>
                <hr>
                <strong>Obrigado pela sua atenção.</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        <br>
        <div class="report-card shadow-sm">
            <form action="{{route('report.send')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <label for="nome">Nome completo *</label>
                        <br>
                        <input type="text" name="nome" placeholder="Inserir nome completo" autocomplete="off" value="{{$user->nome.' '.$user->apelido}}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="email">Endereço eletrónico *</label>
                        <br>
                        <input type="text" name="email" placeholder="Inserir endereço eletrónico" value="{{$user->email}}" required>
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <div class="col-md-6">
                        <label for="telemovel">Número de telemóvel</label>
                        <br>
                        <input type="text" name="telemovel" placeholder="Inserir número de telemóvel" value="{{$user->telefone1}}">
                    </div>
                    <div class="col-md-6">
                        <div class="help-button" id="tooltipScreenshot" data-toggle="tooltip" data-placement="top" title="Para ajudar melhor a compreender o problema, pode inserir uma captura de ecrã que ilustre o erro que está a visualizar.">
                            <span>
                                ?
                            </span>
                        </div>
                        <label for="screenshot">Captura de ecrã</label>
                        <br>
                        <input type="file" name="screenshot" id="upfile" onchange="sub(this)">
                        <div class="input-file-div text-truncate" id="addFileButton" onclick="getFile()">Adicionar um ficheiro</div>
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <div class="col">
                        <div class="help-button" id="tooltipReport" data-toggle="tooltip" data-placement="top" title="Nesta seccção tente ser o mais específico possível, em relação ao problema que está a enfrentar.">
                            <span>
                                ?
                            </span>
                        </div>
                        <label for="relatorio">Relatório do problema *</label>
                        <br>
                        <textarea name="relatorio" rows="5" placeholder="Inserir um relatório acerca problema" required></textarea>
                    </div>
                </div>
        </div>
        <div class="form-group text-right">
            <br>
            <button type="submit" class="top-button mr-2" name="ok" id="buttonSubmit">Enviar relatório</button>
            <a href="javascript:history.go(-1)" class="cancel-button">Cancelar</a>
        </div>
        </form>
    </div>
</div>

@section('scripts')
<script type="text/javascript">
    function getFile() {
        document.getElementById("upfile").click();
    }

    function sub(obj) {
        var file = obj.value;
        var fileName = file.split("\\");
        document.getElementById("addFileButton").innerHTML = fileName[fileName.length - 1];
    }

    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
@endsection
@endsection
