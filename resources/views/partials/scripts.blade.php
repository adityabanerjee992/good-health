<!-- Essential Scripts -->
<script src="{{ url('js/jquery.js') }}"></script>
<script src="{{ url('js/bootstrap.min.js') }}"></script>
<script src="{{ url('js/custom.js') }}"></script>
{{-- <script src="{{ url('js/live-search.js') }}"></script> --}}
<script src="{{ url('js/bootbox.min.js') }}"></script>
<script src="{{ url('js/laravel-bootstrap-modal-form.js') }}"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="{{ url('js/ie10-viewport-bug-workaround.js') }}"></script>
{{-- <script type="text/javascript" src="http://www.google.com/jsapi"></script> --}}
<script src="{{ url('js/handlebars.js') }}"></script>
<script src="{{ url('js/typeahead.js') }}"></script>
<script src="{{ url('js/search.js') }}"></script>

@if(\Cookie::has('user_pincode') == false)
<script type="text/javascript">
	$('#pincodePopup').modal('show');
</script>
@endif
