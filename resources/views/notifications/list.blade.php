@extends('layout.master')
<!-- Page Title -->
@section('title', 'Notificações')
<!-- Page Content -->
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h4 mb-0 text-gray-800">Central de notificações</h1>
		<a href="#" data-toggle="modal" data-target="#infoModal" class="btn btn-secondary btn-icon-split btn-sm" title="Informações">
			<span class="icon text-white-50">
				<i class="fas fa-info-circle"></i>
			</span>
			<span class="text">Informações</span>
		</a>
	</div>
	<!-- Approach -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Listagem - Notificações</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive p-1">
				<table class="table table-bordered table-striped" id="table" width="100%">
					<thead>
						<tr>
							<th>Tipo</th>
							<th>Assunto</th>
							<th>Estado</th>
							<th style="max-width:100px; min-width:100px;">Opções</th>
						</tr>
					</thead>
					<tbody>
						@if($notifications)
							@foreach ($notifications as $notification)
							<tr>
								<td>
									@if($notification->type == "App\Notifications\BugReportSend")
										<span>Relatório de erro</span>
									@elseif($notification->type == "App\Notifications\Aniversario")
										<span>Aniversário</span>
									@elseif($notification->type == "App\Notifications\Atraso")
										<span>Atraso<span>
									@elseif($notification->type == 'App\Notifications\AtrasoCliente')
										<span>AtrasoCliente</span>
									@else
										<span>Abertura</span>
									@endif
								</td>
								<td>
									@if($notification->type == "App\Notifications\BugReportSend")
										{{$notification->data["subject"]}}
									@else
										{{$notification->data["assunto"]}}
									@endif
								</td>
								<td>
									@if($notification->data['urgencia'])
										<span class="font-weight-bold text-danger">Urgente</span>
									@else
										<span>Regular</span>
									@endif
								</td>
								<td class="text-center align-middle">
									@if($notification->type == "App\Notifications\BugReportSend")
									<a href="{{route("bugreport.show", $notification->data["idReport"])}}" class="btn btn-sm btn-outline-primary" title="Ficha completa"><i class="far fa-eye"></i></a>
									@else
									<a href="{{route('notification.show',$notification)}}" class="btn btn-sm btn-outline-primary" title="Ficha completa"><i class="far fa-eye"></i></a>
									@endif
									@if($notification->type == "App\Notifications\Aniversario")
									<button onclick="{{$notification->delete()}}" class="btn btn-sm btn-outline-danger" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
									@endif
								</td>
							</tr>
							@endforeach
						@endif
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<!-- End of container-fluid -->

<!-- Modal for more information -->
<div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header pl-4 pb-1 pt-4">
				<h5 class="modal-title text-gray-800 font-weight-bold">Para que serve?</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-button">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body text-gray-800 pl-4 pr-5">
				Nesta secção encontram-se a listagem das notificações do sistema. Caso a notificação for <span class="font-weight-bold text-danger">Urgente</span>, significa que há algum atraso relativo ao tipo de notificação.
			</div>
			<div class="modal-footer mt-3">
				<a data-dismiss="modal" class="mr-4 font-weight-bold" id="close-option">Fechar</a>
				<button type="button" data-dismiss="modal" class="btn btn-primary font-weight-bold mr-2">Entendido!</button>
			</div>
		</div>
	</div>
</div>
<!-- End of Modal for more information  -->

<!-- Begin of Scripts -->
@section('scripts')
	<script src="{{asset('/js/notifications/list.js')}}"></script>
@endsection
<!-- End of Scripts -->
@endsection
<!-- End of Page Content -->
