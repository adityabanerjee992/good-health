@extends('app')

@section('content')     
<section class="container-1022 main-container">
	<div class="order-success container-725">
		<img src="{{ url('images/thank-you.png') }}" class="img-responsive" title="Order Success" alt="Order Success" />
		<h1> Order Placed Successfully .. Your Order Is Under Review .. </h1>
		<p>Thank you for placing the order.</p>
		<a href="{{ route('home') }}" class="transition-all btn-style1">back to home</a>
	</div>
</section>
@endSection


