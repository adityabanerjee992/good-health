@extends('app')

@section('content')


<section class="header-bottom"><hr></section>


<!-- ENTER ADDRESS -->
<section class="enter-address">
	<div class="container">
		@include('myaccounts.partials.submenu')    
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<h2 class="text-center myaccount-title">My Documents</h2>
                <!-- my account tabs -->
                <div class="myaccount-btns-gp">
				
				<ul>
					@if($type == 'prescription')
	                	<li><a href="{{ route('my-documents','prescription') }}" class="active">Prescriptions</a></li>
	                    <li><a href="{{ route('my-documents','medical-report') }}">Medical Reports</a></li>
	                @else
	                	<li><a href="{{ route('my-documents','prescription') }}">Prescriptions</a></li>
	                    <li><a href="{{ route('my-documents','medical-report') }}" class="active">Medical Reports</a></li>
	                @endIf
                </ul>   
                <br/>
                <ul class="couple-btn">
			        <div class="form-group">
			            <li><a href="#" class="up-new-presc bootstrap-modal-form-open" data-toggle="modal" data-target="#myModal">UPLOAD NEW</a></li>			            
			        </div>
			    </ul>

                </div><!-- end of myaccount-btns-gp -->
  				
                @if(!$documents->isEmpty())
                <br/>
                @include('flash::message')
				<table class="table table-hover table-responsive myaccount-doc">
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
								<a href="{{ route('edit-document',$document->id)}}"><img src="{{ url('images/edit2.png')}}" alt=""></a>
							 	<a href="#" onclick = "deleteDocument({{ $document->id }});"><img src="{{ url('images/del2.png')}}" alt=""></a>

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
				
			</div> <!-- /.col-md-12 -->

			  <!-- Modal -->
                        <div class="modal fade upload-prescription-popup" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Upload New Prescription</h4>
                              </div>
                              
                              {!! Form::open(array('url'=>'cart/upload-prescription','files'=>true,'method' => 'POST' ,'class' => 'bootstrap-modal-form' )) !!}

                              {{-- {!! Form::token() !!} --}}
                              
                              <div class="modal-body">
                                  <div class="form-group">
                                    <input type="text" name="patient_name" placeholder="Patient Name" required="required" class="form-control"/>
                                  </div>                
                                  <div class="form-group">
                                    <input type="text" name="document_name" placeholder="My Prescription Name For Eg: My Fever Prescription.." required="required" class="form-control"/>
                                  </div>
                                  <div class="form-group">
                                    <input type="date" name="prescription_date" placeholder="Prescription Date" class="form-control" />
                                  </div>
                                  <div class="form-group">
                                    <textarea name="notes" placeholder="Prescription Notes .. If Any" class="form-control"></textarea>
                                  </div>  
                                  <div class="form-group">
                                    <input type="file" name="prescription_file" placeholder="Prescription File" class="form-control" />
                                  </div>
                                  <div class="form-group">
                                    <strong>Disclaimer:</strong><br/>
                                    <input name="disclaimer" type="checkbox" class="checkout-txt" id="originality_checkbox">  I declare that the prescription that I am uploading is genuine and true to my knowledge</input>
                                  </div>                
                                  <div class="form-group text-center">  
                                     <input type="submit" name="" value="UPLOAD" class="transition-all btn btn-primary"/>
                                  </div>                                  
                              </div>
                              {!! Form::close() !!}
                            </div>
                          </div>
                        </div>

		</div> <!-- /.row -->
	</div> <!-- /.container -->
</section> <!-- /.enter-address -->

<script type="text/javascript">
    
    function deleteDocument(documentId){

        var dataString = 'document_id='+ documentId;

        $.ajax({
            type: "POST",
            url: "{{ route('post-delete-document') }}",
             headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
            data: dataString,
            cache: false,
            success: function(response)
            {
             	bootbox.alert(response.message, function() {
                    console.log("Alert Callback");
                   location.reload();
                });
       
             //    if(response.status != 0){
        	    //     location.reload();
   		        // }
            }
            });
    }
</script>

@stop