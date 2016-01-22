@extends('app')

@section('content')
	<br/>
	<br/>
	<div class="container">
		@if(!$roles->isEmpty())
			<table class="table table-striped">
		    <thead>
		        <tr>
		            <th>Role Name</th>
		            <th>Role Label</th>
		            <th colspan="3">Actions</th>
		        </tr>
		    </thead>
	        <tbody>
				@foreach($roles as $role)	  
			        <tr>
			            <td>{{ $role->name }}</td>
			            <td>{{ $role->label }}</td>
			            <td><a href="{{ route('role-edit',$role->id) }}" > Edit </a></td>
			            <td><a href="{{ route('role-permissions',$role->id) }}" > List Permissions</a></td>
			            <td><a href="{{ route('role-permissions-create',$role->id) }}" > Assign Permission </a></td>
			            <td><a href="{{ route('role-delete',$role->id) }}" > Destroy </a></td>
			        </tr>
				@endForeach
		    </tbody>
			</table>
		@else
			<p class="alert alert-info"> No Roles added so far .. consider adding some roles.</p>
		@endIf
	</div>
@stop 