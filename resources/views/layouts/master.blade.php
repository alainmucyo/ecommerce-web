<!DOCTYPE html>
<html lang="en">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Tajyire store market is an online modern, secure shop where you make orders and buy your needs online, easily and in a flash.">
    <meta name="keywords" content="Tajyire, store market , market , africa ,   e commerce, rwanda, online, modern, shop, secure, clothes, accessories, watches, women, jewels, kigali">
    <meta name="author" content="Tajyire store market">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-175795975-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-175795975-1');
    </script>
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
@include("includes.header")
<div id="app">
    <vue-progress-bar></vue-progress-bar>
@yield("content")
</div>
@include("includes.footer")
</body>
</html>
