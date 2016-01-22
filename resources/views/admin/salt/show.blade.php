@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
 Salt Details
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
                <h1>Salt Details</h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{ route('dashboard') }}">
                            <i class="livicon" data-name="home" data-size="14" data-loop="true"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="#">Salts</a>
                    </li>
                    <li class="active">Salt Details</li>
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
                                    Salt Details
                                </h3>
                                <span class="pull-right">
                                    <i class="fa fa-fw fa-chevron-up clickable"></i>
                                </span>
                            </div>
                            <div class="panel-body border">

                                @if(!is_null($salt))
                                    <div class="form-horizontal form-bordered">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Salt Name</label>
                                            <div class="col-md-9">
                                                <p class="form-control-static">{{ $salt['salt_name']}}</p>
                                            </div>
                                        </div>
                                        @if(!$saltCategory->isEmpty())
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Salt Category</label>
                                                <div class="col-md-9">
                                                    <p class="form-control-static">{{ $saltCategory[0]->name }}</p>
                                                </div>
                                            </div>     
                                        @endif

                                        @if(!$saltScType->isEmpty())                                   
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Salt Schdule Type</label>
                                                <div class="col-md-9">
                                                    <p class="form-control-static">{{ $saltScType[0]->name }}</p>
                                                </div>
                                            </div>
                                        @endif
                                                                                
                                        <div class="form-group">
                                            <label class="col-md-3 control-label"> Salt Dose </label>
                                            <div class="col-md-9">
                                                <p class="form-control-static">{{ $salt['salt_dose']}}</p>
                                            </div>
                                        </div>                                        
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Salt Contraindications</label>
                                            <div class="col-md-9">
                                                <p class="form-control-static">{{ $salt['salt_contraindications']}}</p>
                                            </div>
                                        </div>                                        
                                        <div class="form-group">
                                            <label class="col-md-3 control-label"> Salt Precautions </label>
                                            <div class="col-md-9">
                                                <p class="form-control-static">{{ $salt['salt_precautions']}}</p>
                                            </div>
                                        </div>                                        
                                        <div class="form-group">
                                            <label class="col-md-3 control-label"> Salt Adverse Effects</label>
                                            <div class="col-md-9">
                                                <p class="form-control-static">{{ $salt['salt_adverse_effects']}}</p>
                                            </div>
                                        </div>         
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Salt Storage</label>
                                            <div class="col-md-9">
                                                <p class="form-control-static">{{ $salt['salt_storage']}}</p>
                                            </div>
                                        </div>                                            
                                    </div>
                                @else
                                    <div class="form-horizontal form-bordered">
                                        <div class="form-group">
                                            <div class="col-md-9">
                                                <p class="form-control-static text-center">No Salt Details Found</p>
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