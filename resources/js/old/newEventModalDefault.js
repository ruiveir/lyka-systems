$("#titleModalNew").on('click', () => {

    $(".limpar").each(function () {
        $(".limpar").val("");
        $("#color").val("#6A74C9");

    });

    addDefaultFields();
});

function addDefaultFields() {

    var date = new Date();
    string = ""

    let month = date.getMonth() + 1;
    string = date.getFullYear() + "-" + ("0" + month).slice(-2)
        + "-" + ("0" + date.getDate()).slice(-2) + "T"
        + ("0" + date.getHours()).slice(-2) + ":" + ("0" + date.getMinutes()).slice(-2);

    $("#modalCalendar input[name='dataInicio']").val(string);
}
