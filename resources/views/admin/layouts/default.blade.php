<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>
        @section('title')
        | Good Health Admin Panel
        @show
    </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <!-- global css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- font Awesome -->
    <link href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/styles/black.css') }}" rel="stylesheet" type="text/css" id="colorscheme" />
    <link href="{{ asset('assets/css/panel.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/metisMenu.css') }}" rel="stylesheet" type="text/css"/>

    <!-- end of global css -->
    <!--page level css-->
    @yield('header_styles')
    <!--end of page level css-->
</head>

<body class="skin-josh">
    <header class="header">
        <a href="{{ route('dashboard') }}" class="logo">
            <img src="{{ asset('assets/img/logo.png') }}" alt="logo" width="200">
        </a>
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <div>
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <div class="responsive_nav"></div>
                </a>
            </div>
            <div class="navbar-right">
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            @if(Sentinel::getUser()->pic)
                                <img src="{!! url('/').'/uploads/users/'.Sentinel::getUser()->pic !!}" alt="img" class="img-circle img-responsive pull-left" height="35px" width="35px"/>
                            @else
                                <img src="{!! asset('assets/img/authors/avatar3.jpg') !!} " width="35" class="img-circle img-responsive pull-left" height="35" alt="riot">
                            @endif
                            <div class="riot">
                                <div>
                                    {{ Sentinel::getUser()->first_name }} {{ Sentinel::getUser()->last_name }}
                                    <span>
                                        <i class="caret"></i>
                                    </span>
                                </div>
                            </div>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header bg-light-blue">
                                @if(Sentinel::getUser()->pic)
                                    <img src="{!! url('/').'/uploads/users/'.Sentinel::getUser()->pic !!}" alt="img" class="img-circle img-bor"/>
                                @else
                                    <img src="{!! asset('assets/img/authors/avatar3.jpg') !!}" class="img-responsive img-circle" alt="User Image">
                                @endif
                                <p class="topprofiletext">{{ Sentinel::getUser()->first_name }} {{ Sentinel::getUser()->last_name }}</p>
                            </li>
                            <!-- Menu Body -->
                            <li>
                                <a href="#">
                                    <i class="livicon" data-name="user" data-s="18"></i>
                                    My Profile
                                </a>
                            </li>
                            <li role="presentation"></li>
                   {{--          <li>
                                <a href="#">
                                    <i class="livicon" data-name="gears" data-s="18"></i>
                                    Account Settings
                                </a>
                            </li> --}}
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                   {{--  <a href="{{ URL::to('admin/lockscreen') }}">
                                        <i class="livicon" data-name="lock" data-s="18"></i>
                                        Lock
                                    </a> --}}
                                </div>
                                <div class="pull-right">
                                    <a href="{{ URL::to('admin/logout') }}">
                                        <i class="livicon" data-name="sign-out" data-s="18"></i>
                                        Logout
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <div class="wrapper row-offcanvas row-offcanvas-left">
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="left-side sidebar-offcanvas">
            <section class="sidebar ">
                <div class="page-sidebar  sidebar-nav">
                    <div class="nav_icons">
                        {{-- <ul class="sidebar_threeicons">
                            <li>
                                <a href="{{ URL::to('admin/form_builder') }}">
                                    <i class="livicon" data-name="hammer" title="Form Builder 1" data-loop="true" data-color="#42aaca" data-hc="#42aaca" data-s="25"></i>
                                </a>
                            </li>
                            <li>
                                <a href="{{ URL::to('admin/form_builder2') }}">
                                    <i class="livicon" data-name="list-ul" title="Form Builder 2" data-loop="true" data-color="#e9573f" data-hc="#e9573f" data-s="25"></i>
                                </a>
                            </li>
                            <li>
                                <a href="{{ URL::to('admin/form_builder2') }}">
                                    <i class="livicon" data-name="vector-square" title="Button Builder" data-loop="true" data-color="#f6bb42" data-hc="#f6bb42" data-s="25"></i>
                                </a>
                            </li>
                            <li>
                                <a href="{{ URL::to('admin/gridmanager') }}">
                                    <i class="livicon" data-name="new-window" title="Form Builder 1" data-loop="true" data-color="#37bc9b" data-hc="#37bc9b" data-s="25"></i>
                                </a>
                            </li>
                        </ul> --}}
                    </div>
                    <div class="clearfix"></div>
                    <!-- BEGIN SIDEBAR MENU -->
                    <ul id="menu" class="page-sidebar-menu">
                    @if (Sentinel::getUser()->hasAnyAccess(['dashboard']))
                        <li {!! (Request::is('admin') ? 'class="active"' : '') !!}>
                            <a href="{{ route('dashboard') }}">
                                <i class="livicon" data-name="home" data-size="18" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i>
                                <span class="title">Dashboard</span>
                            </a>
                        </li>
                    @endif
                        
                        @if (Sentinel::getUser()->hasAnyAccess(['group.view','group.create','group.edit','group.delete','group.restore']))
                            <li {!! (Request::is('admin/groups') || Request::is('admin/groups/create') || Request::is('admin/groups/*') ? 'class="active"' : '') !!}>
                                @if (Sentinel::getUser()->hasAnyAccess(['group.view']))
                                <a href="#">
                                    <i class="livicon" data-name="users" data-size="18" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i>
                                    <span class="title">Groups</span>
                                    <span class="fa arrow"></span>
                                </a>
                                @endif
                                <ul class="sub-menu">
                                    @if (Sentinel::getUser()->hasAnyAccess(['group.view']))
                                    <li>
                                        <a href="{{ URL::to('admin/groups') }}">
                                            <i class="fa fa-angle-double-right"></i>
                                            Groups
                                        </a>
                                    </li>
                                    @endif
                                     @if (Sentinel::getUser()->hasAccess('group.create'))
                                        <li {!! (Request::is('admin/groups/create') ? 'class="active" id="active"' : '') !!}>
                                            <a href="{{ URL::to('admin/groups/create') }}">
                                                <i class="fa fa-angle-double-right"></i>
                                                Add New Group
                                            </a>
                                        </li>
                                    @endIf
                                </ul>
                            </li>
                        @endIf         
                        @if (Sentinel::getUser()->hasAnyAccess(['users','create/user','users.update','delete/user','restore/user','users.show','deleted_users']))
                            <li {!! (Request::is('admin/users') || Request::is('admin/users/create') || Request::is('admin/users/*') || Request::is('admin/deleted_users') ? 'class="active"' : '') !!}>

                             @if(Sentinel::getUser()->hasAccess('users'))
                                <a href="#">
                                    <i class="livicon" data-name="user" data-size="18" data-c="#6CC66C  " data-hc="#6CC66C" data-loop="true"></i>
                                    <span class="title">Users</span>
                                    <span class="fa arrow"></span>
                                </a>
                             @endif
                                
                                <ul class="sub-menu">
                                @if(Sentinel::getUser()->hasAccess('users'))
                                    <li {!! (Request::is('admin/users') ? 'class="active" id="active"' : '') !!}>
                                        <a href="{{ URL::to('admin/users') }}">
                                            <i class="fa fa-angle-double-right"></i>
                                            Users
                                        </a>
                                    </li>
                                 @endif
  
                                @if(Sentinel::getUser()->hasAccess('create/user'))
                                    <li {!! (Request::is('admin/users/create') ? 'class="active" id="active"' : '') !!}>
                                        <a href="{{ URL::to('admin/users/create') }}">
                                            <i class="fa fa-angle-double-right"></i>
                                            Add New User
                                        </a>
                                    </li>
                                @endif
                                @if(Sentinel::getUser()->hasAccess('deleted_users'))
                                    <li {!! (Request::is('admin/deleted_users') ? 'class="active" id="active"' : '') !!}>
                                        <a href="{{ URL::to('admin/deleted_users') }}">
                                            <i class="fa fa-angle-double-right"></i>
                                            Deleted Users
                                        </a>
                                    </li>
                                @endif
                                </ul>
                            </li>   
                         @endif
                      @if (Sentinel::getUser()->hasAnyAccess(['customers','customers-edit','delete/customer','customers-show','deleted-customers','restore/customer']))
                        <li {!! (Request::is('admin/customers') || Request::is('admin/customers/create') || Request::is('admin/customers/*') || Request::is('admin/deleted-customers') ? 'class="active"' : '') !!}>
                            <a href="#">
                                <i class="livicon" data-name="user" data-size="18" data-c="#6CC66C" data-hc="#6CC66C" data-loop="true"></i>
                                <span class="title">Customers</span>
                                <span class="fa arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li {!! (Request::is('admin/customers') ? 'class="active" id="active"' : '') !!}>
                                    <a href="{{ URL::to('admin/customers') }}">
                                        <i class="fa fa-angle-double-right"></i>
                                        Customers
                                    </a>
                                </li>
                                <li {!! (Request::is('admin/deleted-customers') ? 'class="active" id="active"' : '') !!}>
                                    <a href="{{ URL::to('admin/deleted-customers') }}">
                                        <i class="fa fa-angle-double-right"></i>
                                        Deleted Customers
                                    </a>
                                </li>
                            </ul>
                        </li>       
                        @endif         

                        @if (Sentinel::getUser()->hasAnyAccess(['orders','orders.askForPrescription','orders.rejectOrder','get-update-order-status','orders.update','orders.show']))    
                        <li {!! (Request::is('admin/orders') || Request::is('admin/orders/create') || Request::is('admin/orders/*') || Request::is('admin/deleted_orders') ? 'class="active"' : '') !!}>
                            <a href="#">
                                <i class="livicon" data-name="shopping-cart" data-size="18" data-c="#6CC66C" data-hc="#6CC66C" data-loop="true"></i>
                                <span class="title">Orders</span>
                                <span class="fa arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li {!! (Request::is('admin/orders') ? 'class="activse" id="active"' : '') !!}>
                                    <a href="{{ URL::to('admin/orders') }}">
                                        <i class="fa fa-angle-double-right"></i>
                                        Orders
                                    </a>
                                </li>   
 {{--                                <li {!! (Request::is('/admin') ? 'class="activse" id="active"' : '') !!}>
                                    <a href="{{ URL::to('admin/check-order-status') }}">
                                        <i class="fa fa-angle-double-right"></i>
                                        Check Order Status
                                    </a>
                                </li> --}}
                            </ul>
                        </li>           
                        @endif

                        @if (Sentinel::getUser()->hasAnyAccess(['all-products','bulk-upload','product-create','product-show','product-edit','delete-product']))    

                        <li {!! (Request::is('admin/products') || Request::is('admin/products/bulk-upload') || Request::is('admin/products/create') || Request::is('admin/products/*') ? 'class="active"' : '') !!}>
                            <a href="#">
                                <i class="livicon" data-name="user" data-size="18" data-c="#6CC66C" data-hc="#6CC66C" data-loop="true"></i>
                                <span class="title">Product Management</span>
                                <span class="fa arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li {!! (Request::is('admin/products') ? 'class="active" id="active"' : '') !!}>
                                    <a href="{{ URL::to('admin/products') }}">
                                        <i class="fa fa-angle-double-right"></i>
                                        All Products 
                                    </a>
                                </li>
                                <li {!! (Request::is('admin/products/bulk-upload') ? 'class="active" id="active"' : '') !!}>
                                    <a href="{{ URL::to('admin/products/bulk-upload') }}">
                                        <i class="fa fa-angle-double-right"></i>
                                        Bulk Import 
                                    </a>
                                </li>
                                <li {!! (Request::is('admin/products/create') ? 'class="active" id="active"' : '') !!}>
                                    <a href="{{ URL::to('admin/products/create') }}">
                                        <i class="fa fa-angle-double-right"></i>
                                         Add New Product
                                    </a>
                                </li>
                            </ul>                            
                        </li> 
                        @endif

                        @if (Sentinel::getUser()->hasAnyAccess(['all-salts','salt-bulk-upload','salt-create','salt-show','salt-edit','delete-salt']))    
                        <li {!! (Request::is('admin/salts') || Request::is('admin/salts/bulk-upload') || Request::is('admin/salts/create') || Request::is('admin/salts/*') ? 'class="active"' : '') !!}>
                            <a href="#">
                                <i class="livicon" data-name="user" data-size="18" data-c="#6CC66C" data-hc="#6CC66C" data-loop="true"></i>
                                <span class="title">Salt Management </span>
                                <span class="fa arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li {!! (Request::is('admin/salts') ? 'class="active" id="active"' : '') !!}>
                                    <a href="{{ URL::to('admin/salts') }}">
                                        <i class="fa fa-angle-double-right"></i>
                                        All Salts 
                                    </a>
                                </li>
                                <li {!! (Request::is('admin/salts/bulk-upload') ? 'class="active" id="active"' : '') !!}>
                                    <a href="{{ URL::to('admin/salts/bulk-upload') }}">
                                        <i class="fa fa-angle-double-right"></i>
                                        Bulk Import
                                    </a>
                                </li>
                                <li {!! (Request::is('admin/salts/create') ? 'class="active" id="active"' : '') !!}>
                                    <a href="{{ URL::to('admin/salts/create') }}">
                                        <i class="fa fa-angle-double-right"></i>
                                         Add New Salt
                                    </a>
                                </li>
                            </ul>                            
                        </li>  
                        @endif

                         @if (Sentinel::getUser()->hasAnyAccess(['all-stores','create-new-store','store-show','store-edit','delete-store','deleted-stores','restore-store']))    
                        <li {!! (Request::is('admin/stores') || Request::is('admin/stores/create')|| Request::is('admin/stores/show/*')|| Request::is('admin/stores/deleted-stores') || Request::is('admin/stores/*') ? 'class="active"' : '') !!}>
                            <a href="#">
                                <i class="livicon" data-name="user" data-size="18" data-c="#6CC66C" data-hc="#6CC66C" data-loop="true"></i>
                                <span class="title">Store Management </span>
                                <span class="fa arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li {!! (Request::is('admin/stores') ? 'class="active" id="active"' : '') !!}>
                                    <a href="{{ URL::to('admin/stores/') }}">
                                        <i class="fa fa-angle-double-right"></i>
                                         All Stores
                                    </a>
                                </li>
                                <li {!! (Request::is('admin/stores/create') ? 'class="active" id="active"' : '') !!}>
                                    <a href="{{ URL::to('admin/stores/create') }}">
                                        <i class="fa fa-angle-double-right"></i>
                                         Add New Store
                                    </a>
                                </li> 
                                <li {!! (Request::is('admin/stores/deleted-stores') ? 'class="active" id="active"' : '') !!}>
                                    <a href="{{ URL::to('admin/stores/deleted-stores') }}">
                                        <i class="fa fa-angle-double-right"></i>
                                        Deleted Stores
                                    </a>
                                </li>
                            </ul>                            
                        </li>
                        @endif

                        @if (Sentinel::getUser()->hasAnyAccess(['cache-flush'])) 
                            <li {!! Request::is('admin/cache-flush') !!} >
                                <a href="#">
                                    <i class="livicon" data-name="user" data-size="18" data-c="#6CC66C" data-hc="#6CC66C" data-loop="true"></i>
                                    <span class="title">Cache Management</span>
                                    <span class="fa arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li {!! (Request::is('admin/cache-flush') ? 'class="active" id="active"' : '') !!}>
                                        <a href="{{ URL::to('admin/cache-flush') }}">
                                            <i class="fa fa-angle-double-right"></i>
                                            Flush Cache 
                                        </a>
                                    </li>
                                </ul>                            
                            </li>
                        @endif
                        <!-- Menus generated by CRUD generator -->
                        @include('admin/layouts/menu')
                    </ul>
                    <!-- END SIDEBAR MENU -->
                </div>
            </section>
        </aside>
        <aside class="right-side">
            
            <!-- Notifications -->
            @include('notifications')
            
            <!-- Content -->
            @yield('content')

        </aside>
        <!-- right-side -->
    </div>
    <a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" title="Return to top" data-toggle="tooltip" data-placement="left">
        <i class="livicon" data-name="plane-up" data-size="18" data-loop="true" data-c="#fff" data-hc="white"></i>
    </a>
    <!-- global js -->
    <script src="{{ asset('assets/js/jquery-1.11.1.min.js') }}" type="text/javascript"></script>
    @if (Request::is('admin/form_builder2') || Request::is('admin/gridmanager') || Request::is('admin/portlet_draggable') || Request::is('admin/calendar'))
        <script src="{{ asset('assets/vendors/form_builder1/js/jquery.ui.min.js') }}"></script>
    @endif
    <script src="{{ asset('assets/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <!--livicons-->
    <script src="{{ asset('assets/vendors/livicons/minified/raphael-min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/livicons/minified/livicons-1.4.min.js') }}" type="text/javascript"></script>
   <script src="{{ asset('assets/js/josh.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/metisMenu.js') }}" type="text/javascript"> </script>
    <script src="{{ asset('assets/vendors/holder-master/holder.js') }}" type="text/javascript"></script>
    <!-- end of global js -->
    <!-- begin page level js -->
    @yield('footer_scripts')
    <!-- end page level js -->
</body>
</html>
