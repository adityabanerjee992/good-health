@extends('app')
<meta name="csrf-token" content="{{ csrf_token() }}" />

<input id="token" type="hidden" value="">

@section('content')

<script type="text/javascript">
	
	var rows = [];

</script>
<!-- MY CART -->

<section class="my-cart">
	<div class="container">
		@include('drugs.partials.search-box')

		<div class="row">
			<h1 class="my-cart-title text-center">MY CART</h1>

			@if(!$cartData->isEmpty())
			<span class="cart-total-items text-center"> {{ $itemsCount }} ITEM(S)</span>
			<div class="col-sm-12 col-md-12 ">
				<table class="table table-responsive my-cart-table">
					<thead class="my-cart-thead">
						<tr>
							<th>PRODUCT Description</th>
							<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
							<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
							<th class="">PRODUCT Price</th>
							<th class="">Quantity</th>
							<th class="text-center">Unit Price</th>
						</tr> <!-- /tr -->
					</thead> <!-- /thead -->

					<tbody>

						<?php $totalMrp=0 ?>
						<?php $totalDiscMrp=0 ; $i=0; ?>

						@foreach($cartData as $data)
						<?php $i++; ?>
						<tr id="{{ $data->rowid }}">
							<td class="">
								<h3>{{ $data->name }}</h3>
                                <span class="med-company-name"> @if(\App\Product::find($data->id)->companies->first()->company_name != NULL) {{ \App\Product::find($data->id)->companies->first()->company_name}}@endIf</span>
							</td> <!-- /td -->
							<td></td>
							<td></td>
							<td class="">
								<p class="my-cart-pro-price">Rs.{{ $data->price * $data->qty }}</p>

								@if($data->options->prescription=='Yes')
								<p class="pro-warn-txt">* This medicine requires a prescription</p>
								@endIf
							</td> <!-- /td -->
							<td style="">
								<select class="form-control my-cart-select-opt" id="select_{{$i}}">

									@foreach(range(1,10) as $number)
									@if($data->qty == $number)
									<option value="{{ $number }}" selected> {{$number}} {{ $data->options->unit }}(s)</option>
									@else
									<option value="{{ $number }}"> {{$number}} {{ $data->options->unit }}(s)</option>
									@endIf
									@endForeach
`
								</select>
								<p class="pro-qnt">({{ $data->options->packing }})</p>
							</td> <!-- /td -->
							<td>
								<p class="my-cart-pro-price">Rs. {{ $data->price * $data->qty }} 
                                                                    <span title="Remove" class="pro-del" id="del_{{ $i }}"></span></p>
								{{-- <p class="pro-save">(Savings: 15%)</p> --}}
							</td> <!-- /td -->
						</tr> <!-- /tr -->
 
						<?php  $totalMrp = ($data->price * $data->qty) + $totalMrp ?>
						<?php  //totalDiscMrp = ($data->price * $data->qty) + $totalDiscMrp ?>

						<script type="text/javascript">
							rows[{{ $i }}] = {{ $i }};
						</script>

						@endForeach
						<?php $totalDiscMrp = ($totalMrp/100)*85?>
						<tr>
							<td class="">
								<p class="ent-cup-txt">Enter Coupon Code</p>
								<div class="form-group" style="width:250px">
									<div class="input-group input-group-xs">
										<input type="text" class="form-control" name="coupon" id="coupon_code">
										<span class="input-group-addon go-btn" id="coupon">GO</span>
									</div>
								</div> <!-- /.form-group -->

							</td> <!-- /td -->
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td class="">
	                            <table class="cart-subtotal">
	                                <tr>
	                                    <td>Subtotal</td>
	                                    <td>Rs. {{ $totalMrp }}</td>
	                                </tr>
	                                <tr>
	                                    <td colspan="2">(Savings: 15% On Total Cart Price)</td>
	                                    
	                                </tr>
	                                <tr>
	                                    <td>Total After Discount</td>
	                                    <td>Rs. {{ $totalDiscMrp }}</td>
	                                </tr> 
	                                <tr>
	                                    <td>You Saved</td>
	                                    <td>Rs {{ ($totalMrp - $totalDiscMrp) }}</td>
	                                </tr>
	                                <tr>
	                                    <td>Total Before Tax</td>
	                                    <td>Rs. {{ $totalDiscMrp }}</td>
	                                </tr>
	                                <tr>
	                                    <td>Tax(12%)</td>
	                                    <td>Rs {{ ($totalDiscMrp/100)*12 }}</td>
	                                </tr>
	                            </table>
								
							</td>
						</tr> <!-- /tr -->
					</tbody> <!-- /tbody -->
				</table> <!-- /.table -->
			</div> <!-- /.col-sm-12 -->
		</div> <!-- /.row -->

		<!-- NEED HTLP? -->
		<div class="row need-help">
			<div class="">
				<div class="col-md-6 col-sm-6 col-xs-12">
                                    <p class="cart-bottom-left"><span>Need Help? </span>1800 3000 0085 or <a href="#">contact us</a></p>
				</div> <!-- /.col-md-6 -->
				
				<div class="col-md-6 col-sm-6 col-xs-12 cart-bottom-right">
                                    <div class="cart-bottom-right-inner">
                                        <p>Grand Total<span>Rs {{ round($totalDiscMrp + (($totalDiscMrp/100) * 12),2) }}</span></p>
                                    </div>
					
				</div> <!-- /.col-md-6 -->
			</div> <!-- /.need-help -->
		</div> <!-- /.row -->

		<!-- CHECKOUT -->
		<div class="row checkout-btn-area">
			<div class="">
				<div class="col-md-12">
					<p class="pull-right checkout-txt"><input type="checkbox" id="terms" checked> <strong> I declare that I do not need the above listed items urgently. And I exempt SRS GoodHealth from any inconvenience caused to me due to a delay in delivery of the above items.</strong></input><br/><br/><input type="checkbox" id="delivery" checked> <strong> I am aware that the Order will be reviewed by a Chemist before it will be processed. And it can take upto 24-48 hours.</strong></input></p>
					<p class="pull-right checkout-txt"><a href="{{ url('cart/checkout') }}" id="checkout"><button class="checkout-btn"> Checkout </button></a></p>
					<p class="pull-right checkout-txt"><a href="{{ url('') }}" id="checkout"><button class="checkout-btn"> Continue Shopping </button></a></p>
				</div> <!-- /.col-md-12 -->
			</div> <!-- /.checkout-btn -->
		</div> <!-- /.row -->

		@else
		<section class="container-1022 main-container">
			<div class="empty-cart container-725">
				<img src="{{ url('images/empty-cart.png') }}" class="img-responsive" title="Cart Empty" alt="Empty Cart" />
				<p>NO MEDICINE IN BAG RIGHT NOW!</p>
				<a href="{{ route('home') }}" class="transition-all btn-style1">back to home</a>
			</div>
		</section>
		@endIf

	</div> <!-- /.container -->
</section> <!-- /.my-cart -->

@endSection
