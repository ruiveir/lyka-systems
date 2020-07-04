@extends('layout.auth')

@section('title', 'Ativação de conta')

@section('content')

<div class="master-form">
    <div>
        @if ($user->tipo == 'admin')
        <p>Bem-vindo {{$user->admin->nome.' '.$user->admin->apelido}}!</p>
        @elseif ($user->tipo == 'agente')
        <p>Bem-vindo {{$user->agente->nome.' '.$user->agente->apelido}}!</p>
        @else
        <p>Bem-vindo {{$user->cliente->nome.' '.$user->cliente->apelido}}!</p>
        @endif
        <p>É com muita alegria que a Lyka Systems o recebe nesta aplicação, sendo que para começar, será apenas preciso clicar no botão abaixo para iniciar sessão com o seu endereço eletrónico e a palavre-chave que escolheu anteriormente,</p>
        <br>
        <div>
            <a style="padding: 0 50px;" href="{{route('login')}}">
                <button type="submit" class="btn submit-button">
                    Iniciar sessão
                </button>
            </a>
        </div>
    </div>
</div>

@endsection
