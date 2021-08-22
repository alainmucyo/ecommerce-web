@extends("layouts.master")
@section("title","Products-List")
@section("content")
    <section class="breadcrumb-section section-b-space">
        <div class="breadcrumb-area">
            <div class="mx-5">
                <div class="row">
                    <div class="col-md-12">
                        <div class="breadcrumb-content">
                            <ul class="nav">
                                <li><a href="/">Home</a></li>
                                <li>Our Products</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="shop-category-area mt-30px" id="app">
            <div class="mx-5">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="shop-top-bar d-flex">
                            <div class="shop-tab nav d-flex">
                                <a href="#shop-1" data-toggle="tab">
                                    <i class="fa fa-th"></i>
                                </a>
                                <a class="active" href="#shop-2" data-toggle="tab">
                                    <i class="fa fa-list"></i>
                                </a>
                                <p>There Are {{ count($products) }} Products.</p>
                            </div>
                            <div class="select-shoing-wrap d-flex">
                                <div class="shot-product">
                                    <p>Sort By:</p>
                                </div>
                                <div class="shop-select">
                                    <select id="sorting">
                                        <option
                                            {{ request("sorting")=="relevance"?'selected':'' }} value="relevance">
                                            Relevance
                                        </option>
                                        <option
                                            {{ request("sorting")=="a_to_z"?'selected':'' }} value="a_to_z">
                                            Name, A To Z
                                        </option>
                                        <option
                                            {{ request("sorting")=="z_to_a"?'selected':'' }} value="z_to_a">
                                            Name, Z To A
                                        </option>
                                        <option
                                            {{ request("sorting")=="low_to_high"?'selected':'' }} value="low_to_high">
                                            Price Low To High
                                        </option>
                                        <option
                                            {{ request("sorting")=="high_to_low"?'selected':'' }} value="high_to_low">
                                            Price High To Low
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="shop-bottom-area mt-35">
                            <div class="tab-content jump">
                                <div id="shop-1" class="tab-pane">
                                    <div class="row responsive-md-class">
                                        @if($products->count()>0)
                                            @foreach($products as $product)
                                                <div class="col-xl-3 col-md-4 col-sm-6 ">
                                                    <article class="list-product mb-4">
                                                        <div class="img-block" style="height: 250px">
                                                            <a href="/item/{{ $product->slug }}" class="thumbnail">
                                                                <img class="first-img h-100"
                                                                     src="{{$product->product_image }}" alt=""/>
                                                                @if($product->images && count(json_decode($product->images)) > 1)
                                                                    <img class="second-img h-100"
                                                                         src="{{json_decode($product->images)[1] }}"
                                                                         alt=""/>
                                                                @endif
                                                                {{--                                                                <img class="first-img"--}}
                                                                {{--                                                                     src="assets/images/product-image/7.jpg"--}}
                                                                {{--                                                                     --}}{{--                                                                     src="{{ $product->product_image }}"--}}
                                                                {{--                                                                     alt=""/>--}}
                                                                {{--                                                                <img class="second-img"--}}
                                                                {{--                                                                     src="assets/images/product-image/8.jpg"--}}
                                                                {{--                                                                     alt=""/>--}}
                                                            </a>
                                                            <div class="quick-view">
                                                                <a class="quick_view" href="#"
                                                                   data-toggle="tooltip"
                                                                   @click.prevent="quickView({{$product}})"
                                                                   data-placement="top" title="Quick view on product">
                                                                    <i class="ion-ios-search-strong"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <ul class="product-flag">
                                                            <li class="new">New</li>
                                                        </ul>
                                                        <div class="product-decs">
                                                            <a class="inner-link"
                                                               href="/item/{{ $product->slug }}"><span>{{ $product->title }}</span></a>
                                                            <h2><a href="/item/{{ $product->slug }}"
                                                                   class="product-link">{{ $product->slug }}</a></h2>
                                                            <div class="pricing-meta">
                                                                <ul>
                                                                    @if($product->discount)
                                                                        <li class="old-price not-cut">{{ ($product->formatted_price) }}
                                                                        </li>
                                                                        <li class="current-price">{{ currencyConverter($product->discount->price) }}
                                                                        </li>
                                                                    @else
                                                                        <li class="old-price not-cut">{{ ($product->formatted_price) }}
                                                                        </li>
                                                                    @endif
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="add-to-link">
                                                            <form method="post" action="{{ route("cart.store") }}"
                                                                  id="buy_form">
                                                                @csrf
                                                                <ul>
                                                                    @guest
                                                                        <li class="cart">
                                                                            <a class="cart-btn" href="#">
                                                                                <button type="submit" name="buy"
                                                                                        value="buy"
                                                                                        class="w-100 text-white">BUY NOW
                                                                                </button>
                                                                            </a>
                                                                        </li>
                                                                    @else
                                                                        <li class="cart"><a class="cart-btn px-2"
                                                                                            href="#">
                                                                                <button type="submit"
                                                                                        class="w-100 text-white">
                                                                                    ADD TO CART
                                                                                </button>
                                                                            </a>
                                                                        </li>
                                                                    @endguest
                                                                </ul>
                                                                <input type="hidden" value="{{ $product->id }}"
                                                                       name="product_id">
                                                                <input type="hidden" name="quantity" value="1">
                                                            </form>
                                                        </div>
                                                    </article>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="col-md-12 alert alert-warning">
                                                Sorry, No Products Available.
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div id="shop-2" class="tab-pane active">
                                    @if($products->count()>0)
                                        @foreach($products as $product)
                                            <div class="shop-list-wrap mb-3 scroll-zoom">
                                                <div class="row list-product m-0px">
                                                    <div class="col-md-12 padding-0px">
                                                        <div class="row mb-3">
                                                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
                                                                <div class="left-img">
                                                                    <div class="img-block" style="height:280px">
                                                                        <a href="/item/{{ $product->slug }}"
                                                                           class="thumbnail">
                                                                            <img class="first-img h-100"
                                                                                 src="{{$product->product_image }}"
                                                                                 alt=""/>
                                                                            @if($product->images && count(json_decode($product->images)) > 1)
                                                                                <img class="second-img h-100"
                                                                                     src="{{json_decode($product->images)[1] }}"
                                                                                     alt=""/>
                                                                            @endif
                                                                            {{--                                                                            <img class="first-img"--}}
                                                                            {{--                                                                                 src="assets/images/product-image/7.jpg"--}}
                                                                            {{--                                                                                 alt=""/>--}}
                                                                            {{--                                                                            --}}{{--                                                                    src="{{ $product->product_image }}"}}--}}
                                                                            {{--                                                                            <img class="second-img"--}}
                                                                            {{--                                                                                 src="assets/images/product-image/8.jpg"--}}
                                                                            {{--                                                                                 alt=""/>--}}
                                                                        </a>
                                                                        <div class="quick-view">
                                                                            <a class="quick_view" href="#"
                                                                               data-toggle="tooltip"
                                                                               @click.prevent="quickView({{$product}})"
                                                                               data-placement="top"
                                                                               title="Quick view on product">
                                                                                <i class="ion-ios-search-strong"></i>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                    <ul class="product-flag">
                                                                        <li class="new">New</li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-9">
                                                                <div class="product-desc-wrap">
                                                                    <div class="product-decs">
                                                                        <a class="inner-link"
                                                                           href="/item/{{ $product->slug }}"><span>{{ $product->title }}</span></a>
                                                                        <h2><a href="/item/{{ $product->slug }}"
                                                                               class="product-link">{{ $product->slug }}</a>
                                                                        </h2>
                                                                        <div class="product-intro-info">
                                                                            {!! $product->description !!}
                                                                        </div>
                                                                    </div>
                                                                    <div class="box-inner">
                                                                        <div class="in-stock">Availability:
                                                                            <span>{{$product->client_max}} In Stock</span>
                                                                        </div>
                                                                        <div class="pricing-meta">
                                                                            <ul>
                                                                                @if($product->discount)
                                                                                    <li class="old-price not-cut">{{ ($product->formatted_price) }}
                                                                                    </li>
                                                                                    <li class="current-price">{{ currencyConverter($product->discount->price) }}
                                                                                    </li>
                                                                                @else
                                                                                    <li class="old-price not-cut">{{ ($product->formatted_price) }}
                                                                                    </li>
                                                                                @endif
                                                                            </ul>
                                                                        </div>
                                                                        <div class="add-to-link">
                                                                            <form method="post"
                                                                                  action="{{ route("cart.store") }}"
                                                                                  id="buy_form">
                                                                                @csrf
                                                                                <ul>
                                                                                    @guest
                                                                                        <li class="cart">
                                                                                            <a class="cart-btn"
                                                                                               href="#">
                                                                                                <button type="submit"
                                                                                                        name="buy"
                                                                                                        value="buy"
                                                                                                        class="w-100 text-white">
                                                                                                    BUY NOW
                                                                                                </button>
                                                                                            </a>
                                                                                        </li>
                                                                                    @else
                                                                                        <li class="cart"><a
                                                                                                class="cart-btn px-2"
                                                                                                href="#">
                                                                                                <button type="submit"
                                                                                                        class="w-100 text-white">
                                                                                                    ADD TO CART
                                                                                                </button>
                                                                                            </a>
                                                                                        </li>
                                                                                    @endguest
                                                                                </ul>
                                                                                <input type="hidden"
                                                                                       value="{{ $product->id }}"
                                                                                       name="product_id">
                                                                                <input type="hidden" name="quantity"
                                                                                       value="1">
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="col-md-12 alert alert-warning">
                                            Sorry, No Products Available.
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="product-pagination mb-0">
                                <div class="theme-paggination-block">
                                    <div class="row">
                                        <div class="col-xl-6 col-md-6 col-sm-12">
                                            {!! $products->appends($_GET)->links("pagination.default") !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include("includes.quick_view_modal")
    </section>
    <!-- section End -->
@endsection
@push("scripts")
    <script type="text/javascript">
        $(function () {
            $("#sorting").change(function () {
                var value = $(this).val();
                window.location = "?{!! request("category")?"category=".request("category").'&':'' !!}sorting=" + value
            })
        })
    </script>
    <script type="text/javascript" src="/js/app.js"></script>
@endpush
