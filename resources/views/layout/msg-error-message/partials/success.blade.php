<div class="pl-4 pr-4">
	<div class="mt-2 alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
		{{session('success')}}
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
</div>

<script src="{{asset('/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

<script src="{{asset('/js/msg-error-message/success.js')}}"></script>
