<br/>
<br/>
<div class="container">
    {!! Form::open(['route' => $route]) !!}

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            {!! Form::label('name',$name) !!}
            {!! Form::input('text','name', null, ['class' => 'form-control']) !!}
            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
        </div>	    

        <div class="form-group{{ $errors->has('label') ? ' has-error' : '' }}">
            {!! Form::label('label', $label) !!}
            {!! Form::input('text','label', null, ['class' => 'form-control']) !!}
            {!! $errors->first('label', '<p class="help-block">:message</p>') !!}
        </div>       
        
        <div class="form-group">
            {!! Form::input('submit','submit', null, ['class' => 'form-control']) !!}
        </div>	    

    {!! Form::close() !!}
</div>