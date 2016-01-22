@extends('app')

@section('content')
<!-- Checkout Steps -->
<div class="container-1022 checkout-steps-outer">
	<div class="checkout-steps">
		<div class="checkout-steps-text">
			<div class="step1 pull-left">
				1. UPLOAD PRESCRIPTION
			</div>
			<div class="step2 active">
				2. ENTER ADDRESS
			</div>
			<div class="step3 pull-right">
				3. ORDER SUMMARY
			</div>
		</div>
		<div class="checkout-steps-design">
			<div class="steps-design-dots text-left">
				<div class="steps-bar"></div>
			</div>
			<div class="steps-design-dots active">
				<div class="steps-bar"></div>
			</div>
			<div class="steps-design-dots text-right">
				<div class="steps-bar"></div>
			</div>
		</div>
	</div>
</div>
<!-- End Checkout Steps -->
<!-- ENTER ADDRESS -->
<section class="enter-address">
	<div class="container">
		<div class="row">
			@include('flash::message')
			<div class="col-md-12 col-sm-12 col-xs-12">

				@if(!$addressData->isEmpty())

				@foreach($addressData as $address)

				<address class="my-address">
					<p class="address-edit-tool"></p>
                                        <span class="address-edit-tool-right">
                                            <a href="{{ route('cart-address-edit',$address->id) }}" class="address-edit">
                                                <span></span>
                                            </a>
                                            <a href="#" class="address-delete" onclick = "deleteAddress({{ $address->id }},{{ Auth::user()->id }});">
                                                <span></span>
                                            </a>
                                        </span>
					<div class="address-text">
						<p class="customer-name">{{ $address->name }}</p>
						<p class="customer-address">{{ $address->address . ', ' . $address->city . ', ' .  $address->state . ', ' .  $address->pincode . ', ' }} <br/>India</p>
						<p class="address-phone"> Mobile: <span>{{ $address->phone }}</span></p>
						<center><a href="{{ route('link-address-to-order',$address->id) }}"><button class="adrs-btn">CONTINUE</button></a></center>
					</div> <!-- /.address-text -->
				</address>

				@endForeach
				@endIf

				<!--				<center><a href="{{ route('address-add-new') }}"><button class="add-new-adrs-btn">+ Add New Address</button></a></center>-->
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <center><button type="button" class="add-new-adrs-btn bootstrap-modal-form-open" data-toggle="modal" data-target="#myModal">+ Add New Address</button></center>
				<!-- Modal -->
				<div class="modal fade add-new-address-popup" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					<div class="modal-dialog" role="document">
						<div class="modal-content">

							<div class="modal-body">

								<!-- SHIPPING ADDRESS -->
								<section class="shipping-address">

									<div class="row">

										<div class="col-md-12 col-sm-12 col-xs-12 form-area">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h3 class="text-center shipping-address-title">Enter a new shipping address</h3>

											<div class="shipping-address-form">
												<div class="form-main-area">  
													<form role="form" method="POST" action="{{ route('address-add-new') }}" class="bootstrap-modal-form"> <br style="clear:both" >

														{!! Form::token() !!}
														{!! Form::hidden('is_cart_form','1')!!}
														<div class="form-group">
															<input type="text" class="form-control ship-frm-inp" id="name" name="name" placeholder="Name" required>
														</div>		    				
														<div class="form-group">
															<input type="text" class="form-control ship-frm-inp" id="pincode" name="pincode" placeholder="Pincode" required>
														</div>
														<div class="form-group">
															<textarea class="form-control ship-frm-inp" type="textarea" id="address" name="address" placeholder="Address" maxlength="140" rows="4"></textarea>
														</div>
														<div class="form-group">
															<input type="text" class="form-control ship-frm-inp" id="name" name="city" placeholder="City" required>
														</div>		    				
														<div class="form-group">
															<input type="text" class="form-control ship-frm-inp" id="name" name="state" placeholder="state" required>
														</div>
														<div class="form-group">
															<p class="service-avl-txt">Country India (Service available only in India)</p>
															<input type="tel" class="form-control ship-frm-inp" id="mobile" name="mobile" placeholder="Phone" required min="10" max="10">
														</div>
														<div class="form-group text-center">  
															<input type="submit" id="add_new_address" name="add_new_address" class="save-shp-adrs" value="Save"> 
														</div>
													</form>
												</div> <!-- /.form-area -->
											</div> <!-- shipping-address-form -->
										</div> <!-- /.col-md-4 -->

									</div> <!-- /.row -->

								</section> <!-- /.shipping-address -->

							</div>

						</div>
					</div>
				</div>

			</div> <!-- /.col-md-12 -->
		</div> <!-- /.row -->
	</div> <!-- /.container -->
</section> <!-- /.enter-address -->

@endSection

<script type="text/javascript">
	
	function deleteAddress(addressId,customerId){

		var dataString = 'address_id='+ addressId +'&customer_id='+customerId;

		$.ajax({
			type: "POST",
			url: "/address/delete",
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			data: dataString,
			cache: false,
			success: function(response)
			{
				// alert(response.message);	
				bootbox.alert(response.message, function() {
                	console.log("Alert Callback");
                	if(response.status != 0){
						location.reload();
					}
         		});
			}
		});
	}
</script>

