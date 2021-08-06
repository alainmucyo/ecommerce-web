@extends("layouts.master")
@section("title","Chat-Box")
@section("content")
    <section class="breadcrumb-section section-b-space">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="page-title">
                        <h2>Chat box</h2>
                    </div>
                </div>
                <div class="col-12">
                    <nav aria-label="breadcrumb" class="theme-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Messaging</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <section class="cart-section section-b-space">
        <div class="container" id="app">
            <vue-progress-bar></vue-progress-bar>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <test-chat :chatter_id="{{ request('seller_id')?:0 }}"></test-chat>
                </div>
            </div>
        </div>
    </section>
@endsection
@push("scripts")
    <script type="text/javascript" src="/js/app.js?new_one"></script>
@endpush
