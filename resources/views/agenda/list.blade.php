@extends('layout.master')
<!-- Page Title -->
@section('title', 'Agenda')
<!-- CSS Links -->
@section('style-links')
<link href="{{asset('/vendor/fullcalendar/lib/main.min.css')}}" rel='stylesheet'>
<style>
	.fc .fc-daygrid-day.fc-day-today {
		background-color: rgba(90, 95, 130, .15) !important;
	}

	.fc .fc-daygrid-day.fc-day-today .fc-daygrid-day-number{
		font-weight: bold;
	}
</style>
@endsection
<!-- Page Content -->
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h4 mb-0 text-gray-800" id="test">Agenda de eventos</h1>
		<div>
			<a href="#" data-toggle="modal" data-target="#calendarModal" class="btn btn-primary btn-icon-split btn-sm" title="Adicionar">
				<span class="icon text-white-50">
					<i class="fas fa-plus"></i>
				</span>
				<span class="text">Adicionar evento</span>
			</a>
			<a href="#" data-toggle="modal" data-target="#infoModal" class="btn btn-secondary btn-icon-split btn-sm" title="Informações">
				<span class="icon text-white-50">
					<i class="fas fa-info-circle"></i>
				</span>
				<span class="text">Informações</span>
			</a>
		</div>
	</div>
	<!-- Approach -->
	<div class="card shadow mb-4">
		<div class="card-body">
			<div id='calendar'></div>
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
				Nesta secção encontra-se a agenda de eventos da Estudar Portugal. Pode registar um evento clicando no botão <b>Adicionar evento</b>.
			</div>
			<div class="modal-footer mt-3">
				<a data-dismiss="modal" class="mr-4 font-weight-bold" id="close-option">Fechar</a>
				<button type="button" data-dismiss="modal" class="btn btn-primary font-weight-bold mr-2">Entendido!</button>
			</div>
		</div>
	</div>
</div>
<!-- End of Modal for more information -->

<!-- Modal for add new event -->
<div class="modal fade" id="calendarModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header pl-4 pb-1 pt-4">
				<h5 class="modal-title text-gray-800 font-weight-bold">Quer adicionar um novo evento?</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-button">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="{{route('agenda.store')}}" method="POST" class="form-group needs-validation mb-0" novalidate>
				@csrf
				<div class="modal-body text-gray-800 pl-4 pr-5">
					<div class="form-row mt-3 mb-3">
						<div class="col-md-12">
							<label for="title">Título do evento <sup class="text-danger small">&#10033;</sup></label>
							<input type="text" class="form-control" id="title" name="titulo" maxlength="120" placeholder="Inserir um título..." required>
							<div class="invalid-feedback">
								Oops, parece que algo não está bem...
							</div>
						</div>
					</div>
					<div class="form-row mb-3">
						<div class="col-md-6">
							<label for="color">Cor de apresentação <sup class="text-danger small">&#10033;</sup></label>
							<input type="color" class="form-control" id="color" name="cor" value="#4e73df" required>
						</div>
						<div class="col-md-6">
							<label for="visibilidade" class="text-gray-900">Visibilidade do evento <sup class="text-danger small">&#10033;</sup></label>
							<select class="custom-select" name="visibilidade" id="visibilidade" required>
								<option selected value="0">Privado</option>
								<option value="1">Público</option>
							</select>
							<div class="invalid-feedback">
								Oops, parece que algo não está bem...
							</div>
						</div>
					</div>
					<div class="form-row mb-3">
						<div class="col-md-12">
							<label for="idUniversidade" class="text-gray-900">Universidade</label>
							<select class="custom-select" name="idUniversidade" id="idUniversidade">
								<option selected hidden disabled>Escolher uma universidade...</option>
								@foreach ($universidades as $universidade)
									<option value="{{$universidade->idUniversidade}}">{{$universidade->nome}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-row mb-3">
						<div class="col-md-12">
							<label for="data_inicio">Data de início <sup class="text-danger small">&#10033;</sup></label>
							<input type="date" class="form-control" id="data_inicio" name="data_inicio" required>
							<div class="invalid-feedback">
								Oops, parece que algo não está bem...
							</div>
						</div>
					</div>
					<div class="form-row mb-3">
						<div class="col-md-12">
							<label for="data_fim">Data de fim </label>
							<input type="date" class="form-control" id="data_fim" name="data_fim">
						</div>
					</div>
					<div class="form-row mb-3">
						<div class="col-md-12">
							<label for="descricao">Descrição do evento</label>
							<textarea class="form-control" name="descricao" id="descricao" rows="2" style="resize: none" maxlength="150" placeholder="Inserir uma descrição..." fixed></textarea>
						</div>
					</div>
				</div>
				<div class="modal-footer mt-3" id="groupBtn">
					<a data-dismiss="modal" class="mr-4 font-weight-bold" id="close-option">Fechar</a>
					<button type="submit" name="action" value="save" id="submitbtn" class="btn btn-primary font-weight-bold mr-2">Registar evento</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- End of Modal for create a new event  -->

<!-- Modal for edit or delete a event -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header pl-4 pb-1 pt-4">
				<h5 class="modal-title text-gray-800 font-weight-bold">Pretende editar o evento?</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-button">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="editForm" method="POST" class="form-group needs-validation mb-0" novalidate>
				@csrf
				@method("PUT")
				<div class="modal-body text-gray-800 pl-4 pr-5">
					<div class="form-row mt-3 mb-3">
						<div class="col-md-12">
							<label for="title">Título do evento <sup class="text-danger small">&#10033;</sup></label>
							<input type="text" class="form-control" id="titulo" name="titulo" maxlength="120" placeholder="Inserir um título..." required>
							<div class="invalid-feedback">
								Oops, parece que algo não está bem...
							</div>
						</div>
					</div>
					<div class="form-row mb-3">
						<div class="col-md-6">
							<label for="color">Cor de apresentação <sup class="text-danger small">&#10033;</sup></label>
							<input type="color" class="form-control" id="cor" name="cor" required>
						</div>
						<div class="col-md-6">
							<label for="visibilidade" class="text-gray-900">Visibilidade do evento <sup class="text-danger small">&#10033;</sup></label>
							<select class="custom-select" name="visibilidade" id="visibilidade" required>
								<option value="0" id="privado">Privado</option>
								<option value="1" id="publico">Público</option>
							</select>
							<div class="invalid-feedback">
								Oops, parece que algo não está bem...
							</div>
						</div>
					</div>
					<div class="form-row mb-3">
						<div class="col-md-12">
							<label for="idUniversidade" class="text-gray-900">Universidade</label>
							<select class="custom-select" name="idUniversidade" id="idUniversidade">
								<option selected hidden disabled id="uni_selected"></option>
								@foreach ($universidades as $universidade)
									<option value="{{$universidade->idUniversidade}}">{{$universidade->nome}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-row mb-3">
						<div class="col-md-12">
							<label for="data_inicio">Data de início <sup class="text-danger small">&#10033;</sup></label>
							<input type="date" class="form-control" id="data_inicio" name="data_inicio" required>
							<div class="invalid-feedback">
								Oops, parece que algo não está bem...
							</div>
						</div>
					</div>
					<div class="form-row mb-3">
						<div class="col-md-12">
							<label for="data_fim">Data de fim </label>
							<input type="date" class="form-control" id="data_fim" name="data_fim">
						</div>
					</div>
					<div class="form-row mb-3">
						<div class="col-md-12">
							<label for="descricao">Descrição do evento</label>
							<textarea class="form-control" name="descricao" id="descricao" rows="2" style="resize: none" maxlength="150" placeholder="Inserir uma descrição..." fixed></textarea>
						</div>
					</div>
				</div>
				<div class="modal-footer mt-3">
					<a data-dismiss="modal" class="mr-4 font-weight-bold" id="close-option">Fechar</a>
					<button type="submit" class="btn btn-primary font-weight-bold mr-2">Atualizar evento</button>
				</form>
				<form id="deleteForm" class="form-group m-0" method="POST">
					@csrf
					@method("DELETE")
					<button type="submit" class="btn btn-danger font-weight-bold mr-2">Eliminar</button>
				</form>
				</div>
		</div>
	</div>
</div>
<!-- End of Modal for edit or delete a event -->

<!-- Begin of Scripts -->
@section('scripts')
	<script src="{{asset('/vendor/fullcalendar/lib/main.min.js')}}"></script>
	<script src="{{asset('/vendor/fullcalendar/lib/locales/pt.js')}}"></script>

	<script>
		var eventList = {!! $events !!};
	</script>
	<script src="{{asset('/js/agenda/list.js')}}"></script>
@endsection
<!-- End of Scripts -->
@endsection
<!-- End of Page Content -->
