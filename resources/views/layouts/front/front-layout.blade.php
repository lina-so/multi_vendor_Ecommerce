<!doctype html>
<html lang="zxx">

<head>
    <!-- Required meta tags -->

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}

    <title>{{ $title }}</title>
    <link rel="icon" href="img/favicon.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('front/css/bootstrap.min.css') }}">
    <!-- animate CSS -->
    <link rel="stylesheet" href="{{ asset('front/css/animate.css') }}">
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="{{ asset('front/css/owl.carousel.min.css') }}">

    {{-- <link rel="stylesheet" href="{{ asset('front/lightslider.min.css') }}"> --}}

    <!-- font awesome CSS -->
    <link rel="stylesheet" href="{{ asset('front/css/all.css') }}">
    <!-- flaticon CSS -->
    <link rel="stylesheet" href="{{ asset('front/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/themify-icons.css') }}">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="{{ asset('front/css/magnific-popup.css') }}">
    <!-- swiper CSS -->
    <link rel="stylesheet" href="{{ asset('front/css/slick.css') }}">
    <!-- style CSS -->
    <link rel="stylesheet" href="{{ asset('front/css/style.css') }}">

    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css" />


    @stack('styles')
</head>

<body>
    <!--::header part start::-->
    <!--::header part start::-->
    <header class="main_menu home_menu">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <a class="navbar-brand" href="index.html"> <img src="{{ asset('img/logo.png') }}"
                                alt="logo"> </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="menu_icon"><i class="fas fa-bars"></i></span>
                        </button>

                        <div class="collapse navbar-collapse main-menu-item" id="navbarSupportedContent">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('getAllProducts') }}">All</a>
                                </li>
                                @foreach ($mainCategoriesWithSubCategories as $mainCategory)
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="blog.html" id="navbarDropdown_1"
                                            role="button" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            {{ $mainCategory->name }}
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown_1">
                                            @foreach ($mainCategory->subcategories as $subcategory)
                                                <a class="dropdown-item" href="category.html">
                                                    {{ $subcategory->name }}</a>
                                            @endforeach
                                        </div>
                                    </li>
                                @endforeach

                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown_1"
                                        role="button" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        Others
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown_1">
                                        <a class="dropdown-item" href="{{ route('getAllOffers') }}">
                                            offers</a>
                                        <a class="dropdown-item" href="{{ route('getAllCoupons') }}">
                                            Coupons</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="hearer_icon d-flex">
                            {{-- guest --}}
                            @if (Auth::guard('admin')->check())
                                <li class="nav-item dropdown list-unstyled">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#"
                                        role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false" v-pre>
                                        {{ Auth::guard('admin')->user()->name }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @elseif (Auth::guard('vendor')->check())
                                <li class="nav-item dropdown list-unstyled">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#"
                                        role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false" v-pre>
                                        {{ Auth::guard('vendor')->user()->name }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @else
                                @guest
                                    <a href="{{ route('register-as') }}">register</a>
                                @else
                                    <li class="nav-item dropdown list-unstyled">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#"
                                            role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false" v-pre>
                                            {{ Auth::user()->name }}
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                class="d-none">
                                                @csrf
                                            </form>
                                        </div>
                                    </li>
                                @endguest
                            @endif


                            {{-- end guest --}}
                            <a id="search_1" href="javascript:void(0)"><i class="ti-search"></i></a>
                            <a href="{{ route('wishlist.index') }}"><i class="ti-heart"></i></a>
                            <div class="dropdown cart">
                                <a href="{{ route('cart.index') }}" role="button" aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="ti-shopping-cart"></i>
                                    @if ($cartCount >= 0)
                                        <span class="badge badge-pill badge-danger">{{ $cartCount }}</span>
                                    @endif
                                </a>


                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>

    </header>
    <!-- Header part end-->

    <!-- Header part end-->


    <!--================Home Banner Area =================-->
    <!-- breadcrumb start-->

    {{ $breadcrumb ?? '' }}

    <!-- End Breadcrumbs -->

    {{-- @yield('content') --}}
    {{ $slot }}

    <!--::footer_part start::-->
    <footer class="footer_part">
        <div class="container">
            <div class="row justify-content-around">
                <div class="col-sm-6 col-lg-2">
                    <div class="single_footer_part">
                        <h4>Top Products</h4>
                        <ul class="list-unstyled">
                            <li><a href="">Managed Website</a></li>
                            <li><a href="">Manage Reputation</a></li>
                            <li><a href="">Power Tools</a></li>
                            <li><a href="">Marketing Service</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-2">
                    <div class="single_footer_part">
                        <h4>Quick Links</h4>
                        <ul class="list-unstyled">
                            <li><a href="">Jobs</a></li>
                            <li><a href="">Brand Assets</a></li>
                            <li><a href="">Investor Relations</a></li>
                            <li><a href="">Terms of Service</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-2">
                    <div class="single_footer_part">
                        <h4>Features</h4>
                        <ul class="list-unstyled">
                            <li><a href="">Jobs</a></li>
                            <li><a href="">Brand Assets</a></li>
                            <li><a href="">Investor Relations</a></li>
                            <li><a href="">Terms of Service</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-2">
                    <div class="single_footer_part">
                        <h4>Resources</h4>
                        <ul class="list-unstyled">
                            <li><a href="">Guides</a></li>
                            <li><a href="">Research</a></li>
                            <li><a href="">Experts</a></li>
                            <li><a href="">Agencies</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="single_footer_part">
                        <h4>Newsletter</h4>
                        <p>Heaven fruitful doesn't over lesser in days. Appear creeping
                        </p>
                        <div id="mc_embed_signup">
                            <form target="_blank"
                                action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"
                                method="get" class="subscribe_form relative mail_part">
                                <input type="email" name="email" id="newsletter-form-email"
                                    placeholder="Email Address" class="placeholder hide-on-focus"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = ' Email Address '">
                                <button type="submit" name="submit" id="newsletter-submit"
                                    class="email_icon newsletter-submit button-contactForm">subscribe</button>
                                <div class="mt-10 info"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="copyright_part">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="copyright_text">
                            <P><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                Copyright &copy;
                                <script>
                                    document.write(new Date().getFullYear());
                                </script> All rights reserved | This template is made with <i
                                    class="ti-heart" aria-hidden="true"></i> by <a href="https://colorlib.com"
                                    target="_blank">Colorlib</a>
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            </P>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="footer_icon social_icon">
                            <ul class="list-unstyled">
                                <li><a href="#" class="single_social_icon"><i
                                            class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#" class="single_social_icon"><i class="fab fa-twitter"></i></a>
                                </li>
                                <li><a href="#" class="single_social_icon"><i class="fas fa-globe"></i></a>
                                </li>
                                <li><a href="#" class="single_social_icon"><i class="fab fa-behance"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--::footer_part end::-->

    <!-- jquery plugins here-->
    <!-- jquery -->
    <script src="{{ asset('front/js/jquery-3.7.1.min.js') }}"></script>

    {{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    {{-- slider --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $('.slick-slider').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: true,
                dots: true,
                // Add other options as needed
            });
        });
    </script>
    <!-- popper js -->
    <script src="{{ asset('front/js/popper.min.js') }}"></script>
    <!-- bootstrap js -->
    <script src="{{ asset('front/js/bootstrap.min.js') }}"></script>
    <!-- easing js -->
    <script src="{{ asset('front/js/jquery.magnific-popup.js') }}"></script>
    <!-- swiper js -->
    <script src="{{ asset('front/js/swiper.min.js') }}"></script>
    <!-- swiper js -->
    <script src="{{ asset('front/js/masonry.pkgd.js') }}"></script>
    <!-- particles js -->
    <script src="{{ asset('front/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('front/js/jquery.nice-select.min.js') }}"></script>
    <!-- slick js -->
    <script src="{{ asset('front/js/slick.min.js') }}"></script>
    <script src="{{ asset('front/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('front/js/waypoints.min.js') }}"></script>
    <script src="{{ asset('front/js/contact.js') }}"></script>
    <script src="{{ asset('front/js/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('front/js/jquery.form.js') }}"></script>
    <script src="{{ asset('front/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('front/js/mail-script.js') }}"></script>
    <script src="{{ asset('front/js/stellar.js') }}"></script>
    <script src="{{ asset('front/js/price_rangs.js') }}"></script>

    <!-- custom js -->
    {{-- <script src="{{ asset('front/js/custom.js') }}"></script> --}}
    @stack('scripts')
</body>

</html>
