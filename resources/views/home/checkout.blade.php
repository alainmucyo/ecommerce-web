@extends("layouts.master")
@section("title", "Checkout")
@section("content")
    <section class="breadcrumb-section section-b-space" id="app">
        <div class="breadcrumb-area mb-4">
            <div class="mx-5">
                <div class="row">
                    <div class="col-md-12">
                        <div class="breadcrumb-content">
                            <ul class="nav">
                                <li><a href="/">Home</a></li>
                                <li>Checkout</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <app-checkout></app-checkout>
    </section>

@endsection
@push("scripts")
    <script type="text/javascript" src="/js/app.js?new_one"></script>
@endpush

