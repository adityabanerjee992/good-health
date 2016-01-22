@extends('app-for-print')

@section('content') 
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">

				<h2 class="text-center myaccount-title">ORDER #{{ ($order->id != NULL) ? $order->id : "" }} - 
                                                               {{ ($orderStatus != NULL) ? $orderStatus : "" }}</h2>

                    @include('flash::message')
                	<div class="col-md-12 col-sm-12 col-xs-12 shipping-top-info">
                        <div class="col-md-2 col-sm-6 col-xs-12">
                            <h3>Shipping Address</h3>
            {{-- {{ dd($userAddress) }} --}}
            <address>
                <h4>{{ $userAddress->name }}</h4>
                <p> {{ $userAddress->address}} ,
                    {{ $userAddress->pincode }}
                    <br>{{ $userAddress->country }}
                    <br>T: {{ $userAddress->phone }}</p>
                </address>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <h3>Billing Address</h3>
                <address>
                    <h4>{{ $userAddress->name }}</h4>
                    <p> {{ $userAddress->address}} ,
                        {{ $userAddress->pincode }}
                        <br>{{ $userAddress->country }}
                        <br>T: {{ $userAddress->phone }}</p>
                    </address>
                </address>
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12 pay-method-area">
                <section class="ship-methods">
                    <h4>Shipping Method</h4>
                    <p>Free shipping only above 500 INR</p>
                </section>
                <section class="ship-methods">
                    <h4>Payment Method</h4>
                    <p>{{ $paymentTypeDetails->name }}</p>
                    {{-- <p>{{ $paymentTypeDetails->name }} fee Rs. {{  $paymentTypeDetails->fee }}</p> --}}
                </section>
            </div>
        </div>
        
        
        <div class="item_ordered_title"><h2>Items Ordered</h2></div>
        <div class="item_ordered_list">          
            <table class="table table-hover table-responsive myorder-detail-table">
                <thead class="my-account-thead">
                    <tr>
                        <th>Product Name</th>
                        <th>Company Name</th>
                        <th>SKU</th>
                        <th class="">Price</th>
                        <th class="">Qty</th>
                        <th class="text-right">Subtotal</th>
                    </tr> <!-- /tr -->
                </thead> <!-- /thead -->

                <?php $total = 0; ?>
                <tbody>
                    @foreach($orderDetails as $orderDetail)
                        <tr>
                            <td>{{ $orderDetail->product_name }}</td> <!-- /td -->
                            <td>{{ $companies[$orderDetail->product_id] }}</td>
                            <td>{{ $orderDetail->product_code }}</td>
                            <td>Rs. {{ $orderDetail->price }}</td> <!-- /td -->
                            <td style=""> {{ $orderDetail->quantity }} {{ \App\Product::find($orderDetail->id)->categories->first()->category_name }}(s)<span>({{ \App\Product::find($orderDetail->id)->packings->first()->packing_type .' '. \App\Product::find($orderDetail->id)->categories->first()->category_name .' in a '. \App\Product::find($orderDetail->id)->units->first()->unit_type }})</span></td> <!-- /td -->
                            <td class="highlight-col text-right">Rs. {{ $orderDetail->price * $orderDetail->quantity }}</td> <!-- /td -->
                        </tr> <!-- /tr -->

                        <?php $total =  ($orderDetail->price * $orderDetail->quantity) + $total; ?>
                    @endForeach
                </tbody> <!-- /tbody -->
            </table> <!-- /.table -->
            
            <div class="subtotal-order-details">
                <ul>
                        <li>
                            <span>Subtotal</span>
                            <span>{{ $total }}</span>
                        </li>
                        {{-- <li>
                            <span>{{ $paymentTypeDetails->name }} fee</span>
                            <span>Rs. {{ $paymentTypeDetails->fee }}</span>
                        </li> --}}
                        <li>
                            <span>Shipping & Handling</span>
                            <span>Rs.0.00</span>
                        </li>
                        <li>
                            <span>Discount (15% On the total medicine bill)</span>
                            <span>-Rs.{{ ($total/100) * 15 }}</span>
                        </li>
                        <li>
                            <span>Total After Discount </span>
                            <span>Rs.{{ ($total/100) * 85 }}</span>
                        </li>
                        <li>
                            <span>Tax (12% On Rs {{ ($total/100) * 85 }})</span>
                            <span>Rs. {{ (((($total/100) * 85)/100)* 12)}}</span>
                        </li>
                        <li class="grand-total">
                            <span>Grand Total</span>
                            <span>Rs. {{ ($total- ($total/100) * 15)  + (((($total/100) * 85)/100)* 12) }}</span>
                        </li>
                    </ul>
                
            </div>
        {{-- </div>   --}}
</div> <!-- /.row -->

@stop