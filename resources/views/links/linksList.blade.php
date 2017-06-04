@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">All links</div>
        <div class="panel-body">
        @if(Session::has('success'))
        <div class="alert alert-success" role="alert">Success</div>
        @endif
        @if($links->count())
          <table class="table table-responsive">
            <thead>
              <tr >
                <th class="text-center" width="30%">
                  Link
                </th>
                <th class="text-center" width="20%">
                  Hash
                </th>
                <th class="text-center" width="20%">
                  Created by
                </th>

                <th class="text-center" width="30%">
                  Since
                </th>
              </tr>
            </thead>
            <tbody>
              @foreach($links as $link)
              <tr>
                <td width="30%" class="text-center">
                  <a title="{{$link->url}}" href="{{$link->url}}" style="border-bottom: 1px dashed #1E88E5;"> {{$link->url}}</a>
                </td>
                <td width="20%" class="text-center">
                  <a title="{{$link->hash}}" href="{{$link->hash}}" style="border-bottom: 1px dashed #1E88E5;"> {{$link->hash}}</a>
                </td>

                <th class="text-center" width="20%">
                  {{$link->user->name}}
                </th>

                <td width="30%" class="text-center">
                 {{$link->created_at->diffForHumans()}}
               </td>
            </tr>
            @endforeach()
          </tbody>
        </table>
        <div class="pull-right">
          {!! $pagination !!}
        </div>

        @else
        <div class="alert alert-warning" role="alert">
          No links found.
          Try one 
        </div>
        @endif
      </div>
    </div>
  </div>
</div>
</div>
@endsection

