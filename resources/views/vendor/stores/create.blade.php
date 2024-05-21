@extends('vendor.layouts.main')
@section('title', 'Create Store')

@section('breadcrumb')
@parent
    <li class="breadcrumb-item active">@yield('title')</li>
@endsection

@section('content')

<div class="p-3">
    <form action="{{ route('dashboard.vendor.stores.store') }}" method="post" enctype="multipart/form-data" id="mainForm">
        @csrf
        @include('vendor.stores._form')
    </form>
</div>

@endsection

