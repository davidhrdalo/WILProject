@extends('layouts.master')

@section('title')
  Edit: {{ $project->title }}
@endsection

@section('content')
<div class="container">
  <div class="row" id="main">
      <div class="col-sm-1"></div>
      <div class="col-sm-10">
        <div class="col-sm-12 align-items-center" id="heading" style="text-align:center;">
          <h3><br>Edit: {{ $project->title }}<br></h3><hr>
          <p>Edit the selected project for Griffith University Work Integrated Learning.</p>
        </div>
          <div class="col-sm-12" id="content">
          @include('forms.form-project-edit')

      </div>
    </div>
  </div>
</div>

@endsection