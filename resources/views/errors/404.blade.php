@extends('app')

@section('content')      
<section class="container-1022 main-container">
  <div class="error-404 container-725">
    <h1>404</h1>
    <p><span>oops!</span> Something goes wrong</p>
    <a href="{{ route('home') }}" class="transition-all btn-style1">back to home</a>
  </div>
</section>
@stop