@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Add New Store
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
    
    <link href="{{ asset('assets/vendors/wizard/jquery-steps/css/wizard.css') }}" rel="stylesheet" >
    <link href="{{ asset('assets/vendors/wizard/jquery-steps/css/jquery.steps.css') }}" rel="stylesheet" >
    <link href="{{ asset('assets/vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}" type="text/css" rel="stylesheet">
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
                        <a href="{{ route('all-stores') }}">Stores</a>
                    </li>
                    <li class="active">Add New Store</li>
                </ol>
            </section>
            <!--section ends-->
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <i class="livicon" data-name="bell" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                                    Add New Store
                                </h3>
                                <span class="pull-right clickable">
                                    <i class="glyphicon glyphicon-chevron-up"></i>
                                </span>
                            </div>
                            <div class="panel-body">

                               <!-- errors -->
                                <div class="has-error">
                                    {!! $errors->first('first_name', '<span class="help-block">:message</span>') !!}
                                    {!! $errors->first('last_name', '<span class="help-block">:message</span>') !!}
                                    {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                                    {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                                    {!! $errors->first('password_confirm', '<span class="help-block">:message</span>') !!}
                                    {!! $errors->first('group', '<span class="help-block">:message</span>') !!}
                                    {!! $errors->first('pic', '<span class="help-block">:message</span>') !!}
                                </div>
                                <!--main content-->
                                <div class="row">

                                    <div class="col-md-12">
                                        <h3>Add New Store</h3>

                                        <!-- BEGIN FORM WIZARD WITH VALIDATION -->
{{--                                         <form id="wizard-validation" action="#"> --}}
                                         <form id="wizard-validation" action="{{ route('post-store-create') }}" method="post">
                                            {!! Form::token() !!}
                                            <h1 class="hidden-xs">Store Details</h1>
                                            <section>
                                                <h2 class="hidden">&nbsp;</h2>
                                                 <div class="form-group">
                                                    <label for="storeName">Store Name *</label>
                                                    <input type="text" class="form-control required" placeholder="Store Name" name="store_name" value="{{ Input::old('store_name') }}">
                                                </div>       
                                                <div class="form-group">
                                                    <label for="storeOwnerName">Store Owner Name *</label>
                                                    <input type="text" class="form-control required" placeholder="Store Owner Name" name="store_owner_name" value="{{ Input::old('store_owner_name') }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="storeAddress">Store Address *</label>
                                                    <textarea class="form-control required ship-frm-inp" type="textarea" id="store_address" name="store_address" placeholder="Store Address" maxlength="140" rows="4"> {{ Input::old('store_address') }} </textarea>
                                                </div> 
                                                    
                                               <div class="form-group">
                                                    <label for="storeCity">Store City *</label>
                                                    <input type="text" class="form-control required" placeholder="Store City" name="store_city" value="{{ Input::old('store_city') }}">
                                                </div>                   
                                                <div class="form-group">
                                                    <label for="storeState">Store State *</label>
                                                    <input type="text" class="form-control required" placeholder="Store State" name="store_state" value="{{ Input::old('store_state') }}">
                                                </div>
                                                 <p>(*) Mandatory</p>
                                                
                                                </section>
                                                <h1 class="hidden-xs">Store Details Continued</h1>
                                                <section>
                                                <div class="form-group">
                                                    <label for="storeCountry">Store Country *</label>
                                                    <p class="service-avl-txt"><strong>Country India (Service available only in India)</strong></p>
                                                </div>
                                                <div class="form-group">
                                                    <label for="storePincode">PinCode/ZipCode *</label>        
                                                    <input type="text" class="form-control required"  name="store_pincode" value="{{ Input::old('store_pincode') }}" data-role="tagsinput" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="primaryMobileNumber">Primary Mobile Number *</label>
                                                    <input type="text" class="form-control required" placeholder="Primary Mobile Number" name="primary_mobile_number" value="{{ Input::old('primary_mobile_number') }}">
                                                </div>  
                                                <div class="form-group">
                                                    <label for="alternateMobileNumber">Alternate Mobile Number *</label>
                                                    <input type="text" class="form-control" placeholder="Alternate Mobile Number" name="alternate_mobile_number" value="{{ Input::old('alternate_mobile_number') }}">
                                                </div>                    

                                                <div class="form-group">
                                                    <label for="storeEmailId">Store Email Id *</label>
                                                    <input type="text" class="form-control required email" placeholder="Store Email Address" name="store_email_id" value="{{ Input::old('store_email_id') }}">
                                                </div>
                                                <p>(*) Mandatory</p>
                                                </section>       
                                                <h1 class="hidden-xs">Store Admin Details</h1>

                                                <section>

                                                    <div class="form-group">
                                                        <label for="first_name" class="col-sm-2 control-label">First Name *</label>
                                                        <div class="col-sm-10">
                                                            <input id="first_name" name="first_name" type="text" placeholder="First Name" class="form-control required" value="{!! Input::old('first_name') !!}" />
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="last_name" class="col-sm-2 control-label">Last Name *</label>
                                                        <div class="col-sm-10">
                                                            <input id="last_name" name="last_name" type="text" placeholder="Last Name" class="form-control required" value="{!! Input::old('last_name') !!}" />
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="email" class="col-sm-2 control-label">Email *</label>
                                                        <div class="col-sm-10">
                                                            <input id="email" name="email" placeholder="E-Mail" type="text" class="form-control required email" value="{!! Input::old('email') !!}" />
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="password" class="col-sm-2 control-label">Password *</label>
                                                        <div class="col-sm-10">
                                                            <input id="password" name="password" type="password" placeholder="Password" class="form-control required" value="{!! Input::old('password') !!}" />
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="password_confirm" class="col-sm-2 control-label">Confirm Password *</label>
                                                        <div class="col-sm-10">
                                                            <input id="password_confirm" name="password_confirm" type="password" placeholder="Confirm Password " class="form-control required" value="{!! Input::old('password_confirm') !!}" />
                                                        </div>
                                                    </div>

                                                    <p>(*) Mandatory</p>

                                                </section>
                                        </form>
                                        <!-- END FORM WIZARD WITH VALIDATION --> </div>
                                </div>
                                <!--main content end--> </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- content --> 
    @stop

{{-- page level scripts --}}
@section('footer_scripts')
    
    <script src="{{ asset('assets/vendors/daterangepicker/moment.min.js') }}" ></script>
    <script src="{{ asset('assets/vendors/wizard/jquery-steps/js/jquery.steps.js') }}"  type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/wizard/jquery-steps/js/jquery.validate.min.js') }}"  type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}"  type="text/javascript"></script>
    <script src="{{ asset('assets/js/pages/form_wizard.js') }}"  type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/tags/dist/bootstrap-tagsinput.min.js') }}"  type="text/javascript"></script>
    
@stop