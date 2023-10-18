@extends('layouts.master')

@section('title')
  Students
@endsection

@section('content')
<div class="container">
  <div class="row" id="main">
      <div class="col-sm-1"></div>
      <div class="col-sm-10">
          <div class="col-sm-12 align-items-center" id="heading" style="text-align:center;">
            <h3><br>All Registered Students<br></h3><hr>
            <p>Below are the current registered students for Griffith University Work Integrated Learning projects.</p>
          </div>

              @foreach ($students as $student)
                <div class="col-sm-12" id = "content"><a href="student/{{$student->id}}"><h6>{{$student->name}}</h6></a></div>
              @endforeach

              <div class="col-sm-12 d-flex align-items-center justify-content-center" id="content">{{ $students->links() }}</div>

      </div>
  </div>
</div>

@endsection