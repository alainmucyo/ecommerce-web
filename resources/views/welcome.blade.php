<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="bigboost">
    <meta name="keywords" content="bigboost">
    <meta name="author" content="bigboost">
    {{--    <link rel="stylesheet" href="/themify-icons/demo-files/demo.css">--}}
    @include("includes.styles")
</head>
<body>

<!-- loader start -->
<div class="loader-wrapper">
    <div class=" bar">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>
</div>
<!-- loader end -->
<!-- header part start -->

@include("includes.header")
<div class="p-0 home-banner layout-2-menu shadow-home ">
    <div class="slide-1 home-slider">
        <div>
            <div class="home text-center p-center">
                <img src="/commerce/assets/images/home-banner/5.jpg" class="bg-img " alt="">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="slider-contain">
                                <div>
                                    <h5>all brands</h5>
                                    <h1>latest fashion</h1>
                                    <h4>save up to 50% off</h4>
                                    <a href="/shop" class="btn btn-solid">shop now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="home text-center p-center">
                <img src="/commerce/assets/images/home-banner/6.jpg" class="bg-img " alt="">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="slider-contain">
                                <div>
                                    <h5>all brands</h5>
                                    <h1>latest fashion</h1>
                                    <h4>save up to 50% off</h4>
                                    <a href="/shop" class="btn btn-solid">shop now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="home text-center p-center">
                <img src="/commerce/assets/images/home-banner/3.jpg" class="bg-img" alt="">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="slider-contain">
                                <div>
                                    <h5>all brands</h5>
                                    <h1>latest fashion</h1>
                                    <h4>save up to 50% off</h4>
                                    <a href="/shop" class="btn btn-solid">shop now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="app">
    <vue-progress-bar></vue-progress-bar>

    <!-- tab section end -->
    @include("includes.quick_view_modal")
</div>
@include("includes.footer")
</body>
</html>
