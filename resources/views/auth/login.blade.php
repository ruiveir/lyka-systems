@extends('layout.auth')

@section('title', 'Autenticação')

@section('content')
<div class="master-form">
    <div>
        <p>Iniciar sessão</p>
        <p>Se por algum motivo esqueceu-se da sua palavra-chave, <a href="{{route('mailrestore.password')}}">clique neste link.</a></p>
        <div>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div>
                    <div>
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" autofocus required placeholder="Endereço eletrónico">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <br>
                <div>
                    <div>
                        <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password" placeholder="Palavra-chave">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <br>
                <div>
                    <div>
                        <button type="submit" class="btn submit-button">
                            {{ __('Iniciar Sessão') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
