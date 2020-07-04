@extends('layout.auth')

@section('title', 'Ativação de conta')

@section('content')

<div class="master-form">
    <div>
        <p>Ativação de conta</p>
        <p>Introduza o código de autenticação que lhe foi fornecido para dar continuidade à ativação da sua conta.</p>
        @if (isset($error))
        <strong id="error">
            {{$error}}
        </strong>
        @endif
        <div>
            <form class="email-form" action="{{route('confirmation.key', $user)}}" method="POST">
                @csrf
                @method('get')
                <div class="form-group">
                    <input id="code" type="text" class="form-control" name="key" maxlength="5" autocomplete="off" placeholder="Código de autenticação">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn submit-button">Confirmar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
