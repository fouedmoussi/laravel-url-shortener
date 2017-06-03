@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">My links</div>
        <div class="panel-body">
          <table class="table table-responsive">
            <thead>
              <tr >
                <th class="text-center" width="40%">
                  Link
                </th>
                <th class="text-center" width="30%">
                  Hash
                </th>
                <th class="text-center" width="20%">
                  Since
                </th>
                <th class="text-center" width="10%">
                  Action
                </th>
                
              </tr>
            </thead>
            <tbody>
              @foreach($links as $link)
              <tr>
                <td width="40%">
                  {{$link->url}}
                </td>
                <td width="30%">
                  {{$link->hash}}
                </td>
                <td width="20%">
                 {{$link->created_at->diffForHumans()}}
               </td>
               <td width="10%">
                {!! Form::open(['method' => 'DELETE', 'url' => ['link', $link->id]]) !!}
                  {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-block', 'onclick' => 'return confirm(\'Vraiment supprimer ce lien ?\')']) !!}
                {!! Form::close() !!}
              </td>

            </tr>
            @endforeach()
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</div>
@endsection

