@extends('dashboard.layouts.main')

@section('title','Roles')

@section('breadcrumb')
@parent
    <li class="breadcrumb-item active">@yield('title')</li>
@endsection

@section('content')

<div class="p-3">
    <form action="{{ route('dashboard.roles.store') }}" method="post" enctype="multipart/form-data" id="mainForm">
        @csrf
        @include('dashboard.roles._form')
    </form>
</div>

@endsection


@push('scripts')


@endpush
