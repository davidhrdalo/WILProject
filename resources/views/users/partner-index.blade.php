@extends('layouts.master')

@section('title')
  Home
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
            <h3><br>Industry Partners<br></h3><hr>
            <p>Below are the current industry partners for Griffith University Work Integrated Learning projects.</p>
          </div>

              @foreach ($partners as $partner)
                <div class="col-sm-12" id = "content"><a href="partner/{{$partner->id}}"><h6>{{$partner->name}}</h6></a></div>
              @endforeach

              <div class="col-sm-12 d-flex align-items-center justify-content-center" id="content">{{ $partners->links() }}</div>

      </div>
  </div>
</div>

@endsection