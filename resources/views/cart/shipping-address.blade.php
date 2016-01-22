@extends('app')

@section('content')
	
	<!-- SHIPPING ADDRESS -->
	<section class="shipping-address">
		<div class="container">
			<div class="row">
				<div class="col-md-3 col-sm-6 col-xs-12 hidden-title-area">
					<h3 class="text-center ship-adrs-tle-bb">hide title</h3>
				</div> <!-- /.col-md-4 -->
				<div class="col-md-6 col-sm-6 col-xs-12 form-area">
					<h3 class="text-center shipping-address-title">Enter a new shipping address</h3>

					<div class="shipping-address-form">
						<div class="form-main-area">  
					        <form role="form"> <br style="clear:both">
			    				<div class="form-group">
									<input type="text" class="form-control ship-frm-inp" id="name" name="name" placeholder="Name" required>
								</div>
								<div class="form-group">
									<input type="text" class="form-control ship-frm-inp" id="pincode" name="pincode" placeholder="Pincode" required>
								</div>
			                    <div class="form-group">
			                    <textarea class="form-control ship-frm-inp" type="textarea" id="message" placeholder="Address" maxlength="140" rows="4"></textarea>
			                    </div>
			                    <div class="form-group">
			                    	<p class="service-avl-txt">Country India (Service available only in India)</p>
									<input type="text" class="form-control ship-frm-inp" id="mobile" name="mobile" placeholder="Phone" required>
								</div>
					            
					        <button type="button" id="submit" name="submit" class="save-shp-adrs">Save</button>
					        </form>

					        <a href="{{ url('cart/order-summary') }}"><button class="save-shp-adrs">Continue</button></a>
					    </div> <!-- /.form-area -->
					</div> <!-- shipping-address-form -->
				</div> <!-- /.col-md-4 -->
				<div class="col-md-3 col-sm-6 col-xs-12 hidden-title-area">
					<h3 class="text-center ship-adrs-tle-bb">hide title</h3>
				</div> <!-- /.col-md-4 -->
			</div> <!-- /.row -->
		</div> <!-- /.container -->
	</section> <!-- /.shipping-address -->

@endSection
