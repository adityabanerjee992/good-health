@extends('app')

@section('content') 
	<div class="container">
	    	@include('myaccounts.partials.submenu')
            @include('flash::message')
		<div class="row width_1022">
			<div class="col-md-12 col-sm-12 col-xs-12 no-padding">
				<h2 class="text-center myaccount-title">My Orders</h2>
                
                @if(!$userOrders->isEmpty())        
					<table class="table table-hover table-responsive myorder-table">
						<thead class="my-account-thead">
		                    <tr>
		                        <th>Order #</th>
		                        <th>Date</th>
		                        <th>Shiped To</th>
		                        <th class="">Order Total</th>
		                        <th class="">Order Status</th>
		                        <th class="text-center">&nbsp;&nbsp;</th>
		                    </tr> <!-- /tr -->
		                </thead> <!-- /thead -->

		                <tbody>

		                	@foreach($userOrders as $order)
			                	@if($order->order_status != 0)
				                	<tr>
				                		<td class="highlight-col">{{ $order->id }}</td> <!-- /td -->
				                		<td>{{ $order->created_at }}</td>
				                		<td>{{ $names["$order->id"] }}</td>
				                		<td class="highlight-col">Rs. {{ $order->order_total }}</td> <!-- /td -->
				                		<td style=""> {{ $orderStatus["$order->id"] }}</td> <!-- /td -->
				                		<td style="text-align: right; vertical-align: middle;" >
				                			<ul class="order_btn_action">
			                                    <li><a href="{{ route('my-account-order-details',$order->id)}}" class="up-new-presc">View Order</a></li>
                                                            <li>@include('myaccounts.partials.reorder-form')</li>
                                                            @if($order->order_status !=5 and $order->order_status !=8 and $order->order_status !=9 and $order->order_status !=10)
	                                                            <li>@include('myaccounts.partials.cancel-order-form')</li>
	                                                        @endIf
			                                </ul>
				                		</td> <!-- /td -->
				                	</tr> <!-- /tr -->	          
			                	@endIf              
	                     	@endForeach

		                </tbody> <!-- /tbody -->
					</table> <!-- /.table -->
				@else
					<p class="alert alert-info">  No Orders As Of Now .. </p>

				@endIf

				

			</div> <!-- /.col-md-12 -->
		</div> <!-- /.row -->
	</div> <!-- /.container -->
@stop