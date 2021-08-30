function routeEvents(route) {
    return document.getElementById('calendar').dataset[route];
}

$(function () {
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
});
