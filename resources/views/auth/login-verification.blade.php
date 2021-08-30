@extends('layout.auth')

@section('title', 'Ativação de conta')

@section('content')

<div class="master-form">
	<div>
		<p>Insira o código de confirmação enviado para o seu email</p>
		@if (isset($error))
		<strong id="error">
			{{$error}}
		</strong>
		@endif
		<div>
			<form class="form-group" action="{{route('confirmation.loginVerification', $user)}}" method="post">
				@csrf
				@method('GET')
				<div>
					<input id="code" type="text" class="form-control" name="code" placeholder="Código de Verificação">
				</div>
				<br>
				<div>
					<button type="submit" class="btn submit-button">Confirmar</button>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection
