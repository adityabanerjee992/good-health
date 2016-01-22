<!-- PAGE BREADCRUMB -->
<section class="page-breadcrumb">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ol class="breadcrumb my-breadcrumb">
					<li><a href="{{ url('') }}">HOME</a><span class="bread-sr">&raquo;</span></li>

					<li><a href="{{ url($previousUrl) }}">DRUGS BY {{ strtoupper($category) }}</a><span class="bread-sr">&raquo;</span></li>
					
					<li class="active"> <a href="{{ url($currentUrl) }}"> {{ strtoupper($name) }} </a></li>					
				</ol>
			</div>
		</div>
	</div>
</section> <!-- /.page-breadcrumb -->

