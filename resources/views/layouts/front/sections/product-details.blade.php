<x-front-layout title="Product Details">


    <x-alert.alert type="success" />
    <x-alert.alert type="info" />
    <x-alert.alert type="danger" />


    <x-slot:breadcrumb>
        <section class="breadcrumb breadcrumb_bg">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="breadcrumb_iner">
                            <div class="breadcrumb_iner_item">
                                <h2>Product Details</h2>
                                <p>Home <span>-</span>Product Details</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </x-slot:breadcrumb>


    <!--================Single Product Area =================-->
    <div class="product_image_area section_padding">
        <div class="container">
            <div class="row s_product_inner justify-content-between">

                {{-- <div class="col-lg-7 col-xl-7">
                    <div class="product_slider_img">
                        <div id="vertical" class="slick-slider">
                            @foreach ($product->images as $image)
                                <div>
                                    <img src="{{ asset('storage/' . $image->path) }}" alt="{{ $product->name }}" width="500" height="200" />
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div> --}}

                <div class="col-lg-7 col-xl-7">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class='list-unstyled'>
                            @foreach ($product->images as $key => $image)
                                <li data-target="#carouselExampleIndicators" data-slide-to="{{ $key }}"
                                    @if ($loop->first) class="active" @endif></li>
                            @endforeach
                        </ol>
                        <div class="carousel-inner">
                            @foreach ($product->images as $key => $image)
                                <div class="carousel-item @if ($loop->first) active @endif">
                                    <img class="d-block w-100 img-fluid" src="{{ asset('storage/' . $image->path) }}"
                                        alt="{{ $product->name }}">
                                </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                            data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                            data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>

                <div class="col-lg-5 col-xl-4">

                    <div class="s_product_text">
                        <h5>previous <span>|</span> next</h5>
                        <h3>{{ $product->name }}</h3>
                        {{-- add to wishlist --}}

                        {{-- inWishlist --}}
                        {{-- التحقق مما إذا كانت القيمة موجودة --}}
                        <a id="addToWishlist" data-id="{{ $product->id }}"
                            style="{{ $inWishlist ? 'color: red; font-size: 35px;cursor: pointer;' : 'color: black;font-size: 35px;cursor: pointer;' }}">&#x2665;</a>


                        <h2>${{ $product->price }}</h2>
                        <ul class="list">
                            <li>
                                <a class="active" href="#">
                                    <span>Brand</span> : {{ $product->brand->name }}</a>
                            </li>
                            <li>
                                <a href="#"> <span>Availibility</span>
                                    @if ($product->quantity > 0)
                                        : In Stock
                                    @else
                                        : insufficient
                                    @endif
                                </a>
                            </li>
                            <li>
                                BY : <a href="{{ route('vendorProfile', $product->store->id) }}"
                                    class='text-warning'>{{ $product->store->name }}</a>
                            </li>
                        </ul>
                        <p>
                            {{ $product->description }}
                        </p>
                        {{-- add to cart form --}}
                        <div class="card_area d-flex justify-content-between align-items-center">
                            <form action="{{ route('cart.store') }}" method="post">
                                @csrf
                                <div class="product_count">
                                    <span class="inumber-decrement"> <i class="ti-minus"></i></span>
                                    <input class="input-number" type="number" value="1" min="0"
                                        name="quantity" max="{{ $product->quantity }}">
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <span class="number-increment"> <i class="ti-plus"></i></span>
                                </div>

                                {{-- options & value for product --}}
                                <div class="form-group">
                                    @foreach ($optionsWithValues as $option_name => $values)
                                        <label>Select {{ $option_name }}:</label>
                                        <select name="selected_options[{{ $values->first()->option->id }}][]"
                                            class="form-control form-select" multiple
                                            onchange="printSelectedValues(this)">
                                            <option value="" disabled selected>Select {{ $option_name }}(s)
                                            </option>

                                            @foreach ($values as $value)
                                                <option value="{{ $value->optionValue->id }}" class="nice-select">
                                                    {{ $value->optionValue->name }}</option>
                                            @endforeach

                                        </select>
                                        <br>
                                    @endforeach
                                </div>




                                @if ($product->quantity > 0)
                                    <button class="btn_3" type="submit">add to cart</button>
                                @else
                                    <button class="btn_3" type="submit" disabled>add to cart</button>
                                @endif

                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!--================End Single Product Area =================-->

    <!--================Product Description Area =================-->
    <section class="product_description_area">
        <div class="container">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab"
                        aria-controls="home" aria-selected="true">Description</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                        aria-controls="profile" aria-selected="false">Specification</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                        aria-controls="contact" aria-selected="false">Comments</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" id="review-tab" data-toggle="tab" href="#review" role="tab"
                        aria-controls="review" aria-selected="false">Reviews</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <p>
                        Beryl Cook is one of Britain’s most talented and amusing artists
                        .Beryl’s pictures feature women of all shapes and sizes enjoying
                        themselves .Born between the two world wars, Beryl Cook eventually
                        left Kendrick School in Reading at the age of 15, where she went
                        to secretarial school and then into an insurance office. After
                        moving to London and then Hampton, she eventually married her next
                        door neighbour from Reading, John Cook. He was an officer in the
                        Merchant Navy and after he left the sea in 1956, they bought a pub
                        for a year before John took a job in Southern Rhodesia with a
                        motor company. Beryl bought their young son a box of watercolours,
                        and when showing him how to use it, she decided that she herself
                        quite enjoyed painting. John subsequently bought her a child’s
                        painting set for her birthday and it was with this that she
                        produced her first significant work, a half-length portrait of a
                        dark-skinned lady with a vacant expression and large drooping
                        breasts. It was aptly named ‘Hangover’ by Beryl’s husband and
                    </p>
                    <p>
                        It is often frustrating to attempt to plan meals that are designed
                        for one. Despite this fact, we are seeing more and more recipe
                        books and Internet websites that are dedicated to the act of
                        cooking for one. Divorce and the death of spouses or grown
                        children leaving for college are all reasons that someone
                        accustomed to cooking for more than one would suddenly need to
                        learn how to adjust all the cooking practices utilized before into
                        a streamlined plan of cooking that is more efficient for one
                        person creating less
                    </p>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>
                                        <h5>Width</h5>
                                    </td>
                                    <td>
                                        <h5>128mm</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5>Height</h5>
                                    </td>
                                    <td>
                                        <h5>508mm</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5>Depth</h5>
                                    </td>
                                    <td>
                                        <h5>85mm</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5>Weight</h5>
                                    </td>
                                    <td>
                                        <h5>52gm</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5>Quality checking</h5>
                                    </td>
                                    <td>
                                        <h5>yes</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5>Freshness Duration</h5>
                                    </td>
                                    <td>
                                        <h5>03days</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5>When packeting</h5>
                                    </td>
                                    <td>
                                        <h5>Without touch of hand</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5>Each Box contains</h5>
                                    </td>
                                    <td>
                                        <h5>60pcs</h5>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- comments --}}
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="comment_list">
                                {{-- <livewire:comments :model="$product"/> --}}
                                <livewire:comments :model="$product" icon="fas fa-arrow-alt-circle-left" />

                            </div>
                        </div>
                        {{-- <div class="col-lg-6">
              <div class="review_box">
                <h4>Post a comment</h4>

              </div>
            </div> --}}
                    </div>
                </div>
                {{-- end comment div --}}
                {{-- start review  --}}
                <div class="tab-pane fade show active" id="review" role="tabpanel" aria-labelledby="review-tab">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="row total_rate">
                                <div class="col-6">
                                    <div class="box_total">
                                        <h5>Overall</h5>
                                        <h4>{{ $overAllRatings }}</h4>
                                        <h6>({{ $countRating }} Reviews)</h6>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="rating_list">
                                        <h3>Based on 3 Reviews</h3>
                                        <ul class="list">

                                            @foreach ($ratings_count as $star => $count)
                                                <li>
                                                    <a href="#">{{ $star }} Star
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            @if ($i <= $star)
                                                                <span class="star-yellow ">&#9733;</span>
                                                            @else
                                                                <span>&#9733;</span>
                                                            @endif
                                                        @endfor

                                                        {{ $count }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            {{--  all reviews with comment  --}}
                            <div class="review_list">
                                @php
                                    $statusByStar = '';
                                @endphp
                                @foreach ($product->reviews as $reviews)
                                    <div class="review_item">
                                        <div class="media">
                                            <div class="d-flex">
                                                <img src="{{ asset('img/product/single-product/review-1.png') }}"
                                                    alt="" />
                                            </div>
                                            <div class="media-body">
                                                <h4>{{ $reviews->user->name }}</h4>
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $reviews->rating)
                                                        <span class="star-yellow ">&#9733;</span>
                                                    @else
                                                        <span>&#9733;</span>
                                                    @endif
                                                @endfor
                                                @if ($reviews->rating < 3)
                                                    <span class='text-danger'>poor</span>
                                                @elseif ($reviews->rating == 3)
                                                    <span class='text-warning'>average</span>
                                                @elseif ($reviews->rating == 4)
                                                    <span class='text-blue'>Good</span>
                                                @elseif ($reviews->rating == 5)
                                                    <span class='text-success'>amazing</span>
                                                @endif


                                            </div>
                                        </div>
                                        <p>
                                            {{ $reviews->comment }}
                                        </p>
                                        <span>{{ date('d-m-y', strtotime($reviews->created_at)) }}</span>
                                    </div>
                                @endforeach


                            </div>
                        </div>
                        {{-- review form --}}

                        @if (!Auth::guard('web')->check())
                            <div class="col-lg-6">
                                <div class="review_box">
                                    <h4>Add a Review</h4>
                                    <p class='btn btn-danger'><a href="{{ route('login') }}" class='text-white'>
                                            Login first to review
                                            this product</a></p>
                                </div>
                            </div>
                        @else
                            <div class="col-lg-6">
                                <div class="review_box">
                                    <h4>Add a Review</h4>

                                    <form class="row contact_form" action="{{ route('product.review') }}"
                                        method="post" novalidate="novalidate">
                                        @csrf
                                        @method('POST')
                                        <br>
                                        <p>Your Rating:</p>
                                        <div class="rate list">
                                            <input type="radio" id="star5" name="rating" value="5" />
                                            <label for="star5" title="text">5 stars</label>
                                            <input type="radio" id="star4" name="rating" value="4" />
                                            <label for="star4" title="text">4 stars</label>
                                            <input type="radio" id="star3" name="rating" value="3" />
                                            <label for="star3" title="text">3 stars</label>
                                            <input type="radio" id="star2" name="rating" value="2" />
                                            <label for="star2" title="text">2 stars</label>
                                            <input type="radio" id="star1" name="rating" value="1" />
                                            <label for="star1" title="text">1 star</label>
                                        </div>

                                        <p>Outstanding</p>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="hidden" class="form-control" name="product_id"
                                                    value="{{ $product->id }}" />
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="email" class="form-control" name="email"
                                                    placeholder="Email Address" />
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <textarea class="form-control" name="comment" rows="1" placeholder="Review"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12 text-right">
                                            <button type="submit" value="submit" class="btn_3">
                                                Submit Now
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
                {{-- end review  --}}

            </div>
        </div>
    </section>
    <!--================End Product Description Area =================-->


    @push('scripts')
        <script>
            function printSelectedValues(selectElement) {
                // Get the selected option value
                var selectedValue = selectElement.value;

                // Get the corresponding option and value IDs
                var optionId = selectElement.name.match(/\[(\d+)\]\[\]/)[1];
                var valueId = selectedValue;

                // Print the values to the console
                console.log('Option ID:', optionId);
                console.log('Value ID:', valueId);
            }


            // select rating value
            let selectedRating = 0;

            function setRating(event, rating) {
                event.preventDefault(); // Prevent default action of link
                selectedRating = rating;
                updateStars();
                document.getElementById('rating').value = rating;
            }

            function updateStars() {
                const stars = document.querySelectorAll('#starRating a i');
                stars.forEach((star, index) => {
                    if (index < selectedRating) {
                        star.classList.add('selected');
                    } else {
                        star.classList.remove('selected');
                    }
                });
            }
        </script>

        <script>
            $(document).ready(function() {
                var isAddedToWishlist = false;

                $('#addToWishlist').on('click', function(event) {
                    event.preventDefault();
                    var productId = $(this).data('id');

                    if (!isAddedToWishlist) {
                        $.ajax({
                            type: 'POST',
                            url: '/wishlist/' + productId,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: $('#wishlistForm').serialize(),
                            success: function(response) {
                                console.log(response);
                                // تغيير اللون إلى أحمر بعد إضافة المنتج
                                $('#addToWishlist').css('color', 'red');
                                // $('#addToWishlist').css('background-color', 'red');

                                isAddedToWishlist = true;
                            },
                            error: function(error) {
                                console.log(error);
                            }
                        });
                    } else {
                        $.ajax({
                            type: 'DELETE',
                            url: '/wishlist/delete/' + productId,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                console.log(response);
                                // إزالة اللون الأحمر بعد إزالة المنتج
                                $('#addToWishlist').css('color', '');
                                // $('#addToWishlist').css('background-color', '');


                                isAddedToWishlist = false;
                            },
                            error: function(error) {
                                console.log(error);
                            }
                        });
                    }
                });
            });
        </script>
    @endpush

    @push('styles')
        <style>
            .review_box .list {
                margin-top: -.5em;
            }

            .rate {
                float: left;
                height: 46px;
                padding: 0 9px;
            }

            .rate:not(:checked)>input {
                position: absolute;
                top: -9999px;
            }

            .rate:not(:checked)>label {
                float: right;
                width: 1em;
                overflow: hidden;
                white-space: nowrap;
                cursor: pointer;
                font-size: 30px;
                color: #ccc;
            }

            .rate:not(:checked)>label:before {
                content: '★ ';
            }

            .rate>input:checked~label {
                /* color: #ffc700; */
                color: yellow;


            }

            .rate:not(:checked)>label:hover,
            .rate:not(:checked)>label:hover~label {
                /* color: #deb217; */
                color: yellow;

            }

            .rate>input:checked+label:hover,
            .rate>input:checked+label:hover~label,
            .rate>input:checked~label:hover,
            .rate>input:checked~label:hover~label,
            .rate>label:hover~input:checked~label {
                /* color: #c59b08; */
                color: yellow;

            }

            .star-yellow {
                color: yellow;
            }

            #carouselExampleIndicators {
                max-width: 400px;
                /* تحديد العرض الأقصى للسلايدر */
                max-height: 300px;
                /* تحديد الارتفاع الأقصى للسلايدر */
                margin: 0 auto;
                /* توسيط السلايدر في الصفحة */
            }

            .carousel-control-prev-icon,
            .carousel-control-next-icon {
                background-color: #ff3368;
                /* لون الأسهم */
            }

            .carousel-control-prev {
                margin-left: -5em;
            }

            .carousel-control-next {
                margin-right: -5em;
            }
        </style>
    @endpush


</x-front-layout>
