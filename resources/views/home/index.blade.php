@extends('app')

@section('content')

@include('home.partials.slider')
@include('home.partials.search-box')
@include('home.partials.medical-equipment')
@include('home.partials.saving-banner')
@include('home.partials.prescription-upload')
@endsection


@include('partials.sweatalert', ['title' => 'You Are Registered Now !','message' => ''])