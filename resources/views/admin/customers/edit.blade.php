@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Edit Customer
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
                <h1>Edit Customer</h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{ route('dashboard') }}">
                            <i class="livicon" data-name="home" data-size="14" data-loop="true"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="#">Edit Customer </a>
                    </li>
                    <li class="active">Edit Customer </li>
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
                    Edit Customer
                </h3>
                <span class="pull-right">
            <i class="fa fa-fw fa-chevron-up clickable"></i>
        </span>
            </div>
            <div class="panel-body">
                @include('flash::message')
                @include('admin.list-form-errors')
                <form role="form" class="form-horizontal" action="{{ route('customers-update',$customer['id']) }}" method="post">
                    {!! Form::token() !!}
                    <div class="form-group">
                        <label class="col-md-2 control-label">Customer Name</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-addon">
                                </span>
                                <input type="text" class="form-control" placeholder="Customer Name" name="customer_name" value="{{ $customer['name'] }}">
                            </div>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-md-2 control-label">Customer Email </label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-addon">
                                </span>
                                <input type="text" class="form-control" placeholder="Customer Email" name="customer_email" value="{{ $customer['email'] }}" disabled>
                            </div>
                        </div>
                    </div>                    
                    <div class="form-group">
                        <label class="col-md-2 control-label">Customer Gender</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-addon">
                                </span>
                                <select class="form-control select2"  name ="gender">
                                    @if($customer['gender'] == NULL)
                                        <option value="" selected>select</option>
                                    @else
                                        <option value="">select</option>
                                    @endIf

                                    @if($customer['gender'] == 'male')
                                        <option value="male" selected>Male</option>
                                    @else
                                        <option value="male">Male</option>
                                    @endIf

                                    @if($customer['gender'] == 'female')
                                        <option value="female" selected>Female</option>
                                    @else
                                        <option value="female">Female</option>
                                    @endIf
                                </select>
                            </div>
                        </div>
                    </div>                      
                    <div class="form-group">
                        <label class="col-md-2 control-label">Account Status</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-addon">
                                </span>
                                <select class="form-control select2"  name ="account_status">
                                    @if($customer['account_status'] == 1)
                                        <option value="1" selected>Active</option>
                                    @else
                                        <option value="1">Active</option>
                                    @endIf

                                     @if($customer['account_status'] == 0)
                                        <option value="0" selected>Suspended</option>
                                    @else
                                        <option value="0">Suspended</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>                    
                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-2">
                            <input class="btn-success btn" type="submit" value="Edit Customer"></input>
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