@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Add New Product
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
                <h1>Add New Product</h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{ route('dashboard') }}">
                            <i class="livicon" data-name="home" data-size="14" data-loop="true"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="#">Add New Product </a>
                    </li>
                    <li class="active">Add New Product </li>
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
                    Add New Product
                </h3>
                <span class="pull-right">
            <i class="fa fa-fw fa-chevron-up clickable"></i>
        </span>
            </div>
            <div class="panel-body">
                @include('flash::message')
                @include('admin.list-form-errors')
                <form role="form" class="form-horizontal" action="{{ route('post-product-create') }}" method="post">
                    {!! Form::token() !!}
                    <div class="form-group">
                        <label class="col-md-2 control-label">Product Code Or SKU</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-addon">
                                </span>
                                <input type="text" class="form-control" placeholder="Enter Product Code" name="sku" value="{{ Input::old('product_code') }}">
                            </div>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-md-2 control-label">Product Name</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-addon">
                                </span>
                                <input type="text" class="form-control" placeholder="Enter Product Name" name="product_name" value="{{ Input::old('product_name') }}">
                            </div>
                        </div>
                    </div>                    
                    <div class="form-group">
                        <label class="col-md-2 control-label">Product MRP</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-addon">
                                </span>
                                <input type="text" class="form-control" placeholder="Product MRP" name="mrp" value="{{ Input::old('mrp') }}">
                            </div>
                        </div>
                    </div>                                 
                    <div class="form-group">
                        <label class="col-md-2 control-label">Product Tax (%)</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-addon">
                                </span>
                                <input type="text" class="form-control" placeholder="Product Tax" name="tax" value="{{ Input::old('tax') }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Product Company</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-addon">
                                </span>
                                <input type="text" class="form-control" placeholder="Product Company" name="company" value="{{ Input::old('company') }}">
                            </div>
                        </div>
                    </div>                    
                    <div class="form-group">
                        <label class="col-md-2 control-label">Product Formation Type</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-addon">
                                </span>
                                <input type="text" class="form-control" placeholder="Product Formation Type" name="category" value="{{ Input::old('category') }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Product Salts</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-addon">
                                </span>
                                <input type="text" class="form-control" placeholder="Seprate multiple salts with + " name="salt" value="{{ Input::old('salt') }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Product Packing</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-addon">
                                </span>
                                <input type="text" class="form-control" placeholder="Product Packing" name="packing" value="{{ Input::old('packing') }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Product Unit</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-addon">
                                </span>
                                <input type="text" class="form-control" placeholder="Product Unit" name="unit" value="{{ Input::old('unit') }}">
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
                                    <option value="YES" selected> Yes </option>
                                    <option value="NO"> No </option>
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
                                <input type="text" class="form-control" placeholder="Product Ailment" name="ailment" value="{{ Input::old('ailment') }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Product Class</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-addon">
                                </span>
                                <input type="text" class="form-control" placeholder="Product Class" name="class" value="{{ Input::old('class') }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-2">
                            <input class="btn-success btn" type="submit" value="Add New Product"></input>
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

@stop