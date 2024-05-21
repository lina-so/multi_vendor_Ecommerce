@extends('vendor.layouts.main')
@section('title', 'Create Coupon')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">@yield('title')</li>
@endsection

@section('content')

    <div class="p-3">
        <form action="{{ route('dashboard.vendor.coupon.store') }}" method="post" enctype="multipart/form-data"
            id="couponForm">
            @csrf
            @include('vendor.coupon._form')
        </form>
    </div>



    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var startsAtInput = document.getElementById('starts_at');
            var expiresAtInput = document.getElementById('expires_at');


            var startsAtError = document.getElementById('startError');
            var expiresAtError = document.getElementById('expireError');


            startsAtInput.addEventListener('change', function () {
                var startsAtDate = new Date(startsAtInput.value);
                var now = new Date();

                if (startsAtDate < now) {
                    startsAtError.textContent = 'Start date must be in the future.';
                    startsAtInput.value = ''; // Clear the input field
                } else {
                    startsAtError.textContent = '';
                }
            });

            expiresAtInput.addEventListener('change', function () {
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

    <script>
        // $(document).ready(function() {
        //     // Function to handle form submission
        //     $("#couponForm").submit(function(event) {
        //         event.preventDefault();
        //         var element = $(this);
        //         $("button[type=submit]").prop('disabled', true);
        //         $.ajax({
        //             url: '{{ route('dashboard.vendor.coupon.store') }}',
        //             type: 'post',
        //             data: element.serializeArray(),
        //             success: function(response) {
        //                 $("button[type=submit]").prop('disabled', false);
        //                 if (response["status"] == true) {
        //                     window.location.href = "{{ route('dashboard.vendor.coupon.index') }}";
        //                     $("#name").removeClass('is-invalid').siblings('p').removeClass(
        //                         'invalid-feedback').html("");
        //                     $("#code").removeClass('is-invalid').siblings('p').removeClass(
        //                         'invalid-feedback').html("");
        //                 } else {
        //                     var errors = response['errors'];
        //                     if (errors['code']) {
        //                         $("#code").addClass('is-invalid').siblings('p').addClass('invalid-feedback')
        //                             .html(errors['code']);
        //                     } else {
        //                         $("#code").removeClass('is-invalid').siblings('p').removeClass(
        //                             'invalid-feedback').html("");
        //                     }
        //                     if (errors['discount_amount']) {
        //                         $("#discount_amount").addClass('is-invalid').siblings('p').addClass(
        //                             'invalid-feedback').html(errors['discount_amount']);
        //                     } else {
        //                         $("#discount_amount").removeClass('is-invalid').siblings('p').removeClass(
        //                             'invalid-feedback').html("");
        //                     }
        //                     if (errors['starts_at']) {
        //                         $("#starts_at").addClass('is-invalid').siblings('p').addClass(
        //                             'invalid-feedback').html(errors['starts_at']);
        //                     } else {
        //                         $("#starts_at").removeClass('is-invalid').siblings('p').removeClass(
        //                             'invalid-feedback').html("");
        //                     }
        //                 }
        //             }
        //         });
        //     });
        // });
    </script>




@endsection
