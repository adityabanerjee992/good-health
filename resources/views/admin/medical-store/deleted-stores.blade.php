@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Deleted Stores
@parent
@stop

{{-- page level styles --}}
@section('header_styles')    
    
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/extensions/bootstrap/dataTables.bootstrap.css') }}" />
    <link href="{{ asset('assets/css/pages/tables.css') }}" rel="stylesheet" type="text/css" />
    <!-- end page css -->
@stop

{{-- Page content --}}
@section('content')

<section class="content-header">
                <h1>Deleted Stores</h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{ route('dashboard') }}">
                            <i class="livicon" data-name="home" data-size="14" data-color="#000"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>Stores</li>
                    <li class="active">Deleted Stores</li>
                </ol>
            </section>
            <!-- Main content -->
         <section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <i class="livicon" data-name="stores-remove" data-size="18" data-c="#ffffff" data-hc="#ffffff"></i>
                    Deleted Stores List
                </h4>
            </div>
            <div class="panel-body">
                @include('flash::message')
                <table class="table table-bordered" id="table">
                    <thead>
                        <tr class="filters">
                            <th>ID</th>
                            <th>Store Name</th>
                            <th>Store Owner Name</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stores as $store)
                            <tr>
                                <td>{!! $store->id !!}</td>
                                <td>{!! $store->name !!}</td>
                                <td>{!! $store->owner_name !!}</td>
                                <td>{!! $store->created_at->diffForHumans() !!}</td>
                                <td>{!! $store->updated_at->diffForHumans() !!}</td>
                                <td>
                                <a href="{{ route('restore-store', $store->id) }}"><i class="livicon" data-name="store-flag" data-c="#6CC66C" data-hc="#6CC66C" data-size="18"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>           
                </table>
            </div>
        </div>
    </div>
</section>

        
    @stop

{{-- page level scripts --}}
@section("footer_scripts")
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/dataTables.bootstrap.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#table').DataTable();
        });
    </script>
@stop