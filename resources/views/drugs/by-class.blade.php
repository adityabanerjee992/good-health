@extends('app')

@section('content')
	
	@include('drugs.partials.breadcrumbs');

	@include('drugs.partials.search-box');

	<!-- DRUGS BY SECTION -->
	<section class="drugs-ali-list">
		<div class="container">

			<h2 class="find-drugs-title text-center">Find Drugs By {{ $category }}</h2>
			<p class="find-drugs-subtitle text-center">Select your drug class. </p>

			<ul class="drug-list-long">
				
				@foreach($classes as $class)
				
					<li><a href="{{ route('products-by-class',$class->id) }}">{{ $class->class_name }}</a></li>
				
				@endForeach
			
			</ul> <!-- /.drug-list-long -->

		</div> <!-- /.container -->
	</section> <!-- /.drugs-ali-list -->

@endSection