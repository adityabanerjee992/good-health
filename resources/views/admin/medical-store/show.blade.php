@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
 Store Details
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
                <h1>Store Details</h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{ route('dashboard') }}">
                            <i class="livicon" data-name="home" data-size="14" data-loop="true"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="#">Stores</a>
                    </li>
                    <li class="active">Store Details</li>
                </ol>
            </section>
            <!--section ends-->
            <section class="content">
                @include('flash::message')
                <div class="row">
                     <div class="col-lg-12">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <i class="livicon" data-name="bell" data-loop="true" data-color="#fff" data-hovercolor="#fff" data-size="18"></i>
                                    Store Details
                                </h3>
                                <span class="pull-right">
                                    <i class="fa fa-fw fa-chevron-up clickable"></i>
                                </span>
                            </div>
                            <div class="panel-body border">
                                @if(!is_null($store))
                                    <div class="form-horizontal form-bordered">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Store Name</label>
                                            <div class="col-md-9">
                                                <p class="form-control-static">{{ $store['name']}}</p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Stpre Owner Name</label>
                                            <div class="col-md-9">
                                                <p class="form-control-static">{{ $store['owner_name']}}</p>
                                            </div>
                                        </div>                                        
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Store Address</label>
                                            <div class="col-md-9">
                                                <p class="form-control-static">{{ $store['address']}}</p>
                                            </div>
                                        </div>                                        
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Store City</label>
                                            <div class="col-md-9">
                                                <p class="form-control-static">{{ $store['city']}}</p>
                                            </div>
                                        </div>                                        
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Store State</label>
                                            <div class="col-md-9">
                                                <p class="form-control-static">{{ $store['state']}}</p>
                                            </div>
                                        </div>                                                                           
   
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Store Pincode/Zipcode</label>
                                            <div class="col-md-9">
                                                <p class="form-control-static">{{ $pincodes }}</p>
                                            </div>
                                        </div>                                            
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Primary Mobile Number</label>
                                            <div class="col-md-9">
                                                <p class="form-control-static">{{ $store['primary_mobile_number']}}</p>
                                            </div>
                                        </div>              
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">ALtername Mobile Number </label>
                                            <div class="col-md-9">
                                                <p class="form-control-static">{{ $store['alternate_mobile_number']}}</p>
                                            </div>
                                        </div>                                        
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Store Email Id</label>
                                            <div class="col-md-9">
                                                <p class="form-control-static"> {{ $store['email']}}</p>
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