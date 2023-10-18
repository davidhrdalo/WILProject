<form method="POST" action='{{url("project")}}' enctype="multipart/form-data">
    {{csrf_field()}}
    <p>
        <h6><label>Title: </label></h6>
        <input type="text" name="title" style="width: 300px;" value="{{ old('title') }}">
        @error('title')
            <div class="alert error-message">{{ $message }}</div>
        @enderror
    </p>
    <p>
        <h6><label>Description: </label></h6>
        <textarea type="textarea" name="description" cols=95% rows="10">{{ old('description') }}</textarea>
        @error('description')
            <div class="alert error-message">{{ $message }}</div>
        @enderror
    </p>
    <p>
        <h6><label>Name: </label></h6>
        <input type="text" name="partner_name" style="width: 300px;" value="{{ old('partner_name', auth()->user()->name) }}">
        @error('partner_name')
            <div class="alert error-message">{{ $message }}</div>
        @enderror
    </p>
    <p>
        <h6><label>Email: </label></h6>
        <input type="text" name="email" style="width: 300px;" value="{{ old('email', auth()->user()->email) }}">
        @error('email')
            <div class="alert error-message">{{ $message }}</div>
        @enderror
    </p>
    <p>
        <h6><label>Team Size: </label></h6>
        <select name="team_size" style="width: 80px;" value="{{ old('team_size') }}">
            <option value="3" {{ old('team_size') == '1' ? 'selected' : '' }}>3</option>
            <option value="4" {{ old('team_size') == '2' ? 'selected' : '' }}>4</option>
            <option value="5" {{ old('team_size') == '3' ? 'selected' : '' }}>5</option>
            <option value="6" {{ old('team_size') == '3' ? 'selected' : '' }}>6</option>
        </select>
        @error('team_size')
            <div class="alert error-message">{{ $message }}</div>
        @enderror
    </p>
    <p>
        <h6><label>Trimester: </label></h6>
        <select name="offering" style="width: 80px;" value="{{ old('offering') }}">
            <option value="1" {{ old('offering') == '1' ? 'selected' : '' }}>1</option>
            <option value="2" {{ old('offering') == '2' ? 'selected' : '' }}>2</option>
            <option value="3" {{ old('offering') == '3' ? 'selected' : '' }}>3</option>
        </select>
        @error('offering')
            <div class="alert error-message">{{ $message }}</div>
        @enderror
    </p>
    <p>
        <h6><label>Year: </label></h6>
        <select name="year" style="width: 80px;" value="{{ old('year') }}">
            <option value="2023" {{ old('year') == '2023' ? 'selected' : '' }}>2023</option>
            <option value="2024" {{ old('year') == '2024' ? 'selected' : '' }}>2024</option>
            <option value="2025" {{ old('year') == '2025' ? 'selected' : '' }}>2025</option>
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
        <br><input type="submit" value="Submit">
    </p>
</form>