<x-front-layout title="All products">

    <x-slot:breadcrumb>
        <section class="breadcrumb breadcrumb_bg">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="breadcrumb_iner">
                            <div class="breadcrumb_iner_item">
                                <h2>All Products</h2>
                                <p>Home <span>-</span> All Products</p>
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
                <div class="col-lg-3">
                    <form action="{{ route('ProductsFilter') }}" method="POST" id="filter_form">
                        @csrf
                        <div class="left_sidebar_area" name="filter">
                            <aside class="left_widgets p_filter_widgets">
                                <div class="l_w_title">
                                    <h3>Browse Main Categories</h3>
                                </div>
                                <div class="widgets_inner">

                                    <ul class="list" name="mainCategory">
                                        @foreach ($mainCategoriesWithSubCategories as $category)
                                            <li>
                                                <input onchange="filterProducts()" type="checkbox" name="mainCategory"
                                                    value="{{ $category->id }}">
                                                <label>{{ $category->name }}</label>
                                                {{-- <a href="#" value="{{ $category->id }}">{{ $category->name }}</a> --}}
                                            </li>
                                        @endforeach

                                    </ul>
                                </div>
                            </aside>

                            {{-- <aside class="left_widgets p_filter_widgets">
                                <div class="l_w_title">
                                    <h3>Categories</h3>
                                </div>
                                <div class="widgets_inner">
                                    <ul class="list" name="subCategory">
                                        @foreach ($mainCategoriesWithSubCategories as $category)
                                            @foreach ($category->subcategories as $subCategory)
                                                <li>
                                                    <input onchange="filterProducts()" type="checkbox"
                                                        name="subCategory" value="{{ $subCategory->id }}">
                                                    <label>{{ $subCategory->name }}</label>
                                                </li>
                                            @endforeach
                                        @endforeach

                                    </ul>
                                </div>
                            </aside> --}}

                            <aside class="left_widgets p_filter_widgets">
                                <div class="l_w_title">
                                    <h3>Brand filters</h3>
                                </div>
                                <div class="widgets_inner">
                                    <ul class="list" name="brand">
                                        @foreach ($brands as $brand)
                                            <li>
                                                {{-- <a href="#" value="{{ $brand->id }}">{{ $brand->name }}</a> --}}
                                                <input onchange="filterProducts()" type="checkbox" name="brand"
                                                    value="{{ $brand->id }}">
                                                <label>{{ $brand->name }}</label>
                                            </li>
                                        @endforeach

                                    </ul>
                                </div>
                            </aside>

                            {{-- <aside class="left_widgets p_filter_widgets">
                                <div class="l_w_title">
                                    <h3>Color Filter</h3>
                                </div>
                                <div class="widgets_inner">
                                    <ul class="list" name="color">
                                        <li>
                                            <input onchange="filterProducts()" type="checkbox" name="color"
                                                value="black">
                                            <label>Black</label>
                                        </li>
                                        <li>
                                            <input onchange="filterProducts()" type="checkbox" name="color"
                                                value="white">
                                            <label>White</label>
                                        </li>
                                        <li>
                                            <input onchange="filterProducts()" type="checkbox" name="color"
                                                value="blue">
                                            <label>Blue</label>
                                        </li>
                                        <li>
                                            <input onchange="filterProducts()" type="checkbox" name="color"
                                                value="green">
                                            <label>Green</label>
                                        </li>
                                        <li>
                                            <input onchange="filterProducts()" type="checkbox" name="color"
                                                value="pink">
                                            <label>Pink</label>
                                        </li>

                                    </ul>
                                </div>
                            </aside> --}}

                            <aside class="left_widgets p_filter_widgets">
                                <div class="l_w_title">
                                    <h3>Price Filter</h3>

                                </div>
                                <div class="widgets_inner">
                                    <ul class="list" name="price">
                                        <li>
                                            <input onchange="filterProducts()" type="checkbox" name="priceRange"
                                                value="100-1000">
                                            <label>100 - 1000 $</label>
                                        </li>
                                        <li>
                                            <input onchange="filterProducts()" type="checkbox" name="priceRange"
                                                value="1000-5000">
                                            <label>1000 - 5000 $</label>
                                        </li>
                                        <li>
                                            <input onchange="filterProducts()" type="checkbox" name="priceRange"
                                                value="5000-10000">
                                            <label>5000 - 10000 $</label>
                                        </li>
                                        <li>
                                            <input onchange="filterProducts()" type="checkbox" name="priceRange"
                                                value="10000-100000">
                                            <label>10000 - 100000 $</label>
                                        </li>
                                    </ul>
                                </div>
                            </aside>
                        </div>
                    </form>

                </div>
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="product_top_bar d-flex justify-content-between align-items-center">
                                <div class="single_product_menu">
                                    <p><span>{{ $products->count() }} </span> Product Found</p>
                                </div>
                                <form>
                                    {{ csrf_field() }}
                                    <div class="single_product_menu d-flex">
                                        <h5>sort by : </h5>
                                        <select class="form-control SlectBox" id="filterProducts" btn btn-success
                                            btn-md>
                                            <option>-</option>
                                            <option value="price">price</option>
                                            <option value="name">name</option>
                                        </select>
                                    </div>
                                </form>
                                <div class="single_product_menu d-flex">
                                    <h5>show :</h5>
                                    <div class="top_pageniation">
                                        <ul>
                                            <li>1</li>
                                            <li>2</li>
                                            <li>3</li>
                                        </ul>
                                    </div>
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
                        @foreach ($products as $product)
                            <div class="col-lg-4 col-sm-6">
                                <div class="single_product_item">
                                    <img src="{{ asset('storage/' . $product->images->first()->path) }}"
                                        alt="{{ $product->name }}" width="100%" height="200px">

                                    <div class="single_product_text">
                                        <h4>{{ $product->name }}</h4>
                                        <h3>${{ $product->price }}</h3>
                                        <a href="{{ route('product-details', $product->id) }}" class="add_cart">+ add
                                            to cart<i class="ti-heart"></i></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="col-lg-12">
                            {{ $products->withQueryString()->links() }}
                            {{-- <div class="pageination">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-center">
                                        <li class="page-item">
                                            <a class="page-link" href="#" aria-label="Previous">
                                                <i class="ti-angle-double-left"></i>
                                            </a>
                                        </li>
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                                        <li class="page-item"><a class="page-link" href="#">5</a></li>
                                        <li class="page-item"><a class="page-link" href="#">6</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#" aria-label="Next">
                                                <i class="ti-angle-double-right"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div> --}}
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

                $('#filterProducts').on('change', function(event) {
                    event.preventDefault(); // منع تحميل الصفحة
                    var sortBy = $(this).val();

                    $.ajax({
                        type: 'GET',
                        url: '{{ route('sortProducts') }}',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            sortBy: sortBy
                            // _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            // console.log(response);
                            updateProductsSection(response);
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
                });
            });



            function updateProductsSection(products) {
                // قم بحذف جميع المنتجات الحالية
                $('.latest_product_inner').empty();

                var productsHtml = '';
                products.forEach(function(product) {
                    var productHtml = '<div class="col-lg-4 col-sm-6">';
                    productHtml += '<div class="single_product_item">';
                    productHtml += '<img src="{{ asset('storage/') }}/' + product.images[0].path + '" alt="' + product
                        .name + '" width="100%" height="200px">';
                    productHtml += '<div class="single_product_text">';
                    productHtml += '<h4>' + product.name + '</h4>';
                    productHtml += '<h3>$' + product.price + '</h3>';
                    productHtml +=
                        '<a href="/product-details/' + product.id +
                        '" class="add_cart">+ add to cart<i class="ti-heart"></i></a>';
                    productHtml += '</div></div></div>';

                    productsHtml += productHtml;
                });

                // استبدال المحتوى القديم بالمحتوى الجديد
                $('.latest_product_inner').html(productsHtml);

            }

            function filterProducts() {
                $.ajax({
                    type: 'POST',
                    url: '{{ route('ProductsFilter') }}',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: $('#filter_form').serialize(),

                    success: function(response) {
                        // console.log(response);
                        updateProductsDiv(response);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            }

            function updateProductsDiv(response) {
                var products = response.data;

                $('.latest_product_inner').empty();

                var productsHtml = '';
                products.forEach(function(product) {
                    var productHtml = '<div class="col-lg-4 col-sm-6">';
                    productHtml += '<div class="single_product_item">';
                    productHtml += '<img src="{{ asset('storage/') }}/' + product.images[0].path + '" alt="' + product
                        .name + '" width="100%" height="200px">';
                    productHtml += '<div class="single_product_text">';
                    productHtml += '<h4>' + product.name + '</h4>';
                    productHtml += '<h3>$' + product.price + '</h3>';
                    productHtml += '<a href="/product-details/' + product.id +
                        '" class="add_cart">+ add to cart<i class="ti-heart"></i></a>';
                    productHtml += '</div></div></div>';

                    productsHtml += productHtml;
                });

                $('.latest_product_inner').html(productsHtml);
            }
        </script>
    @endpush

    @push('styles')
        <style>
            .left_sidebar_area .widgets_inner ul li {
                display: flex;
                flex-wrap: nowrap;
                justify-content: flex-start;
                align-items: baseline;
            }
        </style>
    @endpush


</x-front-layout>
