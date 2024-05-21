@extends('vendor.layouts.main')
@section('title', 'Edit Stores')

@section('breadcrumb')
@parent
    <li class="breadcrumb-item active">@yield('title')</li>
@endsection

@section('content')

<div class="p-3">
    <form action="{{ route('dashboard.vendor.stores.update',$store->id) }}" method="post" enctype="multipart/form-data" id="mainForm">
        @csrf
        @method('PUT')
        @include('vendor.stores._form')

    </form>
</div>

@endsection
