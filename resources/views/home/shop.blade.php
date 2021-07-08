@extends("layouts.master")
@section("content")
    <!-- breadcrumb start -->
    <section class="breadcrumb-section section-b-space">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="page-title">
                        <h2>Shop</h2>
                    </div>
                </div>
                <div class="col-12">
                    <nav aria-label="breadcrumb" class="theme-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            @if($seller)
                                <li class="breadcrumb-item active" aria-current="page" data-toggle="tooltip" data-placement="top"
                                    title="Phone number: {{ $seller->phone }}">{{ $seller->name }} ({{ $seller->email }})</li>
                            @else
                                <li class="breadcrumb-item active" aria-current="page">Our products</li>
                            @endif
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb End -->
    <!-- section start -->
    <section class="section-b-space ratio_square">
        <div class="collection-wrapper">
            <div class="container">
                <div class="row">
                    <div class="collection-content col">
                        <div class="page-main-content">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="collection-product-wrapper">
                                        <div class="product-top-filter">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="popup-filter">
                                                        <div class="sidebar-popup"><a class="popup-btn">filter
                                                                products</a></div>
                                                        <div class="open-popup">
                                                            <div class="collection-filter">
                                                                <!-- side-bar colleps block stat -->
                                                                <div class="collection-filter-block">
                                                                    <!-- brand filter start -->
                                                                    <div class="collection-mobile-back"><span
                                                                            class="filter-back"><i
                                                                                class="fa fa-angle-left"
                                                                                aria-hidden="true"></i> back</span>
                                                                    </div>
                                                                    <form method="get" action="">
                                                                        <div class="collection-collapse-block open">
                                                                            <h3 class="collapse-block-title">
                                                                                Category</h3>
                                                                            <div
                                                                                class="collection-collapse-block-content">
                                                                                <div class="collection-brand-filter">
                                                                                    <div
                                                                                        class="custom-control custom-checkbox collection-filter-checkbox">
                                                                                        <input type="radio"
                                                                                               class="custom-control-input"
                                                                                               name="category"
                                                                                               value="all"
                                                                                               {{ request("category")=="all"?'checked':'' }}
                                                                                               id="all">
                                                                                        <label
                                                                                            class="custom-control-label"
                                                                                            for="all">All</label>
                                                                                    </div>
                                                                                    @foreach($categories as $category)
                                                                                        <div
                                                                                            class="custom-control custom-checkbox collection-filter-checkbox">
                                                                                            <input type="radio"
                                                                                                   class="custom-control-input"
                                                                                                   name="category"
                                                                                                   value="{{ $category->slug }}"
                                                                                                   {{ request("category")==$category->slug?'checked':'' }}
                                                                                                   id="{{ $category->name }}">
                                                                                            <label
                                                                                                class="custom-control-label"
                                                                                                for="{{ $category->name }}">{{ $category->name }}</label>
                                                                                        </div>
                                                                                    @endforeach
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div
                                                                            class="collection-collapse-block border-0 open">
                                                                            <input type="submit" class="btn btn-solid"
                                                                                   value="Filter Products">
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <!-- silde-bar colleps block end here -->
                                                            </div>
                                                        </div>
                                                        <div class="collection-view">
                                                            <ul>
                                                                <li><i class="fa fa-th grid-layout-view"></i></li>
                                                                <li><i class="fa fa-list-ul list-layout-view"></i></li>
                                                            </ul>
                                                        </div>
                                                        <div class="collection-grid-view">
                                                            <ul>
                                                                <li><a href="javascript:void(0)"
                                                                       class="product-2-layout-view">
                                                                        <ul class="filter-select">
                                                                            <li></li>
                                                                            <li></li>
                                                                        </ul>
                                                                    </a></li>
                                                                <li><a href="javascript:void(0)"
                                                                       class="product-3-layout-view">
                                                                        <ul class="filter-select">
                                                                            <li></li>
                                                                            <li></li>
                                                                            <li></li>
                                                                        </ul>
                                                                    </a></li>
                                                                <li><a href="javascript:void(0)"
                                                                       class="product-4-layout-view">
                                                                        <ul class="filter-select">
                                                                            <li></li>
                                                                            <li></li>
                                                                            <li></li>
                                                                            <li></li>
                                                                        </ul>
                                                                    </a></li>
                                                                <li><a href="javascript:void(0)"
                                                                       class="product-6-layout-view">
                                                                        <ul class="filter-select">
                                                                            <li></li>
                                                                            <li></li>
                                                                            <li></li>
                                                                            <li></li>
                                                                            <li></li>
                                                                            <li></li>
                                                                        </ul>
                                                                    </a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="product-page-filter">
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
                                            </div>
                                        </div>
                                        <div class="product-wrapper-grid">
                                            <div class="row">
                                                @if($products->count()>0)
                                                    @foreach($products as $product)
                                                        <div class="col-xl-3 col-6 col-grid-box">
                                                            <div class="product-box">
                                                                <div class="img-block">
                                                                    <a href="/item/{{ $product->slug }}"><img
                                                                            src="{{ $product->product_image }}"
                                                                            class=" img-fluid bg-img" alt=""></a>
                                                                </div>
                                                                <div class="product-info">
                                                                    <div>
                                                                        <a href="/item/{{ $product->slug }}">
                                                                            <h6>{{ $product->title }}</h6></a>
                                                                        <p>{{ $product->title }}
                                                                            By {!! $product->seller->name !!}</p>
                                                                        @if($product->discount)
                                                                            <del
                                                                                class="text-warning">{{ number_format($product->price) }}
                                                                                Rwf
                                                                            </del>
                                                                            <h5>{{ number_format($product->discount->price) }}
                                                                                Rwf</h5>
                                                                        @else
                                                                            @if($product->min_price > 0 and $product->max_price > 0)
                                                                                <h5 class="d-flex justify-content-between">
                                                                                    <span> {{ number_format($product->min_price) }} Rwf</span>
                                                                                    <span>-</span>
                                                                                    <span> {{ number_format($product->max_price) }} Rwf</span>
                                                                                </h5>
                                                                            @else
                                                                                <h5>{{ number_format($product->price) }}
                                                                                    Rwf</h5>
                                                                            @endif
                                                                        @endif
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
                                                        {{--                                                        <nav aria-label="Page navigation">--}}
                                                        {{--                                                           --}}
                                                        {{--                                                        --}}{{--    <ul class="pagination">--}}
                                                        {{--                                                                <li class="page-item"><a class="page-link" href="#"--}}
                                                        {{--                                                                                         aria-label="Previous"><span--}}
                                                        {{--                                                                            aria-hidden="true"><i--}}
                                                        {{--                                                                                class="fa fa-chevron-left"--}}
                                                        {{--                                                                                aria-hidden="true"></i></span> <span--}}
                                                        {{--                                                                            class="sr-only">Previous</span></a></li>--}}
                                                        {{--                                                                <li class="page-item active"><a class="page-link"--}}
                                                        {{--                                                                                                href="#">1</a></li>--}}
                                                        {{--                                                                <li class="page-item"><a class="page-link"--}}
                                                        {{--                                                                                         href="#">2</a></li>--}}
                                                        {{--                                                                <li class="page-item"><a class="page-link"--}}
                                                        {{--                                                                                         href="#">3</a></li>--}}
                                                        {{--                                                                <li class="page-item"><a class="page-link" href="#"--}}
                                                        {{--                                                                                         aria-label="Next"><span--}}
                                                        {{--                                                                            aria-hidden="true"><i--}}
                                                        {{--                                                                                class="fa fa-chevron-right"--}}
                                                        {{--                                                                                aria-hidden="true"></i></span> <span--}}
                                                        {{--                                                                            class="sr-only">Next</span></a></li>--}}
                                                        {{--                                                            </ul>--}}
                                                        {{--                                                        </nav>--}}
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
                </div>
            </div>
        </div>
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
@endpush
