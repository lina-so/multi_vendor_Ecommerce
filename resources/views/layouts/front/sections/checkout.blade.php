<x-front-layout title="checkout">

    <x-slot:breadcrumb>
        <section class="breadcrumb breadcrumb_bg">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="breadcrumb_iner">
                            <div class="breadcrumb_iner_item">
                                <h2>Product Checkout</h2>
                                <p>Home <span>-</span> Shop Single</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </x-slot:breadcrumb>

    <x-alert.alert type="success" />
    <x-alert.alert type="info" />

    <!--================Checkout Area =================-->
    <section class="checkout_area padding_top">
        <div class="container">
            <form action="{{ route('checkout.store') }}" method="post" id="checkoutForm">
                @csrf
                <div class="cupon_area">
                    <div class="check_title">
                        <h2>
                            Have a coupon?
                            <a href="#">Click here to enter your code</a>
                        </h2>
                    </div>

                    <input type="text" id="coupon_code" name="coupon_code" placeholder="Enter coupon code" />
                </div>
                {{-- billing --}}
                <div class="billing_details">
                    <div class="row">
                        <div class="col-lg-8">
                            <h3>Billing Details</h3>
                            <form class="row contact_form" action="#" method="post" novalidate="novalidate">
                                <div class="col-md-5 form-group p_star">
                                    <input type="text" class="form-control" id="first" name="first_name" placeholder="First name"/>
                                    <span class="placeholder" ></span>
                                </div>
                                <div class="col-md-5 form-group p_star">
                                    <input type="text" class="form-control" id="last" name="last_name" placeholder="Last name"/>
                                    <span class="placeholder" ></span>
                                </div>

                                <div class="col-md-5 form-group p_star">
                                    <input type="text" class="form-control" id="number" name="phone_number" placeholder="Phone number"/>
                                    <span class="placeholder" ></span>
                                </div>
                                <div class="col-md-5 form-group p_star">
                                    <input type="text" class="form-control" id="email" name="email" placeholder="Email Address"/>
                                    <span class="placeholder" ></span>
                                </div>

                                <div class="col-md-12 form-group p_star">
                                    <input type="text" class="form-control" id="add1" name="add1" placeholder="Address line 01" />
                                    <span class="placeholder" placeholder="Address line 01"></span>
                                </div>
                                <div class="col-md-12 form-group p_star">
                                    <input type="text" class="form-control" id="add2" name="add2" placeholder="Address line 02" />
                                    <span class="placeholder" ></span>
                                </div>
                                <div class="col-md-12 form-group p_star">
                                    <input type="text" class="form-control" id="city" name="city"  placeholder="Town/City"/>
                                    <span class="placeholder" ></span>
                                </div>


                                <div class="col-md-12 form-group p_star">
                                    <input type="text" class="form-control" id="country" name="country" placeholder="country"/>
                                    <span class="placeholder" ></span>
                                </div>


                                <div class="col-md-12 form-group">
                                    <input type="text" class="form-control" id="zip" name="postal_code"
                                        placeholder="Postcode/ZIP" />
                                </div>


                                {{-- shipping --}}
                                <div class="col-md-12 form-group">
                                    <div class="creat_account">
                                        <h3>Shipping Details</h3>
                                        <input type="checkbox" id="f-option3" name="shipping" />
                                        <label for="f-option3">Ship to a different address?</label>
                                        <div class="col-md-12 form-group p_star">
                                            <input type="text" class="form-control" id="add3" name="add3" />
                                            <span class="placeholder" data-placeholder="Address line 03"></span>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                        <div class="col-lg-4">
                            <div class="order_box">
                                <h2>Your Order</h2>
                                <ul class="list">
                                    <li>
                                        <a href="#">Product
                                            <span>Total</span>
                                        </a>
                                    </li>
                                    @php
                                        $Subtotal = 0;
                                    @endphp
                                    @foreach ($carts as $cart)
                                        <li>
                                            <a href="#">{{ $cart->product->name }}
                                                <span class="middle">x {{ $cart->quantity }}</span>
                                                @if (isset($cart->product->offer->compare_price))
                                                    <span
                                                        class="last">${{ number_format($cart->quantity * ($cart->product->price - ($cart->product->price * $cart->product->offer->compare_price) / 100), 2) }}</span>
                                                @else
                                                    <span
                                                        class="last">${{ number_format($cart->quantity * $cart->product->price, 2) }}</span>
                                                @endif

                                            </a>
                                        </li>
                                        @if (isset($cart->product->offer->compare_price))
                                            @php
                                                $Subtotal +=
                                                    $cart->quantity * $cart->product->price -
                                                    ($cart->product->price * $cart->product->offer->compare_price) /
                                                        100;
                                            @endphp
                                        @else
                                            @php
                                                $Subtotal += $cart->quantity * $cart->product->price;
                                            @endphp
                                        @endif
                                    @endforeach



                                </ul>
                                <ul class="list list_2">
                                    <li>
                                        <a href="#">Subtotal
                                            <span>${{ number_format($Subtotal, 2) }}</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">Shipping
                                            <span>Flat rate: ${{ $cart->shipping }}</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">Total
                                            @if (session()->has('coupon'))
                                                <span id="finalPrice"></span>
                                            @else
                                                <span
                                                    id="finalPrice ">${{ number_format($Subtotal + $cart->shipping, 2) }}</span>
                                            @endif
                                            <input type="hidden" name="total"
                                                value="{{ $Subtotal + $cart->shipping }}">
                                        </a>
                                    </li>
                                </ul>
                                <div class="payment_item">
                                    <div class="radion_btn">
                                        <input type="radio" id="f-option5" name="selector" />
                                        <label for="f-option5">Check payments</label>
                                        <div class="check"></div>
                                    </div>
                                    <p>
                                        Please send a check to Store Name, Store Street, Store Town,
                                        Store State / County, Store Postcode.
                                    </p>
                                </div>
                                <div class="payment_item active">
                                    <div class="radion_btn">
                                        <input type="radio" id="f-option6" name="selector" />
                                        <label for="f-option6">Paypal </label>
                                        <img src="img/product/single-product/card.jpg" alt="" />
                                        <div class="check"></div>
                                    </div>
                                    <p>
                                        Please send a check to Store Name, Store Street, Store Town,
                                        Store State / County, Store Postcode.
                                    </p>
                                </div>
                                <div class="creat_account">
                                    <input type="checkbox" id="f-option4" name="selector" />
                                    <label for="f-option4">I’ve read and accept the </label>
                                    <a href="#">terms & conditions*</a>
                                </div>
                                <div id="couponMessage"></div>

                                <div class='d-flex justify-content-around'>
                                    <button class="btn_3 btn-sm p-3" href="#" type="submit">Submit</button>
                                    <button class="btn_3" type="button" onclick="applyCoupon(event)">Apply
                                        Coupon</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </section>
    <!--================End Checkout Area =================-->



    @push('styles')
        <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    @endpush

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
        <script>
            function applyCoupon(event) {
                event.preventDefault();
                var couponCode = $('#coupon_code').val();
                var formData = $('#checkoutForm').serialize();

                $.ajax({
                    url: "{{ route('checkCoupon') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        coupon_code: couponCode,
                        total: {{ $Subtotal + $cart->shipping }},
                        formData: formData
                    },

                    success: function(response) {
                        if (response.valid) {
                            $('#couponMessage').html(
                                '<div class="alert alert-success">Coupon applied successfully!</div>'
                            );
                            $('#finalPrice').text('Final Price: $' + response.finalPrice.toFixed(2));
                            // console.log(response.finalPrice);

                        } else {
                            $('#couponMessage').html(
                                '<div class="alert alert-danger">this coupon was expired .</div>'
                            );
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        alert('An error occurred while processing your request. Please try again.');
                    }
                });
            }
        </script>
    @endpush
</x-front-layout>
