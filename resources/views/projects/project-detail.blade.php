@extends('layouts.master')

@section('title')
  {{$project->title}}
@endsection

@section('content')
<div class="container">
  <div class="row" id="main">
    <div class="col-sm-1"></div>
    <div class="col-sm-10">
      <div class="col-sm-12" id="content">
      @if(session('message'))
        <div class="alert error-message" style="color: black !important;">{{ session('message') }}</div>
      @endif
      @if(session('error'))
        <div class="alert error-message" style="color: black !important;">{{ session('message') }}</div>
      @endif
        <div class="col-sm-12 align-items-center" style="text-align:center;">
          <h3><br>{{$project->title}}</h3>
        </div>
        @auth
          @if(auth()->user()->id == $project->user_id && auth()->user()->type == 'Partner')
          <br><hr><br>
            <div class="row">
              <div class="col-sm-12"><h5>Project Changes: </h5><br></div>
              <div class="col-sm-2"><a href="{{url("project/$project->id/edit")}}" class="link-button" style="text-decoration: underline;">Edit Project</a></div>
              <div class="col-sm-4">@include('forms.form-project-delete')</div>
              @if(session('error'))
                <div class="alert error-message">{{ session('error') }}</div>
              @endif
            </div>
          @endif
        @endauth
          <br><hr><br>
          <div class="row">
            <div class="col-sm-12"><h5>Project Description: </h5><br></div>
            <div class="col-sm-12">{{$project->description}}</div>
            <div class="col-sm-12"><hr><br></div>
            <div class="col-sm-12"><h5>Project Details: </h5><br></div>
            <div class="col-sm-12">Posted By: <a href="{{ url('partner/' . $project->user->id) }}">{{$project->user->name}}</a></div>
            <div class="col-sm-12">Offered By: {{$project->partner_name}}</a></div>
            <div class="col-sm-12">Partner Email: {{$project->email}}</div>
            <div class="col-sm-12">Team Size: {{$project->team_size}}</div>
            <div class="col-sm-12">Trimester: {{$project->offering}}</div>
            <div class="col-sm-12">Year: {{$project->year}}</div>
          </div>

          <!-- Checking if there are images for the project -->
          @if($project && $project->images && $project->images->isNotEmpty())
            <br><hr><br>
            <div class="col-sm-12"><h5>Project Images: </h5></div><br>
            <div id="carouselControls" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-inner">
                <!-- $project->images is iterated over to fetch each $image. 
                $num is the index of the current $image being iterated over. 
                It starts from 0 for the first image, 1 for the second, and so on. -->
                @foreach($project->images as $num => $image)
                  <div class="carousel-item @if($num == 0) active @endif">
                    <div style="display: flex; align-items: center; justify-content: center; height: 400px;">
                    <img src="{{ asset($image->image) }}" class="d-block" alt="project image" style="height:400px; width:auto; margin: auto;">
                    </div>
                  </div>
                @endforeach
              </div>

              <!-- Display controls if there is more than one image -->
              @if($project->images->count() > 1)
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselControls" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselControls" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              @endif

            </div>
          @endif

          @if($project && $project->files && $project->files->isNotEmpty())
            <br><hr><br>
            <div class="col-sm-12"><h5>Project Files: </h5></div><br>

            <p>Total attached files: {{ $project->files->count() }}</p>

            @foreach($project->files as $file) 
              <div class="col-sm-12"><a href="{{ asset($file->file) }}" download>Download PDF File <!-- : {{$file->file}} --> </a></div> <!-- Uncomment for file name with path -->
            @endforeach
          @endif

          @auth
            @if(auth()->user()->type == 'Student')
            <br><hr><br>
              <div class="row">
                <div class="col-sm-12"><h5>Apply for Project: </h5><br></div>
                @include('forms.form-application-create')
              </div>
            @endif
          @endauth

          @if($project->application->isNotEmpty())
            <br><hr><br>
            <div class="col-sm-12"><h5>Project Applications: </h5></div><br>
            @foreach($project->application as $application)
              <div class="col-sm-12">Applied By: {{$application->user->name}}</div>
              @auth
                @if(auth()->user()->id == $application->user_id && auth()->user()->type == 'Student')
                  @include('forms.form-application-delete')
                @endif
              @endauth
              <div class="col-sm-12">{{$application->justification}}<hr></div>
            @endforeach
          @endif

          <!-- Show assigned students if they exist -->
          @if($project->assignedStudents->isNotEmpty())
            @auth
              @if(auth()->user()->type == 'Teacher')
                <br>
                <div class="col-sm-12"><h5>Assigned Students: </h5></div><br>
                @foreach($project->assignedStudents as $student)
                  <div class="col-sm-12">Student Name: {{ $student->user->name }}</div>
                  <div class="col-sm-12">GPA: {{ $student->gpa }}</div>
                  <div class="col-sm-12">Role Proficiency: </div>
                  <div class="col-sm-12">Software Developer: {{$student->software_developer}}</div>
                  <div class="col-sm-12">Project Manager: {{$student->project_manager}}</div>
                  <div class="col-sm-12">Business Analyst: {{$student->business_analyst}}</div>
                  <div class="col-sm-12">Tester: {{$student->tester}}</div>
                  <div class="col-sm-12">Client Liaison: {{$student->client_liaison}}</div>
                  <div class="col-sm-12"><hr></div>
                @endforeach
              @endif
            @endauth
          @endif

        </div>
      </div>
    </div>
  </div>
</div>
@endsection