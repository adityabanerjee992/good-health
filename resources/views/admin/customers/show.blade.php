@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
 Customer Details
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
                <h1>Customer Details</h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{ route('dashboard') }}">
                            <i class="livicon" data-name="home" data-size="14" data-loop="true"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="#">Customers</a>
                    </li>
                    <li class="active">Customer Details</li>
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
                                    Customer Details
                                </h3>
                                <span class="pull-right">
                                    <i class="fa fa-fw fa-chevron-up clickable"></i>
                                </span>
                            </div>
                            <div class="panel-body border">
                                @if(!is_null($customer))
                                    <div class="form-horizontal form-bordered">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Customer Name</label>
                                            <div class="col-md-9">
                                                <p class="form-control-static">{{ $customer['name']}}</p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Customer Email</label>
                                            <div class="col-md-9">
                                                <p class="form-control-static">{{ $customer['email']}}</p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Customer gender</label>
                                            <div class="col-md-9">
                                                 @if($customer['gender'] != NULL) 
                                                    <p class="form-control-static">{{ $customer['email'] }}</p>
                                                @else
                                                    <p class="form-control-static"> No Gender Specified </p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Account Status </label>
                                            <div class="col-md-9">
                                                 @if($customer['account_status'] == 1) 
                                                    <p class="form-control-static text-success"> Active </p>
                                                @else
                                                    <p class="form-control-static text-danger"> Suspended </p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Created At</label>
                                            <div class="col-md-9">
                                                <p class="form-control-static">{{ $customer['created_at']->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Updated At</label>
                                            <div class="col-md-9">
                                                <p class="form-control-static">{{ $customer['updated_at']->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                       
                                    </div>
                                @else
                                    <div class="form-horizontal form-bordered">
                                        <div class="form-group">
                                            <div class="col-md-9">
                                                <p class="form-control-static text-center">No Customer Details Found</p>
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