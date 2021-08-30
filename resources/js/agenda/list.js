$(() => {

    let parsedEvents = [];
    for (let event of eventList) {
        if (event.idUser == userId || event.visibilidade) {
            let start_date = new Date(event.data_inicio);
            let end_date = event.data_fim ? new Date(event.data_fim) : null;

            parsedEvents.push({
                title: event.titulo,
                description: event.descricao || null,
                start: start_date.getFullYear() + ' - ' + start_date.getMonth() + ' - ' + start_date.getDay(),
                end: end_date ? end_date.getFullYear() + ' - ' + end_date.getMonth() + ' - ' + end_date.getDay() : null,
                color: event.cor,
                extendedProps: {
                    visibilidade: event.visibilidade,
                    id: event.agenda_id,
                    universidade_id: event.idUniversidade || null,
                    universidade_nome: event.universidade ? event.universidade.nome : null
                }
            });
        }
    }

    $(".needs-validation").on('submit', event => {
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
        events: parsedEvents,
        // Ao clicar num evento, irá correr o seguinte código (Modal para editar e apagar um evento).
        eventClick: function (element) {
            let modal = $("#editModal");
            modal.find('.modal-body #titulo').val(element.event.title);
            modal.find('.modal-body #cor').val(element.event.backgroundColor);
            modal.find('.modal-body #data_inicio').val(dealWithDate(element.event.start));

            if (element.event.extendedProps.universidade_id != null) {
                modal.find('.modal-body #uni_selected').val(element.event.extendedProps.universidade_id);
                modal.find('.modal-body #uni_selected').text(element.event.extendedProps.universidade_nome);
            } else {
                modal.find('.modal-body #uni_selected').text("Escolha uma universidade...");
            }

            if (element.event.extendedProps.visibilidade == 1) {
                $("#publico").attr("selected", "true");
            } else {
                $("#privado").attr("selected", "true");
            }

            if (element.event.end != null) {
                modal.find('.modal-body #data_fim').val(dealWithDate(element.event.end));
            }

            if (element.event.extendedProps.description != null) {
                modal.find('.modal-body #descricao').val(element.event.extendedProps.description);
            }

            modal.find('#editForm').attr("action", "/agenda/" + element.event.extendedProps.id);
            modal.find('#deleteForm').attr("action", "/agenda/" + element.event.extendedProps.id);
            $("#editModal").modal("show");
        },
    });
    calendar.render();
});
