@extends('dashboard.layouts.main')

@section('title', '')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">@yield('title')User Roles/{{ $role->name }}</li>
@endsection

@section('content')
    <div class="container">
        {{-- name --}}
        <div class="form-group">
            <h4 class='text-gray'>{{$role->name}}</h4>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-success ">Allowed Abilities</h5>
                        <br>
                        <hr>
                        @foreach (config('abilities') as $ability_code => $ability_name )
                            @if(isset($role_abitlities[$ability_code]) && $role_abitlities[$ability_code] === 'allow')
                                <p class="card-text ">{{ $ability_name }}</p>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title  text-danger">Denied Abilities</h5>
                        <br>
                        <hr>
                        @foreach (config('abilities') as $ability_code => $ability_name )
                            @if(isset($role_abitlities[$ability_code]) && $role_abitlities[$ability_code] === 'deny')
                                <p class="card-text ">{{ $ability_name }}</p>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
