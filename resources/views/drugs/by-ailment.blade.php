@extends('app')

@section('content')
	
	@include('drugs.partials.breadcrumbs')

	@include('drugs.partials.search-box')

	<!-- DRUGS BY SECTION -->
	<section class="drugs-ali-list">
		<div class="container">

			<h2 class="find-drugs-title text-center">Find Drugs By {{ $category }}</h2>
			<p class="find-drugs-subtitle text-center">Select your disease or condition.</p>

			<ul class="drug-list-long">
				@foreach($ailments as $ailment)

				
				<li><a href="{{ route('products-by-ailment',$ailment->id) }}">{{ $ailment->ailment_name }}</a></li>
				
				@endForeach
			</ul> <!-- /.drug-list-long -->

		</div> <!-- /.container -->
	</section> <!-- /.drugs-ali-list -->

@endSection