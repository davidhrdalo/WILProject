@extends('layouts.master')

@section('title')
  {{$partner->name}}
@endsection

@section('content')
<div class="container">
  <div class="row" id="main">
    <div class="col-sm-1"></div>
      <div class="col-sm-10">
        <div class="row align-items-center" id="heading" style="text-align:center;">
          <div class="col-sm-12"><h3>Industry Partner</h3></div>
        </div>
        <div class="row align-items-center" id="content">
          <div class="col-sm-12"><h3>Partner Details</h3></div>
          <div class="col-sm-12">{{$partner->name}}</div>
          <div class="col-sm-12">{{$partner->email}}</div>

          @if(auth()->check() && auth()->user()->type == 'Teacher')
          <div class="col-sm-12">
          @if(!is_null($user_partner) && !is_null($user_partner->approved))
          @include('forms.form-user-partner-edit')
          @else
          @include('forms.form-user-partner-detail')
          @endif
          </div>
          @endif

        </div>
        <div class="row align-items-center" id="content">
          @auth
            @if(auth()->user()->id == $partner->id && auth()->user()->type == 'Partner')
              <div class="col-sm-12"><a href="{{ url('project/create') }}">Create a New Project<hr><br></a></div>
            @endif
          @endauth

          <div class="col-sm-12"><h4>Projects on Offer by {{$partner->name}}</h4></div>

            @forelse ($projects as $project)
              <div class="col-sm-12"><a href="{{ url('project/' . $project->id) }}"><hr>{{$project->title}}</a></div>
            @empty
              <div class="col-sm-12"><hr>No projects on offer</div>
          @endforelse
        </div>
      </div>
    </div>
  </div>
</div>
@endsection