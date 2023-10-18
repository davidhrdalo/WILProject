<form method="POST" action='{{ url("project/$project->id") }}'>
    {{csrf_field()}}
    @method('DELETE')
    <button type="submit" class="link-button" style="text-decoration: underline;">Delete Project</button>
</form>