<header class="header-4 header-basic">
    <div class="mobile-fix-header">
    </div>
  {{--  <div class="notification-bar">
        <div class="marquee">Welcome to Tajyire store. Buy any products Online from our extensive collection of products
            at affordable prices. You can avail exciting deals and discount
            offers on our online shop. register now & save up to 500,000RWF
        </div>
    </div>--}}
    <div class="container">
        <div class="row header-content">
            <div class="col-12">
                <div class="left-part">
                    <div class="navbar">
                        <a href="javascript:void(0)" onclick="openNav()">
                            <div class="bar-style"><i class="fa fa-bars sidebar-bar" aria-hidden="true"></i></div>
                        </a>
                        <div id="mySidenav" class="sidenav">
                            <a href="javascript:void(0)" class="sidebar-overlay" onclick="closeNav()"></a>
                            <nav class="">
                                <div onclick="closeNav()">
                                    <div class="sidebar-back text-left"><i class="fa fa-angle-left pr-2"
                                                                           aria-hidden="true"></i> Back
                                    </div>

                                </div>
                                <ul id="sub-menu" class="sm pixelstrap sm-vertical ">
                                    @foreach($categories as $category)
                                        <li class="mega"><a
                                                href="/shop?category={{ $category->slug }}">{{ $category->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="brand-logo">
                        <a href="/">
                            {{--                            <img src="/commerce/assets/images/icon/brand-logo/6.png" class=" img-fluid" alt="">--}}
                            <img src="/img/logo-new.png" class="img-fluid" style="height: 3.2rem; width: auto" alt="">
                        </a>
                    </div>
                </div>
                <div class="nav-right">
                    <nav id="main-nav">
                        <div class="toggle-nav">
                            <i class="fa fa-bars sidebar-bar"></i>
                        </div>
                        <ul id="main-menu" class="sm pixelstrap sm-horizontal">
                            <li>
                                <div class="mobile-back text-right">
                                    Back<i class="fa fa-angle-right pl-2" aria-hidden="true"></i>
                                </div>
                            </li>
                            <li><a href="/">Home</a>
                            </li>
                            <li><a href="/shop">shop</a>
                                <ul>
                                    @foreach($categories as $category)
                                        <li><a href="/shop?category={{ $category->slug }}">{{ $category->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            @auth
                                <li><a href="/orders">My Orders</a></li>
                                <li><a href="/chatbox/customer">Messages</a></li>
                                <li><a href="#" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Logout</a></li>
                            @else
                                <li><a href="/login">Login</a></li>
                                <li><a href="/register">Register</a></li>
                            @endif

                        </ul>
                    </nav>
                    <div class="search-bar">
                        <form action="/shop" method="get">
                            <div class="search-bar">

                                <input class="search__input" name="query" value="{{ request("query") }}" type="search"
                                       placeholder="Search a product">
                                {{--                                <div class="search-icon "></div>--}}
                            </div>
                        </form>
                        <div class="search-icon "></div>
                        <i class="ti-search mobile-icon-search" onclick="openSearch()"></i>
                        <div id="search-overlay" class="search-overlay">
                            <div>
                                <span class="closebtn" onclick="closeSearch()" title="Close Overlay">×</span>
                                <div class="overlay-content">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <form action="/shop" method="get">
                                                    <div class="form-group">
                                                        <input type="search" class="form-control"
                                                               name="query" value="{{ request("query") }}"
                                                               id="exampleInputPassword1"
                                                               placeholder="Search a Product">
                                                    </div>
                                                    <button type="submit" class="btn btn-primary"><i
                                                            class="fa fa-search"></i></button>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nav-icon">
                        <ul>
                            <li class="onhover-div user-icon" onclick="openAccount()">
                                <img src="/commerce/assets/images/icon/user.png" alt="" class="user-img">
                                <i class="ti-user mobile-icon"></i>
                            </li>
                            @auth
                                <li class="onhover-div setting-icon">
                                    <div><img src="/commerce/assets/images/icon/settings.png"
                                              class=" img-fluid setting-img" alt="">
                                        <i class="ti-settings mobile-icon"></i>
                                    </div>
                                    <div class="show-div setting">
                                        <h6>{{ auth()->user()->name }}</h6>

                                        <ul>
                                            <li><a href="/customer/profile">Profile</a></li>
                                            <li><a href="#" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Logout</a></li>
                                        </ul>
                                    </div>
                                </li>
                            @endauth
                            <li class="onhover-div cart-icon"  onclick="openCart()">
                                @if(auth()->check() && $cart_products->count()>0)
                                    <span class="badge badge-primary icon-badge">{{ $cart_products->count() }}</span>
                                @endif
                                <img src="/commerce/assets/images/icon/cart.png" alt="" class="cart-image">
                                <i class="ti-shopping-cart mobile-icon"></i>
                                {{--<div class="cart">
                                    <h6>my cart</h6>
                                    <span>{{ $sum }}</span>
                                </div>--}}
                            </li>
                            <style>
                                .icon-likes {
                                    display: none !important;
                                }

                                @media only screen and (max-width: 576px) {
                                    .icon-likes {
                                        display: flex !important;
                                    }

                                }
                            </style>
                            @if(isset($like_product))
                                <li class="onhover-div user-icon  d-flex align-items-center icon-likes" style="left:60%"
                                >
                                  <span class="badge badge-primary mr-1"
                                        data-toggle="tooltip" data-placement="top"
                                        title="{{ $like_product->likes->count() }} likes"
                                        style="background-color: #ff6a00 !important;"> {{ $like_product->likes->count() }} </span>
                                    <a href="#" class="mr-2"
                                       style="color: #ff6a00 !important;"
                                       data-toggle="tooltip"
                                       data-placement="top" title="Like the product"
                                       onclick="event.preventDefault();
                                                     document.getElementById('like-form').submit();">
                                        <i class="fa fa-thumbs-o-up mobile-icon"></i>
                                    </a>
                                    <form id="like-form" action="/like/{{ $like_product->id }}" method="POST"
                                          style="display: none;">
                                        {{ method_field("PUT") }}
                                        @csrf
                                    </form>
                                </li>
                                <li class="onhover-div user-icon  d-flex align-items-center icon-likes" style="left:80%"
                                >
                                    <a href="#" class="btn btn-solid btn-solid-sm"
                                       style="padding: 1px 10px!important;"
                                       data-toggle="tooltip"
                                       data-placement="top" title="Buy the product"
                                       onclick="event.preventDefault();
                                                     document.getElementById('buy_form').submit();">
{{--                                        <i class="fa fa-thumbs-o-up mobile-icon"></i>--}}
                                        BUY
                                    </a>
                                    <form id="like-form" action="/like/{{ $like_product->id }}" method="POST"
                                          style="display: none;">
                                        {{ method_field("PUT") }}
                                        @csrf
                                    </form>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
{{--<header class="header-3">
    <div class="mobile-fix-header">
    </div>
    <div class="container">
        @auth
            <div class="row header-content">
                <div class="col-lg-8"></div>
                <div class="col-lg-4 col-6">
                    <div class="right-part float-right">
                        <ul>
                            <li>
                                <div class="dropdown language">
                                    <div style="cursor: pointer;padding: 15px">
                                        <span>{{ auth()->user()->email }}</span>
                                    </div>
                                    <input type="hidden" name="language">
                                    <ul class="dropdown-menu">
                                        <li id="English"><a href="#" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Logout</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        @endauth
        <div class="row header-content">
            <div class="col-xl-2 col-md-2 col-sm-3">
                <div class="brand-logo">
                    <a href="/"> <img src="/commerce/assets/images/icon/brand-logo/3.png" class="imf-fluid" alt=""></a>
                </div>
            </div>
            <div class="col-xl-7 col-lg-5 col-md-4 col-sm-2">
                <div class="row">
                    <div class="col-xl-12 ">
                        <form action="/shop" method="get">
                            <div class="search-bar">

                                <input class="search__input" name="query" value="{{ request("query") }}" type="search"
                                       placeholder="Search a product">
                                <div class="search-icon "></div>
                            </div>
                        </form>
                    </div>
                    <div class="col-xl-12 col-lg-12">
                        <nav id="main-nav">
                            <div class="toggle-nav">
                                <i class="ti-menu-alt"></i>
                            </div>
                            <ul id="main-menu" class="sm pixelstrap sm-horizontal">
                                <li>
                                    <div class="mobile-back text-right">
                                        Back<i class="fa fa-angle-right pl-2" aria-hidden="true"></i>
                                    </div>
                                </li>
                                <li class="icon-cls"><a href="#"><i class="fa fa-home home-icon" aria-hidden="true"></i></a>
                                </li>
                                <li><a href="/">Home</a>
                                </li>
                                <li><a href="/shop">shop</a>
                                    <ul>
                                        @foreach($categories as $category)
                                            <li><a href="/shop?category={{ $category->slug }}">{{ $category->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                                @auth
                                    <li><a href="/orders">My Orders</a></li>
                                    <li><a href="#" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Logout</a></li>
                                @else
                                    <li><a href="/login">Login</a></li>
                                    <li><a href="/register">Register</a></li>
                                @endif
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-5 col-md-6 col-sm-7 padding-class">
                <div class="right_part">
                    <div class="navbar">
                        <a href="javascript:void(0)" onclick="openNav()">
                            <div class="bar-style"><i class="fa fa-bars sidebar-bar" aria-hidden="true"></i></div>
                        </a>
                        <div id="mySidenav" class="sidenav">
                            <a href="javascript:void(0)" class="sidebar-overlay" onclick="closeNav()"></a>
                            <nav class="">
                                <div onclick="closeNav()">
                                    <div class="sidebar-back text-left"><i class="fa fa-angle-left pr-2"
                                                                           aria-hidden="true"></i> Back
                                    </div>
                                </div>
                                <ul id="sub-menu" class="sm pixelstrap sm-vertical ">
                                    @foreach($categories as $category)
                                        <li class="mega"><a
                                                href="/shop?category={{ $category->slug }}">{{ $category->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="nav-icon">
                        <ul>
                            <li class="onhover-div pr-0 search-3">
                                <div onclick="openSearch()">
                                    <img src="/commerce/assets/images/icon/search.png" class=" img-fluid search-img"
                                         alt="">
                                    <i class="ti-search mobile-icon-search"></i>
                                </div>
                                <div id="search-overlay" class="search-overlay">
                                    <div>
                                        <span class="closebtn" onclick="closeSearch()" title="Close Overlay">×</span>
                                        <div class="overlay-content">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-xl-12">
                                                        <form method="get" action="/shop">
                                                            <div class="form-group">
                                                                <input type="search" name="query" class="form-control"
                                                                       id="exampleInputPassword1"
                                                                       value="{{ request("query") }}"
                                                                       placeholder="Search a Product">
                                                            </div>
                                                            <button type="submit" class="btn btn-primary"><i
                                                                    class="fa fa-search"></i></button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="onhover-div user-icon pr-0" onclick="openAccount()">
                                <img src="/commerce/assets/images/icon/profile.png" alt="" class="user-img">
                                <i class="ti-user mobile-icon"></i>
                            </li>
                            <li class="onhover-div cart-icon" onclick="openCart()">
                                <img src="/commerce/assets/images/icon/cart-3.png" alt="" class="cart-image">
                                <i class="ti-shopping-cart mobile-icon"></i>
                                @auth
                                    <div class="cart-count">
                                        <span>{{ $cart_products->count() }}</span>
                                    </div>
                                    <div class="cart">
                                        <h6>my cart</h6>
                                        <span>{{ $sum }}</span>
                                    </div>
                                @endauth
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>--}}
<form id="logout-form" action="{{ route('logout') }}" method="POST"
      style="display: none;">
    @csrf
</form>
