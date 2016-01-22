@extends('app')


@section('content')
	
	<div class="container">
		@include('flash::message')
		@include('admin.partials.create_form',['name' => 'Permission Name','label' => 'Permission Label','route' => 'permission-store'])
	</div>

@stop