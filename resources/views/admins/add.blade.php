@extends('layout.master')

{{-- Page Title --}}
@section('title', 'Adicionar administrador')

{{-- CSS Style Link --}}
@section('style-links')
<link href="{{asset('/css/users.css')}}" rel="stylesheet">
@endsection

{{-- Page Content --}}
@section('content')

<div class="container mt-2">
    {{-- Navegação --}}
    <div class="float-left buttons">
        <a href="javascript:history.go(-1)" title="Voltar">
            <ion-icon name="arrow-back-outline" class="button-back"></ion-icon>
        </a>
        <a href="javascript:window.history.forward();" title="Avançar">
            <ion-icon name="arrow-forward-outline" class="button-foward"></ion-icon>
        </a>
    </div>

    <br><br>
    <div class="cards-navigation">
        <div class="title">
            <h6>Adicionar administrador</h6>
        </div>
        <br>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Atenção!</strong><br>
            <p class="mt-1" style="font-weight:500;">
                Ao adicionar um administrador e colocá-lo com o cargo <strong>total</strong>, significa que este terá
                controlo total sobre a aplicação, podendo visualizar, editar e/ou eliminar dados importantes.
                <br>
                Recordarmos, que depois de adicionar um novo administrador, este irá receber um e-mail para ativar a sua conta.
            </p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <br>
        <div class="payment-card shadow-sm">
            <form class="needs-validation" method="POST" action="{{route('admins.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <label for="nome">Primeiro nome *</label>
                        <br>
                        <input type="text" name="nome" required title="Campo de preenchimento obrigatório." placeholder="Inserir primeiro nome" value="{{old('nome', $admin->nome)}}">
                    </div>
                    <div class="col-md-6">
                        <label for="apelido">Último nome *</label>
                        <br>
                        <input type="text" name="apelido" required title="Campo de preenchimento obrigatório." placeholder="Inserir último nome" value="{{old('apelido', $admin->apelido)}}">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <label for="email">Endereço eletrónico *</label>
                        <br>
                        <input type="text" name="email" id="inputEmail" placeholder="Inserir endereço eletrónico" required title="Campo de preenchimento obrigatório." value="{{old('email', $admin->email)}}">
                    </div>
                    <div class="col-md-6">
                        <label for="dataNasc">Data de nascimento *</label>
                        <br>
                        <input type="date" name="dataNasc" required title="Campo de preenchimento obrigatório." value="{{old('dataNasc', $admin->dataNasc)}}">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <label for="telefone1">Telefone princial *</label>
                        <br>
                        <input type="text" name="telefone1" required title="Campo de preenchimento obrigatório." placeholder="Inserir número de telefone principal" maxlength="25" value="{{old('telefone1', $admin->telefone1)}}">
                    </div>
                    <div class="col-md-6">
                        <label for="telefone2">Telefone secundário</label>
                        <br>
                        <input type="text" name="telefone2" placeholder="Inserir número de telefone secundário" value="{{old('telefone2', $admin->telefone2)}}" maxlength="25">
                    </div>
                </div>
                <br>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="genero">Género do administrador *</label>
                        <br>
                        <select name="genero" required title="Campo de preenchimento obrigatório.">
                            <option selected disabled hidden>Escolher género do administrador</option>
                            <option value="M">Masculino</option>
                            <option value="F">Feminino</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="superAdmin">Cargo do administrador *</label>
                        <br>
                        <select name="superAdmin" required title="Campo de preenchimento obrigatório.">
                            <option selected disabled hidden>Escolher cargo de administrador</option>
                            <option value="0">Regular</option>
                            <option value="1">Total</option>
                        </select>
                    </div>
                </div>
        </div>
        <div class="form-group text-right">
            <br>
            <button type="submit" class="top-button mr-2" name="ok" id="buttonSubmit">Adicionar administrador</button>
            <a href="javascript:history.go(-1)" class="cancel-button">Cancelar</a>
        </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    
    $(document).ready(function() {
        bsCustomFileInput.init();
        $(".needs-validation").submit(function(event) {
            var email = $('#inputEmail').val();
            
            var link = "/api/unique/admin/"+email;
            $.ajax({
                method:"GET",
                url:link
            })
            .done(function(response){
                if(response != null){
                    if(response.email == true){
                        alert("Já existe um administrador com esse email");
                    }
                    if(response.user == true && response.email == false){
                        alert("Já existe um user com esse email");
                    }
                }
            })
        });
    });
</script>
@endsection
