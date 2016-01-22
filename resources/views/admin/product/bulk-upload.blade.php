@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Form Examples
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
    
    <link href="{{ asset('assets/vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet" />
    
@stop

{{-- Page content --}}
@section('content')

<section class="content-header">
                <!--section starts-->
                <h1>Form Examples</h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{ route('dashboard') }}">
                            <i class="livicon" data-name="home" data-size="14" data-loop="true"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="#">Forms</a>
                    </li>
                    <li class="active">Form Examples</li>
                </ol>
            </section>
            <!--section ends-->
            <section class="content">
                <!--main content-->
                <div class="row">
                    <!--row starts-->
                    <div class="col-md-12">
                        <!--lg-6 starts-->
                        <!--basic form starts-->
                        <div class="panel panel-primary" id="hidepanel1">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <i class="livicon" data-name="clock" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                                    Product Bulk Upload Form.. 
                                </h3>
                                <span class="pull-right">
                                    <i class="glyphicon glyphicon-chevron-up clickable"></i>
                                    <i class="glyphicon glyphicon-remove removepanel clickable"></i>
                                </span>
                            </div>
                            <div class="panel-body">
                                @include('admin.list-form-errors')
                                @include("flash::message")
                                <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                                    {!! Form::token() !!}
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="name">File Upload</label>
                                            <div class="col-md-9">
                                                <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                                    <div class="form-control" data-trigger="fileinput">
                                                        <i class="glyphicon glyphicon-file fileinput-exists"></i>
                                                        <span class="fileinput-filename"></span>
                                                    </div>
                                                    <span class="input-group-addon btn btn-default btn-file">
                                                        <span class="fileinput-new">Select file</span>
                                                        <span class="fileinput-exists">Change</span>
                                                        <input type="file" name="product_file"></span>
                                                    <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                                </div>
                                                <span class="text-danger"> <strong>* Max File Size : 10 MB <br/>* Max Rows In File should Not Exceed 5000 Rows </strong></span>
                                            </div>
                                        </div>
                                        <!-- Form actions -->
                                        <div class="form-group">
                                            <div class="col-md-12 text-right">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--md-6 ends-->
                </div>
                <!--main content ends--> </section>
            <!-- content --> 
    @stop

{{-- page level scripts --}}
@section('footer_scripts')
    
    <script src="{{ asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}" ></script>
    
@stop