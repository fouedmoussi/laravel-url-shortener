@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Link-Shortener</div>
        <div class="panel-body">
          {{Form::open(array('url'=>'/','method'=>'post'))}}
          <div class="form-group {!! $errors->has('link') ? 'has-error' : '' !!}">
            {{Form::url('link','',array('placeholder'=>'Insert your Link here and press enter !','class' => 'form-control', 'required'))}}
            {!! $errors->first('link', '<small class="help-block">:message</small>') !!}
          </div>
          {{Form::close()}}

          @if(Session::has('hash'))
            <h3 class="success">
              Your short Link {{Html::link(Session::get('hash'),Session::get('hash'))}}
            </h3>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

