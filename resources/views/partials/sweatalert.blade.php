@if(Session::has('show_alert'))
{{ Session::forget('show_alert') }}
	@section('scripts')
		<script src="{{asset('js/sweetalert.min.js')}}"></script>
		<link rel="stylesheet" href="{{asset('css/sweetalert.css')}}">		

		<script type="text/javascript">
			var message = "{{ $message }}";
			var title = "{{ $title }}";

			swal({ title: title, 
				   text: message,   
				   type: 'success',
				   timer: 2000,   
				   showConfirmButton: false 
				});

		</script>
	@endSection
@endif
