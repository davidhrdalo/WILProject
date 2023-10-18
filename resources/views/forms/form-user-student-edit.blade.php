<form method="POST" action='{{url("student/$userStudent->id")}}'>
    {{csrf_field()}}
    @method('PUT')
    <p>
        <h6><label for="gpa">GPA:</label></h6>
        <input type="number" name="gpa" value="{{ old('gpa', $userStudent->gpa) }}" step="0.01">
        @error('gpa')
            <div class="alert error-message">{{ $message }}</div>
        @enderror
    </p>
    <p>
        <hr>
        <h6>Role Proficiency: </h6>
        Please rate your proficiency in each role from 0-5.
        <br> With 0 being the lowest and 5 being the highest.
    </p>
    <p>
        <h6><label>Software Developer: </label></h6>
        <select name="software_developer" style="width: 80px;" value="{{ old('software_developer') }}">
            <option value="0" {{ $userStudent->software_developer == '0' ? 'selected' : '' }}>0</option>
            <option value="1" {{ $userStudent->software_developer == '1' ? 'selected' : '' }}>1</option>
            <option value="2" {{ $userStudent->software_developer == '2' ? 'selected' : '' }}>2</option>
            <option value="3" {{ $userStudent->software_developer == '3' ? 'selected' : '' }}>3</option>
            <option value="4" {{ $userStudent->software_developer == '4' ? 'selected' : '' }}>4</option>
            <option value="5" {{ $userStudent->software_developer == '5' ? 'selected' : '' }}>5</option>
        </select>
        @error('software_developer')
            <div class="alert error-message">{{ $message }}</div>
        @enderror
    </p>
    <p>
        <h6><label>Project Manager: </label></h6>
        <select name="project_manager" style="width: 80px;" value="{{ old('project_manager') }}">
            <option value="0" {{ $userStudent->project_manager == '0' ? 'selected' : '' }}>0</option>
            <option value="1" {{ $userStudent->project_manager == '1' ? 'selected' : '' }}>1</option>
            <option value="2" {{ $userStudent->project_manager == '2' ? 'selected' : '' }}>2</option>
            <option value="3" {{ $userStudent->project_manager == '3' ? 'selected' : '' }}>3</option>
            <option value="4" {{ $userStudent->project_manager == '4' ? 'selected' : '' }}>4</option>
            <option value="5" {{ $userStudent->project_manager == '5' ? 'selected' : '' }}>5</option>
        </select>
        @error('project_manager')
            <div class="alert error-message">{{ $message }}</div>
        @enderror
    </p>
    <p>
        <h6><label>Business Analyst: </label></h6>
        <select name="business_analyst" style="width: 80px;" value="{{ old('business_analyst') }}">
            <option value="0" {{ $userStudent->business_analyst == '0' ? 'selected' : '' }}>0</option>
            <option value="1" {{ $userStudent->business_analyst == '1' ? 'selected' : '' }}>1</option>
            <option value="2" {{ $userStudent->business_analyst == '2' ? 'selected' : '' }}>2</option>
            <option value="3" {{ $userStudent->business_analyst == '3' ? 'selected' : '' }}>3</option>
            <option value="4" {{ $userStudent->business_analyst == '4' ? 'selected' : '' }}>4</option>
            <option value="5" {{ $userStudent->business_analyst == '5' ? 'selected' : '' }}>5</option>
        </select>
        @error('business_analyst')
            <div class="alert error-message">{{ $message }}</div>
        @enderror
    </p>
    <p>
        <h6><label>Tester: </label></h6>
        <select name="tester" style="width: 80px;" value="{{ old('tester') }}">
            <option value="0" {{ $userStudent->tester == '0' ? 'selected' : '' }}>0</option>
            <option value="1" {{ $userStudent->tester == '1' ? 'selected' : '' }}>1</option>
            <option value="2" {{ $userStudent->tester == '2' ? 'selected' : '' }}>2</option>
            <option value="3" {{ $userStudent->tester == '3' ? 'selected' : '' }}>3</option>
            <option value="4" {{ $userStudent->tester == '4' ? 'selected' : '' }}>4</option>
            <option value="5" {{ $userStudent->tester == '5' ? 'selected' : '' }}>5</option>
        </select>
        @error('tester')
            <div class="alert error-message">{{ $message }}</div>
        @enderror
    </p>
    <p>
        <h6><label>Client Liaison: </label></h6>
        <select name="client_liaison" style="width: 80px;" value="{{ old('client_liaison') }}">
            <option value="0" {{ $userStudent->client_liaison == '0' ? 'selected' : '' }}>0</option>
            <option value="1" {{ $userStudent->client_liaison == '1' ? 'selected' : '' }}>1</option>
            <option value="2" {{ $userStudent->client_liaison == '2' ? 'selected' : '' }}>2</option>
            <option value="3" {{ $userStudent->client_liaison == '3' ? 'selected' : '' }}>3</option>
            <option value="4" {{ $userStudent->client_liaison == '4' ? 'selected' : '' }}>4</option>
            <option value="5" {{ $userStudent->client_liaison == '5' ? 'selected' : '' }}>5</option>
        </select>
        @error('client_liaison')
            <div class="alert error-message">{{ $message }}</div>
        @enderror
    </p>
    @if(session('error'))
        <div class="alert error-message">{{ session('error') }}</div>
    @endif
    <p>
        <input type="submit" value="Update">
    </p>
    @if(session('message'))
        <div class="alert error-message" style="color: black !important;">{{ session('message') }}</div>
    @endif
</form>

