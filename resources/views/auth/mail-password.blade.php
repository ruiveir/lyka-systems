@extends('layout.auth')
@section('title', 'Restaurar password')
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
								<div class="text-center">
									<h1 class="h4 text-gray-900 mb-2">Esqueceu-se da password?</h1>
									<p class="mb-4">Nós compreendos, as coisas acontecem. Insira o seu e-mail e nós enviamos um link para poder refeinir a sua password!</p>
								</div>
								<form class="user needs-validation" novalidate id="form" method="POST">
									@csrf
									<div class="form-group">
										<input type="email" class="form-control form-control-user" id="email" aria-describedby="emailHelp" placeholder="Insira o seu e-mail..." required>
										<div class="invalid-feedback">
											Oops, parece que algo não está bem...
										</div>
									</div>
									<button type="submit" class="btn btn-primary btn-user btn-block">Redefinir Password</button>
								</form>
								<br>
								<div class="text-center">
									<a class="small" href="{{route("login")}}">Já têm uma conta? Faça login!</a>
								</div>
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
				<h5 class="modal-title text-gray-800 font-weight-bold">Estamos a sua espera... 🙂</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-button">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body text-gray-800 pl-4 pr-5">
				Acabou mesmo de sair um e-mail para que possa restaurar a sua password! Aconselhamos a verificar o seu e-mail...
			</div>
			<div class="modal-footer mt-3">
				<a data-dismiss="modal" class="mr-4 font-weight-bold" id="close-option">Fechar</a>
				<a data-dismiss="modal" type="button" class="btn btn-primary font-weight-bold mr-2">Entendido!</a>
			</div>
		</div>
	</div>
</div>
<!-- End of Modal Info -->
@section('scripts')
	<script src="{{asset('/js/auth/mail-password.js')}}"></script>
@endsection
@endsection
