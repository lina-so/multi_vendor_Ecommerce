@extends('dashboard.layouts.main')

@section('title', 'Edit User')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">@yield('title')</li>
@endsection

@section('content')

    <div class="p-3">
        <form action="{{ route('dashboard.users.update', $user->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('dashboard.users._form')

        </form>
    </div>

@endsection
