<form class="mb-6" wire:submit="{{$method}}">
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @csrf
    <div class="mb-3">
        <label for="{{$inputId}}" class="form-label sr-only">{{$inputLabel}}</label>
        <textarea id="{{$inputId}}" rows="6" class="form-control @error($state.'.body') is-invalid @enderror" placeholder="Write a comment..." wire:model.live="{{$state}}.body" oninput="detectAtSymbol()"></textarea>
        @error($state.'.body')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
    </div>

    @if(!empty($users) && $users->count() > 0)
        @include('commentify::livewire.partials.dropdowns.users')
    @endif

    <button wire:loading.attr="disabled" type="submit" class="btn btn-primary">
        <span wire:loading wire:target="{{$method}}">
            @include('commentify::livewire.partials.loader')
        </span>
        {{$button}}
    </button>
</form>
