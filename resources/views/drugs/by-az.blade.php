@extends('app')

@section('content')
	
	@include('drugs.partials.breadcrumbs');

	@include('drugs.partials.search-box');

	<!-- DRUGS BY SECTION -->
	<section class="drugs-ali-list">
		<div class="container">

			<h2 class="find-drugs-title text-center">Find Drugs By {{ $category }}</h2>
			<p class="find-drugs-subtitle text-center">Select your disease or condition, then choose the salts to view the relevant drugs.</p>

			<ul class="drug-list-long">
				@foreach($products as $product)

				<?php $slug = str_replace(' ', '-', strtolower($product->product_name)) ?> 
				
				<li><a href="{{route('product-details',$product->id) }}">{{ $product->product_name }}</a></li>
				
				@endForeach

				{{-- {!! $products->render() !!} --}}
			</ul> <!-- /.drug-list-long -->
			{!! $products->render() !!}
		</div> <!-- /.container -->
	</section> <!-- /.drugs-ali-list -->

@endSection