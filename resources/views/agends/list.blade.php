@extends('layout.master')

{{-- Titulo da Página --}}
@section('title', 'Agenda')

{{-- Estilos de CSS --}}
@section('styleLinks')

    <link href="{{asset('css/datatables_general.css')}}" rel="stylesheet">

    {{-- <link href="{{asset('css/agends.css')}}" rel="stylesheet"/> --}}

    <link href="{{asset('vendor/fullcalendar/core/main.css')}}" rel='stylesheet'/>
    <link href="{{asset('vendor/fullcalendar/daygrid/main.css')}}" rel='stylesheet'/>
    <link href="{{asset('vendor/fullcalendar/list/main.css')}}" rel='stylesheet'/>
    <link href="{{asset('vendor/fullcalendar/timegrid/main.css')}}" rel='stylesheet'/>

@endsection


{{-- Conteudo da Página --}}
@section('content')
    @include('agends.partials.modal')
    <!-- MODAL DE INFORMAÇÔES -->
    <div class="container-fluid my-4">

        {{-- Conteúdo --}}
        <div class="bg-white shadow-sm mb-4 p-4 ">

            <div class="row">

                <div class="col">
                    <div class="title">
                        <h4><strong>Agenda</strong><h4>
                    </div>
                </div>

                {{-- Opções --}}
                <div class="col text-right">
                    <a class="btn btn-sm btn-success m-1" href="#" id="titleModalNew" data-toggle="modal"
                    data-target="#modalCalendar"><i class="fas fa-plus mr-2"></i>Novo Evento</a>

                </div>

            </div>

            <hr class="my-3">

            <div class="row p-2">
                <div class="col" >
                    <div id='calendar'></div>
                </div>
            </div>

        </div>
    </div>

@endsection

{{-- Utilização de scripts: --}}

@section('scripts')
{{-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script> --}}

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>


    <script src="{{asset('/vendor/fullcalendar/core/main.js')}}"></script>
    <script src="{{asset('/vendor/fullcalendar/rrule.js')}}"></script>
    <script src="{{asset('/vendor/fullcalendar/interaction/main.js')}}"></script>
    <script src="{{asset('/vendor/fullcalendar/daygrid/main.js')}}"></script>
    <script src="{{asset('/vendor/fullcalendar/core/locales/pt.js')}}"></script>
    <script src="{{asset('/vendor/fullcalendar/timegrid/main.js')}}"></script>
    <script src="{{asset('/vendor/fullcalendar/list/main.js')}}"></script>
    <script src="{{asset('/vendor/fullcalendar/rrule/main.js')}}"></script>


    <script src="{{asset('/js/agends.js')}}"></script>
    <script src="{{asset('/js/newEventModalDefault.js')}}"></script>

    {{-- script permite definir se um input recebe só numeros OU so letras --}}
    <script src="{{asset('/js/jquery-key-restrictions.min.js')}}"></script>

    <script>
        var dateToday = new Date();
        var dd = String(dateToday.getDate()).padStart(2, '0');
        var mm = String(dateToday.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = dateToday.getFullYear();

        dateToday = mm + '/' + dd + '/' + yyyy;

        /**
         *  Dealing with data to be shown in datetime-local type input
         *  "2020-05-30T01:00"
         * */
        function dealWithDate(value) {
            let month = value.getMonth() + 1;
            return value.getFullYear() + "-" + ("0" + month).slice(-2)
                + "-" + ("0" + value.getDate()).slice(-2) + "T"
                + ("0" + value.getHours()).slice(-2) + ":" + ("0" + value.getMinutes()).slice(-2);
        }

        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: ['interaction', 'dayGrid', 'timeGrid', 'list', 'rrule'],
                height:700,
                aspectRatio: 1.5,
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
                },
                locale: 'pt',
                editable: true,
                navLinks: true,
                eventLimit: true,
                selectable: true,
                timeZone: 'UTC',
                events: [
                        @foreach($agends as $agend)
                    {
                        id: '{{ $agend->idAgenda }}',
                        title: '{{ $agend->titulo }}',
                        start: '{{ $agend->dataInicio }}',
                        end: '{{ $agend->dataFim }}',
                        color: '{{ $agend->cor }}',
                        description: '{{ $agend->descricao }}',
                        editable: true,
                    },
                    @endforeach
                ],
                extraParams: function () {
                    return {
                        cachebuster: new Date().valueOf()
                    };
                },

                eventClick: function (element) {

                    resetForm("#formEvent");

                    $("#modalCalendar #titleModal").text('Alterar Evento');
                    $("#modalCalendar button.deleteEvent").css('display', 'flex');

                    let id = element.event.id;
                    $("#modalCalendar input[name='idAgenda']").val(id);

                    let title = element.event.title;
                    $("#modalCalendar input[name='titulo']").val(title);

                    let start = element.event.start;
                    $("#modalCalendar input[name='dataInicio']").val(dealWithDate(start));

                    let end = element.event.end;
                    $("#modalCalendar input[name='dataFim']").val(dealWithDate(end));

                    let color = element.event.backgroundColor;
                    $("#modalCalendar input[name='cor']").val(color);

                    let description = element.event.extendedProps.description;
                    $("#modalCalendar textarea[name='descricao']").val(description);

                    $("#modalCalendar").modal('show');
                },

                select: function (element) {

                    resetForm("#formEvent");

                    $("#modalCalendar input[name='idAgenda']").val("");

                    $("#modalCalendar").modal('show');
                    $("#modalCalendar #titleModal").text('Novo Evento');
                    $("#modalCalendar button.deleteEvent").css('display', 'none');

                    let start = element.start;
                    $("#modalCalendar input[name='dataInicio']").val(dealWithDate(start));

                    $("#modalCalendar input[name='cor']").val("#6A74C9");

                    calendar.unselect();
                },
            });

            calendar.render();
        });


    </script>


@endsection
