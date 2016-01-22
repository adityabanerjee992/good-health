@extends('app')

@section('content')


<section class="header-bottom"><hr></section>

<!-- ENTER ADDRESS -->
<section class="enter-address">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<h2 class="text-center myaccount-title">Choose Prescription</h2>

				@if(!$documents->isEmpty())
				<table class="table table-responsive myaccount-doc">
					<thead class="my-account-thead">
						<tr>
							<th>Patient Name</th>
							<th>Upload Date</th>
							<th>Prescription Date</th>
							<th class="">Document Name</th>
							<th class="">Notes</th>
							<th class="text-center">&nbsp;&nbsp;</th>
						</tr> <!-- /tr -->
					</thead> <!-- /thead -->

					<tbody>

						@foreach($documents as $document)
						<tr>
							<td class="">{{ $document->patient_name }}</td> <!-- /td -->
							<td>{{ date("F jS, Y",strtotime($document->created_at)) }}</td>
							<td>{{ date("F jS, Y",strtotime($document->prescription_date)) }}</td>
							<td class=""><a href="{{ route('get-document',$document->id) }}" target="_blank">{{ $document->document_name }}</a></td> <!-- /td -->
							<td style=""><p>{{ $document->document_notes }}</p></td> <!-- /td -->

							<td style="text-align: center; vertical-align: middle;" >
								{{-- <a href="#"><img src="{{ url('images/edit2.png')}}" alt=""></a>
								<a href="#"><img src="{{ url('images/del2.png')}}" alt=""></a> --}}

								<a href="{{ route('link-prescription-to-order',$document->id) }}"><button class="checkout-btn"> Continue </button></a>
							</td> <!-- /td -->

						</tr> <!-- /tr -->


						@endForeach



					</tbody> <!-- /tbody -->
				</table> <!-- /.table -->
				@else
				<br/>
				<br/>
				<p class="alert alert-info text-center"> No Documents As of Now .. </p>
				@endIf
				{!! $documents->render()!!}
			</div> <!-- /.col-md-12 -->
		</div> <!-- /.row -->
	</div> <!-- /.container -->
</section> <!-- /.enter-address -->

@stop