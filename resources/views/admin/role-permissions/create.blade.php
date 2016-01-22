@extends('app')

@section('content')
	@include('flash::message')
	<br/>
	<br/>
	<div class="container">
	    {!! Form::open(['route' => 'role-permissions-store']) !!}

	    	@if(!$permissions->isEmpty())
	    	
	        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
	    		{!! Form::input('hidden','role-id',$roleId)!!}
	    		@foreach($permissions as $permission)
	    			{!! Form::checkbox('permissions[]', $permission->id) !!} : {{ $permission->label }} 
		            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}	    			
	    		@endForeach
	        
	        </div>	    
	    	
	    	@else
	    		<p class="alert alert-info"> No Permissions Exists In The System So Far .. </p>
	    	@endIf
	    	
	        <div class="form-group">
	            {!! Form::input('submit','Assign Permissions', null, ['class' => 'form-control']) !!}
	        </div>	    

	    {!! Form::close() !!}
	</div>
@stop