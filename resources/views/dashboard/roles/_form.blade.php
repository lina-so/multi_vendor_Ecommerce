    @if ($errors->any())
        <div class="alert alert-danger">
            <h4>Error Occured!</h4>
            <ul>
                @foreach ($errors->all() as $error )
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>

    @endif

    @if (session('customError'))
    <div class="alert alert-danger">
        <h4>Error Occurred!</h4>
        <p>{{ session('customError') }}</p>
    </div>
@endif


    {{-- name --}}
    <div class="form-group" >
        <x-form.input name="name"  type="text"  label="role Name" id="inputField"  placeholder="role name" value="{{$role->name}}"/>
    <div>
    <br/>
    <fieldset>
        <label class=''>Abilities</label>

        @foreach (config('abilities') as $ability_code => $ability_name )
        <div class="row mb-2">
            <div class="col-md-6">
               <p> {{ $ability_name }}</p>
            </div>
            <div class="col-md-2">
                <label for="">allow</label>
                <input type="radio" name="abilities[{{ $ability_code }}]" value="allow" @checked(($role_abitlities[$ability_code] ?? '' )== 'allow')>
            </div>
            <div class="col-md-2">
                <label for="">deny</label>
                <input type="radio" name="abilities[{{ $ability_code }}]" value="deny" @checked(($role_abitlities[$ability_code] ?? '') == 'deny')>
            </div>
        </div>

        @endforeach
    </fieldset>


    <div class="form-group">
        @if ($role->exists)
        <button type="submit" class="mt-3 btn btn-primary">edit role</button>
        @else
        <button type="submit" class="mt-3 btn btn-primary" id="submit">Add role</button>
        @endif
    </div>
