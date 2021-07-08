@extends("layouts.master",['like_product'=>$product])
@section("content")
    <style>
        @media only screen and (max-width: 576px) {
            .like-container {
                display: none;
            }
        }
    </style>
    <hr class="sm-how">

    <!-- section start -->
    <section class="">
        <div class="collection-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-sm-3 collection-filter">
                        <div class="collection-filter-block">
                            <div class="collection-mobile-back">
                            <span class="filter-back">
                                <i class="fa fa-angle-left" aria-hidden="true"></i>
                                back
                            </span>
                            </div>
                            <div class="collection-collapse-block border-0 open">
                                <h3 class="collapse-block-title">Category</h3>
                                <div class="collection-collapse-block-content">
                                    <div class="collection-brand-filter">
                                        <ul class="category-list">
                                            @foreach($product->categories as $category)
                                                <li><a href="#">{{ $category->name }}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- side-bar single product slider start -->
                        <div class="theme-card">
                            <h5 class="title-border">new product</h5>
                            <div class="offer-slider slide-1">
                                <div>
                                    @foreach($products as $new_product)
                                        <div class="media">
                                            <a href="/item/{{ $new_product->slug }}"><img class="img-fluid "
                                                                                          src="{{ $new_product->product_image }}"
                                                                                          alt=""></a>
                                            <div class="media-body align-self-center">
                                                <a href="/item/{{ $new_product->slug }}">
                                                    <h6>{{ $new_product->title }}</h6>
                                                </a>
                                                @if($new_product->discount)
                                                    <del class="text-warning">{{ number_format($new_product->price) }}
                                                        Rwf
                                                    </del>
                                                    <h4>{{ number_format($new_product->discount->price) }} Rwf</h4>
                                                @else
                                                    <h4>{{ number_format($new_product->price) }} Rwf</h4>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <!-- side-bar single product slider end -->
                    </div>
                    <div class="col-lg-9 col-sm-12 col-xs-12">
                        <div class="container-fluid p-0">
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="filter-main-btn mb-2"><span class="filter-btn"><i class="fa fa-filter"
                                                                                                  aria-hidden="true"></i> filter</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @if($product->images->count()>0)
                                    <div class="col-lg-6">
                                        <div class="product-slick">
                                            @foreach($product->images as $image)
                                                <div><img src="{{ $image->image }}" alt=""
                                                          class="img-fluid  image_zoom_cls-{{ $loop->iteration - 1 }}">
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="row mobile-hide">
                                            <div class="col-12 p-0">
                                                <div class="slider-nav">
                                                    @foreach($product->images as $image)
                                                        <div><img src="{{ $image->image }}" alt=""
                                                                  class="img-fluid "></div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 rtl-text">
                                        @else
                                            <div class="col-lg-12 rtl-text">
                                                @endif
                                                <form method="post" action="{{ route("cart.store") }}" id="buy_form">
                                                    @csrf
                                                    <div class="product-right mt-sm">
                                                        <h2 class="mobile-hide">{{ $product->title }}</h2>
                                                        @if($product->discount)
                                                            <h3 style="display: inline">{{ number_format($product->discount->price) }}
                                                                Rwf</h3> &nbsp;
                                                            <del class="text-danger"
                                                                 style="display: inline;font-size: 120%">{{ number_format($product->price) }}
                                                                Rwf
                                                            </del>
                                                            &nbsp;  <span class="badge badge-warning"
                                                                          id="countdown"></span>
                                                        @else
                                                            <h3>{{ number_format($product->price) }} Rwf</h3>
                                                        @endif
                                                        <div class="product-description border-product pb-sm-0">
                                                            @if($product->sizes && json_decode($product->sizes))
                                                                <div class="form-group">
                                                                    <label for="size">Size/Color:</label>
                                                                    <select id="size" class="form-control" name="size"
                                                                    >
                                                                        @foreach(json_decode($product->sizes) as $size)
                                                                            <option
                                                                                value="{{ $size }}">{{ $size }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            @endif
                                                            {{-- @foreach(json_decode($product->sizes) as $size)
                                                                 <li class="{{ json_decode($product->sizes)[0]==$size?'active':'' }} size"
                                                                     style="padding: 5px"><a
                                                                         href="javascript:void(0)">{{ $size }}</a>
                                                                 </li>
                                                             @endforeach
                                                             <input type="hidden" name="size"
                                                                    value="{{ json_decode($product->sizes)[0] }}"
                                                                    id="size">--}}

                                                            <input type="hidden" name="product_id"
                                                                   value="{{ $product->id }}">
                                                            <div class="form-group">
                                                                <label for="quantity">Quantity</label>
                                                                <input type="number" name="quantity" id="quantity"
                                                                       class="form-control input-number"
                                                                       min="1"
                                                                       max="{{ $product->client_max }}"
                                                                       value="1">
                                                            </div>
                                                            @auth
                                                                <div class="d-flex justify-content-center">
                                                                    <a class="text-center"
                                                                       href="/chatbox/customer?seller_id={{ $product->seller->id }}"
                                                                       data-toggle="tooltip" data-placement="top"
                                                                       title="Chat with {{ $product->seller->name }}"><span
                                                                            class="fa fa-comment"></span> Contact Seller</a>
                                                                </div>
                                                            @endauth
                                                        </div>
                                                        @guest
                                                            <div
                                                                class="product-buttons d-flex align-items-center justify-content-center">
                                                                <span class="badge badge-primary mr-1 like-container"
                                                                      data-toggle="tooltip" data-placement="top"
                                                                      title="{{ $product->likes->count() }} likes"
                                                                      style="background-color: #ff6a00 !important;"> {{ $product->likes->count() }} </span>
                                                                <a href="#" class="mr-2 like-container"
                                                                   style="color: #ff6a00 !important;"
                                                                   data-toggle="tooltip"
                                                                   data-placement="top" title="Like the product"
                                                                   onclick="event.preventDefault();
                                                     document.getElementById('like-form').submit();">
                                                                    <span class="fa fa-thumbs-o-up fa-lg"></span>
                                                                </a>
                                                                <button type="submit" name="buy" value="buy"
                                                                        class="btn btn-solid">
                                                                    Buy
                                                                </button>
                                                                <a href="/login" class="btn btn-solid">
                                                                    Login
                                                                </a>
                                                            </div>
                                                        @else
                                                            <div
                                                                class="product-buttons d-flex align-items-center justify-content-center">
                                                                <span class="badge badge-primary mr-1 like-container"
                                                                      data-toggle="tooltip" data-placement="top"
                                                                      title="{{ $product->likes->count() }} likes"
                                                                      style="background-color: #ff6a00 !important;"> {{ $product->likes->count() }} </span>
                                                                <a href="#" class="mr-2 like-container"
                                                                   style="color: #ff6a00 !important;"
                                                                   data-toggle="tooltip"
                                                                   data-placement="top" title="Like the product"
                                                                   onclick="event.preventDefault();
                                                     document.getElementById('like-form').submit();">
                                                                    <span class="fa fa-thumbs-o-up fa-lg"></span>
                                                                </a>
                                                                <button type="submit"
                                                                        class="btn btn-solid">add
                                                                    to cart
                                                                </button>
                                                                <button type="submit" name="buy" value="buy"
                                                                        class="btn btn-solid">
                                                                    Buy
                                                                </button>
                                                                {{--                                                            </div>--}}
                                                                {{--   <a href="#" class="btn btn-solid">buy
                                                                       now</a></div>--}}
                                                            </div>
                                                        @endguest
                                                        <div
                                                            class="border-product product-description mb-4 mt-3">
                                                            <h6 class="product-title">Product Details</h6>
                                                            <div style="overflow: auto; max-height: 600px">
                                                                {!! $product->description !!}
                                                            </div>
                                                            <p class="float-right mt-2">
                                                                <b>Seller: </b>{{ $product->seller->name }}</p>
                                                        </div>
                                                        <div class="border-product">
                                                            <h6 class="product-title">share it</h6>
                                                            <div class="product-icon">
                                                                <ul class="product-social">
                                                                    <li><a href="#"><i
                                                                                class="fa fa-facebook"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="fa fa-google-plus"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="fa fa-twitter"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="fa fa-instagram"></i></a>
                                                                    </li>
                                                                </ul>

                                                            </div>
                                                        </div>
                                                        <a href="/" class="btn btn-solid btn-solid-sm float-right">Go
                                                            to home</a>
                                                    </div>
                                                </form>
                                            </div>

                                    </div>
                                    <form id="like-form" action="/like/{{ $product->id }}" method="POST"
                                          style="display: none;">
                                        {{ method_field("PUT") }}
                                        @csrf
                                    </form>

                            </div>
                            <div class="tab-product m-0">
                                <div class="container row">
                                    <div class="col-sm-12 col-lg-12">
                                        <ul class="nav nav-tabs nav-material" id="top-tab" role="tablist">
                                            <li class="nav-item"><a class="nav-link active" id="top-home-tab"
                                                                    data-toggle="tab" href="#top-home" role="tab"
                                                                    aria-selected="true"><i
                                                        class="icofont icofont-ui-home"></i>Product Reviews</a>
                                                <div class="material-border"></div>
                                            </li>
                                            <li class="nav-item"><a class="nav-link" id="top-review-tab"
                                                                    data-toggle="tab" href="#top-review" role="tab"
                                                                    aria-selected="true"><i
                                                        class="icofont icofont-ui-home"></i>Write Your Review</a>
                                                <div class="material-border"></div>
                                            </li>
                                        </ul>
                                        <div class="tab-content nav-material" id="top-tabContent">
                                            <div class="tab-pane fade show active" id="top-home" role="tabpanel"
                                                 aria-labelledby="top-home-tab">
                                                <br>
                                                <div class="row">
                                                    @forelse($reviews as $review)
                                                        <div class="col-md-12">
                                                            <p>
                                                                <strong>{{ $review->title }}</strong>
                                                            </p>
                                                            <p>{{ $review->content }}</p>
                                                            <div
                                                                class="d-flex justify-content-between">
                                                                <p class="text-secondary">{{ $review->name }}</p>
                                                                <p class="text-secondary">{{ $review->created_date }}</p>
                                                            </div>
                                                            <br>
                                                        </div>
                                                    @empty
                                                        <div class="col-md-8">
                                                            <div class="alert alert-info">No Reviews available.</div>
                                                        </div>
                                                    @endforelse
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="top-review" role="tabpanel"
                                                 aria-labelledby="top-review-tab">
                                                <br>
                                                <form class="theme-form" action="/review/store" method="post">
                                                    @csrf
                                                    <div class="form-row">
                                                        <div class="col-md-6">
                                                            <label for="name">Name</label>
                                                            <input type="text" class="form-control" name="name"
                                                                   id="name"
                                                                   value="{{ auth()->check()?auth()->user()->name:old('name') }}"
                                                                   placeholder="Enter Your name" required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="email">Email</label>
                                                            <input type="text" class="form-control" name="email"
                                                                   placeholder="Email"
                                                                   value="{{ auth()->check()?auth()->user()->email:old('email') }}"
                                                                   required>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label for="review">Review Title</label>
                                                            <input type="text" class="form-control"
                                                                   name="title"
                                                                   value="{{ old('title') }}"
                                                                   placeholder="Enter your Review Subjects" required>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label for="review">Review Content</label>
                                                            <textarea class="form-control"
                                                                      placeholder="Write Your Testimonial Here"
                                                                      id="exampleFormControlTextarea1"
                                                                      name="content"
                                                                      rows="6">{{ old('content') }}</textarea>
                                                        </div>
                                                        <input type="hidden" value="{{ $product->id }}"
                                                               name="product_id">
                                                        <div class="col-md-12">
                                                            <button class="btn btn-solid" type="submit">Submit Your
                                                                Review
                                                            </button>
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
        </div>
    </section>
    <!-- Section ends -->
    <!-- product section start -->
    @if($recommended_products->count()>0)
        <section class="section-b-space ratio_square product-related">
            <div class="container">
                <div class="row">
                    <div class="col-12 product-related">
                        <h2 class="title pt-0">related products</h2></div>
                </div>
                <div class="slide-6">
                    @foreach($recommended_products as $recommended_product  )
                        <div class="">
                            <div class="product-box">
                                <div class="img-block">
                                    <a href="/item/{{ $recommended_product->slug }}"><img
                                            src="{{ $recommended_product->product_image }}"
                                            class=" img-fluid bg-img"
                                            alt=""></a>
                                </div>
                                <div class="product-info">
                                    <a href="/item/{{ $recommended_product->slug }}">
                                        <h6>{{ $recommended_product->title }}</h6></a>
                                    @if($recommended_product->discount)
                                        <del class="text-warning">{{ number_format($recommended_product->price) }}Rwf
                                        </del>
                                        <h5>{{ number_format($recommended_product->discount->price) }} Rwf</h5>
                                    @else
                                        @if($recommended_product->min_price > 0 and $recommended_product->max_price > 0)
                                            <h5 class="d-flex justify-content-between" style="font-size: .93rem">
                                                <span> {{ number_format($recommended_product->min_price) }} Rwf</span>
                                                <span>-</span>
                                                <span> {{ number_format($recommended_product->max_price) }} Rwf</span>
                                            </h5>
                                        @else
                                            <h5>{{ number_format($recommended_product->price) }}
                                                Rwf</h5>
                                        @endif
                                    @endif
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
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
