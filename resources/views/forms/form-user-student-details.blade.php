<form method="POST" action='{{url("student")}}'>
    {{csrf_field()}}
    <p>
        <h6><label>GPA: </label></h6>
        <input type="number" name="gpa" value="{{ old('gpa') }}" step="0.01">
        @error('gpa')
            <div class="alert error-message">{{ $message }}</div>
        @enderror
    </p>
    <p>
        <h6><label>Software Developer: </label></h6>
        <select name="software_developer" style="width: 80px;" value="{{ old('software_developer') }}">
            <option value="0" {{ old('software_developer') == '0' ? 'selected' : '' }}>0</option>
            <option value="1" {{ old('software_developer') == '1' ? 'selected' : '' }}>1</option>
            <option value="2" {{ old('software_developer') == '2' ? 'selected' : '' }}>2</option>
            <option value="3" {{ old('software_developer') == '3' ? 'selected' : '' }}>3</option>
            <option value="4" {{ old('software_developer') == '4' ? 'selected' : '' }}>4</option>
            <option value="5" {{ old('software_developer') == '5' ? 'selected' : '' }}>5</option>
        </select>
        @error('software_developer')
            <div class="alert error-message">{{ $message }}</div>
        @enderror
    </p>
    <p>
        <h6><label>Project Manager: </label></h6>
        <select name="project_manager" style="width: 80px;" value="{{ old('project_manager') }}">
            <option value="0" {{ old('project_manager') == '0' ? 'selected' : '' }}>0</option>
            <option value="1" {{ old('project_manager') == '1' ? 'selected' : '' }}>1</option>
            <option value="2" {{ old('project_manager') == '2' ? 'selected' : '' }}>2</option>
            <option value="3" {{ old('project_manager') == '3' ? 'selected' : '' }}>3</option>
            <option value="4" {{ old('project_manager') == '4' ? 'selected' : '' }}>4</option>
            <option value="5" {{ old('project_manager') == '5' ? 'selected' : '' }}>5</option>
        </select>
        @error('project_manager')
            <div class="alert error-message">{{ $message }}</div>
        @enderror
    </p>
    <p>
        <h6><label>Business Analyst: </label></h6>
        <select name="business_analyst" style="width: 80px;" value="{{ old('business_analyst') }}">
            <option value="0" {{ old('business_analyst') == '0' ? 'selected' : '' }}>0</option>
            <option value="1" {{ old('business_analyst') == '1' ? 'selected' : '' }}>1</option>
            <option value="2" {{ old('business_analyst') == '2' ? 'selected' : '' }}>2</option>
            <option value="3" {{ old('business_analyst') == '3' ? 'selected' : '' }}>3</option>
            <option value="4" {{ old('business_analyst') == '4' ? 'selected' : '' }}>4</option>
            <option value="5" {{ old('business_analyst') == '5' ? 'selected' : '' }}>5</option>
        </select>
        @error('business_analyst')
            <div class="alert error-message">{{ $message }}</div>
        @enderror
    </p>
    <p>
        <h6><label>Tester: </label></h6>
        <select name="tester" style="width: 80px;" value="{{ old('tester') }}">
            <option value="0" {{ old('tester') == '0' ? 'selected' : '' }}>0</option>
            <option value="1" {{ old('tester') == '1' ? 'selected' : '' }}>1</option>
            <option value="2" {{ old('tester') == '2' ? 'selected' : '' }}>2</option>
            <option value="3" {{ old('tester') == '3' ? 'selected' : '' }}>3</option>
            <option value="4" {{ old('tester') == '4' ? 'selected' : '' }}>4</option>
            <option value="5" {{ old('tester') == '5' ? 'selected' : '' }}>5</option>
        </select>
        @error('tester')
            <div class="alert error-message">{{ $message }}</div>
        @enderror
    </p>
    <p>
        <h6><label>Client Liaison: </label></h6>
        <select name="client_liaison" style="width: 80px;" value="{{ old('client_liaison') }}">
            <option value="0" {{ old('client_liaison') == '0' ? 'selected' : '' }}>0</option>
            <option value="1" {{ old('client_liaison') == '1' ? 'selected' : '' }}>1</option>
            <option value="2" {{ old('client_liaison') == '2' ? 'selected' : '' }}>2</option>
            <option value="3" {{ old('client_liaison') == '3' ? 'selected' : '' }}>3</option>
            <option value="4" {{ old('client_liaison') == '4' ? 'selected' : '' }}>4</option>
            <option value="5" {{ old('client_liaison') == '5' ? 'selected' : '' }}>5</option>
        </select>
        @error('client_liaison')
            <div class="alert error-message">{{ $message }}</div>
        @enderror
    </p>
    @if(session('error'))
        <div class="alert error-message">{{ session('error') }}</div>
    @endif
    <p>
        <input type="submit" value="Apply">
    </p>
    @if(session('message'))
        <div class="alert error-message" style="color: black !important;">{{ session('message') }}</div>
    @endif
</form>