<x-front-layout title="coupons">

    <x-alert.alert type="success" />
    <x-alert.alert type="info" />

    <!--================Cart Area =================-->

    <section>
        @php
            $hasCoupons = $coupons->isNotEmpty();
        @endphp
        <!-- product_list part start-->
        <section class="product_list best_seller section_padding">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="section_tittle text-center">
                            <h3>Coupons <span></span></h3>
                        </div>
                    </div>
                </div>

                <div class="row align-items-center justify-content-between">
                    <div class="col-lg-12">
                        <div class="best_product_slider d-flex justify-content-between">
                            @forelse ($coupons as $coupon)
                                <div class="single_product_item">
                                    <div class="single_product_text">
                                        <h4>{{ $coupon->name }}</h4>
                                        <h6 id="couponCode{{ $coupon->id }}">code: {{ $coupon->code }}</h6>
                                        <button class='btn btn-warning text-sm'
                                            onclick="copyCouponCode({{ $coupon->id }})">collect coupon</button>
                                            <p class='text-success' id="copid"></p>

                                    </div>
                                </div>
                            @empty
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- product_list part end-->

        <!-- product_list part start-->
        <section class="product_list best_seller section_padding">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="section_tittle text-center">
                            <h2>Best Sellers <span>shop</span></h2>
                        </div>
                    </div>
                </div>

                <div class="row align-items-center justify-content-between">
                    <div class="col-lg-12">
                        <div class="best_product_slider d-flex justify-content-between">
                            @forelse ($bestSellingProducts as $product)
                                <div class="single_product_item">
                                    <img src="{{ asset('storage/' . $product->images->first()->path) }}"
                                        alt="{{ $product->name }}" width="100px" height="50%">
                                    <div class="single_product_text">
                                        <h4>{{ $product->name }}</h4>
                                        <h3>${{ $product->price }}</h3>
                                    </div>
                                </div>


                            @empty
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- product_list part end-->

        <!-- subscribe_area part start-->
        <section class="subscribe_area section_padding">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-7">
                        <div class="subscribe_area_text text-center">
                            <h5>Join Our Newsletter</h5>
                            <h2>Subscribe to get Updated
                                with new offers</h2>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="enter email address"
                                    aria-label="Recipient's username" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <a href="#" class="input-group-text btn_2" id="basic-addon2">subscribe now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>

    <!--::subscribe_area part end::-->
    <!--================End Cart Area =================-->





    @push('scripts')
        @if ($hasCoupons)
            <script>
                function copyCouponCode(couponId) {
                    var couponCode = document.getElementById("couponCode" + couponId);
                    var range = document.createRange();
                    range.selectNode(couponCode);
                    window.getSelection().removeAllRanges();
                    window.getSelection().addRange(range);
                    document.execCommand("copy");
                    window.getSelection().removeAllRanges();

                    couponCode.innerText = "Code copied";
                    couponCode.style.color = "#00FF00";

                }
            </script>
        @endif
    @endpush

</x-front-layout>
