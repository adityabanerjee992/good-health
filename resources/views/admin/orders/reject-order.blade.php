@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Order Rejection Reason 
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
    <h1>Order Rejection Reason</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}">
                <i class="livicon" data-name="home" data-size="14" data-loop="true"></i>
                Dashboard
            </a>
        </li>
        <li>
            <a href="{{ route('orders') }}">Orders </a>
        </li>
        <li class="active">Order Rejection Reason </li>
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
                        Order Rejection Reason 
                    </h3>
                    <span class="pull-right">
                        <i class="fa fa-fw fa-chevron-up clickable"></i>
                    </span>
                </div>
                <div class="panel-body">
                    @include('flash::message')
                    @include('admin.list-form-errors')
                    <form role="form" class="form-horizontal" action="{{ route('post-reject-order') }}" method="post">
                        {!! Form::token() !!}
                        {!! Form::hidden('order_id',$orderId) !!}
                        <div class="form-group">
                            <label class="col-md-2 control-label">Rejection Reason</label>
                            <div class="col-md-8">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                    </span>
                                    <textarea class="form-control" placeholder="Give Your Order Rejection Reason" name="rejection_reason">{{ Input::old('order_rejection_reason') }}</textarea>
                                </div>
                            </div>
                        </div>                    

                        <div class="form-group">
                            <div class="col-sm-8 col-sm-offset-2">
                                <input class="btn-success btn" type="submit" value="Reject Order"></input>
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