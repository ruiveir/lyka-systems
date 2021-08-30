@extends('layout.auth')
@section('title', 'Restaurar palavra-chave')
@section('style')
<style media="screen">
	#code {
		text-transform: uppercase;
	}

	#code::placeholder {
		text-transform: none !important;
	}

	#passform{
		display: none;
	}
</style>
@endsection
@section('content')
<!-- Begin of page content -->
<div class="container">
	<!-- Outer Row -->
	<div class="row justify-content-center">
		<div class="col-xl-10 col-lg-12 col-md-9">
			<div class="card o-hidden border-0 shadow-lg my-5">
				<div class="card-body p-0">
					<!-- Nested Row within Card Body -->
					<div class="row">
						<div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
						<div class="col-lg-6">
							<div class="p-5">
								<div id="title" class="text-center">
									<h1 class="h4 text-gray-900 mb-2">Pretende uma password nova?</h1>
									<p class="mb-4">Basta colocar a chave de segurança fornecida e estará muito perto da sua nova password.</p>
								</div>
								<form class="user needs-validation" novalidate id="form" method="POST">
									@csrf
									<div class="form-group">
										<input type="text" class="form-control form-control-user" id="code" maxlength="5" placeholder="Insira a chave de segurança..." required>
										<div class="invalid-feedback">
											Oops, parece que algo não está bem...
										</div>
									</div>
									<button type="submit" class="btn btn-primary btn-user btn-block">Confirmar</button>
								</form>
								<form id="passform" class="user needs-validation" novalidate method="POST">
									<div class="form-group">
										<input id="password" type="password" class="form-control form-control-user" placeholder="Password" autofocus>
										<div class="invalid-feedback">
											Oops, parece que algo não está bem...
										</div>
									</div>
									<div class="form-group">
										<input id="passwordconf" type="password" class="form-control form-control-user" placeholder="Confirmar password">
										<div class="invalid-feedback">
											Oops, parece que as passwords não são iguais...
										</div>
									</div>
									<button class="btn btn-primary btn-user btn-block" type="submit" name="button">Quero esta password!</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End of page content -->
<!-- Modal Info -->
<div class="modal fade" id="infoModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header pl-4 pb-1 pt-4">
				<h5 class="modal-title text-gray-800 font-weight-bold">Hurray, password restaurada! 🎉🎉</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-button">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body text-gray-800 pl-4 pr-5">
				Agora que já têm a sua nova password, pode continuar o seu trabalho na aplicação Lyka! Mas primeiro tem que inicar sessão...
			</div>
			<div class="modal-footer mt-3">
				<a data-dismiss="modal" class="mr-4 font-weight-bold" id="close-option">Fechar</a>
				<a href="{{route("login")}}" type="button" class="btn btn-primary font-weight-bold mr-2">Vamos trabalhar!</a>
			</div>
		</div>
	</div>
</div>
<!-- End of Modal Info -->
@section('scripts')
	<script>
		let userId = {!! $user->idUser !!};
	</script>
	<script src="{{asset('/js/auth/restore-password.js')}}"></script>
@endsection
@endsection
