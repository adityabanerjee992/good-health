@extends('app')

@section('content')

<!-- ORDER FORM -->
<section class="order-form">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<h2 class="order-form-title text-center"> {{ $saltName }}</h2>
				<h3 class="order-form-sub-title text-center">AVAILABLE MEDICINE</h3>

				@if(!$products->isEmpty())
				<table class="table table-responsive table-bordered salt-dtls-table my-table">
					<tr>
						<th>Medicine</th>
						<th>Company</th>
						{{-- <th>Variant</th> --}}
						<th>Packs</th>
						{{-- <th>Substitutes</th> --}}
						<th>Quantity</th>
						<th>MRP</th>
						<th class="">Order</th>
					</tr>

					<tbody>

						@foreach($products as $product)
						<tr>
							<td>
								<p><img src="{{ url('images/small-drug.png') }}" alt="Small Drugs" class="small-drug">{{ $product['product_name'] }} </p>
							</td>
							<td><p>{{ $product['manufacturer'] }}</p></td>
							{{-- <td>
								<select class="form-control">
									<option>10MG</option>
									<option>10MG</option>
									<option>10MG</option>
									<option>10MG</option>
								</select>
							</td> --}}
							<td><p> {{ $product['packing'] }} </p></td>
							{{-- <td class="clsp tbl-view"><p>Collapse -</p></td> --}}
							<td>
								<select class="form-control">
									@foreach(range(1,100) as $number)
										<option value="{{ $number }}"> {{$number}} {{ $product['unit'] }}(s)</option>		
									@endForeach
								</select>
							</td>
							<td><p>Rs. {{ $product['product_mrp'] }}</p></td>
							<td><a href="{{ route('cart-add-product', $product['id'])}}"><button class="buy-button">Buy Now</button></a></td>
						</tr> <!-- /tr -->
						@endForeach
						{{-- <tr class="tbl-txt-tr tbl-data">
							<td></td>
							<td></td>
							<td></td>
							<td><p class="collapse out sub-histeze" id="collapseme" >Substitutes for Histeeze1</p></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr> --}}

					</tbody> <!-- /tbody -->
				</table> <!-- /.table -->
				@else
					<p class="text-center alert alert-warning">No Medinces Available . Consider Going To <a href="{{ url('') }}">Home Page</a> and find something else..</p>

				@endIf
			</div> <!-- /.col-md-12 -->
		</div> <!-- /.row -->
	</div> <!-- /.container -->
</section> <!-- /.order-form -->


@endSection