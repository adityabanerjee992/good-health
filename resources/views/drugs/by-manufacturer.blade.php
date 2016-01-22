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
				@foreach($manufacturers as $manufacturer)
								
				<li><a href="{{ route('products-by-manufacturer',$manufacturer->id) }}">{{ $manufacturer->company_name }}</a></li>
				
				@endForeach
			</ul> <!-- /.drug-list-long -->

		</div> <!-- /.container -->
	</section> <!-- /.drugs-ali-list -->

@endSection