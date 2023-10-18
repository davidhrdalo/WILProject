<form method="POST" action='{{url("partner")}}'>
    {{ csrf_field() }}
    
    <input type="hidden" name="user_id" value="{{$partner->id}}">
    @error('user_id')
            <div class="alert error-message">{{ $message }}</div>
    @enderror
    
    <p>
        <h6><label>Approved: </label></h6>
        <select name="approved">
            <option value="no" {{ old('approved') == 'no' ? 'selected' : '' }}>No</option>
            <option value="yes" {{ old('approved') == 'yes' ? 'selected' : '' }}>Yes</option>
        </select>
        @error('approved')
            <div class="alert error-message">{{ $message }}</div>
        @enderror
    </p>
    
    <p>
        <input type="submit" value="Create">
    </p>
    
    @if(session('message'))
        <div class="alert error-message" style="color: black !important;">{{ session('message') }}</div>
    @endif
</form>
