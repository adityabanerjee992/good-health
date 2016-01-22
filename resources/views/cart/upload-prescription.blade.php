@extends('app')

@section('content')
        <!-- \eckout Steps -->
        <div class="container-1022 checkout-steps-outer">
            <div class="checkout-steps">
                <div class="checkout-steps-text">
                    <div class="step1 active pull-left">
                        1. UPLOAD PRESCRIPTION
                    </div>
                    <div class="step2">
                        2. ENTER ADDRESS
                    </div>
                    <div class="step3 pull-right">
                        3. ORDER SUMMARY
                    </div>
                </div>
                <div class="checkout-steps-design">
                    <div class="steps-design-dots active text-left">
                        <div class="steps-bar"></div>
                    </div>
                    <div class="steps-design-dots">
                        <div class="steps-bar"></div>
                    </div>
                    <div class="steps-design-dots text-right">
                        <div class="steps-bar"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Checkout Steps -->
	<!-- UPLOAD 2 PRESCRIPTION -->
	<section class="upload2presc">
		<div class="container">
			<div class="row">
				@include('flash::message')
				<div class="col-md-12 col-sm-12 col-xs-12">
<!--					<h2 class="text-center up2presc-title">2. UPLOAD PRESCRIPTION</h2>-->
<!--					<p class="text-center up2presc-sub-title">2 ITEM(S)</p>-->
<div class="prescrition1">
   <p class="text-center some-medi">Some medicines in your cart require a prescription.<br/>
					Please upload a prescription image in order for us to process your order.</p>

					@if($drugsName != NULL)

						@foreach($drugsName as $name)

							<p class="text-center k-carb">{{ $name }}</p>

						@endForeach
					@endIf
 
</div>
					
			{{-- 		<ul class="couple-btn">

						{!! Form::open(array('url'=>'cart/upload-prescription','files'=>true,'method' => 'POST')) !!}
						<div class="form-group">

						{!! Form::label('file','Upload Prescription',array('id'=>'','class'=>'')) !!}
						{!! Form::file('prescription_file') !!}
						{!! Form::submit('UPLOAD PRESCRIPTIONS',array('class' =>'up-new-presc')) !!}
						</div>
						{!! Form::close() !!}

						 
                                                  --}}
                                                 
                                                 
					</ul>
    <ul class="couple-btn">
        <div class="form-group">
            <li><a href="#" class="up-new-presc bootstrap-modal-form-open" data-toggle="modal" data-target="#myModal">UPLOAD NEW</a></li>
            
            <li><a href="{{ route('choose-prescription') }}" class="email-presc savedpresc">Click here to select saved</a></li>
<!--            <li><a href="{{ url('cart/address')}}" class="up-new-presc">Continue</a></li> -->
        </div>
    </ul>
  
				</div> <!-- /.col-md-12 -->
			</div> <!-- /.row -->
                        
                        
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
                                    <input type="text" id="datepicker" name="prescription_date">
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

                      {{--   <div class="transition-all saved-prescriptions saved-prescriptions-hide">  
                            <div class="saved-presc">hgweiohwgeiogvewifgew</div>
                            <div class="saved-presc">hgweiohwgeiogvewifgew</div>
                            <div class="saved-presc">hgweiohwgeiogvewifgew</div>
                            <div class="saved-presc">hgweiohwgeiogvewifgew</div>
                            <div class="saved-presc">hgweiohwgeiogvewifgew</div>
                        </div> --}}
                        
                        
		</div> <!-- /.container -->
	</section> <!-- /.upload2presc -->
            
@stop

@section('scripts')
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

    <script>
    $(function() {
      $( "#datepicker" ).datepicker({  maxDate: new Date });
    });
    </script>
    <style>
        .ui-datepicker .ui-datepicker-title{
            line-height: 1em;
        }
        .ui-datepicker td span, .ui-datepicker td a {
          text-align: center;
          padding: 2px;
      }
      .ui-datepicker th{
          font-weight: normal;
          font-size: 14px;
      }
      .ui-widget-header{
          font-weight: normal;
          font-size: 13px;
      }
      .ui-datepicker .ui-datepicker-prev, .ui-datepicker .ui-datepicker-next {
          height: 1em;
      }
      .ui-datepicker .ui-datepicker-prev-hover, .ui-datepicker .ui-datepicker-next-hover{
          border: none;
          background: none;
      }
      .ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default {
          background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
      }
      
    </style>
@stop