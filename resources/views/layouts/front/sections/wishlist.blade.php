<x-front-layout title="Wishlist">

    <x-slot:breadcrumb>
        <section class="breadcrumb breadcrumb_bg">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="breadcrumb_iner">
                            <div class="breadcrumb_iner_item">
                                <h2>wishlist Products</h2>
                                <p>Home <span>-</span> wishlist Products</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </x-slot:breadcrumb>

    <x-alert.alert type="success" />
    <x-alert.alert type="info" />


    <!--================Category Product Area =================-->
    <section class="cat_product_area section_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="product_top_bar d-flex justify-content-between align-items-center">
                                <div class="single_product_menu">
                                    <p><span>{{ $products->count() }} </span> Product Found</p>
                                </div>

                                <div class="single_product_menu d-flex">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="search"
                                            aria-describedby="inputGroupPrepend">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupPrepend"><i
                                                    class="ti-search"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row align-items-center latest_product_inner">
                        @php
                            $wishlistProductsCount = count($data['wishlistProducts']);
                        @endphp
                        @forelse ($data['wishlistProducts'] as $product)
                            <div class="col-lg-4 col-sm-6">
                                <div class="single_product_item">
                                    <img src="{{ asset('storage/' . $product->images->first()->path) }}"
                                        alt="{{ $product->name }}" width="100%" height="200px">

                                    <div class="single_product_text">
                                        <h4>{{ $product->name }}</h4>
                                        <h3>${{ $product->price }}</h3>
                                        <a href="{{ route('product-details', $product->id) }}" class="add_cart">+ add
                                            to cart</a>
                                        {{-- inWishlist --}}
                                        {{-- التحقق مما إذا كانت القيمة موجودة --}}
                                        <a id="addToWishlist{{ $product->id }}" data-id="{{ $product->id }}"
                                            class="addToWishlist"
                                            style="{{ $data['inWishlist'] ? 'color: red; font-size: 35px;cursor: pointer;' : 'color: black;font-size: 35px;cursor: pointer;' }}">&#x2665;</a>

                                    </div>
                                </div>
                            </div>
                        @empty
                        @endforelse

                        <div class="col-lg-12">
                            {{ $products->withQueryString()->links() }}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Category Product Area =================-->


    @push('scripts')
        <script>
            $(document).ready(function() {
                var isAddedToWishlist = false;

                {!! $wishlistProductsCount > 0
                    ? '
                    document.querySelectorAll(".addToWishlist").forEach(function(element) {
                        element.addEventListener("click", function(event) {
                            event.preventDefault();
                            var productId = element.getAttribute("data-id");

                            if (!isAddedToWishlist) {
                                $.ajax({
                                    type: "POST",
                                    url: "/wishlist/" + productId,
                                    headers: {
                                        "X-CSRF-TOKEN": $("meta[name=\'csrf-token\']").attr("content")
                                    },
                                    data: $("#wishlistForm").serialize(),
                                    success: function(response) {
                                        console.log(response);
                                        element.style.color = "red";
                                        isAddedToWishlist = true;
                                    },
                                    error: function(error) {
                                        console.log(error);
                                    }
                                });
                            } else {
                                $.ajax({
                                    type: "DELETE",
                                    url: "/wishlist/delete/" + productId,
                                    headers: {
                                        "X-CSRF-TOKEN": $("meta[name=\'csrf-token\']").attr("content")
                                    },
                                    success: function(response) {
                                        console.log(response);
                                        element.style.color = "";
                                        isAddedToWishlist = false;
                                    },
                                    error: function(error) {
                                        console.log(error);
                                    }
                                });
                            }
                        });
                    });
                   
            });
        </script>
    @endpush

    @push('styles')
    @endpush


</x-front-layout>
