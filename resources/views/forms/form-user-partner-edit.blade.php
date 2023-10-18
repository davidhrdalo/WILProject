<form method="POST" action='{{url("partner/" . $partner->id)}}'>
    {{csrf_field()}}
    @method('PUT')

    <input type="hidden" name="user_id" value="{{$partner->id}}">


    <p>
        <h6><label>Approved: </label></h6>
        <select name="approved">
            <option value="yes" {{ $user_partner->approved == 'yes' ? 'selected' : '' }}>Yes</option>
            <option value="no" {{ $user_partner->approved == 'no' ? 'selected' : '' }}>No</option>
        </select>
        @error('approved')
            <div class="alert error-message">{{ $message }}</div>
        @enderror
    </p>

    <p>
        <input type="submit" value="Update">
    </p>

    @if(session('message'))
        <div class="alert error-message" style="color: black !important;">{{ session('message') }}</div>
    @endif
</form>