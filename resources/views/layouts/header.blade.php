<!-- Created using boostrap nav class-->
<nav class="navbar navbar-expand-sm navbar-dark navbar-custom fixed-top">
    <div class="container-fluid">
    <a class="navbar-brand" href="{{asset('/')}}"><img src="{{URL('/images/griffith-logo-red-square.webp')}}" alt ="icon" width="75" height="75"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="{{ url('/') }}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('project') }}">Projects</a>
        </li>
        <li class="nav-item">
          @auth
            @if(auth()->user()->type == 'Partner')
              <div class="col-sm-12"><a class="nav-link" href="{{ url('project/create') }}">New Project </a></div>
            @endif
            @if(auth()->user()->type == 'Student')
              @if(auth()->user()->student)
                  <div class="col-sm-12"><a class="nav-link" href="{{ url('student/' . auth()->user()->student->id . '/edit') }}">Update Profile</a></div>
              @else
                  <div class="col-sm-12"><a class="nav-link" href="{{ url('student/create') }}">Enter Profile Details</a></div>
              @endif
            @endif
            @if(auth()->user()->type == 'Teacher')
              <div class="col-sm-12"><a class="nav-link" href="{{ url('student/') }}">Students</a></div>
            @endif
          @endauth
        </li>
        </ul>

        <ul class="navbar-nav">
        @auth
          @if(auth()->user()->type == 'Partner')
            <li class="nav-item">
              <a class="nav-link" href="{{ url('partner/' . Auth::user()->id) }}">{{Auth::user()->name}} ({{Auth::user()->type}})</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="{{ url('partner/' . Auth::user()->id) }}">View Profile</a>
            </li>

            <li class="nav-item">
              <form method="POST" action="{{url('/logout')}}">
                {{csrf_field()}}
                <button type="submit" class="link-button" style="padding-top:8px;">Logout</button>
              </form>
            </li>
          @endif

          @if(auth()->user()->type == 'Student')
            <li class="nav-item">
              <a class="nav-link" href="{{ url('student/' . Auth::user()->id) }}">{{Auth::user()->name}} ({{Auth::user()->type}})</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="{{ url('student/' . Auth::user()->id) }}">View Profile</a>
            </li>

            <li class="nav-item">
              <form method="POST" action="{{url('/logout')}}">
                {{csrf_field()}}
                <button type="submit" class="link-button" style="padding-top:8px;">Logout</button>
              </form>
            </li>
          @endif

          @if(auth()->user()->type == 'Teacher')
            <li class="nav-item" style="padding-top:8px;">{{Auth::user()->name}} ({{Auth::user()->type}}) </li>

            <li class="nav-item">
              <form method="POST" action="{{url('/logout')}}">
                {{csrf_field()}}
                <button type="submit" class="link-button" style="padding-top:8px;"> Logout</button>
              </form>
            </li>
          @endif

          @else
            <li class="nav-item">
              <a class="nav-link" href="{{route('login')}}">Log in</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('register')}}">Register</a> 
            </li>
          @endauth
      </ul>
    </div>
  </div>
</nav>