@extends('app')
@section('content')	
<!-- ENTER ADDRESS -->
<section class="enter-address">
	<div class="container">
		
		@if(isset($routeAction['as']) and $routeAction['as'] == 'cart-address-edit')
		@else
			@include('myaccounts.partials.submenu')	
		@endif

		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<h2 class="text-center myaccount-title">Address Book >> Edit Address</h2>
				
				<div class="col-md-9 col-sm-9 col-xs-16 edit-address">
					<div class="address_info_user">
						<h3><strong>Edit Your Address</strong></h3>
						
						@if($address != NULL)						
								@include('flash::message')
								<form role="form" method="POST" action="{{ route('update-address') }}"> <br style="clear:both">
									
									@if(isset($routeAction['as']) and $routeAction['as'] == 'cart-address-edit')
										{!! Form::hidden('is_request_from_cart_address_page',1)  !!}
									@else
										{!! Form::hidden('is_request_from_cart_address_page',0)  !!}
									@endif

									{!! Form::token() !!}
									{!! Form::hidden('address_id',$address->id) !!}
									{!! Form::hidden('customer_id',Auth::user()->id) !!}
									{!! Form::hidden('id',$address->id) !!}
									<div class="form-group">
										<input type="text" class="form-control ship-frm-inp" id="name" name="name" placeholder="Name" 
										value="{{ $address->name }}" required>
										<span class="text-danger">{{$errors->first('name')}}</span>
									</div>				    				
									<div class="form-group">
										<input type="text" class="form-control ship-frm-inp" id="pincode" name="pincode" placeholder="Pincode" 
										value="{{ $address->pincode }}" required>
										<span class="text-danger">{{$errors->first('pincode')}}</span>
									</div>
									<div class="form-group">
										<textarea class="form-control ship-frm-inp" type="textarea" id="address" name="address" 
										placeholder="Address" maxlength="140" rows="4">{{ $address->address }}</textarea>
										<span class="text-danger">{{$errors->first('address')}}</span>
									</div>
									<div class="form-group">
										<input type="text" class="form-control ship-frm-inp" id="city" name="city" placeholder="City" 
										value="{{ $address->city }}" required>
										<span class="text-danger">{{$errors->first('city')}}</span>
									</div>				    				
									<div class="form-group">
										<input type="text" class="form-control ship-frm-inp" id="state" name="state" placeholder="State" 
										value="{{ $address->state }}" required>
										<span class="text-danger">{{$errors->first('state')}}</span>
									</div>
									<div class="form-group">
										<p class="service-avl-txt">Country India (Service available only in India)</p>
										<input type="text" class="form-control ship-frm-inp" id="mobile" name="mobile" placeholder="Mobile Number" value="{{ $address->phone }}" required>
										<span class="text-danger">{{$errors->first('mobile')}}</span>
									</div>
									
									<input type="submit" id="add_new_address" name="add_new_address" class="save-shp-adrs" value="Update"> 
								</form>
						@else
							<p class="alert alert-danger"> Unable to find the address for the given id..</p>
						@endIf
						
					</div><!-- /.account_info_user -->
				</div>				 
				
			</div> <!-- /.col-md-12 -->
		</div> <!-- /.row -->
	</div> <!-- /.container -->
</section> <!-- /.enter-address -->

@stop
