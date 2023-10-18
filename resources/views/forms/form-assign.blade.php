<form method="POST" action="{{ route('student.auto-assign') }}">
    {{ csrf_field() }}
    <input type="hidden" name="year" value="{{ $year }}" />
    <input type="hidden" name="offering" value="{{ $offering }}" />
    <button type="submit">Auto Assign</button>
</form>
