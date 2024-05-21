@extends('vendor.layouts.main')
@section('title', 'Edit Coupon')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">@yield('title')</li>
@endsection

@section('content')

    <div class="p-3">
        <form action="{{ route('dashboard.vendor.coupon.update', $coupon->id) }}" method="post" enctype="multipart/form-data"
            id="couponForm">
            @csrf
            @method('PUT')
            @include('vendor.coupon._form')

        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var startsAtInput = document.getElementById('starts_at');
            var expiresAtInput = document.getElementById('expires_at');


            var startsAtError = document.getElementById('startError');
            var expiresAtError = document.getElementById('expireError');


            startsAtInput.addEventListener('change', function() {
                var startsAtDate = new Date(startsAtInput.value);
                var now = new Date();

                if (startsAtDate < now) {
                    startsAtError.textContent = 'Start date must be in the future.';
                    startsAtInput.value = ''; // Clear the input field
                } else {
                    startsAtError.textContent = '';
                }
            });

            expiresAtInput.addEventListener('change', function() {
                var startsAtDate = new Date(startsAtInput.value);
                var expireAtDate = new Date(expiresAtInput.value);


                if (expireAtDate <= startsAtDate) {
                    expiresAtError.textContent = 'Expiration date must be greater than the start date.';
                    expiresAtInput.value = '';
                } else {
                    expiresAtError.textContent = '';
                }
            });
        });
    </script>

@endsection
