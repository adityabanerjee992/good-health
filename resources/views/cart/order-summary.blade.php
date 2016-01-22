@extends('app')

@section('content')
<!-- Checkout Steps -->
<div class="container-1022 checkout-steps-outer">
    <div class="checkout-steps">
        <div class="checkout-steps-text">
            <div class="step1 pull-left">
                1. UPLOAD PRESCRIPTION
            </div>
            <div class="step2">
                2. ENTER ADDRESS
            </div>
            <div class="step3 active pull-right">
                3. ORDER SUMMARY
            </div>
        </div>
        <div class="checkout-steps-design">
            <div class="steps-design-dots text-left">
                <div class="steps-bar"></div>
            </div>
            <div class="steps-design-dots">
                <div class="steps-bar"></div>
            </div>
            <div class="steps-design-dots active text-right">
                <div class="steps-bar"></div>
            </div>
        </div>
    </div>
</div>
<!-- End Checkout Steps -->
<!-- ORDER SUMMARY -->
<section class="order-summary">
    <div class="container">
        <div class="row">


            <!-- ORDER SUMMARY PRODUCT DETAILS -->
            <div class="col-md-6 col-xs-12">
                <div class="order-summary-left">
                    @if(!$orderDetails->isEmpty())

                    @foreach($orderDetails as $details)
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12 order-summary-left-product">
                            <div class="order-summary-left-product-summery">
                                <div class="order-summary-left-product-name">
                                    {{ $details->product_name }}
                                </div>
                                <div class="order-summary-left-product-company">
                                    {{ \App\Product::find($details->product_id)->companies->first()->company_name }}
                                </div>
                                <div class="order-summary-left-product-note">

                                    @if(\App\Product::find($details->product_id)->is_prescription_drug == 'YES') 
                                    *This medicine requires a prescription 
                                    @endif
                                </div>
                            </div>
                            <div class="order-summary-left-product-price">
                                Rs. {{ $details->price * $details->quantity }}
                            </div>
                        </div>
                    </div>
                    @endForeach 

                    @else
                    {{  redirect(url('')) }}
                    @endIf
                    <!--                                        <div class="row">
                                                                <div class="col-md-12 col-sm-12 col-xs-12 order-summary-left-product">
                                                                    <div class="order-summary-left-product-summery">
                                                                        <div class="order-summary-left-product-name">
                                                                            K Carb (25mg)
                                                                        </div>
                                                                        <div class="order-summary-left-product-company">
                                                                            Blue Cross Laboratories Ltd
                                                                        </div>
                                                                        <div class="order-summary-left-product-note">
                                                                            *This medicine requires a prescription
                                                                        </div>
                                                                    </div>
                                                                    <div class="order-summary-left-product-price">
                                                                        Rs. 2525.34
                                                                    </div>
                                                                </div>
                                                            </div>-->
                </div>
<!--                <table class="table table-responsive order-smry-tbl my-cart-table">
                    <tbody>

                        @if(!$orderDetails->isEmpty())

                        @foreach($orderDetails as $details)
                        {{-- {{ dd($details) }} --}}
                        <tr class="order-td-btm">
                            <td class="">
                                <h3> {{ $details->product_name }}</h3>
                                <p>{{ \App\Product::find($details->product_id)->companies->first()->company_name }}</p>
                            </td>  /td 
                            <td class="">
                                <h3> Quantity Ordered </h3>
                                <p>{{ $details->quantity }}</p>
                            </td>  /td 
                            <td></td>
                            <td></td>
                            <td class="">
                                <p class="my-cart-pro-price order-smry-tbl-p">Rs. {{ $details->price * $details->quantity }}</p>
                            </td>  /td 
                        </tr>  /tr 

                        @endForeach 

                        @else
                        {{  redirect(url('')) }}
                        @endIf

                    </tbody>  /tbody 
                </table>  /.order-smry-tbl 	-->
            </div> <!-- /.col-md-6 -->

            <!-- ORDER SUMMARY CASH PAYMENT -->
            <div class="col-md-6 col-xs-12 order-summary-right">
                <div class="ord-smr-ch-pmt order-summary-right-inner">
                    @if(!empty($paymentTypes))
                    @include('flash::message')
                    <form action="{{ route('order-confirmation') }}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        @foreach($paymentTypes as $paymentType)
                        <div class="radio select-pay-opt">
                            <label for="">
                                <input type="radio" name="payment_type"  value="{{ $paymentType->id }}" checked="checked">
                                <p>{{ $paymentType->name }}</p>
                            </label>
                            <p class="radio-details">{{ $paymentType->description }}</p>
                        </div> <!-- /.select-pay-opt -->
                        @endForeach

                      </div>

                        <a href="{{ url('cart/order-confirmation') }}"><button class="place-order">PLACE YOUR ORDER</button></a>
                    </form>
                    @endIf
                </div> <!-- /.ord-smr-ch-pmt -->
            </div> <!-- /.col-md-6 -->

        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section> <!-- /order-summary -->

@endSection