<x-front-layout title="offers">

    <x-alert.alert type="success" />
    <x-alert.alert type="info" />

    <!--================Cart Area =================-->

    <section>
        @if ($items && $items->count() > 0)

            <!-- product_list start-->
            <section class="product_list section_padding">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <div class="section_tittle text-center">
                                <h3>Offers <span>shop</span></h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="product_list_slider d-flex justify-content-between">
                                <div class="single_product_list_slider">
                                    <div class="row align-items-center justify-content-between">

                                        @foreach ($items as $product)
                                            @if ($product && $product->count() > 0)
                                                <div class="col-lg-4 col-sm-6">
                                                    <div class="single_product_item">
                                                        <img src="{{ asset('storage/' . $product->images->first()->path) }}"
                                                            alt="{{ $product->name }}" width="100%" height="200px">

                                                        <div class="single_product_text">
                                                            <h4>{{ $product->name }}</h4>
                                                            @if (isset($product->offer) && $product->compare_price !== 0.0)
                                                                <span class="text-danger"
                                                                    style="text-decoration: line-through;">${{ $product->price }}</span>
                                                                @php
                                                                    $discountedPrice =
                                                                        $product->price -
                                                                        ($product->price * $product->compare_price) /
                                                                            100;
                                                                @endphp
                                                                <span>${{ $discountedPrice }}</span>
                                                            @else
                                                                <span>${{ $product->price }}</span>
                                                            @endif
                                                            </span>

                                                            <span><a href="{{ route('product-details', $product->id) }}"
                                                                    class="add_cart">+ add to cart</a></span>

                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


            <!-- product_list part start-->
        @else
            <p class='btn btn-warning'> No offers Define</p>
        @endif

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



</x-front-layout>
