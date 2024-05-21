<div class="row">
    <div class="col-md-6">
        {{-- name --}}
        <div class="form-group">
            <x-form.input name="name" value="{{ $coupon->name }}" type="text" label="coupon Name" />
            <p></p>
        </div>

        {{-- code --}}
        <div class="form-group">
            <x-form.input name="code" value="{{ $coupon->code }}" type="text" label="coupon code" />
            <p></p>
        </div>

        {{-- max_uses --}}
        <div class="form-group">
            <x-form.input name="max_uses" value="{{ $coupon->max_uses }}" type="number" label="coupon's max_uses" />
            <p></p>
        </div>

        {{-- max_uses_user --}}
        <div class="form-group">
            <x-form.input name="max_uses_user" value="{{ $coupon->max_uses_user }}" type="text"
                label="coupon's max_uses_user" />
            <p></p>
        </div>

        {{-- discount_amount --}}
        <div class="form-group">
            <x-form.input name="discount_amount" value="{{ $coupon->discount_amount }}" type="text"
                label="coupon's discount_amount" />
            <p></p>
        </div>
    </div>

    <div class="col-md-6">
        {{-- min_amount --}}
        <div class="form-group">
            <x-form.input name="min_amount" value="{{ $coupon->min_amount }}" type="text"
                label="coupon's min_amount" />
            <p></p>
        </div>

        {{-- type --}}
        <div class="form-group">
            <label for="">coupon type</label>
            <div>
                <x-form.radio type="radio" name='type' :checked="$coupon->type" :options="['fixed' => 'fixed', 'percent' => 'percent']" class="mr-5" />
                <p></p>

            </div>
        </div>

        {{-- status --}}
        <div class="form-group">
            <label for="">coupon status</label>
            <div>
                <x-form.radio type="radio" name='status' :checked="$coupon->status" :options="['1' => 'active', '0' => 'inactive']" class="mr-5" />
                <p></p>

            </div>Pcheckout
        </div>

        {{-- start at --}}
        <div class="form-group">
            <x-form.input name="starts_at" id="starts_at" value="{{ \Carbon\Carbon::parse($coupon->starts_at)->format('Y-m-d') }}"  label="starts_at"
                type="date"  min="2024-01-01" max="2030-12-31" />
            <p id="startError" style="color: red;"></p>
        </div>

        {{-- expire at --}}
        <div class="form-group">
            <x-form.input name="expires_at" id="expires_at" value="{{ \Carbon\Carbon::parse($coupon->expires_at)->format('Y-m-d') }}"  label="expires_at"
                type="date"  min="2024-01-01" max="2030-12-31" />
                <p id="expireError" style="color: red;"></p>

        </div>


    </div>
    <div class="form-group">
        @if ($coupon->exists)
            <button type="submit" class="mt-3 btn btn-primary">edit coupon</button>
        @else
            <button type="submit" class="mt-3 btn btn-primary">Submit</button>
        @endif
    </div>
</div>
