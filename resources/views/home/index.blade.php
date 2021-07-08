    <!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="pragma" content="no-cache"/>
    <meta http-equiv="cache-control" content="max-age=604800"/>
    <meta name="description" content="Tajyire store market is an online modern, secure shop where you make orders and buy your needs online, easily and in a flash.">
    <meta name="keywords" content="Tajyire, store market , market , africa ,   e commerce, rwanda, online, modern, shop, secure, clothes, accessories, watches, women, jewels, kigali">
    <meta name="author" content="Tajyire store market">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>TAJYIRE Marketplace</title>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-175795975-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-175795975-1');
    </script>

    <link href="/img/logo-gorilla.png" rel="shortcut icon" type="image/x-icon">

    <link href="/alistyle/css/bootstrap.css" rel="stylesheet" type="text/css"/>

    <!-- Font awesome 5 -->
    <link rel="stylesheet" type="text/css"
          href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- custom style -->
    <link href="/alistyle/css/ui.css" rel="stylesheet" type="text/css"/>
    <link href="/alistyle/css/responsive.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="/css/home_style.css" type="text/css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style type="text/css">
        .last-color {
            color: #fa3434 !important;
        }
    </style>
</head>
<body>

<header class="section-header">
    <section class="header-main border-bottom">
        <div class="container">
            <div class="row align-items-center logo-container">
                <div class="col-xl-2 col-lg-3 col-md-12">
                    <a href="/" class="brand-wrap">
                        <img class="logo" src="/img/logo-new.png" style="max-height: 57px;">
                    </a> <!-- brand-wrap.// -->
                </div>
                <div class="col-xl-6 col-lg-5 col-md-6">
                    <form action="/shop" class="search-header">
                        <div class="input-group w-100">
                            <select class="custom-select border-right" name="category">
                                <option value="all">All Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->slug }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <input type="search" class="form-control" name="query" value="{{ request("query") }}"
                                   placeholder="Search">

                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fa fa-search"></i> Search
                                </button>
                            </div>
                        </div>
                    </form> <!-- search-wrap .end// -->
                </div> <!-- col.// -->

                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="widgets-wrap float-md-right">
                        @auth
                            <div class="widget-header">
                                <a href="/customer/profile" class="widget-view">
                                    <div class="icon-area" style="width: 36px;height: auto">
                                        {{--                                        <i class="fa fa-user"></i>--}}
                                        <img src="{{ auth()->user()->image }}"
                                             style="border-radius: 50%;margin-top: -15px;width: 100%" alt="">
                                    </div>
                                    <small class="text"> My profile </small>
                                </a>
                            </div>
                            <div class="widget-header">
                                <a href="/chatbox/customer" class="widget-view">
                                    <div class="icon-area">
                                        <i class="fa fa-comment"></i>

                                    </div>
                                    <small class="text"> Message </small>
                                </a>
                            </div>
                            <div class="widget-header">
                                <a href="/orders" class="widget-view">
                                    <div class="icon-area">
                                        <i class="fa fa-database"></i>
                                    </div>
                                    <small class="text"> Orders </small>
                                </a>
                            </div>
                            <div class="widget-header">
                                <a href="/cart" class="widget-view">
                                    <div class="icon-area">
                                        <i class="fa fa-shopping-cart"></i>
                                        @if($cart_products->count()>0)
                                            <span class="notify">{{$cart_products->count()}}</span>
                                        @endif
                                    </div>
                                    <small class="text"> Cart </small>
                                </a>
                            </div>
                        @else
                            <div class="widget-header mr-3">
                                <a href="/login" class="widget-view">
                                    <div class="icon-area">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <small class="text"> Login </small>
                                </a>
                            </div>
                            <div class="widget-header mr-3">
                                <a href="/register" class="widget-view">
                                    <div class="icon-area">
                                        <i class="fa fa-user-plus"></i>
                                    </div>
                                    <small class="text"> Register </small>
                                </a>
                            </div>
                        @endif
                        <div class="widget-header">
                            <a href="/shop" class="widget-view">
                                <div class="icon-area">
                                    <i class="fa fa-list"></i>
                                </div>
                                <small class="text">Products </small>
                            </a>
                        </div>
                    </div> <!-- widgets-wrap.// -->
                </div> <!-- col.// -->
            </div> <!-- row.// -->
        </div> <!-- container.// -->
    </section> <!-- header-main .// -->


    <nav class="navbar navbar-main navbar-expand-lg border-bottom">
        <div class="container">

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav"
                    aria-controls="main_nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="main_nav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"> Shop </a>
                        <div class="dropdown-menu dropdown-large">
                            <nav class="row">
                                <div class="col-6">
                                    <a
                                        href="/shop">All</a>
                                    @foreach($categories as $category)
                                        @if($loop->iteration==$categories_count_half)
                                </div>
                                <div class="col-6">
                                    @endif
                                    <a href="/shop?category={{ $category->slug }}">{{ $category->name }}</a>
                                    @endforeach
                                </div>
                                {{--<div class="col-6">
                                    <a href="page-profile-main.html">Profile main</a>
                                </div>--}}
                            </nav> <!--  row end .// -->
                        </div> <!--  dropdown-menu dropdown-large end.// -->
                    </li>
                </ul>
                <ul class="navbar-nav ml-md-auto">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="/login">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/register">Register</a>
                        </li>
                    @else
                        @role(['admin','seller'])
                        <li class="nav-item">
                            <a class="nav-link" href="/home">Dashboard</a>
                        </li>
                        @endrole
                        <li class="nav-item">
                            <a class="nav-link" href="/logout">Logout</a>
                        </li>
                    @endguest
                </ul>
            </div> <!-- collapse .// -->
        </div> <!-- container .// -->
    </nav>
</header> <!-- section-header.// -->


<div class="container">
    <!-- ========================= SECTION MAIN  ========================= -->
    <section class="section-main padding-y">
        <main class="card">
            <div class="card-body">

                <div class="row">
                    <aside class="col-lg col-md-3 flex-lg-grow-0 small-hide ">
                        <h6>CATEGORIES</h6>
                        <nav class="nav-home-aside">
                            <ul class="menu-category">
                                @foreach($paginated_cats as $category)
                                    <li><a href="/shop?category={{ $category->slug }}">{{ $category->name }}</a></li>
                                @endforeach
                            </ul>
                            {!! $paginated_cats->links() !!}
                        </nav>
                    </aside> <!-- col.// -->
                    <div class="col-md-9 col-xl-7 col-lg-7">

                        <!-- ================== COMPONENT SLIDER  BOOTSTRAP  ==================  -->
                        <div id="carousel1_indicator" class="slider-home-banner carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carousel1_indicator" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel1_indicator" data-slide-to="1"></li>
                                <li data-target="#carousel1_indicator" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="/alistyle/images/banners/slide1.jpeg" alt="First slide">
                                </div>
                                <div class="carousel-item">
                                    <img src="/alistyle/images/banners/slide2.jpeg" alt="Second slide">
                                </div>
                                <div class="carousel-item ">
                                    <img src="/alistyle/images/banners/slide3.jpeg" alt="First slide">
                                </div>
                                <div class="carousel-item">
                                    <img src="/alistyle/images/banners/slide4.jpeg" alt="Second slide">
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carousel1_indicator" role="button"
                               data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carousel1_indicator" role="button"
                               data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                        <!-- ==================  COMPONENT SLIDER BOOTSTRAP end.// ==================  .// -->

                    </div> <!-- col.// -->
                    <div class="col-md d-none d-lg-block flex-grow-1">
                        <aside class="special-home-right">
                            <h6 class="bg-blue text-center text-white mb-0 p-2">Most popular products</h6>
                            @foreach($popularProducts as $popProduct)
                                <div class="card-banner border-bottom">
                                    <div class="py-3" style="width:80%">
                                        <h6 class="card-title">{{ $popProduct->title }}</h6>
                                        <a href="/item/{{ $popProduct->slug }}" class="btn btn-secondary btn-sm"> Buy
                                            now </a>
                                    </div>
                                    <img src="{{$popProduct->product_image }}"
                                         style="max-width: 30%"
                                         height="80" class="img-bg"/>
                                </div>
                            @endforeach
                        </aside>
                    </div> <!-- col.// -->
                </div> <!-- row.// -->

            </div> <!-- card-body.// -->
        </main> <!-- card.// -->
    </section>
    <!-- ========================= SECTION MAIN END// ========================= -->
  {{--  <div class="icons">
        <div class="icons-list">
            <div class="icons__detail">
                <a href="#" class="icons__link icon__link--1">
                    <span class="fa fa-database"></span>
--}}{{--                    <img src="/stores/icyangwe.png" class="icon__img" alt="">--}}{{--
                </a>
                <p class="icons__name">Official Store</p>
            </div>

            <div class="icons__detail">
                <a href="#" class="icons__link icon__link--2">
                    <span class="fa fa-gamepad"></span>
                </a>
                <p class="icons__name">Official Store</p>
            </div>
            <div class="icons__detail">
                <a href="#" class="icons__link icon__link--3">
                    <span class="fa fa-plane"></span>
                </a>
                <p class="icons__name">Official Store</p>
            </div>
            <div class="icons__detail">
                <a href="#" class="icons__link icon__link--4">
                    <span class="fa fa-phone"></span>
                </a>
                <p class="icons__name">Official Store</p>
            </div>
        </div>
        <div class="icons-list">
            <div class="icons__detail">
                <a href="#" class="icons__link icon__link--5">
                    <span class="fa fa-database"></span>
                </a>
                <p class="icons__name">Official Store</p>
            </div>
            <div class="icons__detail">
                <a href="#" class="icons__link icon__link--6">
                    <span class="fa fa-gamepad"></span>
                </a>
                <p class="icons__name">Official Store</p>
            </div>
            <div class="icons__detail">
                <a href="#" class="icons__link icon__link--7">
                    <span class="fa fa-calendar"></span>
                </a>
                <p class="icons__name">Official Store</p>
            </div>
            <div class="icons__detail">
                <a href="#" class="icons__link icon__link--8">
                    <span class="fa fa-phone"></span>
                </a>
                <p class="icons__name">Official Store</p>
            </div>
        </div>
    </div>--}}
    <div id="app">
        <section class="padding-bottom">
            <header class="section-heading heading-line">
                <h4 class="title-section text-uppercase">Apparel</h4>
            </header>

            <div class="card card-home-category">
                <div class="row no-gutters">
                    <div class="col-md-3">

                        <div class="home-category-banner bg-light-orange">
                            <h5 class="title">Best trending clothes only for summer</h5>
                            <p>"When you don’t dress like everyone else, you don’t have to think like everyone else." </p>
                            <a href="/shop" class="btn btn-outline-primary rounded-pill">Source now</a>
                            <img src="alistyle/images/items/summer.webp" class="img-bg">
                        </div>

                    </div> <!-- col.// -->
                    <div class="col-md-9">
                        <ul class="row no-gutters bordered-cols">
                            @foreach($ad_products as $ad_product)
                                <li class="col-6 col-lg-3 col-md-4">
                                    <a href="#" class="item">
                                        <div class="card-body">
                                            <h6 class="title">{{ $ad_product->title }} </h6>
                                            <img class="img-sm float-right" src="{{$ad_product->product_image}}">
                                            <p class="text-muted"><i
                                                    class="fa fa-map-marker"></i> {{ $ad_product->details }}
                                            </p>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div> <!-- col.// -->
                </div> <!-- row.// -->
            </div> <!-- card.// -->
        </section>
        <vue-progress-bar></vue-progress-bar>

        @foreach($homeSections as $homeSection)
            @if($homeSection->discount && \Carbon\Carbon::parse($homeSection->discount_time)->greaterThan(now()) && $homeSection->products->where("status",1)->count()>0 )
                <section class="padding-bottom">
                    <div class="card card-deal">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="col-heading content-body">
                                    <header class="section-heading">
                                        <h3 class="section-title">Deals and offers</h3>
                                        <p>Be sure to pick yours!</p>
                                    </header><!-- sect-heading -->
                                    <div class="timer">
                                        <div><span class="num" id="countdown{{ $homeSection->id }}days">00</span>
                                            <small>Days</small></div>
                                        <div><span class="num" id="countdown{{ $homeSection->id }}hrs">00</span> <small>Hours</small>
                                        </div>
                                        <div><span class="num" id="countdown{{ $homeSection->id }}min">00</span> <small>Min</small>
                                        </div>
                                        <div><span class="num" id="countdown{{ $homeSection->id }}sec">00</span> <small>Sec</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @foreach($homeSection->products->where("status",1) as $product)
                                @if($product->has_discount)
                                    <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                                        <figure class="card-product-grid card-sm">
                                            <a href="/item/{{ $product->slug }}" class="img-wrap">
                                                <img
                                                    src="{{$product->product_image }}"/>
                                            </a>
                                            <div class="text-wrap p-3">
                                                <a href="/item/{{ $product->slug }}"
                                                   class="title">{{ $product->title }}</a>
                                                <span
                                                    class="badge badge-danger"> -{{ $product->discount_percent }}% </span>
                                            </div>
                                        </figure>
                                    </div>
                                @endif
                            @endforeach
                        </div><!-- col.// -->
                        {{-- <div class="row no-gutters items-wrap">

                         </div>--}}
                    </div>

                </section>
            @endif
        @endforeach
        @foreach($homeSections as $homeSection)
            @if(!$homeSection->discount)
                <section class="padding-bottom-sm {{ $homeSections->last()->id==$homeSection->id?'redish_bg':'' }}">
                    <header class="section-heading heading-line heading-line-{{ $loop->iteration }}">
                        <h4 class="title-section text-uppercase {{ $homeSections->last()->id==$homeSection->id?'redish_bg p-2':'' }} title-header-{{ $loop->iteration }}">{{ $homeSection->name }}</h4>

                    </header>
                    @if($homeSection->discount)
                        <label class="badge badge-primary">
                            <h4 id="countdown{{ $homeSection->id }}">{{ $homeSection->discount_time }}</h4>
                        </label>
                        <br/>
                        <br/>
                    @endif
                    <div class="row row-sm">
                        @foreach($homeSection->products->where("status",1) as $product)
                            <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                                <div href="/item/{{ $product->slug }}" class="card card-sm card-product-grid">
                                    <a href="/item/{{ $product->slug }}" class="img-wrap" style="height: 12rem"> <img
                                            src="{{$product->product_image }}"
                                            style="height: 100%"> </a>
                                    <figcaption class="info-wrap">

                                        <a href="/item/{{ $product->slug }}" class="title ">{{ str_limit($product->title, 20)}}</a>
                                        <div
                                            class="price mt-1 {{ $homeSections->last()->id==$homeSection->id?'last-color':'' }}">
                                            @if($product->discount)
                                                <del class="text-danger">{{ number_format($product->price) }} Rwf</del>
                                                &nbsp;
                                                <span
                                                    class="float-right">{{ number_format($product->discount->price) }} Rwf</span>
                                            @else
                                                @if($product->min_price)
                                                    <div class="d-flex justify-content-between flex-wrap"
                                                         style="font-size: .85rem;">
                                        <span>
                                             {{ number_format($product->min_price) }} Rwf
                                        </span>
                                                        <span>-</span>
                                                        <span>
                                             {{ number_format($product->max_price) }} Rwf
                                        </span>
                                                    </div>

                                                @else
                                                    {{ number_format($product->price) }} Rwf
                                                @endif
                                            @endif
                                        </div> <!-- price-wrap.// -->
                                        <div class="mt-2">
                                            @if($homeSections->last()->id!=$homeSection->id)
                                                <span class="badge badge-primary  mr-1"
                                                      data-toggle="tooltip" data-placement="top"
                                                      title="{{ $product->likes->count() }} likes"> {{ $product->likes->count() }} </span>
                                            @endif
                                            <a href="#"
                                               class="mr-2 {{ $homeSections->last()->id==$homeSection->id?'last-color':'text-primary' }} "
                                               data-toggle="tooltip"
                                               data-placement="top" title="Like the product"
                                               onclick="event.preventDefault();
                                                   document.getElementById('like-form-{{ $product->id }}').submit();">
                                                <span class="fa fa-thumbs-o-up fa-lg"></span>
                                            </a>
                                            <form id="like-form-{{ $product->id }}" action="/like/{{ $product->id }}"
                                                  method="POST"
                                                  style="display: none;">
                                                {{ method_field("PUT") }}
                                                @csrf
                                            </form>
                                            <a href="#"
                                               class=" {{ $homeSections->last()->id==$homeSection->id?'last-color':'text-primary' }} float-right"
                                               data-toggle="tooltip"
                                               @click.prevent="quickView({{$product}})"
                                               data-placement="top" title="Quick view on product"
                                            >
                                                <span class="fa fa-eye fa-lg"></span>
                                            </a>

                                        </div>
                                    </figcaption>

                                </div>
                            </div> <!-- col.// -->
                        @endforeach
                    </div> <!-- row.// -->
                    @include("includes.quick_view_modal")
                </section>
            @endif
        @endforeach
        <section class="padding-bottom-sm greyish-bg mb-4">
            <header class="section-heading heading-line heading-line-5">
                <h4 class="title-section text-uppercase title-header-5 greyish-bg">Our Top Sellers</h4>

            </header>
            <div class="row row-sm">
                @foreach($sellers as $seller)
                    {{-- <div class="col-xl-2 col-lg-2 col-md-3 col-4">
                         <figure class="card-product-grid card-sm">
                             <a href="/item/{{ $seller->slug }}" class="img-wrap">
                                 <img style="border-radius: 50%"
                                     src="{{$seller->image }}"/>
                             </a>
                             <div class="text-wrap p-3">
                                 <a href="/item/{{ $seller->slug }}" class="title">{{ $seller->name }}</a>
                                 <span class="badge badge-danger"> {{ $seller->phone }}</span>
                             </div>
                         </figure>
                     </div>--}}
                    <div class="col-xl-2 seller col-lg-3 col-6 col-sm-4">
                        <div href="/shop?seller={{ $seller->slug }}" class="card card-seller card-sm card-product-grid" data-toggle="tooltip" data-placement="bottom"
                             title="Seller email: {{ $seller->email }}">
                            <a href="/shop?seller={{ $seller->slug }}" class="img-wrap"> <img
                                    src="{{$seller->image }}"
                                    style="height: 100%;border-radius: 50%;object-fit: cover"> </a>
                            <figcaption class="info-wrap text-center">
                                <a href="/shop?seller={{ $seller->slug }}" class="title ">{{ $seller->shop_name }}</a>
                                <div
                                    class="price mt-1">
                                    <span class="fa fa-phone"></span>
                                    <span
                                        class="">{{ ($seller->phone) }}</span>
                                </div>
                            </figcaption>

                        </div>
                    </div>
                @endforeach
            </div> <!-- row.// -->
            @include("includes.quick_view_modal")
        </section>
    </div>
    <!-- =============== SECTION ITEMS .//END =============== -->


    <!-- =============== SECTION SERVICES =============== -->
    {{-- <section class="padding-bottom">

         <header class="section-heading heading-line">
             <h4 class="title-section text-uppercase">Trade services</h4>
         </header>

         <div class="row">
             <div class="col-md-3 col-sm-6">
                 <article class="card card-post">
                     <img src="/alistyle/images/posts/1.jpg" class="card-img-top">
                     <div class="card-body">
                         <h6 class="title">Trade Assurance</h6>
                         <p class="small text-uppercase text-muted">Order protection</p>
                     </div>
                 </article> <!-- card.// -->
             </div> <!-- col.// -->
             <div class="col-md-3 col-sm-6">
                 <article class="card card-post">
                     <img src="/alistyle/images/posts/2.jpg" class="card-img-top">
                     <div class="card-body">
                         <h6 class="title">Pay anytime</h6>
                         <p class="small text-uppercase text-muted">Finance solution</p>
                     </div>
                 </article> <!-- card.// -->
             </div> <!-- col.// -->
             <div class="col-md-3 col-sm-6">
                 <article class="card card-post">
                     <img src="/alistyle/images/posts/3.jpg" class="card-img-top">
                     <div class="card-body">
                         <h6 class="title">Inspection solution</h6>
                         <p class="small text-uppercase text-muted">Easy Inspection</p>
                     </div>
                 </article> <!-- card.// -->
             </div> <!-- col.// -->
             <div class="col-md-3 col-sm-6">
                 <article class="card card-post">
                     <img src="/alistyle/images/posts/4.jpg" class="card-img-top">
                     <div class="card-body">
                         <h6 class="title">Ocean and Air Shipping</h6>
                         <p class="small text-uppercase text-muted">Logistic services</p>
                     </div>
                 </article> <!-- card.// -->
             </div> <!-- col.// -->
         </div> <!-- row.// -->

     </section>--}}

</div>
<!-- container end.// -->
<!-- ========================= FOOTER ========================= -->
<footer class="section-footer bg-secondary">
    <div class="container">
      {{--  <section class="footer-top padding-y-lg text-white">
            <div class="row">
                <aside class="col-md col-6">
                    <h6 class="title">Brands</h6>
                    <ul class="list-unstyled">
                        <li><a href="#">Adidas</a></li>
                        <li><a href="#">Puma</a></li>
                        <li><a href="#">Reebok</a></li>
                        <li><a href="#">Nike</a></li>
                    </ul>
                </aside>
                <aside class="col-md col-6">
                    <h6 class="title">Company</h6>
                    <ul class="list-unstyled">
                        <li><a href="#">About us</a></li>
                        <li><a href="#">Career</a></li>
                        <li><a href="#">Find a store</a></li>
                        <li><a href="#">Rules and terms</a></li>
                        <li><a href="#">Sitemap</a></li>
                    </ul>
                </aside>
                <aside class="col-md col-6">
                    <h6 class="title">Help</h6>
                    <ul class="list-unstyled">
                        <li><a href="#">Contact us</a></li>
                        <li><a href="#">Money refund</a></li>
                        <li><a href="#">Order status</a></li>
                        <li><a href="#">Shipping info</a></li>
                        <li><a href="#">Open dispute</a></li>
                    </ul>
                </aside>
                <aside class="col-md col-6">
                    <h6 class="title">Account</h6>
                    <ul class="list-unstyled">
                        <li><a href="/login"> User Login </a></li>
                        <li><a href="/register"> User register </a></li>
                        <li><a href="#"> Account Setting </a></li>
                        <li><a href="#"> My Orders </a></li>
                    </ul>
                </aside>
                <aside class="col-md">
                    <h6 class="title">Social</h6>
                    <ul class="list-unstyled">
                        <li><a href="#"> <i class="fa fa-facebook"></i> Facebook </a></li>
                        <li><a href="#"> <i class="fa fa-twitter"></i> Twitter </a></li>
                        <li><a href="#"> <i class="fa fa-instagram"></i> Instagram </a></li>
                        <li><a href="#"> <i class="fa fa-youtube"></i> Youtube </a></li>
                    </ul>
                </aside>
            </div> <!-- row.// -->
        </section> --}}
        <section class="footer-bottom text-center">

            <p class="text-white">Privacy Policy - Terms of Use - User Information Legal Enquiry Guide</p>
            <p class="text-muted"> &copy {{now()->year}} TAJYIRE Marketplace, All rights reserved </p>
            <br>
        </section>
    </div><!-- //container -->
    <div class="fixed-footer @auth justify-content-between @endauth">
        @auth
            <div class="widget-header mr-3">
                <a href="/customer/profile" class="widget-view">
                    <div class="icon-area">
                        {{--                        <i class="fa fa-user"></i>--}}
                        <img src="{{ auth()->user()->image }}"
                             style="border-radius: 50%;margin-top: -15px;width: 100%" alt="">
                    </div>
                    <small class="text"> My profile </small>
                </a>
            </div>
            <div class="widget-header mr-3">
                <a href="/chatbox/customer" class="widget-view">
                    <div class="icon-area">
                        <i class="fa fa-comment"></i>

                    </div>
                    <small class="text"> Message </small>
                </a>
            </div>
            <div class="widget-header mr-3">
                <a href="/orders" class="widget-view">
                    <div class="icon-area">
                        <i class="fa fa-database"></i>
                    </div>
                    <small class="text"> Orders </small>
                </a>
            </div>
            <div class="widget-header">
                <a href="/cart" class="widget-view">
                    <div class="icon-area">
                        <i class="fa fa-shopping-cart"></i>
                        @if($cart_products->count()>0)
                            <span class="notify">{{$cart_products->count()}}</span>
                        @endif
                    </div>
                    <small class="text"> Cart </small>
                </a>
            </div>
        @else
            <div class="widget-header">
                <a href="/login" class="widget-view mr-3">
                    <div class="icon-area">
                        <i class="fa fa-user"></i>
                    </div>
                    <small class="text"> Login </small>
                </a>
            </div>
            <div class="widget-header">
                <a href="/register" class="widget-view mr-3">
                    <div class="icon-area">
                        <i class="fa fa-user-plus"></i>
                    </div>
                    <small class="text"> Register </small>
                </a>
            </div>
        @endif
        <div class="widget-header">
            <a href="/shop" class="widget-view mr-3">
                <div class="icon-area">
                    <i class="fa fa-list"></i>
                </div>
                <small class="text">Our Products </small>
            </a>
        </div>
    </div>
</footer>
<!-- custom javascript -->

<!-- jQuery -->
<script src="/alistyle/js/jquery-2.0.0.min.js" type="text/javascript"></script>

<!-- Bootstrap4 files-->
<script src="/alistyle/js/bootstrap.bundle.min.js" type="text/javascript"></script>
<script src="/alistyle/js/script.js" type="text/javascript"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script type="text/javascript" src="/js/toastr.min.js"></script>
@if(session("success"))
    <script type="application/javascript">
        $(function () {
            toastr.options.timeOut = '10000';
            toastr.success('{{ session("success") }}')
        })
    </script>
@endif
@if(session("info"))
    <script type="application/javascript">
        $(function () {
            toastr.options.timeOut = '10000';
            toastr.info('{{ session("info") }}')
        })
    </script>
@endif
@if(count($errors))
    <script type="application/javascript">
        $(function () {
            toastr.options.timeOut = '10000';
            toastr.error('Please, make sure all fields are filled correctly!')
        })
    </script>
@endif
@foreach($homeSections as $homeSection)
    @if($homeSection->discount)
        <script type="text/javascript">
            var end = new Date('{{ $homeSection->discount_time }}');
            var _second = 1000;
            var _minute = _second * 60;
            var _hour = _minute * 60;
            var _day = _hour * 24;
            var timer;

            function showRemaining() {
                var now = new Date();
                var distance = end - now;
                if (distance < 0) {
                    clearInterval(timer);
                    // document.getElementById('countdown').innerHTML = 'EXPIRED!';
                    return;
                }
                var days = Math.floor(distance / _day);
                var hours = Math.floor((distance % _day) / _hour);
                var minutes = Math.floor((distance % _hour) / _minute);
                var seconds = Math.floor((distance % _minute) / _second);

                document.getElementById('countdown{{ $homeSection->id }}days').innerHTML = days;
                document.getElementById('countdown{{ $homeSection->id }}hrs').innerHTML = hours;
                document.getElementById('countdown{{ $homeSection->id }}min').innerHTML = minutes;
                document.getElementById('countdown{{ $homeSection->id }}sec').innerHTML = seconds;
            }

            timer = setInterval(showRemaining, 1000);
        </script>
    @endif
@endforeach

<script type="text/javascript" src="/js/new_app.js"></script>
</body>
</html>
