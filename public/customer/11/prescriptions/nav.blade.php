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
                <li class=""><a href="#">Hi @if(Auth::check()) {{ Auth::user()->name }} @else Guest @endIf</a></li>
                 @if(Auth::check() == False)
                     <li><a href="#" data-toggle="modal" data-target=".bs-modal-sm" class="active">Sign In</a></li>
                     <li class=""><a href="#">Register</a></li>
                 @endIf
                <li class="dropdown">
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle">Tools+ <span class="caret"></span></a>
                        <ul class="dropdown-menu my-dropdown">
                            <li><a href="#">About</a></li>
                            <li><a href="#">History</a></li>
                            <li><a href="#">About</a></li>
                            <li><a href="#">History</a></li>
                            <li><a href="#">About</a></li>
                            <li><a href="#">History</a></li>
                        </ul>
                </li>
                <li class="shopping-bag gh-shop-button"><a href="{{ url('cart') }}"><img src="{{ url('images/shopping-bag.png') }}" alt="Shopping Bag" class="shp-bag"><span>10</span></a></li>
            </ul>
        </div> <!-- /.navbar-collapse -->
    </div> <!-- /.container-fluid -->
</nav> <!-- /.navbar -->

<section class="header-bottom"><hr></section>
