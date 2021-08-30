@extends('layout.auth')
@section('title', 'Autenticação')
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
						<div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
						<div class="col-lg-6">
							<div class="p-5">
								<div class="text-center">
									<h1 class="h4 text-gray-900 mb-4">Bem-vindo de volta!</h1>
								</div>
								@if ($errors->has('active'))
									<div class="mb-3 text-danger text-center" id="error">
										<i class="fas fa-exclamation-circle"></i>
										<span class="font-weight-bold">{{$errors->first('active')}}</span>
									</div>
								@endif

								@if ($errors->has('email'))
									<div class="mb-3 text-danger text-center" id="error">
										<i class="fas fa-exclamation-circle"></i>
										<span class="font-weight-bold">{{$errors->first('email')}}</span>
									</div>
								@endif

								@if ($errors->has('throttle'))
									<div class="mb-3 text-danger text-center" id="error">
										<i class="fas fa-exclamation-circle"></i>
										<span class="font-weight-bold">{{$errors->first('throttle')}}</span>
									</div>
								@endif

								<form class="user needs-validation" novalidate method="POST" action="{{route("login")}}">
									@csrf
									<div class="form-group">
										<input id="email" type="email" class="form-control form-control-user" value="{{old('email')}}" name="email" aria-describedby="emailHelp" placeholder="Endereço eletrónico" autofocus>
									</div>
									<div class="form-group">
										<input type="password" class="form-control form-control-user" name="password" id="password" placeholder="Password">
									</div>
									<button class="btn btn-primary btn-user btn-block" type="submit" name="button">Iniciar Sessão</button>
								</form>
								<br>
								<div class="text-center">
									<a class="small" href="{{route('mailrestore.password')}}">Esqueceu-se da password?</a>
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
@section('scripts')
	<script src="{{asset('/js/auth/login.js')}}"></script>
@endsection
@endsection
