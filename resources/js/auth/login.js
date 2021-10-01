$(() => {
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    $("#email").on('change', () => {
        $("#error").remove();
    });

    $("#password").on('change', () => {
        $("#error").remove();
    });
});
