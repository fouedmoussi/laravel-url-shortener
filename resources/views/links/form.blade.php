@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">{{trans('links.shortify')}}</div>
        <div class="panel-body">
          {{Form::open(['route' => ['post-form', 'lang='.app()->getLocale()]])}}
          <div class="form-group {!! $errors->has('link') ? 'has-error' : '' !!}">
            {{Form::url('link','',array('placeholder'=>trans('links.insertYourLinkHere'),'class' => 'form-control', 'required'))}}
            {!! $errors->first('link', '<small class="help-block">:message</small>') !!}
          </div>
          {{Form::close()}}

          @if(Session::has('hash'))
            <h3 class="success">
              {{trans('links.yourShortLink')}} {{Html::link(Session::get('hash'),Session::get('hash'))}}
            </h3>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

