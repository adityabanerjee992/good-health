<!-- SMALL SEARCH BOX -->
<section class="large-search-box small-search-box ">
	<div class="container">
		<div class="row">
			 

		    <div class="col-md-12 col-sm-12 col-xs-12">
				<form id="my-search-bar" method="post" action="">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">

					<div class="my-search-p">
<!--						<span class="fa fa-map-marker in-check-poin-icon"></span> -->
						{{-- <input type="text" placeholder="Check picode" class="ininput ininput1"> 
						<span class="input-vert-bdr"></span>  --}}
						<input type="text" placeholder="SEARCH YOUR MEDICINE / OTC PRODUCTS" class="ininput ininput2"  name="search" id="search"> 
                                                <a href="#"><span class="fa fa-search in-search-icon"></span></a>	
                                                <div class="search-results" id="search-results">
						</div>
						
					</div>
				</form>
		    </div> <!-- /.col-md-10 -->
	    
			<div class="col-md-2"></div>
		</div> <!-- /.row -->
	</div> <!-- /.container -->
</section> <!-- /.small-search-box -->
