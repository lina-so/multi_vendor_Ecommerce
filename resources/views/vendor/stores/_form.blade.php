@if ($errors->any())
    <div class="alert alert-danger">
        <h4>Error Occured!</h4>
        <ul>
            @foreach ($errors->all() as $error)
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
<div class="form-group">
    <x-form.input name="name" value="{{ $store->name }}" type="text" label="Store Name" />
</div>

{{-- description --}}
<div class="form-group">
    <x-form.textarea name="description" cols="5" rows="5" :value="$store->description"
        label="description"></x-form.textarea>
</div>

{{-- address --}}
<div class="form-group">
    <x-form.input name="address" value="{{ $store->address }}" type="text" label="store's address" />
</div>


{{-- city --}}
<div class="form-group">
    <x-form.input name="city" value="{{ $store->city }}" type="text" label="store's city" />
</div>


{{-- email --}}
<div class="form-group">
    <x-form.input name="email" value="{{ $store->email }}" type="email" label="store's email" />
</div>

{{-- phone --}}
<div class="form-group">
    <x-form.input name="phone" value="{{ $store->phone }}" type="text" label="store's phone"  aria-placeholder="963 957758075"/>
</div>

{{-- industry --}}
<div class="form-group">
    <x-form.input name="industry" value="{{ $store->industry }}" type="text" label="industry" />
</div>


{{-- facebook --}}
<div class="form-group">
    <x-form.input name="facebook" value="{{ $store->facebook }}" type="text" label="Facebook" />
</div>

{{-- twitter --}}
<div class="form-group">
    <x-form.input name="twitter" value="{{ $store->twitter }}" type="text" label="Twitter" />
</div>

{{-- Instagram --}}
<div class="form-group">
    <x-form.input name="instagram" value="{{ $store->instagram }}" type="text" label="Instagram" />
</div>

{{-- return_policy --}}
<div class="form-group">
    <x-form.input name="return_policy" value="{{ $store->return_policy }}" type="file" label="return policy" />
</div>

{{-- shipping_policy --}}
<div class="form-group">
    <x-form.input name="shipping_policy" value="{{ $store->shipping_policy }}" type="file" label="shipping policy" />
</div>

{{-- logo --}}
<div class="form-group">
    <x-form.label id="logo">store's Logo</x-form.label>
    <x-form.input type="file" name="logo"  />
</div>



<div class="form-group">
    @if ($store->exists)
        <button type="submit" class="mt-3 btn btn-primary">edit
            storee</button>
    @else
        <button type="submit" class="mt-3 btn btn-primary">Submit</button>
    @endif
</div>


