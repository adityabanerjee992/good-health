@extends('app')
@section('content')
	@include('flash::message')
	@include('admin.partials.create_form',['name' => 'Role Name','label' => 'Role Label','route' => 'role-store'])
@stop