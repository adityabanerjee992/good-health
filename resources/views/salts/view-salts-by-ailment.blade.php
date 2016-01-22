@extends('app')

@section('content')
	
	@include('salts.partials.breadcrumbs');

	@include('salts.partials.search-box');

	<!-- DRUGS BY SECTION -->
	<section class="drugs-ali-list">
		<div class="container">

			<h2 class="find-drugs-title text-center">List Of Medicines For {{ $name }}</h2>
			<p class="find-drugs-subtitle text-center">Choose a salt to view its products.</p>

			@if(!$salts->isEmpty())

			<ul class="drug-list-long">
				
				@foreach($salts as $salt)

				<li><a href="{{ route('products-by-salt',$salt->id) }}">{{ $salt->salt_name }}</a></li>
				
				@endForeach

			@else
			
				<p class="text-center alert alert-warning">No Salts Available . Consider Going <a href="{{ url($previousUrl) }}">Back</a> and find something else..</p>

			@endif

			</ul> <!-- /.drug-list-long -->

		</div> <!-- /.container -->
	</section> <!-- /.drugs-ali-list -->

@endSection