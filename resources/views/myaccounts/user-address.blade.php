@extends('app')
@section('content')	

@include('partials.scripts')
<!-- ENTER ADDRESS -->
<section class="enter-address">
	<div class="container">
		
		@include('myaccounts.partials.submenu')

		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<h2 class="text-center myaccount-title">Address Book</h2>
				
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="address_info_user">
						<h3>Your Saved Addresses</h3>
						
						@if(!$userAddresses->isEmpty())

						@foreach($userAddresses as $address)

						<address class="myaccount-address">
							<!--							<img src="{{ url('images/tick-icon.png') }}" class="tick-icon">-->
							<p class="address-edit-tool">
								
							</p>
							<p class="address-edit-tool2">
								<a href="#" class="pull-right edit-tool-right" onclick = "deleteAddress({{ $address->id }},{{ Auth::user()->id }});"> &nbsp;X</a>
								<a href="{{ route('edit-address',$address->id) }} " class="pull-right edit-tool-right"><img src="{{ url('images/pen-icon.png') }}" class="pen-icon "></a>
							</p>

							<div class="myaccount-address-text">
								{{-- {{ dd($address) }} --}}
								<p class="customer-name">{{ $address->name }}</p>
								<p class="customer-address">{{ $address->address . ', 	' . $address->city . ', 	' .  $address->state . ', 	' .  $address->pincode . ', 	' }} <br/>India</p>
								<p class="address-phone"> {{ $address->phone }}</p>
								<!--								<a href="#" class="del_btn"></a>-->
							</div> <!-- /.address-text -->
						</address>

						@endForeach
						@endIf
						
					</div><!-- /.account_info_user -->
				</div>

				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="address_user_details">
						<h3>Add new address</h3>
						@include('flash::message')
						<form role="form" method="POST" action="{{ route('address-add-new') }}"> <br style="clear:both">
							{!! Form::token() !!}
							<div class="form-group">
								<input type="text" class="form-control ship-frm-inp" id="name" name="name" placeholder="Name" 
								value="{{ old('name') }}" required>
								<span class="text-danger">{{$errors->first('name')}}</span>
							</div>				    				
							<div class="form-group">
								<input type="text" class="form-control ship-frm-inp" id="pincode" name="pincode" placeholder="Pincode" 
								value="{{ old('pincode') }}" required>
								<span class="text-danger">{{$errors->first('pincode')}}</span>
							</div>
							<div class="form-group">
								<textarea class="form-control ship-frm-inp" type="textarea" id="address" name="address" 
								placeholder="Address"value="{{ old('address') }}"  maxlength="140" rows="4"></textarea>
								<span class="text-danger">{{$errors->first('address')}}</span>
							</div>
							<div class="form-group">
								<input type="text" class="form-control ship-frm-inp" id="city" name="city" placeholder="City" 
								value="{{ old('city') }}" required>
								<span class="text-danger">{{$errors->first('city')}}</span>
							</div>				    				
							<div class="form-group">
								<input type="text" class="form-control ship-frm-inp" id="state" name="state" placeholder="State" 
								value="{{ old('state') }}" required>
								<span class="text-danger">{{$errors->first('state')}}</span>
							</div>
							<div class="form-group">
								<p class="service-avl-txt">Country India (Service available only in India)</p>
								<input type="text" class="form-control ship-frm-inp" id="mobile" name="mobile" placeholder="Mobile Number" value="{{ old('mobile') }}" required>
								<span class="text-danger">{{$errors->first('mobile')}}</span>
							</div>
							
							<input type="submit" id="add_new_address" name="add_new_address" class="save-shp-adrs" value="Save"> 
						</form>
					</div>
				</div>     					 
				
			</div> <!-- /.col-md-12 -->
		</div> <!-- /.row -->
	</div> <!-- /.container -->
</section> <!-- /.enter-address -->

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
				 bootbox.alert(response.message, function() {
                        console.log("Alert Callback");
                       location.reload();
                    });
				// if(response.status != 0){
				// 	location.reload();
				// }
			}
		});	
	}
</script>
@stop

