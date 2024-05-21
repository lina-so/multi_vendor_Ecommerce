@extends('dashboard.layouts.main')

@section('title', '')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">@yield('title')User users/{{ $user->name }}</li>
@endsection

@section('content')
    <div class="container">
        {{-- name --}}
        <div class="form-group">
            <h4 class='text-gray'>{{$user->name}}</h4>
        </div>
        <div class="row">
          
        </div>
    </div>
@endsection
