@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Order Details
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/extensions/bootstrap/dataTables.bootstrap.css') }}" />
<link href="{{ asset('assets/css/pages/tables.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ url('css/bootstrap.min.css') }} ">
<link rel="stylesheet" href="{{ url('css/font-awesome.min.css') }} ">
<link rel="stylesheet" href="{{ url('css/custom-style.css') }} ">
<link rel="stylesheet" href="{{ url('css/responsive.css') }} ">
@stop


{{-- Page content --}}
@section('content')
<section class="content-header">
    <h1>Order Details</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}">
                <i class="livicon" data-name="home" data-size="14" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>
            <a href="{{ route('orders') }}">
                Orders
            </a>
        </li>
        <li class="active">Order Details</li>
    </ol>
</section>


<section class="content paddingleft_right15">
  <div class="row">
     <div class="col-md-12 col-sm-12 col-xs-12">

        <h2 class="text-center myaccount-title">ORDER #{{ ($order->id != NULL) ? $order->id : "" }} - 
         {{ ($orderStatus != NULL) ? $orderStatus : "" }}</h2>

         @include('flash::message')
         <div class="order-detail-action">
           <ul class="detail_action">
            @if($orderStatus != 'Cancelled' && $orderStatus != 'Delivered' && $orderStatus != 'Rejected')
            @if($prescriptions->isEmpty())  
            <li><a href="{{ route('orders.askForPrescription',$order->id) }}" class="btn btn-info">Prescription</a></li>
            @endif                           
            <li><a href="{{ route('orders.rejectOrder',$order->id) }}" class="btn btn-danger">Reject Order</a></li>
            <li><a href="{{ route('get-update-order-status',$order->id) }}" class="btn btn-success">Update Status</a></li>
            <li><a href="{{ route('orders.edit',$order->id) }}" class="btn btn-success">Edit Order</a></li>
            <li><a href="{{ route('print-order-admin',$order->id) }}" class="btn btn-success">Print Invoice</a></li>
            <li><a href="{{ route('print-order-admin',$order->id) }}" class="btn btn-success">Shipping Label</a></li>
            {{-- @if (Sentinel::getUser()->hasAnyAccess(['view-order-logs'])) --}}
               <li><a href="{{ route('view-order-logs-admin',$order->id) }}" class="btn btn-info">View Logs</a></li>
            {{-- @endIf --}}
            <li><a href="{{ route('orders') }}" class="btn btn-info">Go Back</a></li>
            @else
           <li><a href="{{ route('view-order-logs-admin',$order->id) }}" class="btn btn-info">View Logs</a></li>
            <li><a href="{{ route('orders') }}" class="btn btn-info">Go Back</a></li>
            @endif

        </ul>
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12 shipping-top-info">
        <div class="col-md-2 col-sm-6 col-xs-12">
            <h3>Shipping Address</h3>
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
                            <td style=""> {{ $orderDetail->quantity }} {{ \App\Product::find($orderDetail->product_id)->categories->first()->category_name }}(s)<span>({{ \App\Product::find($orderDetail->product_id)->packings->first()->packing_type .' '. \App\Product::find($orderDetail->product_id)->categories->first()->category_name .' in a '. \App\Product::find($orderDetail->product_id)->units->first()->unit_type }})</span></td> <!-- /td -->
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
        </div>  
        <div class="item_ordered_title"><h2>Order Prescription </h2></div>
       
        <div class="item_ordered_list">      
         @if(!$prescriptions->isEmpty())    
            <table class="table table-hover table-responsive myorder-detail-table">
               <thead class="my-account-thead"> 
                    <th width="10%">Patient Name</th>
                    <th width="10%">Upload Date</th>
                    <th width="20%">Prescription Date</th>
                    <th class="" width="15%">prescription Name</th>
                    <th class="" width="35%">Notes</th>
                    <th class="text-center" width="10%">Actions</th>
                </tr> <!-- /tr -->
            </thead> <!-- /thead -->

            <tbody>
                
                @foreach($prescriptions as $prescription)
                <tr>
                    <td>{{ $prescription->patient_name }}</td>
                    <td>{{ date("F jS, Y",strtotime($prescription->created_at)) }}</td>
                    <td>{{ date("F jS, Y",strtotime($prescription->prescription_date)) }}</td>
                    <td class=""><a href="{{ route('get-document',$prescription->id) }}" target="_blank">{{ $prescription->document_name }}</a></td> <!-- /td -->
                    <td style=""><p>{{ $prescription->document_notes }}</p></td> <!-- /td -->

                    <td style="text-align: center; vertical-align: middle;" >
                        <ul class="detail_action">
                         <li><a href="{{ route('orders.askForPrescriptionUpdate',[$prescription->id,$order->id]) }}" class="btn btn-info">Ask For Prescription Update</a></li>
                     </ul>
                 </td> <!-- /td -->

             </tr> <!-- /tr -->
             @endForeach
         </tbody> <!-- /tbody -->
     </table> <!-- /.table -->
 </div>
 @else
    <br/>
    <p class="alert alert-info text-center"> No medical prescriptions attached with this order ..</p>
@endif
</div> <!-- /.col-md-12 -->
</div> <!-- /.row -->

</section> <!-- /.container -->
@stop