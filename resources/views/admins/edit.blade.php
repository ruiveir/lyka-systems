@extends('layout.master')

{{-- Page Title --}}
@section('title', 'Adicionar Utilizador')

{{-- CSS Style Link --}}
@section('styleLinks')
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
    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif
    <br><br>
    <div class="cards-navigation">
        <div class="title">
            <h6>Edição do utilizador: {{$admin->nome.' '.$admin->apelido}}</h6>
        </div>
        <br>
        <div class="payment-card shadow-sm">
            <form class="needs-validation" method="POST" action="{{route('admins.update', $admin)}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <label for="nome">Primeiro nome *</label>
                        <br>
                        <input type="text" name="nome" required placeholder="Inserir primeiro nome" value="{{old('nome', $admin->nome)}}">
                    </div>
                    <div class="col-md-6">
                        <label for="inputFullname">Último nome *</label>
                        <br>
                        <input type="text" name="apelido" required placeholder="Inserir último nome" value="{{old('apelido', $admin->apelido)}}">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <label for="inputEmail">Endereço eletrónico *</label>
                        <br>
                        <input type="text" name="email" id="inputEmail" placeholder="Inserir endereço eletrónico" required value="{{old('email', $admin->email)}}">
                    </div>
                    <div class="col-md-6">
                        <label for="inputFullname">Data de Nascimento *</label>
                        <br>
                        <input type="date" name="dataNasc" required value="{{old('dataNasc', $admin->dataNasc)}}">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <label for="inputFullname">Telefone Princial *</label>
                        <br>
                        <input type="text" name="telefone1" required placeholder="Inserir número de telefone principal" value="{{old('telefone1', $admin->telefone1)}}">
                    </div>
                    <div class="col-md-6">
                        <label for="inputFullname">Telefone Secundário</label>
                        <br>
                        <input type="text" name="telefone2" placeholder="Inserir número de telefone secundário" value="{{old('telefone2', $admin->telefone2)}}">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <label for="inputFullname">Género do administrador *</label>
                        <br>
                        <select type="text" name="genero" id="genero" required>
                            @if ($admin->genero == 'M')
                              <option value="M" selected>Masculino</option>
                              <option value="F">Feminino</option>
                            @else
                              <option value="M">Masculino</option>
                              <option value="F" selected>Feminino</option>
                            @endif
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="superAdmin">Cargo do administrador *</label>
                        <br>
                        <select name="superAdmin" required title="Campo de preenchimento obrigatório.">
                          @if ($admin->superAdmin == true)
                            <option value="0">Regular</option>
                            <option value="1" selected>Total</option>
                          @else
                            <option value="0" selected>Regular</option>
                            <option value="1">Total</option>
                          @endif
                        </select>
                    </div>
                </div>
        </div>

        <div class="form-group text-right">
            <br>
            <button type="submit" class="top-button mr-2" name="ok" id="buttonSubmit">atualizar administrador</button>
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
            
            var link = "/api/unique/admin/{{$admin->idAdmin}}/"+email;
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