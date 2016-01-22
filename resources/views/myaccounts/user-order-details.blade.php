@extends('app')

@section('content') 
<div class="container">
  @include('myaccounts.partials.submenu')
  <div class="row width_1022">
     <div class="col-md-12 col-sm-12 col-xs-12 no-padding">

        <h2 class="text-center myaccount-title">ORDER #{{ ($order->id != NULL) ? $order->id : "" }} - 
         {{ ($orderStatus != NULL) ? $orderStatus : "" }}</h2>

         @include('flash::message')
         <div class="order-detail-action">
           <ul class="detail_action">
            <li>@include('myaccounts.partials.reorder-form')</li>
            <li><a href="{{ route('print-order',$order->id) }}" class="email-presc">Print Order</a></li>
        </ul>
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12 shipping-top-info">
        <div class="col-md-3 col-sm-3 col-xs-12">
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
            <div class="col-md-3 col-sm-3 col-xs-12">
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

               <?php $total = 0; $showPrescriptionBlock = 0;?>
               <tbody>
                @foreach($orderDetails as $orderDetail)
                {{-- {{ dd($orderDetail) }} --}}
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
            </div>
        </div> <!-- /.col-md-12 -->

        <div class="item_ordered_title"><h2>Order Prescription </h2></div>
        <div class="item_ordered_list">        
            @if(!$prescriptions->isEmpty())  
            <table class="table table-hover table-responsive myorder-detail-table">
             <thead class="my-account-thead">
               <tr>
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
                    <a href="{{ route('my-account-order-details-doc-edit',$prescription->id) }}"><img src="{{ url('images/edit2.png')}}" alt="Edit Prescription" title="Edit Prescription"></a>
                    <a href="#" onclick = "deleteDocument({{ $prescription->id }});"><img src="{{ url('images/del2.png')}}" alt=""></a>
                </td> <!-- /td -->
            </tr> <!-- /tr -->
            @endForeach
            @else
            <br/>
            <p class="alert alert-info text-center"> {{  ucfirst('No medical prescriptions attached with this order ..') }}</p>
            <p><li><a href="#" class="up-new-presc bootstrap-modal-form-open" data-toggle="modal" data-target="#myModal">Add New</a></li></p>
            {{-- <p><li><a href="" class="btn btn-info">Choose Existing</a></li></p> --}}

            @endif
        </tbody> <!-- /tbody -->
    </table> <!-- /.table -->
</div>
</div>
<!-- Modal -->
<div class="modal fade upload-prescription-popup" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Upload New Prescription</h4>
    </div>

    {!! Form::open(array('url'=>'cart/upload-prescription','files'=>true,'method' => 'POST' ,'class' => 'bootstrap-modal-form' )) !!}

    {!! Form::hidden('order_id',$order->id) !!}

    <div class="modal-body">
      <div class="form-group">
        <input type="text" name="patient_name" placeholder="Patient Name" required="required" class="form-control"/>
    </div>                
    <div class="form-group">
        <input type="text" name="document_name" placeholder="Document Name" required="required" class="form-control"/>
    </div>
    <div class="form-group">
        <input type="date" name="prescription_date" placeholder="Prescription Date" class="form-control" />
    </div>
    <div class="form-group">
        <textarea name="notes" placeholder="Prescription Notes .. If Any" class="form-control"></textarea>
    </div>                
    <div class="form-group">
        <input type="file" name="prescription_file" placeholder="Prescription File" class="form-control" />
    </div>
    <div class="form-group text-center">  
       <input type="submit" name="" value="UPLOAD" class="transition-all btn btn-primary"/>
   </div>                                  
</div>
{!! Form::close() !!}
</div>
</div>
</div>
</div> <!-- /.row -->
</div> <!-- /.container -->

<script type="text/javascript">

    function deleteDocument(documentId){

        var dataString = 'document_id='+ documentId;

        $.ajax({
            type: "POST",
            url: "{{ route('post-delete-document') }}",
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
             if(response.status != 0){
                location.reload();
            }
        }
    });
    }
</script>
@stop