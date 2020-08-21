<div class="pl-4 pr-4">
    <div class="mt-2 alert alert-danger alert-dismissible fade show" role="alert" id="error-alert">
        @foreach ($errors ->all() as $message)
        <h6 style="font-size: 15px; position:relative; top:4px;">{{$message}}</h6>
        @endforeach
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>

<script src="{{asset('/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

<script>
    $(document).ready(function() {
        $("#error-alert").fadeTo(7500, 500).slideUp(500, function() {
            $("#error-alert").slideUp(500);
        });
    });
</script>
