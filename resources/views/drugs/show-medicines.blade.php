@extends('app')

@section('content')

	<!-- PAGE BREADCRUMB -->
	<section class="page-breadcrumb">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<ol class="breadcrumb my-breadcrumb">
						<li><a href="{{ url('') }}">HOME</a><span class="bread-sr">&raquo;</span></li>
						<li>DRUGS BY {{$class}} <span class="bread-sr">&raquo;</span> </li>
						<li class="active">{{strtoupper($category)}} </li>
					</ol>
				</div>
			</div>
		</div>
	</section> <!-- /.page-breadcrumb -->


	<!-- SMALL SEARCH BOX -->
	<section class="small-search-box">
		<div class="container">
			<div class="row">
				<div class="col-md-2"></div>

			    <div class="col-md-8 col-xs-12">
			    	<div id="my-search-bar">
						<p class="my-search-p my-search-p-sml">
							<span class="fa fa-map-marker in-check-poin-icon"></span> 
							<input type="text" placeholder="Check picode" class="ininput ininput1"> 
							<span class="input-vert-bdr"></span> 
							<input type="text" placeholder="SEARCH YOUR MEDICINE / OTC PRODUCTS" class="ininput ininput2"> 
							<span class="fa fa-search in-search-icon in-search-icon-sml"></span>
						</p>
					</div> <!-- /.my-search-bar -->
			    </div> <!-- /.col-md-10 -->
		    
				<div class="col-md-2"></div>
			</div> <!-- /.row -->
		</div> <!-- /.container -->
	</section> <!-- /.small-search-box -->

	<!-- DRUGS BY ALIMENTS -->
	<section class="drugs-ali-list">
		<div class="container">

			{{-- <h2 class="find-drugs-title text-center">Find Drugs By </h2> --}}
			<p class="find-drugs-subtitle text-center">Choose a Salt to view its products</p>

			<ul class="drug-list-long">
				@foreach($medicineList as $medicine)

				<?php $slug = str_replace(' ', '-', strtolower($medicine)) ?> 
				
				<li><a href="{{ url($currentUrl."/".$slug) }}">{{ $medicine }}</a></li>
				
				@endForeach
			</ul> <!-- /.drug-list-long -->

		</div> <!-- /.container -->
	</section> <!-- /.drugs-ali-list -->

@endSection