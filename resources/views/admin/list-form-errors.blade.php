 @if ($errors->has())
	<div class="alert alert-danger">
	    <ul>
	        @foreach ($errors->all() as $error)
	            <li> <strong>* {{ ucwords($error) }} </strong><br> </li><br/>     
	        @endforeach
	    </ul>
	</div>
@endif