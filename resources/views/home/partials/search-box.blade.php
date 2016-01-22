<div class="banner-static">
	<!-- SEARCH BOX -->
	<section class="search-box">
		<div class="container">
			<div class="row">
				<h2>If You Don'T Make Time For Exercise, You Must Make Time For Illness.</h2>
				<div class="col-md-1"></div>
				
				<div class="col-md-10 col-xs-12">
					<p class="font-13">Buy Medicines Online !! Cash on Delivery in Delhi NCR!</p>
				
						@include('home.partials.search-input-div')
						<span class="search-box-options">
							@if(\Cookie::has('user_pincode') == true)
							<a href="#" class="bootstrap-modal-form-open"  data-toggle="modal" data-target="#pincodePopup">Change Pincode </a>
							@endif
						</span>
					{{-- </form> --}}
				</div> <!-- /.col-md-12 --> 

				<div class="col-md-1"></div>
			</div> <!-- /.row -->

			<!-- /.row -->
		</div> <!-- /.container -->
	</section> <!-- /.search-box -->
	<!-- MEDICAL EQUIPMENT -->
	<section class="medical-equipment">
		<div class="container">
			<div class="row">
				<div class="medical-equipment-icons">
					<div class="icon-div">
						<img src="images/tablets-capsules.png" class="img-rounded med-drug" alt="Medical Equipment"></img>
					</div>
					<p class="equip-name text-center font-12">TABLET & CAPSULES</p>
				</div><!-- /.col-md-2 -->

				<div class="medical-equipment-icons">
					<div class="icon-div"><img src="images/syrups.png" class="img-rounded med-drug" alt="Medical Equipment"></img></div>
					<p class="equip-name text-center font-12">SYRUPS</p>
				</div><!-- /.col-md-2 -->

				<div class="medical-equipment-icons">
					<div class="icon-div"><img src="images/injections.png" class="img-rounded med-drug" alt="Medical Equipment"></img></div>
					<p class="equip-name text-center font-12">INJECTIONS</p>
				</div><!-- /.col-md-2 -->

				<div class="medical-equipment-icons">
					<div class="icon-div"><img src="images/ointments.png" class="img-rounded med-drug" alt="Medical Equipment"></img></div>
					<p class="equip-name text-center font-12">OINTMENTS</p>
				</div><!-- /.col-md-2 -->

				<div class="medical-equipment-icons">
					<div class="icon-div"><img src="images/health-equipments.png" class="img-rounded med-drug" alt="Medical Equipment"></img></div>
					<p class="equip-name text-center font-12">HEALTH EQUIPMENT</p>
				</div><!-- /.col-md-2 -->

				
			</div> <!-- /.row -->
		</div> <!-- /.container -->
	</section> <!-- /.medical-equipment -->
	<section class="container drug-by">
		<div class="row">
			<div class="col-md-12 search-menu">
				<ul class="search-filter">
					<li><a href="{{ route('drugs-by-ailment') }}">Drugs By Ailments</a></li>
					<li><a href="{{ route('drugs-by-class') }}">Drugs By Class</a></li>
					<li><a href="{{ route('drugs-by-manufacturer') }}">Drugs By Company</a></li>
					<li><a href="{{ route('drugs-by-az') }}">Drugs By A-Z List</a></li>
				</ul>
			</div>
		</div> 
	</section>

</div>

