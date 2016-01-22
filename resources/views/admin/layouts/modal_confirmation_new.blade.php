<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
  <h4 class="modal-title" id="user_delete_confirm_title">{{ $modalTitle }}</h4>
</div>
<div class="modal-body">
    @if($error)
        <div>{!! $error !!}</div>
    @else
        {{ $modalBody }}
    @endif
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal"> Cancel </button>
  &nbsp;
  @if(!$error)
    {{-- <a href="{{ $confirm_route }}" type="button" class="btn btn-danger"> Delete </a> --}}
     {!! Form::open(array('url' => $confirm_route, 'class' => 'pull-right')) !!}
                    {!! Form::hidden('_method', 'DELETE') !!}
                    {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
                {!! Form::close() !!}
      
  @endif
</div>
