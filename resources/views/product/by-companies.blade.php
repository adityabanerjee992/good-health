@extends('app')

@section('content')
	
	
	@include('drugs.partials.breadcrumbs');

	@include('drugs.partials.search-box');
	<!-- DRUGS BY SECTION -->
	<section class="drugs-ali-list">
		<div class="container">

			<h2 class="find-drugs-title text-center">List Of Medicines For {{ $name }}</h2>
			<p class="find-drugs-subtitle text-center">Choose any medicine to view its details.</p>

			@if(!$products->isEmpty())

			<ul class="drug-list-long">
				
				@foreach($products as $product)

				<li><a href="{{ route('product-details',$product->id) }}">{{ $product->product_name }}</a></li>
				
				@endForeach

			@else
			
				<p class="text-center alert alert-warning">No Medinces Available . Consider Going <a href="{{ url($url) }}">Back</a> and find something else..</p>

			@endif

			{!! $products->render() !!}
			</ul> <!-- /.drug-list-long -->

		</div> <!-- /.container -->
	</section> <!-- /.drugs-ali-list -->

@endSection