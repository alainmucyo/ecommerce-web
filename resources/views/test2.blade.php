<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta http-equiv="x-ua-compatible" content="ie=edge"/>
    <meta name="robots" content="noindex, follow"/>
    <meta name="description" content="david's high deals for shopping different styles you need"/>
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon/favicon.png"/>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>David's-High-Deals | Home</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">


    <!-- Styles -->
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            margin: 0;
            background-color: #fff !important;
        }

        [hidden] {
            display: none
        }

        .dropdown-toggle::after {
            display: none !important;
        }

        .header-tools .dropdown ul.dropdown-menu {
            margin: 0;
            top: 15px !important;
            right: 0;
            left: auto !important;
            min-width: 130px;
            overflow: hidden;
            border-radius: 0;
            border: 1px solid #ebebeb;
            background: #fff none repeat scroll 0 0;
            box-shadow: 0 1px 7px -2px rgb(0, 0, 0.3);
            transform: rotateX(
                90deg
            );
            transform-origin: center top 0;
        }

        .label {
            border-radius: 4px;
            font-size: 75%;
            padding: 4px 7px;
            margin-right: 5px;
            font-weight: 400;
            color: #fff;
        }

        .label-danger {
            background: #ff5370;
        }

        .media {
            display: flex;
            align-items: flex-start;
        }

        .media-body {
            flex: 1;
        }
    </style>
    <!-- Styles -->
    <link rel="stylesheet" href="assets/css/vendor/vendor.min.css"/>
    <link rel="stylesheet" href="assets/css/plugins/plugins.min.css"/>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/style.min.css">

    <link href="/assets/files/assets/icon/feather/css/feather.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack("style")
</head>
<body id="top">
<div id="app">
    {{-- @include('sweet::alert') --}}
    <header class="header-wrapper">
        <!-- Header Nav Start -->
        <div class="header-nav">
            <div class="mx-5">
                <div class="header-nav-wrapper d-md-flex d-sm-flex d-xl-flex d-lg-flex justify-content-between">
                    <div class="header-static-nav">
                        <p class="mb-0">Welcome to DH-Deals!</p>
                    </div>
                    <div class="header-menu-nav">
                        <ul class="menu-nav mb-0">
                            @guest
                                <li><a href="/login">Sign in</a></li>
                                <li><a href="/register">Register</a></li>
                            @else
                                <li>
                                    <div class="dropdown">
                                        <button type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">Setting <i
                                                class="ion-ios-arrow-down"></i></button>
                                        <ul class="dropdown-menu animation slideDownI"
                                            aria-labelledby="dropdownMenuButton">
                                            <li><a href="/checkout">Checkout</a></li>

                                            @role("customer")
                                            <li><a href="/chatbox/customer">Message</a></li>
                                            <li><a href="/orders">Orders</a></li>
                                            <li><a href="/customer/profile">My account</a></li>
                                            @endrole
                                            @role("admin" || "seller")
                                            <li><a href="/home">Dashboard</a></li>
                                            @endrole
                                            <li><a href="/logout">Logout</a></li>
                                        </ul>
                                    </div>
                                </li>
                            @endguest
                            <li class="pr-0">
                                <div class="dropdown">
                                    <button type="button" id="dropdownMenuButton-2" data-toggle="dropdown"
                                            aria-haspopup="true"
                                            aria-expanded="false">{{ mb_strtoupper(currentCurrency()) }}<i
                                            class="ion-ios-arrow-down ml-1"></i></button>
                                    <ul class="dropdown-menu animation slideDownIn"
                                        aria-labelledby="dropdownMenuButton-2">
                                        <li><a href="{{ route("currency.change","rwf") }}">RWF F</a></li>
                                        <li><a href="{{ route("currency.change","usd") }}">USD $</a></li>
                                        <li><a href="{{ route("currency.change","dirham") }}">Dirham</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header Nav End -->
        <div class="header-top bg-white ptb-30px d-xl-block d-none sticky-nav">
            <div class="mx-5">
                <div class="row">
                    <div class="col-md-3 d-flex">
                        <div class="mobile-menu-toggle home-2 my-auto">
                            <a href="#offcanvas-mobile-menu" class="offcanvas-toggle text-decoration-none">
                                <svg viewBox="0 0 800 600">
                                    <path
                                        d="M300,220 C300,220 520,220 540,220 C740,220 640,540 520,420 C440,340 300,200 300,200"
                                        id="top"></path>
                                    <path d="M300,320 L540,320" id="middle"></path>
                                    <path
                                        d="M300,210 C300,210 520,210 540,210 C740,210 640,530 520,410 C440,330 300,190 300,190"
                                        id="bottom"
                                        transform="translate(480, 320) scale(1, -1) translate(-480, -318) "></path>
                                </svg>
                            </a>
                        </div>
                        <div class="logo">
                            <a href="/"><img class="img-responsive h-100" src="/img/DHD2_logo.jpg"
                                             style="width: 85%"
                                             alt="logo.png"/></a>
                        </div>
                    </div>
                    <div class="col-md-9 align-self-center">
                        <div class="header-right-element d-flex">
                            <div class="search-element media-body mr-120px">
                                <form class="d-flex" action="/shop">
                                    <div class="search-category">
                                        <select name="category">
                                            <option value="all">All categories</option>
                                            @if($categories->count() >0)
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->slug }}"
                                                            id="{{ $category->name }}">{{ $category->name }}</option>
                                                @endforeach
                                            @else
                                                <option value="null" disabled class="text-danger">No Categories Found
                                                </option>
                                            @endif
                                        </select>
                                    </div>
                                    <input type="text" name="query" value="{{ request("query") }}"
                                           placeholder="Enter your search key ... "/>
                                    <button type="submit"><i class="icon-magnifier"></i></button>
                                </form>
                            </div>
                            <!--Cart info Start -->

                            <div class="header-tools d-flex">
                                @role("customer")
                                <div class="dropdown-primary dropdown">
                                    <div class="cart-info d-flex align-self-center mr-3 dropdown-toggle"
                                         data-toggle="dropdown">
                                        @if($undelivered>0 || $unread_messages>0)
                                            <a href="javascript:void(0)" class="bag text-decoration-none"
                                               data-number="{{ $undelivered + $unread_messages}}"><i
                                                    class="feather icon-bell"></i></a>
                                        @else
                                            <a href="javascript:void(0)" class="text-decoration-none"
                                               data-number="0"><i class="feather icon-bell"></i></a>
                                        @endif
                                    </div>
                                    @if($undelivered>0 || $unread_messages>0)
                                        <ul class="show-notification notification-view dropdown-menu"
                                            data-dropdown-in="fadeIn"
                                            data-dropdown-out="fadeOut"
                                            style="min-width: 225px;right: -25% !important;top: 15px !important;">
                                            <li class="d-flex">
                                                <h6>Notifications</h6>
                                                @if( $undelivered>0 || $unread_messages>0)
                                                    <label class="label label-danger ml-auto h-100">New</label>
                                                @endif
                                            </li>
                                            <li>
                                                <div class="media">
                                                    <div class="media-body">
                                                        @if($undelivered>0)
                                                            <h5 class="notification-user"><b>Undelivered
                                                                    orders</b></h5>
                                                            <p class="notification-msg mb-0">You
                                                                have {{ $undelivered }}
                                                                undelivered
                                                                product(s)
                                                                orders.</p>
                                                        @endif
                                                        @if($unread_messages>0)
                                                            <h5 class="notification-user"><b>Unread messages</b>
                                                            </h5>
                                                            <p class="notification-msg">You
                                                                have {{ $unread_messages }}
                                                                unread
                                                                messages from seller(s).</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    @endif
                                </div>
                                @endrole
                                <div class="cart-info d-flex align-self-center">
                                    @if(count($cart_products)>0)
                                        <a href="#offcanvas-cart" class="bag offcanvas-toggle text-decoration-none"
                                           data-number="{{$cart_products->count()}}"><i
                                                class="icon-bag"></i><span>{{$sum}}</span></a>
                                    @else
                                        <a href="#offcanvas-cart" class="bag offcanvas-toggle text-decoration-none"
                                           data-number="0"><i class="icon-bag"></i><span>{{$sum}}</span></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!--Cart info End -->
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header Section End Here -->

    <!-- Mobile Header Section Start -->
    <div class="mobile-header d-xl-none sticky-nav bg-white ptb-10px">
        <div class="container">
            <div class="row align-items-center">

                <!-- Header Logo Start -->
                <div class="col">
                    <div class="header-logo">
                        <a href="#"><img class="img-responsive" src="/img/dhd_logo.png" alt="logo.png"/></a>
                    </div>
                </div>
                <!-- Header Logo End -->

                <!-- Header Tools Start -->
                <div class="col-auto">
                    <div class="header-tools justify-content-end">
                        <div class="cart-info d-flex align-self-center">
                            @if(count($cart_products)>0)
                                <a href="#offcanvas-cart" class="bag offcanvas-toggle text-decoration-none"
                                   data-number="{{$cart_products->count()}}"><i
                                        class="icon-bag"></i><span>{{$sum}}</span></a>
                            @else
                                <a href="#offcanvas-cart" class="bag offcanvas-toggle text-decoration-none"
                                   data-number="0"><i class="icon-bag"></i><span>{{$sum}}</span></a>
                            @endif
                        </div>
                        <div class="mobile-menu-toggle">
                            <a href="#offcanvas-mobile-menu" class="offcanvas-toggle text-decoration-none">
                                <svg viewBox="0 0 800 600">
                                    <path
                                        d="M300,220 C300,220 520,220 540,220 C740,220 640,540 520,420 C440,340 300,200 300,200"
                                        id="top"></path>
                                    <path d="M300,320 L540,320" id="middle"></path>
                                    <path
                                        d="M300,210 C300,210 520,210 540,210 C740,210 640,530 520,410 C440,330 300,190 300,190"
                                        id="bottom"
                                        transform="translate(480, 320) scale(1, -1) translate(-480, -318) "></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Header Tools End -->

            </div>
        </div>
    </div>

    <!-- Search Category Start -->
    <div class="mobile-search-area d-xl-none mb-15px">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="search-element media-body">
                        <form class="d-flex" action="/shop">
                            <div class="search-category">
                                <select name="category">
                                    <option value="all">All categories</option>
                                    @if($categories->count())>0)
                                    @foreach($categories as $category)
                                        <option value="{{ $category->slug }}"
                                                id="{{ $category->name }}">{{ $category->name }}</option>
                                    @endforeach
                                    @else
                                        <option value="all" disabled class="text-danger">No Categories Found
                                        </option>
                                    @endif
                                </select>
                            </div>
                            <input type="text" name="query" value="{{ request("query") }}"
                                   placeholder="Enter your search key ... "/>
                            <button type="submit"><i class="icon-magnifier"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Search Category End -->
    <div class="mobile-category-nav d-xl-none mb-15px">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <!--=======  category menu  =======-->
                    <div class="hero-side-category">
                        <!-- Category Toggle Wrap -->
                        <div class="category-toggle-wrap">
                            <!-- Category Toggle -->
                            <button class="category-toggle"><i class="fa fa-bars"></i> All Categories</button>
                        </div>

                        <!-- Category Menu -->
                        <nav class="category-menu">
                            <ul>
                                @if($categories->count()>0)
                                    @foreach($categories as $category)
                                        <li><a href="#">{{ $category->name }}</a></li>
                                    @endforeach
                                @else
                                    <li class="text-danger"><a href="#">No Categories Found</a></li>
                                @endif
                                {{--                                <li class="hidden"><a href="#">Projectors</a></li>--}}
                                {{--                                <li>--}}
                                {{--                                    <a href="#" id="more-btn"><i class="ion-ios-plus-empty" aria-hidden="true"></i> More--}}
                                {{--                                        Categories</a>--}}
                                {{--                                </li>--}}
                            </ul>
                        </nav>
                    </div>

                    <!--=======  End of category menu =======-->
                </div>
            </div>
        </div>
    </div>
    <!-- Mobile Header Section End -->
    <!-- OffCanvas Cart Start -->
    <div id="offcanvas-cart" class="offcanvas offcanvas-cart">
        <div class="inner">
            <div class="head">
                <span class="title">Cart</span>
                <button class="offcanvas-close">×</button>
            </div>
            <div class="body customScroll">
                <ul class="minicart-product-list">
                    @guest
                        <div class="col-md-12">
                            <div class="alert alert-info text-center">No Cart Available For You Please Login.</div>
                        </div>
                    @else
                        @forelse($cart_products as $cart_product)
                            <li>
                                {{--                                                                                 src="{{ $cart_product->product->product_image }}"--}}
                                <a href="/item/{{$cart_product->product->slug}}" class="image" style="height: 75px"><img
                                        src="{{$cart_product->product->product_image}}"
                                        alt="Cart product Image" class="w-100 h-100"></a>
                                <div class="content">
                                    <a href="/item/{{$cart_product->product->slug}}"
                                       class="title">{{$cart_product->product->title}}</a>
                                    <span class="quantity-price">{{ $cart_product->quantity }} x <span class="amount">{{ currencyConverter($cart_product->price) }}</span></span>
                                    <a href="#" class="remove"
                                       onclick="if(!confirm('Remove {{$cart_product->product->title}} From Cart?' ))return;event.preventDefault();
                                           document.getElementById('cart{{ $cart_product->id }}').submit();">×</a>
                                </div>
                            </li>
                        @empty
                            <div class="col-md-12">
                                <div class="alert alert-info text-center">No Cart Available For You.</div>
                            </div>
                        @endforelse
                    @endguest
                </ul>
            </div>
            @guest
            @else
                @foreach($cart_products as $cart_product)
                    <form id="cart{{ $cart_product->id }}"
                          action="{{ route('cart.destroy',$cart_product->id) }}" method="POST"
                          style="display: none;">
                        {{ method_field("DELETE") }}
                        @csrf
                    </form>
                @endforeach
            @endguest
            <div class="foot">
                @guest
                    <div class="buttons mt-5">
                        <a href="/login" class="btn btn-dark btn-hover-primary mb-30px">Login</a>
                    </div>
                @else
                    <div class="sub-total">
                        <strong>Total :</strong>
                        <span class="amount text-black-50">{{$sum}}</span>
                    </div>
                    <div class="buttons">
                        <a href="/cart" class="btn btn-dark btn-hover-primary mb-30px">view cart</a>
                        <a href="/checkout" class="btn btn-outline-dark current-btn">checkout</a>
                    </div>
                @endguest
                <p class="minicart-message">Free Shipping on All Orders Over 30,000 RFW !</p>
            </div>
        </div>
    </div>
    <!-- OffCanvas Cart End -->

    <!-- OffCanvas Search Start -->
    <div id="offcanvas-mobile-menu" class="offcanvas offcanvas-mobile-menu">
        <div class="inner customScroll">
            <div class="head">
                <span class="title">&nbsp;</span>
                <button class="offcanvas-close">×</button>
            </div>
            <div class="offcanvas-menu-search-form">
                <form action="#">
                    <input type="text" placeholder="Search...">
                    <button><i class="icon-magnifier"></i></button>
                </form>
            </div>
            <div class="offcanvas-menu">
                <ul>
                    <li><a href="/" class="text-decoration-none"><span class="menu-text">Home</span></a></li>
                    <li><a href="/shop" class="text-decoration-none"><span class="menu-text">Products</span></a>
                    </li>
                    <li><a href="/contact-us" class="text-decoration-none">Contact Us</a></li>
                    <li><a href="#" class="text-decoration-none"><span class="menu-text">About-Us</span></a></li>
                    <li><a href="/cart" class="text-decoration-none"><span class="menu-text">Cart</span></a></li>
                    <li><a href="/checkout" class="text-decoration-none"><span class="menu-text">Checkout</span></a>
                    </li>
                    @guest
                        <li><a href="/login" class="text-decoration-none"><span
                                    class="menu-text">Login & Register</span></a>
                        </li>
                    @else
                        <li><a href="/customer/profile" class="text-decoration-none"><span
                                    class="menu-text">My Account</span></a></li>
                    @endguest
                </ul>
            </div>
            <div class="offcanvas-buttons mt-30px">
                <div class="header-tools d-flex">
                    <div class="cart-info d-flex align-self-center">
                        <a href="/customer/profile" class="user"><i class="icon-user"></i></a>
                        @if(count($cart_products)>0)
                            <a href="#offcanvas-cart" class="bag offcanvas-toggle text-decoration-none"
                               data-number="{{$cart_products->count()}}"><i
                                    class="icon-bag"></i><span>{{$sum}}</span></a>
                        @else
                            <a href="#offcanvas-cart" class="bag offcanvas-toggle text-decoration-none"
                               data-number="0"><i class="icon-bag"></i><span>{{$sum}}</span></a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="offcanvas-social mt-30px">
                <ul>
                    <li>
                        <a href="#" class="text-decoration-none"><i class="icon-social-facebook"></i></a>
                    </li>
                    <li>
                        <a href="#" class="text-decoration-none"><i class="icon-social-twitter"></i></a>
                    </li>
                    <li>
                        <a href="#" class="text-decoration-none"><i class="icon-social-instagram"></i></a>
                    </li>
                    <li>
                        <a href="#" class="text-decoration-none"><i class="icon-social-google"></i></a>
                    </li>
                    <li>
                        <a href="#" class="text-decoration-none"><i class="icon-social-instagram"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- OffCanvas Search End -->

    <div class="offcanvas-overlay"></div>
    <!-- Brand area end -->

    <main class="py-4">
        @include("home.welcome")
    </main>
    <!-- Footer Area Start -->
    <div class="footer-area">
        <div class="footer-container">
            <div class="footer-top">
                <div class="mx-5">
                    <div class="row">
                        <div class="col-md-6 col-lg-4 mb-md-30px mb-lm-30px">
                            <div class="single-wedge">
                                <h4 class="footer-herading">ABOUT US</h4>
                                <p class="text-infor">We are a team of fashion and design that create high quality
                                    style</p>
                                <div class="need-help">
                                    <p class="phone-info">
                                        NEED HELP?
                                        <span>
                                        078888888888 <br/>
                                        078888888888
                                    </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-2 mb-md-30px mb-lm-30px">
                            <div class="single-wedge">
                                <h4 class="footer-herading">Information</h4>
                                <div class="footer-links">
                                    <ul>
                                        <li><a href="#">Delivery</a></li>
                                        <li><a href="#">About Us</a></li>
                                        <li><a href="#">Secure Payment</a></li>
                                        <li><a href="/contact-us">Contact Us</a></li>
                                        <li><a href="/contact-us#viewMap">Sitemap</a></li>
                                        <li><a href="/shop">Stores</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-2 mb-sm-30px mb-lm-30px">
                            <div class="single-wedge">
                                <h4 class="footer-herading">CUSTOM LINKS</h4>
                                <div class="footer-links">
                                    <ul>
                                        <li><a href="#">Legal Notice</a></li>
                                        <li><a href="#">Prices Drop</a></li>
                                        <li><a href="/shop">Products</a></li>
                                        @guest
                                            <li><a href="/login" class="text-decoration-none"><span
                                                        class="menu-text">Login & Register</span></a>
                                            </li>
                                        @else
                                            <li><a href="/customer/profile" class="text-decoration-none"><span
                                                        class="menu-text">My Account</span></a></li>
                                        @endguest
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 ">
                            <div class="single-wedge">
                                <h4 class="footer-herading">NEWS LETTER</h4>
                                <div class="subscrib-text">
                                    <p>You may unsubscribe at any moment. For that purpose, please find our contact info
                                        in the legal notice.</p>
                                </div>
                                <div id="mc_embed_signup" class="subscribe-form">
                                    <form
                                        id="mc-embedded-subscribe-form"
                                        class="validate"
                                        novalidate=""
                                        target="_blank"
                                        name="mc-embedded-subscribe-form"
                                        method="post"
                                        action="http://devitems.us11.list-manage.com/subscribe/post?u=6bbb9b6f5827bd842d9640c82&amp;id=05d85f18ef"
                                    >
                                        <div id="mc_embed_signup_scroll" class="mc-form">
                                            <input class="email" type="email" required=""
                                                   placeholder="Enter your email here.." name="EMAIL" value=""/>
                                            <div class="mc-news" aria-hidden="true"
                                                 style="position: absolute; left: -5000px;">
                                                <input type="text" value="" tabindex="-1"
                                                       name="b_6bbb9b6f5827bd842d9640c82_05d85f18ef"/>
                                            </div>
                                            <div class="clear">
                                                <input id="mc-embedded-subscribe" class="button" type="submit"
                                                       name="subscribe" value="Sign Up"/>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="social-info">
                                    <ul>
                                        <li>
                                            <a href="#"><i class="icon-social-facebook"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="icon-social-twitter"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="icon-social-instagram"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="icon-social-google"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="icon-social-instagram"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">

                            <p class="copy-text"> © {{now()->year}} <strong>DH Deals</strong></p>
                        </div>
                        <div class="col-md-6 text-right">
                            <img class="payment-img" src="assets/images/icons/payment.png" alt=""/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{--<a id="scrollUp" href="#top" style="position: fixed; z-index: 2147483647;"><i class="ion-android-arrow-up"></i></a>--}}
<!--<script src="assets/js/vendor/vendor.min.js"></script>
<script src="assets/js/plugins/plugins.min.js"></script>
<script src="assets/js/jquery-v3.4.1.js"></script>
<script src="assets/js/main.js"></script>-->
<script src="assets/js/vendor/vendor.min.js"></script>
<script src="assets/js/plugins/plugins.min.js"></script>

<!-- Main Activation JS -->
<script src="assets/js/main.js"></script>
@stack("scripts")
</body>
</html>
