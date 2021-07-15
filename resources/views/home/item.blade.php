@extends("layouts.master",['like_product'=>$product])
@section("title","Product-Details")
@section("content")
    <style>
        @media only screen and (max-width: 576px) {
            .like-container {
                display: none;
            }
        }
    </style>

    @if (\Session::has('success'))
        <div class="alert alert-success ml-auto mt-2" style="width: fit-content">
            <ul class="list-unstyled" style="width: fit-content">
                <li>{!! \Session::get('success') !!}</li>
            </ul>
        </div>
    @endif
    @if (\Session::has('danger'))
        <div class="alert alert-danger ml-auto" style="width: fit-content">
            <ul class="list-unstyled" style="width: fit-content">
                <li>{!! \Session::get('danger') !!}</li>
            </ul>
        </div>
    @endif
    <!-- section start -->
    <section class="">
        <div class="breadcrumb-area">
            <div class="mx-5">
                <div class="row">
                    <div class="col-md-12">
                        <div class="breadcrumb-content">
                            <ul class="nav">
                                <li><a href="/">Home</a></li>
                                <li>Product Details</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section class="product-details-area mtb-60px">
            <div class="mx-5">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <div class="product-details-img product-details-tab">
                            <div class="zoompro-wrap zoompro-2">
                                <div class="zoompro-border zoompro-span">
                                    <img class="zoompro" src="/assets/images/product-image/22.jpg"
                                         data-zoom-image="/assets/images/product-image/zoom/1.jpg" alt=""/>
                                </div>
                            </div>
                            <div id="gallery" class="product-dec-slider-2 swiper-container">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <a class="active" data-image="/assets/images/product-image/22.jpg"
                                           data-zoom-image="/assets/images/product-image/zoom/1.jpg">
                                            <img class="img-responsive" src="/assets/images/product-image/22.jpg"
                                                 alt=""/>
                                        </a>
                                    </div>
                                    <div class="swiper-slide">
                                        <a data-image="/assets/images/product-image/21.jpg"
                                           data-zoom-image="/assets/images/product-image/zoom/2.jpg">
                                            <img class="img-responsive" src="/assets/images/product-image/21.jpg"
                                                 alt=""/>
                                        </a>
                                    </div>
                                    <div class="swiper-slide">
                                        <a data-image="/assets/images/product-image/23.jpg"
                                           data-zoom-image="/assets/images/product-image/zoom/3.jpg">
                                            <img class="img-responsive" src="/assets/images/product-image/23.jpg"
                                                 alt=""/>
                                        </a>
                                    </div>
                                    <div class="swiper-slide">
                                        <a data-image="/assets/images/product-image/6.jpg"
                                           data-zoom-image="/assets/images/product-image/zoom/4.jpg">
                                            <img class="img-responsive" src="/assets/images/product-image/6.jpg"
                                                 alt=""/>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <div class="product-details-content">
                            <form method="post" action="{{ route("cart.store") }}" id="buy_form">
                                @csrf
                                <h2>{{ $product->title }}</h2>
                                <p class="reference">Reference:<span> {{ $product->slug }}</span></p>
                                <div class="pro-details-rating-wrap">
                                    <div class="rating-product">
                                        <i class="ion-android-star"></i>
                                        <i class="ion-android-star"></i>
                                        <i class="ion-android-star"></i>
                                        <i class="ion-android-star"></i>
                                        <i class="ion-android-star"></i>
                                    </div>
                                    <span class="read-review"><a class="reviews" data-toggle="tab" href="#des-details3">Read reviews ({{count($reviews)}})</a></span>
                                </div>
                                <div class="pricing-meta">
                                    <ul>
                                        @if($product->discount)
                                            <li>
                                                <span class="old-price text-danger">{{ number_format($product->discount->price) }}Rwf</span>
                                                - <span>{{ number_format($product->price) }}Rwf</span>
                                                &nbsp; <span class="badge badge-warning"
                                                             id="countdown"></span>
                                            </li>
                                        @else
                                            <li class="old-price no-cut">{{ number_format($product->price) }} Rwf</li>
                                        @endif
                                    </ul>
                                </div>
                                <div class="pro-details-list">
                                    <p>{!! $product->description !!}</p>
                                </div>
                                <div class="pro-details-size-color d-flex">
                                    <div class="product-size ml-0">
                                        <span>Color / Size</span>
                                        @if($product->sizes && json_decode($product->sizes))
                                            <select name="size" class="form-control cursor-pointer">
                                                @foreach(json_decode($product->sizes) as $size)
                                                    <option value="{{ $size }}"
                                                            class="cursor-pointer">{{ $size }}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>
                                </div>
                                <div class="pro-details-quality mt-0px">
                                    <div class="cart-plus-minus">
                                        <input class="cart-plus-minus-box" type="text"
                                               max="{{ $product->client_max }}"
                                               min="1" name="quantity"
                                               value="1"/>
                                    </div>
                                    <input type="hidden" name="product_id"
                                           value="{{ $product->id }}">
                                    <div class="pro-details-cart btn-hover">
                                        @guest
                                            <div
                                                class="ml-3 product-buttons d-flex align-items-center justify-content-center">
                                                <button type="submit" name="buy" value="buy"
                                                        class="btn btn-solid btn-primary py-2 font-weight-bold px-3 text-capitalize">
                                                    Buy
                                                </button>
                                                <a href="/login" class="btn btn-solid">
                                                    Login
                                                </a>
                                            </div>
                                        @else
                                            <div
                                                class="justify-content-around ml-3 product-buttons d-flex align-items-center justify-content-center">
                                                <button type="submit"
                                                        class="btn btn-solid px-4 mr-2 bg-primary font-weight-bold text-white text-capitalize">
                                                    add to cart
                                                </button>
                                                <button type="submit" name="buy" value="buy"
                                                        class="btn btn-solid btn-primary py-2 font-weight-bold text-capitalize">
                                                    Buy
                                                </button>
                                            </div>
                                        @endguest
                                    </div>
                                </div>
                                <div class="pro-details-wish-com">
                                    <div class="pro-details-wishlist">
                                        <a href="#">
                                            @auth
                                                <div class="d-flex justify-content-center">
                                                    <a class="text-center text-primary"
                                                       href="/chatbox/customer?seller_id={{ $product->seller->id }}"
                                                       data-toggle="tooltip" data-placement="top"
                                                       title="Chat with Us"><span
                                                            class="fa fa-comment"></span> Contact Seller</a>
                                                </div>
                                            @endauth
                                        </a>
                                    </div>
                                </div>
                                <div class="pro-details-social-info">
                                    <span>Share</span>
                                    <div class="social-info">
                                        <ul>
                                            <li>
                                                <a title="Facebook" href="#"><i class="ion-social-facebook"></i></a>
                                            </li>
                                            <li>
                                                <a title="Twitter" href="#"><i class="ion-social-twitter"></i></a>
                                            </li>
                                            <li>
                                                <a title="Google+" href="#"><i class="ion-social-google"></i></a>
                                            </li>
                                            <li>
                                                <a title="Instagram" href="#"><i class="ion-social-instagram"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </form>
                            <div class="pro-details-policy">
                                <ul>
                                    <li><img src="/assets/images/icons/policy.png" alt=""/><span>Security Policy (Edit With Customer Reassurance Module)</span>
                                    </li>
                                    <li><img src="/assets/images/icons/policy-2.png" alt=""/><span>Delivery Policy (Edit With Customer Reassurance Module)</span>
                                    </li>
                                    <li><img src="/assets/images/icons/policy-3.png" alt=""/><span>Return Policy (Edit With Customer Reassurance Module)</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="description-review-area mb-60px">
            <div class="mx-5">
                <div class="description-review-wrapper">
                    <div class="description-review-topbar nav">
                        <a data-toggle="tab" href="#des-details1">Description</a>
                        <a class="active" data-toggle="tab" href="#des-details3">Reviews ({{count($reviews)}})</a>
                    </div>
                    <div class="tab-content description-review-bottom">
                        <div id="des-details1" class="tab-pane">
                            <div class="product-description-wrapper">
                                <p class="text-capitalize text-justify">{!! $product->description !!}</p>
                            </div>
                        </div>
                        <div id="des-details3" class="tab-pane active">
                            <div class="row">
                                <div class="col-lg-7">
                                    <div class="review-wrapper">
                                        @forelse($reviews as $review)
                                            <div class="single-review">
                                                <div class="review-img">
                                                    <img src="/img/user.png" alt="" style="width: 5em;"/>
                                                </div>
                                                <div class="review-content w-100">
                                                    <div class="review-top-wrap">
                                                        <div class="review-left">
                                                            <div class="review-name">
                                                                <strong>{{ $review->title }}</strong>
                                                            </div>
                                                        </div>
                                                        <div class="review-left ml-auto">
                                                            <span class="text-muted">{{ $review->name }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="review-bottom">
                                                        <p>{{ $review->content }}</p>
                                                    </div>
                                                    <p class="text-right text-info"><span
                                                            class="small"> {{ $review->created_date }}</span>
                                                    </p>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="col-md-8">
                                                <div class="alert alert-info">No Reviews available.</div>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="ratting-form-wrapper pl-50">
                                        <h3>Add a Review</h3>
                                        <div class="ratting-form">
                                            <form action="/review/store" method="post">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="rating-form-style mb-10">
                                                            <input name="name"
                                                                   id="name"
                                                                   value="{{ old('name') }}"
                                                                   placeholder="Enter Your name" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="rating-form-style mb-10">
                                                            <input type="email" class="form-control" name="email"
                                                                   placeholder="Email"
                                                                   value="{{ auth()->check()?auth()->user()->email:old('email') }}"
                                                                   required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="rating-form-style mb-10">
                                                            <input type="text" class="form-control"
                                                                   name="title"
                                                                   value="{{ old('title') }}"
                                                                   placeholder="Enter your Review Subjects" required>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" value="{{ $product->id }}"
                                                           name="product_id">
                                                    <div class="col-md-12">
                                                        <div class="rating-form-style form-submit">
                                                            <textarea class="form-control"
                                                                      placeholder="Write Your Testimonial Here"
                                                                      id="exampleFormControlTextarea1"
                                                                      name="content"
                                                                      rows="6" required>{{ old('content') }}</textarea>
                                                            <input type="submit" value="Submit"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="feature-area single-product-responsive mt-60px mb-30px">
            <div class="mx-5">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title">
                            <h2 class="section-heading">New Product</h2>
                        </div>
                    </div>
                </div>
                <div class="feature-slider-two slider-nav-style-1">
                    <div class="feature-slider-wrapper swiper-wrapper">
                        @foreach($products as $new_product)
                            <div class="feature-slider-item swiper-slide mb-3">
                                <article class="list-product">
                                    <div class="img-block">
                                        <a href="/item/{{ $new_product->slug }}" class="thumbnail">
                                            {{--                                        src="{{ $new_product->product_image }}"--}}
                                            <img class="first-img" src="/assets/images/product-image/7.jpg" alt=""/>
                                            <img class="second-img" src="/assets/images/product-image/8.jpg" alt=""/>
                                        </a>
                                        <div class="quick-view">
                                            <a class="quick_view" href="#" data-link-action="quickview"
                                               title="Quick view"
                                               data-toggle="modal" data-target="#exampleModal">
                                                <i class="icon-magnifier icons"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <ul class="product-flag">
                                        <li class="new">New</li>
                                    </ul>
                                    <div class="product-decs">
                                        <a class="inner-link"
                                           href="/item/{{$new_product->slug}}"><span>{{ $new_product->title }}</span></a>
                                        <h2><a href="/item/{{$new_product->slug}}"
                                               class="product-link">{{$new_product->slug}}</a></h2>
                                        <div class="rating-product">
                                            <i class="ion-android-star"></i>
                                            <i class="ion-android-star"></i>
                                            <i class="ion-android-star"></i>
                                        </div>
                                        <div class="pricing-meta">
                                            <ul>
                                                @if($new_product->discount)
                                                    <li class="current-price text-black-50">{{ number_format($new_product->price) }}
                                                        Rwf
                                                    </li>
                                                    <li class="old-price">{{ number_format($new_product->discount->price) }}
                                                        Rwf
                                                    </li>
                                                @else
                                                    <li class="current-price text-black-50">{{ number_format($new_product->price) }}
                                                        Rwf
                                                    </li>
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
                                                            <button type="submit" name="buy" value="buy"
                                                                    class="w-100 text-white">BUY NOW
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
                                            <input type="hidden" value="{{ $new_product->id }}"
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
        @if($recommended_products->count()>0)
            <div class="feature-area single-product-responsive  mb-30px">
                <div class="mx-5">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="section-title">
                                <h2 class="section-heading">{{count($recommended_products)}} Other Products In The Same
                                    Category:</h2>
                            </div>
                        </div>
                    </div>
                    <div class="feature-slider-two slider-nav-style-1">
                        <div class="feature-slider-wrapper swiper-wrapper">
                            @foreach($recommended_products as $recommended_product)
                                <div class="feature-slider-item swiper-slide mb-3">
                                    <article class="list-product">
                                        <div class="img-block">
                                            <a href="/item/{{$recommended_product->slug}}" class="thumbnail">
                                                {{--                                        src="{{ $recommended_product->product_image }}"--}}
                                                <img class="first-img" src="/assets/images/product-image/6.jpg" alt=""/>
                                                <img class="second-img" src="/assets/images/product-image/7.jpg"
                                                     alt=""/>
                                            </a>
                                            <div class="quick-view">
                                                <a class="quick_view" href="#" data-link-action="quickview"
                                                   title="Quick view"
                                                   data-toggle="modal" data-target="#exampleModal">
                                                    <i class="icon-magnifier icons"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <ul class="product-flag">
                                            <li class="new">New</li>
                                        </ul>
                                        <div class="product-decs">
                                            <a class="inner-link"
                                               href="shop-4-column.html"><span>{{ $recommended_product->title }}</span></a>
                                            <h2><a href="/item/{{$recommended_product->slug}}"
                                                   class="product-link">{{ $recommended_product->slug }}</a></h2>
                                            <div class="rating-product">
                                                <i class="ion-android-star"></i>
                                                <i class="ion-android-star"></i>
                                                <i class="ion-android-star"></i>
                                                <i class="ion-android-star"></i>
                                                <i class="ion-android-star"></i>
                                            </div>
                                            <div class="pricing-meta">
                                                <ul>
                                                    @if($recommended_product->discount)
                                                        <del
                                                            class="text-warning">{{ number_format($recommended_product->price) }}
                                                            Rwf
                                                        </del>
                                                        <h5>{{ number_format($recommended_product->discount->price) }}
                                                            Rwf</h5>
                                                    @else
                                                        @if($recommended_product->min_price > 0 and $recommended_product->max_price > 0)
                                                            <h5 class="d-flex justify-content-between"
                                                                style="font-size: .93rem">
                                                                <span> {{ number_format($recommended_product->min_price) }} Rwf</span>
                                                                <span>-</span>
                                                                <span> {{ number_format($recommended_product->max_price) }} Rwf</span>
                                                            </h5>
                                                        @else
                                                            <h5>{{ number_format($recommended_product->price) }}
                                                                Rwf</h5>
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
                                                                <button type="submit" name="buy" value="buy"
                                                                        class="w-100 text-white">BUY NOW
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
                                                <input type="hidden" value="{{ $recommended_product->id }}"
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
    </section>
@endsection
@push("scripts")
    @if($product->discount)
        <script type="text/javascript">
            // var end = new Date('05/24/2020 11:00 PM');
            var end = new Date('{{ $product->discount->end_time }}');
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
                    window.location = "";
                    return;
                }
                var days = Math.floor(distance / _day);
                var hours = Math.floor((distance % _day) / _hour);
                var minutes = Math.floor((distance % _hour) / _minute);
                var seconds = Math.floor((distance % _minute) / _second);

                document.getElementById('countdown').innerHTML = days + 'days ';
                document.getElementById('countdown').innerHTML += hours + 'hrs ';
                document.getElementById('countdown').innerHTML += minutes + 'mins ';
                document.getElementById('countdown').innerHTML += seconds + 'secs';
            }

            timer = setInterval(showRemaining, 1000);
        </script>
    @endif
    <script type="text/javascript">
        $(function () {
            $(".size").click(function () {
                var size = $(this).text();
                $("#size").val(size)
            })
        })
    </script>
    <script src="/commerce/assets/js/jquery.elevatezoom.js"></script>
@endpush
