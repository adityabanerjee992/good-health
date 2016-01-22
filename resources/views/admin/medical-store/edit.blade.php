@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
   Edit Store
@parent
@stop


{{-- page level styles --}}
@section('header_styles')
    <link href="{{ asset('assets/css/pages/form_layouts.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('assets/vendors/tags/dist/bootstrap-tagsinput.css') }}" />
@stop


{{-- Page content --}}
@section('content')

<section class="content-header">
                <!--section starts-->
                <h1>Add New Store</h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{ route('dashboard') }}">
                            <i class="livicon" data-name="home" data-size="14" data-loop="true"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="#">Add New Store </a>
                    </li>
                    <li class="active">Add New Store </li>
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
                   Edit Store
                </h3>
                <span class="pull-right">
            <i class="fa fa-fw fa-chevron-up clickable"></i>
        </span>
            </div>
            <div class="panel-body">
                @include('flash::message')
                @include('admin.list-form-errors')
                {!! Form::open(array('route' => array('store-update', $store->id), 'method' => 'PUT','role'=>'form','class'=>'form-horizontal')) !!}
                    {!! Form::token() !!}
                    <div class="form-group">
                        <label class="col-md-2 control-label">Store Name</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-addon">
                                </span>
                                <input type="text" class="form-control" placeholder="Store Name" name="store_name" value="{{ $store->name }}">
                            </div>
                        </div>
                    </div>                       
                    <div class="form-group">
                        <label class="col-md-2 control-label">Store Owner Name</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-addon">
                                </span>
                                <input type="text" class="form-control" placeholder="Store Owner Name" name="store_owner_name" value="{{ $store->owner_name }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Store Address</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-addon">
                                </span>
                                <textarea class="form-control ship-frm-inp" type="textarea" id="store_address" name="store_address" placeholder="Store Address" maxlength="140" rows="4"> {{ $store->address }} </textarea>
                            </div>
                        </div>
                    </div>               
        
                   <div class="form-group">
                        <label class="col-md-2 control-label">Store City</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-addon">
                                </span>
                                <input type="text" class="form-control" placeholder="Store City" name="store_city" value="{{ $store->city }}">
                            </div>
                        </div>
                    </div>                   
                    <div class="form-group">
                        <label class="col-md-2 control-label">Store State</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-addon">
                                </span>
                                <input type="text" class="form-control" placeholder="Store State" name="store_state" value="{{ $store->state }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Store Country</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <p class="service-avl-txt"><strong>Country India (Service available only in India)</strong></p>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">PinCode/ZipCode</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="PinCode/ZipCode" name="store_pincode" data-role="tagsinput" value="{{ $pincodes }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Primary Mobile Number</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-addon">
                                </span>
                                <input type="text" class="form-control" placeholder="Primary Mobile Number" name="primary_mobile_number" value="{{ $store->primary_mobile_number }}">
                            </div>
                        </div>
                    </div>  
                    <div class="form-group">
                        <label class="col-md-2 control-label">Alternate Mobile Number</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-addon">
                                </span>
                                <input type="text" class="form-control" placeholder="Alternate Mobile Number" name="alternate_mobile_number" value="{{ $store->lternate_mobile_number }}">
                            </div>
                        </div>
                    </div>                    

                    <div class="form-group">
                        <label class="col-md-2 control-label">Store Email Id</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-addon">
                                </span>
                                <input type="text" class="form-control" placeholder="Store Email Address" name="store_email_id" value="{{ $store->email }}">
                            </div>
                        </div>
                    </div>
        
                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-2">
                            <input class="btn-success btn" type="submit" value="Update Store"></input>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
            </section>
            <!-- content --> 
    @stop

{{-- page level scripts --}}
@section('footer_scripts')
    <script src="{{ asset('assets/vendors/tags/dist/bootstrap-tagsinput.min.js') }}"  type="text/javascript"></script>
@stop