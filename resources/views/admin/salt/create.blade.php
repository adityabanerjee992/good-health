@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Add New Salt
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
                <h1>Add New Salt</h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{ route('dashboard') }}">
                            <i class="livicon" data-name="home" data-size="14" data-loop="true"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="#">Add New Salt </a>
                    </li>
                    <li class="active">Add New Salt </li>
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
                    Add New Salt
                </h3>
                <span class="pull-right">
            <i class="fa fa-fw fa-chevron-up clickable"></i>
        </span>
            </div>
            <div class="panel-body">
                @include('flash::message')
                @include('admin.list-form-errors')
                <form role="form" class="form-horizontal" action="{{ route('post-salt-create') }}" method="post">
                    {!! Form::token() !!}
                    <div class="form-group">
                        <label class="col-md-2 control-label">Salt Name</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-addon">
                                </span>
                                <input type="text" class="form-control" placeholder="Salt Name" name="salt_name" value="{{ Input::old('salt_name') }}">
                            </div>
                        </div>
                    </div>               
                    <div class="form-group">
                        <label class="col-md-2 control-label">Salt Category Name</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-addon">
                                </span>
                                <input type="text" class="form-control" placeholder="Salt Category Name" name="category" value="{{ Input::old('category') }}">
                            </div>
                        </div>
                    </div>                    
                    <div class="form-group">
                        <label class="col-md-2 control-label">Salt Schedule Type</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-addon">
                                </span>
                                <input type="text" class="form-control" placeholder="Salt Schedule Type" name="schedule" value="{{ Input::old('schedule') }}">
                            </div>
                        </div>
                    </div>               
                    <div class="form-group">
                        <label class="col-md-2 control-label">Salt Indications</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-addon">
                                </span>
                                <textarea  class="form-control" placeholder="Salt Indications" name="indications">
                                    {{ Input::old('indications') }}
                                </textarea>
                            </div>
                        </div>
                    </div>                         
                    <div class="form-group">
                        <label class="col-md-2 control-label">Salt Dose</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-addon">
                                </span>
                                <textarea  class="form-control" placeholder="Salt Dose" name="dose" >
                                    {{ Input::old('dose') }}
                                </textarea>
                            </div>
                        </div>
                    </div>                         
                    <div class="form-group">
                        <label class="col-md-2 control-label">Salt Contraindications</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-addon">
                                </span>
                                <textarea  class="form-control" placeholder="Salt Contraindications" name="contraindications" >
                                    {{ Input::old('contraindications') }}
                                </textarea>
                            </div>
                        </div>
                    </div>   
                    <div class="form-group">
                        <label class="col-md-2 control-label">Salt Precautions</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-addon">
                                </span>
                                <textarea  class="form-control" placeholder="Salt Precautions" name="precautions" >
                                    {{ Input::old('precautions') }}
                                </textarea>
                            </div>
                        </div>
                    </div>                         
                    <div class="form-group">
                        <label class="col-md-2 control-label">Salt Adverse Effects</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-addon">
                                </span>
                                <textarea  class="form-control" placeholder="Salt Adverse Effects" name="adverse_effects">
                                    {{ Input::old('adverse_effects') }}
                                </textarea>
                            </div>
                        </div>
                    </div>                      
                    <div class="form-group">
                        <label class="col-md-2 control-label">Salt Storage</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-addon">
                                </span>
                                <textarea  class="form-control" placeholder="Salt Storage" name="storage" >
                                    {{ Input::old('storage') }}
                                </textarea>
                            </div>
                        </div>
                    </div>                    
                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-2">
                            <input class="btn-success btn" type="submit" value="Add New Salt"></input>
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