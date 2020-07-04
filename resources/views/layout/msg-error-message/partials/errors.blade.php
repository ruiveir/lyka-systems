<div class="mt-2 alert alert-danger alert-dismissible fade show" role="alert" id="error-alert">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    @foreach ($errors ->all() as $message)
       <h6 style="font-size: 15px; position:relative; top:4px;">{{$message}}</h6>
    @endforeach
</div>

<script src="{{asset('/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

<script src="/js/form-messages.js" charset="utf-8"></script>
