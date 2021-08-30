// Custom upload file area
function getFile() {
    document.getElementById("upfile").click();
}

function sub(obj) {
    var file = obj.value;
    var fileName = file.split("\\");
    document.getElementById("addFileButton").innerHTML = fileName[fileName.length - 1];
}

function removeFile() {
    document.getElementById("upfile").value = "";
    document.getElementById("addFileButton").innerHTML = 'Adicionar um ficheiro';
}

// Tooltip
$(function() {
    $('[data-toggle="tooltip"]').tooltip()
})

// Context Menu
window.onclick = hideContextMenu;
var contextMenu = document.getElementById("contextMenu");

function showContextMenu() {
    contextMenu.style.display = "inline-block";
    contextMenu.style.left = event.clientX - '260' + 'px';
    contextMenu.style.top = event.clientY + 'px';
    return false;
}

function hideContextMenu() {
    if ($('#contextMenu, .contextMenu').length) {
        contextMenu.style.display = "none";
    }
}




$(document).ready(function () {

    var table = $('#dataTable').DataTable({

        "pageLength": 100,

        "columnDefs": [
/*                 {
                "orderable": false,
                "width": "60px",
                "targets": 0
            }, */
/*                 {
                "orderable": false,
                "targets": 2
            }, */
            {
                "orderable": false,
                "width": "130px",
                "targets": -1
            },

        ],


        "language": {
            "lengthMenu": "Mostrar _MENU_ por página",
            "search": "Procurar",
            "zeroRecords": "Sem registos",
            "paginate": {
                "first": "Primeiro",
                "last": "Ultimo",
                "next": "Proximo",
                "previous": "Anterior"
            },

            "info": "",
            "infoEmpty": "",
            "infoFiltered": ""
        },

        "order": [1, 'desc'],

        /* "bLengthChange": false, */
        /* "bFilter": false, */


    });


    $(".dataTables_filter").hide(); // Esconde o input search por defeito
    $("#customSearchBox").on('keyup', function () {
        $(".dataTables_filter input").val($("#customSearchBox").val())
        table.search($(".dataTables_filter input").val()).draw();
    });



    $('.dataTables_length').hide(); // Esconde o select "rows per page" por defeito
    $('#records_per_page').val(table.page.len());
    $('#records_per_page').on('change', () => {
        table.page.len($(this).val()).draw();
    });



    /* FIM configs DATATABLES */
});
