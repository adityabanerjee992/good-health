<div class="body-top"></div>

<!-- HEADER -->
<nav class="header-area navbar navbar-default">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand site-logo" href="{{ url('') }}"><img src="{{ url('images/logo.png') }}"/></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse main-menu" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right main-nav">

                <li class="user-welcome">Hi @if(Auth::check()) {{ Auth::user()->name }} @else Guest @endIf</li>

                 @if(Auth::check())
                    <li><a href="{{ route('my-documents','prescription') }}">My Account</a></li>
                    <li><a href="{{ url('auth/logout') }}"> Logout </a></li>
                 @else
<!--                    <li><a href="javascript:void(0);" data-toggle="modal" data-target="#loginModal">Sign In</a></li>
                    <li class=""><a href="javascript:void(0);" data-toggle="modal" data-target="#registerModal">Register</a></li>-->
                    <li><a href="{{ url('auth/login') }}">Sign In</a></li>
                    <li class=""><a href="{{ url('auth/register') }}">Register</a></li>
                 @endIf
                <li class="dropdown">
                    {{-- <a href="#" data-toggle="dropdown" class="dropdown-toggle">Tools+</a> --}}
<!--                     <span class="caret"></span>
                        <ul class="dropdown-menu my-dropdown">
                            <li><a href="#">About</a></li>
                            <li><a href="#">History</a></li>
                            <li><a href="#">About</a></li>
                            <li><a href="#">History</a></li>
                            <li><a href="#">About</a></li>
                            <li><a href="#">History</a></li>
                        </ul>-->
                </li>   
                <li class="shopping-bag gh-shop-button"><a href="{{ url('cart') }}"><img src="{{ url('images/shopping-bag.png') }}" alt="Shopping Bag" class="shp-bag"><span>
                {{ (session()->has('cart_count'))? session()->get('cart_count') : 0 }}
                </span></a></li>
            </ul>
        </div> <!-- /.navbar-collapse -->
    </div> <!-- /.container-fluid -->
</nav> <!-- /.navbar -->

<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


 
