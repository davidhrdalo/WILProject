<form method="POST" action='{{ url("application/$application->id") }}'>
    {{csrf_field()}}
    @method('DELETE')
    <button type="submit" class="link-button" style="text-decoration: underline;">Delete Application</button>
</form>