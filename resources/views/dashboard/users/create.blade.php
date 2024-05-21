@extends('dashboard.layouts.main')

@section('title','create User')

@section('breadcrumb')
@parent
    <li class="breadcrumb-item active">@yield('title')</li>
@endsection

@section('content')

<div class="p-3">
    <form action="{{ route('dashboard.users.store') }}" method="post" enctype="multipart/form-data" id="mainForm">
        @csrf
        @include('dashboard.users._form')
    </form>
</div>

@endsection


@push('scripts')


@endpush
