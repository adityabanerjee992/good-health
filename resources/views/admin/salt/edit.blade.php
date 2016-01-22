@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Edit Salt
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
                <h1>Edit Salt</h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{ route('dashboard') }}">
                            <i class="livicon" data-name="home" data-size="14" data-loop="true"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="#">Edit Salt </a>
                    </li>
                    <li class="active">Edit Salt </li>
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
                    Edit Salt
                </h3>
                <span class="pull-right">
            <i class="fa fa-fw fa-chevron-up clickable"></i>
        </span>
            </div>
            <div class="panel-body">
                @include('flash::message')
                @include('admin.list-form-errors')
                
                <form role="form" class="form-horizontal" action="{{ route('post-salt-edit') }}" method="post">
                    {!! Form::token() !!}
                    <div class="form-group">
                        <label class="col-md-2 control-label">Salt Name</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-addon">
                                </span>
                                <input type="text" class="form-control" placeholder="Salt Name" name="salt_name" value="{{ $salt['salt_name'] }}">
                            </div>
                        </div>
                    </div>               
                    <div class="form-group">
                        <label class="col-md-2 control-label">Salt Category Name</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-addon">
                                </span>
                                <input type="text" class="form-control" placeholder="Salt Category Name" name="category" value="{{ $saltCategory[0]->category }}">
                            </div>
                        </div>
                    </div>                    
                    <div class="form-group">
                        <label class="col-md-2 control-label">Salt Schedule Type</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-addon">
                                </span>
                                <input type="text" class="form-control" placeholder="Salt Schedule Type" name="schedule" value="{{ $saltSchedule[0]->schedule }}">
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
                                    {{ $salt['indications'] }}
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
                                    {{ $salt['dose'] }}
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
                                    {{ $salt['contraindications'] }}
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
                                    {{ $salt['precautions'] }}
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
                                    {{ $salt['adverse_effects'] }}
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
                                    {{ $salt['storage'] }}
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