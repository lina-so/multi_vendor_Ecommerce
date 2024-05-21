@extends('dashboard.layouts.main')

@section('title', 'Roles')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">@yield('title')</li>
@endsection

@section('content')

    <div class="p-3">
        <form action="{{ route('dashboard.roles.update', $role->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('dashboard.roles._form')

        </form>
    </div>

@endsection
