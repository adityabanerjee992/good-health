@extends('admin/layouts/default')


{{-- Page title --}}
@section('title')
 Product Details
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
                <h1>Product Details</h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{ route('dashboard') }}">
                            <i class="livicon" data-name="home" data-size="14" data-loop="true"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="#">Products</a>
                    </li>
                    <li class="active">Product Details</li>
                </ol>
            </section>
            <!--section ends-->
            <section class="content">
                <div class="row">
                     <div class="col-lg-12">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <i class="livicon" data-name="bell" data-loop="true" data-color="#fff" data-hovercolor="#fff" data-size="18"></i>
                                    Product Details
                                </h3>
                                <span class="pull-right">
                                    <i class="fa fa-fw fa-chevron-up clickable"></i>
                                </span>
                            </div>
                            <div class="panel-body border">
                                @if(!is_null($productDetails))
                                    <div class="form-horizontal form-bordered">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Product Code</label>
                                            <div class="col-md-9">
                                                <p class="form-control-static">{{ $productDetails['product_code']}}</p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Product Name</label>
                                            <div class="col-md-9">
                                                <p class="form-control-static">{{ $productDetails['product_name']}}</p>
                                            </div>
                                        </div>                                        
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Product Salts</label>
                                            <div class="col-md-9">
                                                <p class="form-control-static">{{ $productDetails['salts']}}</p>
                                            </div>
                                        </div>                                        
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Product Categories</label>
                                            <div class="col-md-9">
                                                <p class="form-control-static">{{ $productDetails['categories']}}</p>
                                            </div>
                                        </div>                                        
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Product Packing</label>
                                            <div class="col-md-9">
                                                <p class="form-control-static">{{ $productDetails['packing']}}</p>
                                            </div>
                                        </div>                                                                           
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Product Company</label>
                                            <div class="col-md-9">
                                                <p class="form-control-static">{{ $productDetails['company']}}</p>
                                            </div>
                                        </div>         
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Ailments</label>
                                            <div class="col-md-9">
                                                <p class="form-control-static">{{ $productDetails['ailments']}}</p>
                                            </div>
                                        </div>                                            
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Class</label>
                                            <div class="col-md-9">
                                                <p class="form-control-static">{{ $productDetails['classes']}}</p>
                                            </div>
                                        </div>              
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Prescription Drug </label>
                                            <div class="col-md-9">
                                                <p class="form-control-static">{{ $productDetails['is_prescription_drug']}}</p>
                                            </div>
                                        </div>                                        
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Product Mrp</label>
                                            <div class="col-md-9">
                                                <p class="form-control-static"> Rs . {{ $productDetails['product_mrp']}}</p>
                                            </div>
                                        </div>                                        
                                    </div>
                                @else
                                    <div class="form-horizontal form-bordered">
                                        <div class="form-group">
                                            <div class="col-md-9">
                                                <p class="form-control-static text-center">No Product Details Found</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
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