<meta name="csrf-token" content="{{ csrf_token() }}">
@extends('admin/layouts/default')

<script type="text/javascript">
  
 var rows = [];
 var orderId= 0;

</script>
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
         Edit </h2>

         @include('flash::message')
          <div class="order-detail-action">
           <ul class="detail_action">
           
            <li><a href="{{ route('orders') }}" class="btn btn-info">Go Back</a></li>

          </ul>
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12 shipping-top-info">
        
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
                            <th class="text-right">Delete Item</th>
                        </tr> <!-- /tr -->
                    </thead> <!-- /thead -->

                    <?php $total = 0; $i=0;?>
                    <tbody>
                        @foreach($orderDetails as $orderDetail)
                          <?php $i++; ?>
                        {{-- {{dd($orderDetail)}} --}}
                            <tr id="{{ $orderDetail->id }}">
                                <td>{{ $orderDetail->product_name }}</td> <!-- /td -->
                                <td>{{ $companies[$orderDetail->product_id] }}</td>
                                <td>{{ $orderDetail->product_code }}</td>
                                <td>Rs. {{ $orderDetail->price }}</td> <!-- /td -->
                                <td style="">
                                    <p class="pro-qnt">{{ \App\Product::find($orderDetail->id)->packings->first()->packing_type }}</p>
                                </td> <!-- /td -->

                                <td style=""> 
                                    <select class="form-control my-cart-select-opt" id="select_{{$i}}">
                                        @foreach(range(1,$orderDetail->quantity) as $number)
                                            @if($orderDetail->quantity == $number)
                                                <option value="{{ $number }}" selected> {{$number}} {{ \App\Product::find($orderDetail->product_id)->units->first()->unit_type }}(s)</option>
                                                @else
                                                <option value="{{ $number }}"> {{$number}} {{ \App\Product::find($orderDetail->product_id)->units->first()->unit_type }}(s)</option>
                                            @endIf
                                        @endForeach
                                    </select>
                                     {{ \App\Product::find($orderDetail->product_id)->categories->first()->category_name }}(s)<span>({{ \App\Product::find($orderDetail->product_id)->packings->first()->packing_type .' '. \App\Product::find($orderDetail->product_id)->categories->first()->category_name .' in a '. \App\Product::find($orderDetail->product_id)->units->first()->unit_type }})</span>
                                 </td> <!-- /td -->
                                <td class="highlight-col text-right">
                                <p class="my-cart-pro-price">Rs. {{ $orderDetail->price * $orderDetail->quantity }} <span title="Remove" class="pro-del glyphicon glyphicon-remove pull-right" id="del_{{ $i }}"></span></p>
                                {{-- <p class="pro-save">(Savings: 15%)</p> --}}
                            </td> <!-- /td -->
                            </tr> <!-- /tr -->

                            <?php $total =  ($orderDetail->price * $orderDetail->quantity) + $total; ?>
                            <script type="text/javascript">
                             rows[{{ $i }}] = {{ $i }};
                          </script>
                        @endForeach
                    </tbody> <!-- /tbody -->
                </table> <!-- /.table -->
        </div>      
</div> <!-- /.row -->

</section> <!-- /.container -->
@stop

<!-- Essential Scripts -->
<script src="{{ url('js/jquery.js') }}"></script>
<script src="{{ url('js/bootstrap.min.js') }}"></script>
<script type="text/javascript">
$(document).ready(function(){
  $.each(rows, function( index, value ) {
      var i=$('#select_'+value);
      orderId = {{ $order->id }};
      
      var selectClone = i.clone();

      i.change(function() {
 
      var rowId    = i.closest("tr").attr("id");
      var quantity = i.val();
      var comfirmResult = confirm("Are you sure you want to perform this operation.. ??");
        if (comfirmResult == true) {
          $.ajax({
            url: '/admin/orders/'+ orderId +'/edit',
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            data: {'rowId': rowId,'quantity' : quantity},
            success: function(data, status) {
              if(data.status == 0) {
                  alert('Invalid inputs prodived for the update operation..');
                  location.reload();
              } 
              if(data.status == 1) {
                  alert('Update Performed SuccessFully ..');
                  location.reload();
              }  
              if(data.status == 2) {
                  alert('Unable to perform the update please try again ..');
                  location.reload();
              }
            },
            error: function(xhr, desc, err) {
              console.log(xhr);
              console.log("Details: " + desc + "\nError:" + err);
            }
          }); // end ajax call
        }else{
          // i.replaceWith(selectClone);
          // comfirmResult = 0;
          location.reload();
        }
      }); 

      var j=$('#del_'+value);

      j.click(function() {
      var rowId    = j.closest("tr").attr("id");
      var comfirmResult = confirm("Are you sure you want to perform this operation.. ??");  
     
      if (comfirmResult == true) {
          $.ajax({
            url: '/admin/orders/'+ orderId +'/edit',
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            data: {'rowId': rowId,'isDelete':1},
            success: function(data, status) {
              if(data.status == 0) {
                  alert('Invalid inputs prodived for the delete operation..');
                  location.reload();
              } 
              if(data.status == 1) {
                  alert('Delete Performed SuccessFully ..');
                  location.reload();
              }  
              if(data.status == 2) {
                  alert('Unable to perform the delete please try again ..');
                  location.reload();
              }
              if(data.status == 3) {
                  alert('Cannot delete the item since there is only one item in the cart..');
                  location.reload();
              }
            },
            error: function(xhr, desc, err) {
              console.log(xhr);
              console.log("Details: " + desc + "\nError:" + err);
            }
          }); // end ajax call
        }else{
          // i.replaceWith(selectClone);
          // comfirmResult = 0;
          location.reload();
        }
      });
  });
});
</script>