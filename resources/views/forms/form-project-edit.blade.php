<form method="POST" action='{{url("project/" . $project->id)}}' enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <p>
        <h6><label>Title: </label></h6>
        <input type="text" name="title" style="width: 300px;" value="{{ $project->title }}">
        @error('title')
            <div class="alert error-message">{{ $message }}</div>
        @enderror
    </p>
    <p>
        <h6><label>Description: </label></h6>
        <textarea type="textarea" name="description" cols="95%" rows="10">{{ $project->description }}</textarea>
        @error('description')
            <div class="alert error-message">{{ $message }}</div>
        @enderror
    </p>
    <p>
        <h6><label>Name: </label></h6>
        <input type="text" name="partner_name" style="width: 300px;" value="{{ $project->partner_name }}">
        @error('partner_name')
            <div class="alert error-message">{{ $message }}</div>
        @enderror
    </p>
    <p>
        <h6><label>Email: </label></h6>
        <input type="text" name="email" style="width: 300px;" value="{{ $project->email }}">
        @error('email')
            <div class="alert error-message">{{ $message }}</div>
        @enderror
    </p>
    <p>
        <h6><label>Team Size: </label></h6>
        <select name="team_size" style="width: 80px;" value="{{ $project->team_size }}">
            <option value="3" {{ $project->team_size == '3' ? 'selected' : '' }}>3</option>
            <option value="4" {{ $project->team_size == '4' ? 'selected' : '' }}>4</option>
            <option value="5" {{ $project->team_size == '5' ? 'selected' : '' }}>5</option>
            <option value="6" {{ $project->team_size == '6' ? 'selected' : '' }}>6</option>
        </select>
        @error('team_size')
            <div class="alert error-message">{{ $message }}</div>
        @enderror
    </p>
    <p>
        <h6><label>Trimester: </label></h6>
        <select name="offering" style="width: 80px;" value="{{ $project->offering }}">
            <option value="1" {{ $project->offering == '1' ? 'selected' : '' }}>1</option>
            <option value="2" {{ $project->offering == '2' ? 'selected' : '' }}>2</option>
            <option value="3" {{ $project->offering == '3' ? 'selected' : '' }}>3</option>
        </select>
        @error('offering')
            <div class="alert error-message">{{ $message }}</div>
        @enderror
    </p>
    <p>
        <h6><label>Year: </label></h6>
        <select name="year" style="width: 80px;" value="{{ $project->year }}">
            <option value="2023" {{ $project->year == '2023' ? 'selected' : '' }}>2023</option>
            <option value="2024" {{ $project->year == '2024' ? 'selected' : '' }}>2024</option>
            <option value="2025" {{ $project->year == '2025' ? 'selected' : '' }}>2025</option>
        </select>
        @error('year')
            <div class="alert error-message">{{ $message }}</div>
        @enderror
    </p>
    <p>
        <h6><label>Images: </label></h6>
        <input type="file" name="images[]" multiple>
        @error('images')
            <div class="alert error-message">{{ $message }}</div>
        @enderror
    </p>
    <p>
        <h6><label>Files: </label></h6>
        <input type="file" name="files[]" multiple>
        @error('files')
            <div class="alert error-message">{{ $message }}</div>
        @enderror
    </p>
    <p>
        <br><input type="submit" value="Update">
    </p>
</form>
