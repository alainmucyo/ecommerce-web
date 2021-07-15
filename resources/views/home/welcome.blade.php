<div class="section">
    <div class="header-menu  d-xl-block d-none bg-light-gray">
        <div class="mx-5">
            <div class="row">
                <div class="col-lg-2 custom-col-3">
                    <div class="header-menu-vertical bg-blue">
                        <h4 class="menu-title be-af-none">All Categories</h4>
                        <ul class="menu-content display-block">
                            @foreach($categories as $category)
                                <li class="menu-item"><a
                                        href="/shop?category={{$category->slug}}">{{ $category->name }}</a></li>
                            @endforeach
                        </ul>
                        <!-- menu content -->
                    </div>
                    <!-- header menu vertical -->
                </div>
                <div class="col-lg-7 custom-col custom-col-3">
                    <!-- Slider Start -->
                    <div class="slider-area slider-height-2">
                        <div class="hero-slider swiper-container">
                            <div class="swiper-wrapper">
                                <!-- Single Slider  -->
                                <div class="swiper-slide bg-img d-flex"
                                     style="background-image: url(assets/images/slider-image/sample-3.jpg);">
                                    <div class="mx-5 align-self-center">
                                        <div class="slider-content-1 slider-animated-1 text-left pl-60px">
                                            <span class="animated color-white">GALAXY WATCH</span>
                                            <h1 class="animated color-white">
                                                Pre-Order <br/>
                                                <strong>Exclusive</strong>
                                            </h1>
                                            <a href="/product-details" class="shop-btn animated">SHOP NOW</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Single Slider  -->
                                <div class="swiper-slide bg-img d-flex"
                                     style="background-image: url(assets/images/slider-image/sample-4.jpg);">
                                    <div class="mx-5 align-self-center">
                                        <div class="slider-content-1 slider-animated-1 text-left pl-60px">
                                            <span class="animated color-white">BT HEADPHONE</span>
                                            <h1 class="animated color-white">
                                                Headset <br/>
                                                <strong>Hyper X</strong>
                                            </h1>
                                            <a href="/product-details" class="shop-btn animated">SHOP NOW</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Single Slider  -->
                            </div>
                            <!-- Add Pagination -->
                            <div class="swiper-pagination swiper-pagination-white"></div>
                        </div>
                    </div>
                    <!-- Slider End -->
                </div>
                <div class="col-lg-3">
                    <div class="banner-area banner-area-2">
                        <div class="banner-wrapper mb-15px">
                            <a href="/product-details"><img src="assets/images/banner-image/9.jpg" alt=""/></a>
                        </div>
                        <div class="banner-wrapper">
                            <a href="/product-details"><img src="assets/images/banner-image/10.jpg" alt=""/></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- row -->
        </div>
        <!-- container -->
        <!-- Static Area Start -->
        <div class="static-area  ptb-40px">
            <div class="mx-5">
                <div class="static-area-wrap">
                    <div class="row">
                        <!-- Static Single Item Start -->
                        <div class="col-lg-3 col-xs-12 col-md-6 col-sm-6 mb-md-30px mb-lm-30px">
                            <div class="single-static">
                                <img src="assets/images/icons/static-icons-1.png" alt="" class="img-responsive"/>
                                <div class="single-static-meta">
                                    <h4>Free Shipping</h4>
                                    <p>On all orders over $75.00</p>
                                </div>
                            </div>
                        </div>
                        <!-- Static Single Item End -->
                        <!-- Static Single Item Start -->
                        <div class="col-lg-3 col-xs-12 col-md-6 col-sm-6 mb-md-30px mb-lm-30px">
                            <div class="single-static">
                                <img src="assets/images/icons/static-icons-2.png" alt="" class="img-responsive"/>
                                <div class="single-static-meta">
                                    <h4>Free Returns</h4>
                                    <p>Returns are free within 9 days</p>
                                </div>
                            </div>
                        </div>
                        <!-- Static Single Item End -->
                        <!-- Static Single Item Start -->
                        <div class="col-lg-3 col-xs-12 col-md-6 col-sm-6 mb-sm-30px">
                            <div class="single-static">
                                <img src="assets/images/icons/static-icons-4.png" alt="" class="img-responsive"/>
                                <div class="single-static-meta">
                                    <h4>Support 24/7</h4>
                                    <p>Contact us 24 hours a day</p>
                                </div>
                            </div>
                        </div>
                        <!-- Static Single Item End -->
                        <!-- Static Single Item Start -->
                        <div class="col-lg-3 col-xs-12 col-md-6 col-sm-6">
                            <div class="single-static">
                                <img src="assets/images/icons/static-icons-3.png" alt="" class="img-responsive"/>
                                <div class="single-static-meta">
                                    <h4>100% Payment Secure</h4>
                                    <p>Your payment are safe with us.</p>
                                </div>
                            </div>
                        </div>
                        <!-- Static Single Item End -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Static Area End -->
    </div>
    <!-- Header Nav End -->
    <div class="header-menu  d-xl-none bg-light-gray">
        <div class="mx-5">
            <div class="row">
                <div class="col-lg-9">
                    <!-- Slider Start -->
                    <div class="slider-area slider-height-2 mb-md-30px mb-lm-30px mb-sm-30px">
                        <div class="hero-slider swiper-container">
                            <div class="swiper-wrapper">
                                <!-- Single Slider  -->
                                <div class="swiper-slide bg-img d-flex"
                                     style="background-image: url(assets/images/slider-image/sample-3.jpg);">
                                    <div class="mx-5 align-self-center">
                                        <div class="slider-content-1 slider-animated-1 text-left pl-60px">
                                            <span class="animated color-white">GALAXY WATCH</span>
                                            <h1 class="animated color-white">
                                                Pre-Order <br/>
                                                <strong>Exclusive</strong>
                                            </h1>
                                            <a href="/product-details" class="shop-btn animated">SHOP NOW</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Single Slider  -->
                                <div class="swiper-slide bg-img d-flex"
                                     style="background-image: url(assets/images/slider-image/sample-4.jpg);">
                                    <div class="mx-5 align-self-center">
                                        <div class="slider-content-1 slider-animated-1 text-left pl-60px">
                                            <span class="animated color-white">BT HEADPHONE</span>
                                            <h1 class="animated color-white">
                                                Headset <br/>
                                                <strong>Hyper X</strong>
                                            </h1>
                                            <a href="/product-details" class="shop-btn animated">SHOP NOW</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Single Slider  -->
                            </div>
                            <!-- Add Pagination -->
                            <div class="swiper-pagination swiper-pagination-white"></div>
                        </div>
                    </div>
                    <!-- Slider End -->
                </div>
                <div class="col-lg-3">
                    <div class="banner-area">
                        <div class="banner-wrapper mb-md-30px mb-lm-30px mb-sm-30px">
                            <a href="/product-details"><img src="assets/images/banner-image/9.jpg" alt=""/></a>
                        </div>
                        <div class="banner-wrapper mb-0px">
                            <a href="/product-details"><img src="assets/images/banner-image/10.jpg" alt=""/></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- row -->
        </div>
        <!-- container -->
        <!-- Static Area Start -->
        <div class="static-area  ptb-40px">
            <div class="mx-5">
                <div class="static-area-wrap">
                    <div class="row">
                        <!-- Static Single Item Start -->
                        <div class="col-lg-3 col-xs-12 col-md-6 col-sm-6 mb-md-30px mb-lm-30px">
                            <div class="single-static">
                                <img src="assets/images/icons/static-icons-1.png" alt="" class="img-responsive"/>
                                <div class="single-static-meta">
                                    <h4>Free Shipping</h4>
                                    <p>On all orders over $75.00</p>
                                </div>
                            </div>
                        </div>
                        <!-- Static Single Item End -->
                        <!-- Static Single Item Start -->
                        <div class="col-lg-3 col-xs-12 col-md-6 col-sm-6 mb-md-30px mb-lm-30px">
                            <div class="single-static">
                                <img src="assets/images/icons/static-icons-2.png" alt="" class="img-responsive"/>
                                <div class="single-static-meta">
                                    <h4>Free Returns</h4>
                                    <p>Returns are free within 9 days</p>
                                </div>
                            </div>
                        </div>
                        <!-- Static Single Item End -->
                        <!-- Static Single Item Start -->
                        <div class="col-lg-3 col-xs-12 col-md-6 col-sm-6 mb-sm-30px">
                            <div class="single-static">
                                <img src="assets/images/icons/static-icons-4.png" alt="" class="img-responsive"/>
                                <div class="single-static-meta">
                                    <h4>Support 24/7</h4>
                                    <p>Contact us 24 hours a day</p>
                                </div>
                            </div>
                        </div>
                        <!-- Static Single Item End -->
                        <!-- Static Single Item Start -->
                        <div class="col-lg-3 col-xs-12 col-md-6 col-sm-6">
                            <div class="single-static">
                                <img src="assets/images/icons/static-icons-3.png" alt="" class="img-responsive"/>
                                <div class="single-static-meta">
                                    <h4>100% Payment Secure</h4>
                                    <p>Your payment are safe with us.</p>
                                </div>
                            </div>
                        </div>
                        <!-- Static Single Item End -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Static Area End -->
    </div>
    <!-- header menu -->
    <!-- Feature Area start -->


    @foreach($homeSections as $homeSection)
        @if(!$homeSection->discount)
            <div class="feature-area mt-60px mb-30px">
                <div class="mx-5">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="section-title">
                                <h2 class="section-heading">{{ $homeSection->name }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="feature-slider-two slider-nav-style-1 single-product-responsive">
                        <div class="feature-slider-wrapper swiper-wrapper">
                            <!-- Single Item -->
                            @foreach($homeSection->products->where("status",1) as $product)
                                <div class="feature-slider-item swiper-slide mb-3">
                                    <article class="list-product">
                                        <div class="img-block">
                                            <a href="/item/{{ $product->slug }}" class="thumbnail">
                                                {{--                                    src="{{$product->product_image }}"--}}
                                                <img class="first-img" src="assets/images/product-image/6.jpg" alt=""/>
                                                <img class="second-img" src="assets/images/product-image/7.jpg" alt=""/>
                                            </a>
                                            <div class="quick-view">
                                                <a class="quick_view" href="#" data-link-action="quickview"
                                                   title="Quick view"
                                                   data-toggle="modal" data-target="#exampleModal">
                                                    {{--                                        @click.prevent="quickView({{$product}})"--}}
                                                    <i class="icon-magnifier icons"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <ul class="product-flag">
                                            <li class="new">New</li>
                                        </ul>
                                        <div class="product-decs">
                                            <a class="inner-link"
                                               href="/item/{{$product->slug}}"><span>{{ str_limit($product->title, 20)}}</span></a>
                                            <h2><a href="/item/{{$product->slug}}"
                                                   class="product-link">{{$product->slug}}</a></h2>
                                            <div class="rating-product">
                                                <i class="ion-android-star"></i>
                                                <i class="ion-android-star"></i>
                                            </div>
                                            <div class="pricing-meta">
                                                <ul>
                                                    @if($product->discount)
                                                        <li class="old-price not-cut">{{ number_format($product->price) }}
                                                            Rwf
                                                        </li>
                                                        &nbsp;
                                                        <span
                                                            class="text-right">{{ number_format($product->discount->price) }} Rwf</span>
                                                    @else
                                                        @if($product->min_price)
                                                            <li class="d-flex justify-content-between flex-wrap"
                                                                style="font-size: .85rem;">
                                        <span>
                                             {{ number_format($product->min_price) }} Rwf
                                        </span>
                                                                <span>-</span>
                                                                <span>
                                             {{ number_format($product->max_price) }} Rwf
                                        </span>
                                                            </li>
                                                        @else
                                                            <li class="old-price not-cut">{{ number_format($product->price) }}
                                                                Rwf
                                                            </li>
                                                        @endif
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="add-to-link">
                                            <form method="post" action="{{ route("cart.store") }}" id="buy_form">
                                                @csrf
                                                <ul>
                                                    @guest
                                                        <li class="cart"><a class="cart-btn px-2" href="#">
                                                                <button type="submit" name="buy" value="buy" class="w-100 text-white">BUY NOW
                                                                </button>
                                                            </a></li>
                                                    @else
                                                        <li class="cart"><a class="cart-btn px-2" href="#">
                                                                <button type="submit" class="w-100 text-white">
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
                        </div>
                        <!-- Add Arrows -->
                        <div class="swiper-buttons">
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>
                    </div>
                </div>
            </div>
    @endif
@endforeach
<!-- Feature Area End -->

    <!-- category Area Start -->
    <div class="popular-categories-area py-4 bg-light-gray">
        <div class="mx-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title">
                        <h2 class="section-heading">Popular Product</h2>
                    </div>
                </div>
            </div>
            <div class="category-slider slider-nav-style-1">
                <div class="category-slider-wrapper swiper-wrapper">
                    @foreach($popularProducts as $popProduct)
                        <div class="category-slider-item swiper-slide">
                            <div class="category-slider-bg ">
                                <div class="thumb-category">
                                    <a href="/item/{{$popProduct->slug}}">
                                        {{--                                        src="{{$popProduct->product_image }}"--}}
                                        <img src="assets/images/product-image/2-1.jpg" alt="{{$popProduct->slug}}"/>
                                    </a>
                                </div>
                                <div class="category-discript">
                                    <h4>{{ $popProduct->title }}</h4>
                                    <ul>
                                        {{--                                        <li><a href="#">Wearable Devices</a></li>--}}
                                    </ul>
                                    <a href="/item/{{ $popProduct->slug }}" class="view-all-btn">View Detail</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- Add Arrows -->
                <div class="swiper-buttons">
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- category Area End -->


    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document" style="margin: 0 auto;max-width: 960px;width: 960px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">x</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-5 col-sm-12 col-xs-12 mb-lm-100px mb-sm-30px">
                            <!-- Swiper -->
                            <div class="swiper-container gallery-top">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <img class="img-responsive m-auto" src="assets/images/product-image/11.jpg"
                                             alt="">
                                    </div>
                                    <div class="swiper-slide">
                                        <img class="img-responsive m-auto" src="assets/images/product-image/12.jpg"
                                             alt="">
                                    </div>
                                    <div class="swiper-slide">
                                        <img class="img-responsive m-auto" src="assets/images/product-image/13.jpg"
                                             alt="">
                                    </div>
                                    <div class="swiper-slide">
                                        <img class="img-responsive m-auto" src="assets/images/product-image/14.jpg"
                                             alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-container gallery-thumbs">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <img class="img-responsive m-auto" src="assets/images/product-image/11.jpg"
                                             alt="">
                                    </div>
                                    <div class="swiper-slide">
                                        <img class="img-responsive m-auto" src="assets/images/product-image/12.jpg"
                                             alt="">
                                    </div>
                                    <div class="swiper-slide">
                                        <img class="img-responsive m-auto" src="assets/images/product-image/13.jpg"
                                             alt="">
                                    </div>
                                    <div class="swiper-slide">
                                        <img class="img-responsive m-auto" src="assets/images/product-image/14.jpg"
                                             alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-12 col-xs-12">
                            <div class="product-details-content quickview-content">
                                <h2>Originals Kaval Windbr</h2>
                                <p class="reference">Reference:<span> demo_17</span></p>
                                <div class="pro-details-rating-wrap">
                                    <div class="rating-product">
                                        <i class="ion-android-star"></i>
                                        <i class="ion-android-star"></i>
                                        <i class="ion-android-star"></i>
                                        <i class="ion-android-star"></i>
                                        <i class="ion-android-star"></i>
                                    </div>
                                    <span class="read-review"><a class="reviews"
                                                                 href="#">Read reviews (1)</a></span>
                                </div>
                                <div class="pricing-meta">
                                    <ul>
                                        <li class="old-price not-cut">€18.90</li>
                                    </ul>
                                </div>
                                <p class="quickview-para">Lorem ipsum dolor sit amet, consectetur adipisic elit
                                    eiusm tempor incidid ut labore et dolore magna aliqua. Ut enim ad minim venialo
                                    quis nostrud exercitation ullamco</p>
                                <div class="pro-details-size-color">
                                    <div class="pro-details-color-wrap">
                                        <span>Color</span>
                                        <div class="pro-details-color-content">
                                            <ul>
                                                <li class="blue"></li>
                                                <li class="maroon active"></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="pro-details-quality">
                                    <div class="cart-plus-minus">
                                        <input class="cart-plus-minus-box" type="text" name="qtybutton" value="1"/>
                                    </div>
                                    <div class="pro-details-cart btn-hover">
                                        @guest
                                            <a href="#"> + Buy Now</a>
                                        @else
                                            <a href="#"> + Add To Cart</a>
                                        @endguest
                                    </div>
                                </div>
                                <div class="pro-details-wish-com">
                                    <div class="pro-details-wishlist">
                                        <a href="#"><i class="ion-android-favorite-outline"></i>Add to
                                            wishlist</a>
                                    </div>
                                    <div class="pro-details-compare">
                                        <a href="#"><i class="ion-ios-shuffle-strong"></i>Add to compare</a>
                                    </div>
                                </div>
                                <div class="pro-details-social-info">
                                    <span>Share</span>
                                    <div class="social-info">
                                        <ul>
                                            <li>
                                                <a href="#"><i class="ion-social-facebook"></i></a>
                                            </li>
                                            <li>
                                                <a href="#"><i class="ion-social-twitter"></i></a>
                                            </li>
                                            <li>
                                                <a href="#"><i class="ion-social-google"></i></a>
                                            </li>
                                            <li>
                                                <a href="#"><i class="ion-social-instagram"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
