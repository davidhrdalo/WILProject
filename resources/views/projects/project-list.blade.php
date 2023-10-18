@extends('layouts.master')

@section('title')
  Open Projects
@endsection

@section('content')
<div class="container">
  <div class="row" id="main">
      <div class="col-sm-1"></div>
      <div class="col-sm-10">
      @if(session('message'))
      <div class="col-sm-12" id="heading">
        <div class="alert error-message" style="color: black !important;">{{ session('message') }}</div>
        </div>
      @endif
      @if(session('error'))
        <div class="col-sm-12" id="heading">
          <div class="alert error-message">{{ session('error') }}</div>
        </div>
      @endif
        <div class="col-sm-12 align-items-center" id="heading" style="text-align:center;">
            <h3><br>Open Projects<br></h3><hr>
            <p>Below are the current open projects for Griffith University Work Integrated Learning.</p>
          </div>

          @forelse($projects as $year => $offeringGroups)
            @foreach($offeringGroups as $offering => $projectGroup)
              <div class="col-sm-12" id="heading">
                <h2>{{ $year }} - Trimester: {{ $offering }}</h2>

                @auth
                  @if(auth()->user()->type == 'Teacher')
                    @include('forms.form-assign')
                      @if(session('error'))
                        <div class="alert error-message">{{ session('error') }}</div>
                      @endif
                  @endif
                @endauth

              </div>
              @foreach($projectGroup as $project)
                <div class="col-sm-12" id="content">
                  <div class="col-sm-12">
                    <a href="{{ url('project/' . $project->id) }}">
                    <h4>{{ $project->title }}</h4>
                    </a>
                    <hr>
                  </div>
                  <div class="col-sm-12">Project Description: {{ $project->description }}</div>
                  <div class="col-sm-12">Year: {{ $project->year }}</div>
                  <div class="col-sm-12">Trimester: {{ $project->offering }}</div>
                  <div class="col-sm-12">Team Size: {{ $project->team_size }}</div>
                  <!--<div class="col-sm-12">Posted By:
                    <a href="{{ url('partner/' . $project->user->id) }}">{{ $project->user->name }}</a>
                  </div>-->
                </div>
              @endforeach
            @endforeach
            @empty
              <div class="col-sm-12" id="content">
                <div class="col-sm-12">No projects on offer.</div>
              </div>
          @endforelse

      </div>
  </div>
</div>

@endsection