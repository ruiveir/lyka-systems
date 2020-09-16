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
                    @if(isset($university))
                    <div class="form-row mb-2">
                        <div class="col">
                            <div class="form-group">
                                <div class="card rounded text-center p-3"><strong><span class="text-muted">{{$university->nome}}</span></strong></div>
                                <input type="hidden" name="idUniversidade" value="{{$university->idUniversidade}}">
                            </div>
                        </div>
                    </div>
                    @endif
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
                    @if(isset($university))
                    <div class="form-row mb-2">
                        <div class="col">
                            <div class="form-group">
                                <div class="card rounded text-center p-3"><strong><span class="text-muted">{{$university->nome}}</span></strong></div>
                                <input type="hidden" name="idUniversidade" value="{{$university->idUniversidade}}">
                            </div>
                        </div>
                    </div>
                    @endif
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
    $(".needs-validation").submit(function(event) {
        if (this.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
        } else {
            $("#close-option").removeAttr("onclick");
            button = "<button class='btn btn-primary' type='submit' disabled><span class='spinner-border spinner-border-sm' role='status' aria-hidden='true' style='position:relative; bottom:4px; right:3px;'></span>A fazer o registo...</button>";
            $("#groupBtn").append(button);
            $("#submitbtn").remove();
        }
        $(".needs-validation").addClass("was-validated");
    });

    var dateToday = new Date();
    var dd = String(dateToday.getDate()).padStart(2, '0');
    var mm = String(dateToday.getMonth() + 1).padStart(2, '0');
    var yyyy = dateToday.getFullYear();
    dateToday = dd + '/' + mm + '/' + yyyy;

    function dealWithDate(value) {
        let month = value.getMonth() + 1;
        return value.getFullYear() + "-" + ("0" + month).slice(-2) + "-" + ("0" + value.getDate()).slice(-2);
    }

    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        // Função que acolhe todas as customizações necessárias para a agenda.
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            themeSystem: 'flatly',
            locale: 'pt',
            weekNumbers: true,
            aspectRatio: 1.60,
            selectable: true,
            droppable: true,
            timeZone: 'UTC',
            editable: true,
            dayMaxEvents: true,
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
            },
            // Aqui é onde se coloca os eventos.
            events: [
                @foreach ($events as $event)
                @if ($event->idUser == Auth()->user()->idUser && !$event->visibilidade)
                    {
                        title: '{{$event->titulo}}',
                        @if ($event->descricao)
                            description: '{{$event->descricao}}',
                        @endif
                        start: '{{date('Y-m-d', strtotime($event->data_inicio))}}',
                        @if ($event->data_fim)
                            end: '{{date('Y-m-d', strtotime($event->data_fim))}}',
                        @endif
                        color: '{{$event->cor}}',
                        extendedProps: {
                            visibilidade: '{{$event->visibilidade}}',
                            id: {{$event->agenda_id}}
                        }
                    },
                @endif
                @if ($event->visibilidade)
                    {
                        title: '{{$event->titulo}}',
                        @if ($event->descricao)
                            description: '{{$event->descricao}}',
                        @endif
                        start: '{{date('Y-m-d', strtotime($event->data_inicio))}}',
                        @if ($event->data_fim)
                            end: '{{date('Y-m-d', strtotime($event->data_fim))}}',
                        @endif
                        color: '{{$event->cor}}',
                        extendedProps: {
                            visibilidade: '{{$event->visibilidade}}',
                            id: {{$event->agenda_id}}
                        }
                    },
                @endif
                @endforeach
            ],
            // Ao clicar num evento, irá correr o seguinte código (Modal para editar e apagar um evento).
            eventClick: function(element) {
                let modal = $("#editModal");
                modal.find('.modal-body #titulo').val(element.event.title);
                modal.find('.modal-body #cor').val(element.event.backgroundColor);
                modal.find('.modal-body #data_inicio').val(dealWithDate(element.event.start));

                if (element.event.extendedProps.visibilidade == 1) {
                    $("#publico").attr("selected", "true");
                }else {
                    $("#privado").attr("selected", "true");
                }

                if (element.event.end != null) {
                    modal.find('.modal-body #data_fim').val(dealWithDate(element.event.end));
                }

                if (element.event.extendedProps.description != null) {
                    modal.find('.modal-body #descricao').val(element.event.extendedProps.description);
                }

                modal.find('#editForm').attr("action", "/agenda/"+element.event.extendedProps.id);
                modal.find('#deleteForm').attr("action", "/agenda/"+element.event.extendedProps.id);
                $("#editModal").modal("show");
            },
        });
        calendar.render();
    });
</script>
@endsection
<!-- End of Scripts -->
@endsection
<!-- End of Page Content -->
