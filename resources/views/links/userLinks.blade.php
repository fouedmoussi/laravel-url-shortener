@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">{{trans('links.myLinks')}}</div>
        <div class="panel-body">

        @if(Session::has('warning'))
        <div class="alert alert-warning" role="alert">
          <strong>{{trans('links.warning')}}</strong> {{trans('links.warningMsg')}}
        </div>
        @endif

        @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
          <strong>{{trans('links.success')}}</strong> {{trans('links.successMsg')}}
        </div>
        @endif
        @if($links->count())
          <table class="table">
            <thead>
              <tr >
                <th class="text-center">
                  <p>{{trans('links.link')}}</p>
                </th>
                <th class="text-center">
                  {{trans('links.hash')}}
                </th>
                <th class="text-center" >
                  {{trans('links.since')}}
                </th>
                <th class="text-center">
                  Action
                </th>
                
              </tr>
            </thead>
            <tbody>
              @foreach($links as $link)
              <tr>
                <td class="text-center">
                  <a title="{{$link->url}}" href="{{$link->url}}" style="border-bottom: 1px dashed #1E88E5;"> {{$link->url}}</a>
                </td>
                <td class="text-center">
                  <a title="{{$link->hash}}" href="{{$link->hash}}" style="border-bottom: 1px dashed #1E88E5;"> {{$link->hash}}</a>
                </td>
                <td  class="text-center">
                 {{$link->created_at->diffForHumans()}}
               </td>
               <td class="text-center" >
                {!! Form::open(['method' => 'DELETE', 'route' => ['delete-link', $link->id, 'lang='.app()->getLocale()]])!!}
                  {!! Form::submit(trans('links.delete'), ['class' => 'btn btn-danger btn-block', 'onclick' => 'return confirm("'.trans("links.deleteMsg").'")']) !!}
                {!! Form::close() !!}
                
              </td>

            </tr>
            @endforeach()
          </tbody>
        </table>
        @else
        <div class="alert alert-warning" role="alert">
          {{trans('links.noLinks')}} <a href="{{route('get-form', ['lang'=> app()->getLocale()])}}">{{trans('links.startShortening')}}</a>
        </div>
        @endif
      </div>
    </div>
  </div>
</div>
</div>
@endsection

