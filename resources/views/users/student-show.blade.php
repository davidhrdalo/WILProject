@extends('layouts.master')

@section('title')
  {{$student->name}}
@endsection

@section('content')
<div class="container">
  <div class="row" id="main">
    <div class="col-sm-1"></div>
      <div class="col-sm-10">
        <div class="row align-items-center" id="heading" style="text-align:center;">
          <div class="col-sm-12"><h3>Griffith University Student</h3></div>
        </div>
        <div class="row align-items-center" id="content">
          <div class="col-sm-12"><h3>Student Details</h3></div>
          <div class="col-sm-12">{{$student->name}}</div>
          <div class="col-sm-12">{{$student->email}}</div>
          @if(auth()->user()->type == 'Student')
            @if(auth()->user()->student)
              <div class="col-sm-12"><hr><a href="{{ url('student/' . auth()->user()->student->id . '/edit') }}">Update Profile</a></div>
            @else
              <div class="col-sm-12"><a href="{{ url('student/create') }}">Enter Profile Details</a></div>
            @endif
          @endif
          @if(!is_null($student->student))
            <div class="col-sm-12"><hr> GPA: {{$student->student->gpa}}</div>
            <div class="col-sm-12"><hr> <h6>Role Proficiency: </h6></div>
            <div class="col-sm-12"><p>
              Students have been asked to rate their proficiency in each role from 0-5.<br>
              With 0 being the lowest and 5 being the highest.
            </p></div>
            <div class="col-sm-12">Software Developer: {{$student->student->software_developer}}</div>
            <div class="col-sm-12">Project Manager: {{$student->student->project_manager}}</div>
            <div class="col-sm-12">Business Analyst: {{$student->student->business_analyst}}</div>
            <div class="col-sm-12">Tester: {{$student->student->tester}}</div>
            <div class="col-sm-12">Client Liaison: {{$student->student->client_liaison}}</div>
          @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection