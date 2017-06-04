@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">{{trans('links.allLinks')}}</div>
        <div class="panel-body">
        @if($links->count())
          <table class="table table-responsive">
            <thead>
              <tr >
                <th class="text-center">
                  {{trans('links.link')}}
                </th>
                <th class="text-center">
                  {{trans('links.hash')}}
                </th>
                <th class="text-center">
                  {{trans('links.createdBy')}}
                </th>

                <th class="text-center">
                  {{trans('links.since')}}
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

                <th class="text-center">
                  {{$link->user->name}}
                </th>

                <td class="text-center">
                 {{$link->created_at->diffForHumans()}}
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

