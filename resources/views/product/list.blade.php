@extends('app')

@section('content')
	


	<hr/>
	<hr/>
	<!-- DRUGS BY SECTION -->
	<section class="drugs-ali-list">
		<div class="container">

			@if(!$products->isEmpty())

			<ul class="drug-list-long">
				
				@foreach($products as $product)

				<li><a href="{{ route('product-details',$product->id) }}">{{ $product->product_name }}</a></li>
				
				@endForeach

			@else
			
				<p class="text-center alert alert-warning">No Medinces Available . Consider Going <a href="{{ url($url) }}">Back</a> and find something else..</p>

			@endif

			</ul> <!-- /.drug-list-long -->

		</div> <!-- /.container -->
	</section> <!-- /.drugs-ali-list -->

@endSection