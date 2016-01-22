@extends('app')

@section('content')

<!-- PAGE BREADCRUMB -->
<section class="page-breadcrumb">
  <div class="container">
   <div class="row">
    
   </div> <!-- /.row -->
 </div> <!-- /.container -->
</section> <!-- /.page-breadcrumb -->

<section class="upload2presc">
  <div class="container">
   <div class="row">
    @include('flash::message')
    <br/>
    @include('admin.list-form-errors')

    {!! Form::open(array('url'=>route("post-edit-document",$document->id),'files'=>true,'method' => 'POST')) !!}

    {!! Form::token() !!}
    {!! Form::hidden('back_url' , \Redirect::back()->getTargetUrl()) !!}
    {!! Form::hidden('isRequestFromOrderDetailsPage' , $isRequestFromOrderDetailsPage) !!}
    
    <div class="modal-body">
      <div class="form-group">
        <input type="text" name="patient_name" placeholder="Patient Name" required="required" class="form-control" value="{{ $document->patient_name}}" />
      </div>                
      <div class="form-group">
        <input type="text" name="document_name" placeholder="Document Name" required="required" class="form-control" value="{{ $document->document_name}}"/>
      </div>
      <div class="form-group">
        <input type="date" name="prescription_date" placeholder="Prescription Date" class="form-control" value="{{ $document->prescription_date}}"/>
      </div>
      <div class="form-group">
        <textarea name="notes" placeholder="Prescription Notes .. If Any" class="form-control">{{ $document->document_notes}}</textarea>
      </div>                
      <div class="form-group">
        <input type="file" name="prescription_file" placeholder="Prescription File" class="form-control" />
      </div>
      <div class="form-group text-center">  
       <input type="submit" name="" value="UPLOAD" class="transition-all btn btn-primary"/>
     </div>                                  
   </div>
   {!! Form::close() !!}
 </div>
</div>                                     
</div> <!-- /.container -->
</section> <!-- /.upload2presc -->

@stop

@include('partials.scripts')
{{-- <script src="{{ url('js/laravel-bootstrap-modal-form.js') }}"></script> --}}
