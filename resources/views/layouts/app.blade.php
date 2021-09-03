<!DOCTYPE html>
<html lang="en">
<meta content="text/html;charset=UTF-8" http-equiv="content-type"/><!-- /Added by HTTrack -->
<head>
    <title>David's High Deals Dashboard</title>
    <!--[if lt IE 10]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" name="viewport">
    <meta content="IE=edge" http-equiv="X-UA-Compatible"/>
    <meta name="description"
          content="David High Deals Marketplace is an online modern, secure shop where you make orders and buy your needs online, easily and in a flash.">
    <meta name="keywords"
          content="David High Deals, store market , market place , market , africa ,   e commerce, rwanda, online, modern, shop, secure, clothes, accessories, watches, women, jewels, kigali">
    <meta name="author" content="David High Deals Marketplace">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-175795975-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'UA-175795975-1');
    </script>
    <link href="/img/logo.png" rel="icon" type="image/x-icon">

    <link href="/assets/fonts/fonts.googleapis.com/css0f7c.css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="/assets/fonts/fonts.googleapis.com/css1180.css?family=Quicksand:500,700" rel="stylesheet">

    <link href="/assets/files/bower_components/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">

    <link href="/assets/files/assets/pages/waves/css/waves.min.css" media="all" rel="stylesheet" type="text/css">

    <link href="/assets/files/assets/icon/feather/css/feather.css" rel="stylesheet" type="text/css">

    <link href="/assets/files/assets/css/style.css" rel="stylesheet" type="text/css">
    <link href="/assets/files/assets/icon/feather/css/feather.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css"
          href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/files/assets/css/widget.css">
    <link rel="stylesheet" type="text/css" href="/assets/files/assets/css/font-awesome-n.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
    <style>
        html {
            font-size: 14px;
        }

        .btn.btn-icon {
            position: relative;
        }

        .btn.btn-icon i {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        @media (min-width: 992px) {
            .modal-lg {
                max-width: 900px !important;
            }
        }

        .product_image {
            width: 3.5rem;
            height: 3.5rem;
            border-radius: 50%;
            object-fit: cover;
        }

        .image_link {
            opacity: .9;
            transition: all .2s;
            margin-right: .5rem;
        }

        .image_link:hover {
            opacity: 1;
        }
    </style>
</head>
<body>
<div class="pcoded" id="pcoded">
    <div class="pcoded-overlay-box"></div>
    <div class="pcoded-container navbar-wrapper">

        <nav class="navbar header-navbar pcoded-header">
            <div class="navbar-wrapper">
                <div class="navbar-logo">
                    <a href="/home">
                        <img alt="Logo" class="img-fluid" src="/img/dhd_logo.png"
                             style="width: 45%;"/>
                    </a>
                    <a class="mobile-menu" href="#!" id="mobile-collapse">
                        <i class="feather icon-menu icon-toggle-right"></i>
                    </a>
                    <a class="mobile-options waves-effect waves-light">
                        <i class="feather icon-more-horizontal"></i>
                    </a>
                </div>
                <div class="navbar-container container-fluid">
                    <ul class="nav-left">
                        <li>
                            <a href="#!"
                               onclick="if (!window.__cfRLUnblockHandlers) return false; javascript:toggleFullScreen()"
                               class="waves-effect waves-light" data-cf-modified-d8a79e998399f7e31336510f-="">
                                <i class="full-screen feather icon-maximize"></i>
                            </a>
                        </li>
                    </ul>

                    <ul class="nav-right">
                        <li class="header-notification">
                            <div class="dropdown-primary dropdown">

                                <div class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="feather icon-bell"></i>
                                    @if( $undelivered>0 || $unread_messages>0)
                                        <span
                                            class="badge bg-c-red">{{ $undelivered + $unread_messages}}</span>
                                    @endif
                                </div>

                                @if($undelivered>0 || $unread_messages>0)
                                    <ul class="show-notification notification-view dropdown-menu"
                                        data-dropdown-in="fadeIn"
                                        data-dropdown-out="fadeOut">
                                        <li>
                                            <h6>Notifications</h6>
                                            @if($undelivered>0 || $unread_messages>0)
                                                <label class="label label-danger">New</label>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="media">
                                                <div class="media-body">
                                                    @if($undelivered>0)
                                                        <h5 class="notification-user"><b>Undelivered orders</b></h5>
                                                        <p class="notification-msg">You have {{ $undelivered }}
                                                            undelivered
                                                            product(s)
                                                            orders.</p>
                                                        <br/>
                                                    @endif
                                                    @if($unread_messages>0)
                                                        <h5 class="notification-user"><b>Unread messages</b></h5>
                                                        <p class="notification-msg">You have {{ $unread_messages }}
                                                            unread
                                                            messages from customer(s).</p>
                                                        <br/>
                                                    @endif
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                @endif
                            </div>
                        </li>
                        <li class="user-profile header-notification">
                            <div class="dropdown-primary dropdown">
                                <div class="dropdown-toggle" data-toggle="dropdown">
                                    @if(auth()->user()->avatar != null)
                                        <img alt="User-Profile-Image" class="img-radius"
                                             src="{{auth()->user()->avatar}}" style="height: 40px">
                                    @else
                                        <img alt="User-Profile-Image" class="img-radius"
                                             src="/img/user.png" style="height: 40px">
                                    @endif
                                    <span>{{ auth()->user()->email }}</span>
                                    <i class="feather icon-chevron-down"></i>
                                </div>
                                <ul class="show-notification profile-notification dropdown-menu"
                                    data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">

                                    <li>
                                        <a href="/profile">
                                            <i class="feather icon-user"></i> Profile
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/chatbox/seller">
                                            <i class="feather icon-mail"></i> My Messages
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                            <i class="feather icon-log-out"></i> Logout
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                              style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="pcoded-main-container">
            <div class="pcoded-wrapper">
                @include("includes.admin")
                <div class="pcoded-content">

                    <div class="page-header card">
                        <div class="row align-items-end">
                            <div class="col-lg-8">
                                <div class="page-header-title">
                                    <i class="feather icon-watch bg-c-blue"></i>
                                    <div class="d-inline">
                                        <h5>David's High Deals shopping</h5>
                                        <span>Welcome to David's High Deals buying and selling.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="page-header-breadcrumb">
                                    <ul class=" breadcrumb breadcrumb-title">
                                        <li class="breadcrumb-item">
                                            <a href="/home"><i class="feather icon-home"></i></a>
                                        </li>
                                        <li class="breadcrumb-item">
                                            <a href="/home">Dashboard</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pcoded-inner-content">
                        <div class="main-body">
                            <div class="page-wrapper">
                                <div class="page-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            @yield("content")
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="styleSelector">
                </div>
            </div>
        </div>
    </div>
</div>

<!--[if lt IE 10]>
<div class="ie-warning">
<h1>Warning!!</h1>
<p>You are using an outdated version of Internet Explorer, please upgrade
    <br/>to any of the following web browsers to access this website.
</p>
<div class="iew-container">
    <ul class="iew-download">
        <li>
            <a href="http://www.google.com/chrome/">
                <img src="/assets/files/assets/images/browser/chrome.png" alt="Chrome">
                <div>Chrome</div>
            </a>
        </li>
        <li>
            <a href="https://www.mozilla.org/en-US/firefox/new/">
                <img src="/assets/files/assets/images/browser/firefox.png" alt="Firefox">
                <div>Firefox</div>
            </a>
        </li>
        <li>
            <a href="http://www.opera.com">
                <img src="/assets/files/assets/images/browser/opera.png" alt="Opera">
                <div>Opera</div>
            </a>
        </li>
        <li>
            <a href="https://www.apple.com/safari/">
                <img src="/assets/files/assets/images/browser/safari.png" alt="Safari">
                <div>Safari</div>
            </a>
        </li>
        <li>
            <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                <img src="/assets/files/assets/images/browser/ie.png" alt="">
                <div>IE (9 & above)</div>
            </a>
        </li>
    </ul>
</div>
<p>Sorry for the inconvenience!</p>
</div>
<![endif]-->
<script src="/assets/files/bower_components/jquery/js/jquery.min.js"
        type="d8a79e998399f7e31336510f-text/javascript"></script>
<script src="/assets/files/bower_components/jquery-ui/js/jquery-ui.min.js"
        type="d8a79e998399f7e31336510f-text/javascript"></script>
<script src="/assets/files/bower_components/popper.js/js/popper.min.js"
        type="d8a79e998399f7e31336510f-text/javascript"></script>
<script src="/assets/files/bower_components/bootstrap/js/bootstrap.min.js"
        type="d8a79e998399f7e31336510f-text/javascript"></script>

<script src="/assets/files/assets/pages/waves/js/waves.min.js" type="d8a79e998399f7e31336510f-text/javascript"></script>
<script src="/assets/files/bower_components/jquery-slimscroll/js/jquery.slimscroll.js"
        type="d8a79e998399f7e31336510f-text/javascript"></script>
<script src="/assets/files/assets/js/pcoded.min.js" type="d8a79e998399f7e31336510f-text/javascript"></script>
<script src="/assets/files/assets/js/vertical/vertical-layout.min.js"
        type="d8a79e998399f7e31336510f-text/javascript"></script>
<script src="/assets/files/assets/js/script.min.js" type="d8a79e998399f7e31336510f-text/javascript"></script>

<script data-cf-settings="d8a79e998399f7e31336510f-|49"
        defer=""
        src="/assets/fonts/ajax.cloudflare.com/cdn-cgi/scripts/7089c43e/cloudflare-static/rocket-loader.min.js"></script>
<script type="d8a79e998399f7e31336510f-text/javascript"
        src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script type="d8a79e998399f7e31336510f-text/javascript" src="/js/toastr.min.js"></script>
@if(session("success"))
    <script type="d8a79e998399f7e31336510f-text/javascript">
        $(function () {
            toastr.options.positionClass = 'toast-bottom-full-width';
            toastr.options.timeOut = '10000';
            toastr.success('{{ session("success") }}')
        })



    </script>
@endif
@if(session("info"))
    <script type="d8a79e998399f7e31336510f-text/javascript">
        $(function () {
            toastr.options.positionClass = 'toast-bottom-full-width';
            toastr.options.timeOut = '10000';
            toastr.info('{{ session("info") }}')
        })







    </script>
@endif
@if(session("error"))
    <script type="d8a79e998399f7e31336510f-text/javascript">
        $(function () {
            toastr.options.positionClass = 'toast-bottom-full-width';
            toastr.options.timeOut = '10000';
            toastr.error('{{ session("error") }}')
        })







    </script>
@endif
@if(count($errors))
    <script type="d8a79e998399f7e31336510f-text/javascript">
        $(function () {
            toastr.options.positionClass = 'toast-bottom-full-width';
            toastr.options.timeOut = '10000';
            toastr.error('Please, make sure all fields are filled correctly!')
        })







    </script>
@endif
@stack("scripts")

</body>

</html>
