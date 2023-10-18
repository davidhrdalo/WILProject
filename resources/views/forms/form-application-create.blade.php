<form method="POST" action='{{url("application")}}'>
    {{csrf_field()}}
    <input type="hidden" name="project_id" value="{{$project->id}}">
    <p>
        <h6><label>Justification: </label></h6>
        <textarea type="textarea" name="justification" cols=50% rows="5">{{ old('justification') }}</textarea>
        @error('justification')
            <div class="alert error-message">{{ $message }}</div>
        @enderror
        @error('user_id')
            <div class="alert error-message">{{ $message }}</div>
        @enderror
    </p>
    <p>
        <input type="submit" value="Apply">
    </p>
    @if(session('message'))
        <div class="alert error-message" style="color: black !important;">{{ session('message') }}</div>
    @endif
</form>