@extends('layouts.master')

@section('title')
  Home
@endsection

@section('content')
<div class="container">
  <div class="row" id="main">
      <div class="col-sm-1"></div>
      <div class="col-sm-10">
        <div class="col-sm-12 align-items-center" id="heading" style="text-align:center;">
          <h3><br>Add Student Details<br></h3><hr>
          <p>Update student details for Griffith university Work Integrated Learning.</p>
        </div>
          <div class="col-sm-12" id="content">
          @include('forms.form-user-student-details')

      </div>
    </div>
  </div>
</div>

@endsection