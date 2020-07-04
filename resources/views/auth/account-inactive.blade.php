@extends('layout.auth')

@section('title', 'Conta desativada')

@section('content')

<div class="master-form">
    <div>
        @if ($user->tipo == 'admin')
        <p>Olá {{$user->admin->nome.' '.$user->admin->apelido}}!</p>
        @elseif ($user->tipo == 'agente')
        <p>Olá {{$user->agente->nome.' '.$user->agente->apelido}}!</p>
        @else
        <p>Olá {{$user->cliente->nome.' '.$user->cliente->apelido}}!</p>
        @endif
        <p>Lamentamos imenso informar, mas a sua conta foi desativada devido a um grande período de tempo após a receção do e-mail para a ativação da mesma.</p>
        <p>Caso queira restaurar a sua conta, insira o seu e-mail no local abaixo disponível.</p>
        @if (isset($error))
        <strong id="error">
            {{$error}}
        </strong>
        @endif
        <form class="email-form" action="{{route('confirmation.restore', $user)}}" method="POST">
            @csrf
            @method('get')
            <div class="form-group">
                <input id="email" class="form-control" type="email" name="email" placeholder="Endereço eletrónico">
            </div>
            <div class="form-group">
                <button type="submit" class="btn submit-button">restaurar conta</button>
            </div>
        </form>
    </div>
</div>

@endsection
