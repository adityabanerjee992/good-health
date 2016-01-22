@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Edit Product
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <link href="{{ asset('assets/css/pages/form_layouts.css') }}" rel="stylesheet" type="text/css"/>
@stop

{{-- Page content --}}
@section('content')

<section class="content-header">
                <!--section starts-->
                <h1>Edit Product</h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{ route('dashboard') }}">
                            <i class="livicon" data-name="home" data-size="14" data-loop="true"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="#">Edit Product </a>
                    </li>
                    <li class="active">Edit Product </li>
                </ol>
            </section>
            <!--section ends-->
            <section class="content">

<div class="row">
    <div class="col-md-12">

        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="livicon" data-name="doc-portrait" data-c="#fff" data-hc="#fff" data-size="18" data-loop="true"></i>
                    Edit Product
                </h3>
                <span class="pull-right">
            <i class="fa fa-fw fa-chevron-up clickable"></i>
        </span>
            </div>
            <div class="panel-body">
                @include('flash::message')
                @include('admin.list-form-errors')
                <form role="form" class="form-horizontal" action="{{ route('post-product-edit',$productData['id']) }}" method="post">
                    {!! Form::token() !!}
                    <div class="form-group">
                        <label class="col-md-2 control-label">Product Code</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-addon">
                                </span>
                                <input type="text" class="form-control" placeholder="Product Code" name="sku" value="{{ $productData['product_code'] }}">
                            </div>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-md-2 control-label">Product Name</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-addon">
                                </span>
                                <input type="text" class="form-control" placeholder="Product Name" name="product_name" value="{{ $productData['product_name'] }}">
                            </div>
                        </div>
                    </div>                    
                    <div class="form-group">
                        <label class="col-md-2 control-label">Product MRP</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-addon">
                                </span>
                                <input type="text" class="form-control" placeholder="Product MRP" name="mrp" value="{{ $productData['product_mrp'] }}">
                            </div>
                        </div>
                    </div>                                 
                    <div class="form-group">
                        <label class="col-md-2 control-label">Product Tax (%)</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-addon">
                                </span>
                                <input type="text" class="form-control" placeholder="Product Tax" name="tax" value="{{ $productData['product_tax'] }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Product Company</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-addon">
                                </span>
                                <input type="text" class="form-control" placeholder="Product Company" name="company" value="{{ $productData['company'] }}">
                            </div>
                        </div>
                    </div>                    
                    <div class="form-group">
                        <label class="col-md-2 control-label">Product Category</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-addon">
                                </span>
                                <input type="text" class="form-control" placeholder="Product Category" name="category" value="{{ $productData['categories'] }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Product Salts</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-addon">
                                </span>
                                <input type="text" class="form-control" placeholder="Seprate multiple salts with + " name="salt" value="{{ $productData['salts'] }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Product Packing</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-addon">
                                </span>
                                <input type="text" class="form-control" placeholder="Product Packing" name="packing" value="{{ $productData['packing'] }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Product Unit</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-addon">
                                </span>
                                <input type="text" class="form-control" placeholder="Product Unit" name="unit" value="{{ $productData['unit'] }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Is Prescription Drug ? </label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-addon">
                                </span>

                                <select class="form-control" name="prescription_drug">
                                    @if($productData['is_prescription_drug'] == 'YES')
                                        <option value="YES" selected> Yes </option>
                                        <option value="NO"> No </option>
                                    @else
                                        <option value="YES"> Yes </option>
                                        <option value="NO" selected> No </option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Product Ailments</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-addon">
                                </span>
                                <input type="text" class="form-control" placeholder="Product Ailment" name="ailment" value="{{ $productData['ailments'] }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Product Classass</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-addon">
                                </span>
                                <input type="text" class="form-control" placeholder="Product Class" name="class" value="{{ $productData['classes'] }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-2">
                            <input class="btn-success btn" type="submit" value="Edit Product"></input>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
            </section>
            <!-- content --> 
    @stop

{{-- page level scripts --}}
@section('footer_scripts')

@stream_context_get_options(stream_or_context)