@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    All Products
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/extensions/bootstrap/dataTables.bootstrap.css') }}" />
<link href="{{ asset('assets/css/pages/tables.css') }}" rel="stylesheet" type="text/css" />
@stop


{{-- Page content --}}
@section('content')
<section class="content-header">
    <h1>Products</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}">
                <i class="livicon" data-name="home" data-size="14" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>Products</li>
        <li class="active">Products</li>
    </ol>
</section>

<!-- Main content -->
<section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-primary ">
            <div class="panel-heading">
                <h4 class="panel-title"> <i class="livicon" data-name="user" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    All Products
                </h4>
            </div>
            <br />
            <div class="panel-body">
                @include('flash::message')
                <table class="table table-bordered " id="table">
                    <thead>
                        <tr class="filters">
                            <th>ID</th>
                            <th>Product Code</th>
                            <th>Product Name</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
{{--                     <tbody>
                    @foreach ($products as $product)
                    	<tr>
                            <td>{!! $product->id !!}</td>
                    		<td>{!! $product->product_code !!}</td>
            				<td>{!! $product->product_name !!}</td>
            				<td>{!! $product->created_at->diffForHumans() !!}</td>
            				<td>
                                <a href="{{ route('product-show', $product->id) }}"><i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="view user"></i></a>

                                <a href="{{ route('product-edit', $product->id) }}"><i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="update user"></i></a>

                            @if(\App\OrderDetails::checkIfProductExist($product->id) == false)
                                    <a href="{{ route('confirm-delete-product', $product->id) }}" data-toggle="modal" data-target="#delete_confirm"><i class="livicon" data-name="product-remove" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete product"></i></a>
                            @endif                                
                            </td>
            			</tr>
                    @endforeach
                        
                    </tbody> --}}
                </table>
            </div>
        </div>
    </div>    <!-- row-->
</section>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
<script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/vendors/datatables/extensions/bootstrap/dataTables.bootstrap.js') }}"></script>

<script>
$(document).ready(function() {
	$('#table').DataTable({
          "processing": true,
        "serverSide": true,
        "ajax": '{{ route("all-products-ajax") }}',
         "columns": [
            {data: 'id', name: 'id'},
            {data: 'product_code', name: 'product_code'},
            {data: 'product_name', name: 'product_name'},
            {data: 'created_at', name: 'created_at'},
            {data: 'actions', name: 'actions'}
        ]   
    });
});
</script>

<div class="modal fade" id="delete_confirm" tabindex="-1" role="dialog" aria-labelledby="user_delete_confirm_title" aria-hidden="true">
	<div class="modal-dialog">
    	<div class="modal-content"></div>
  </div>
</div>
<script>
$(function () {
	$('body').on('hidden.bs.modal', '.modal', function () {
		$(this).removeData('bs.modal');
	});
});
</script>
@stop