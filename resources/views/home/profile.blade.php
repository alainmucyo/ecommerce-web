@extends("layouts.master")
@section("content")
    <section class="breadcrumb-section section-b-space">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="page-title">
                        <h2>cart</h2>
                    </div>
                </div>
                <div class="col-12">
                    <nav aria-label="breadcrumb" class="theme-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Profile</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb End -->
    <!--section start-->
    <section class="cart-section section-b-space">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-9">
                    <app-profile></app-profile>
                </div>
            </div>
        </div>
    </section>
@endsection
@push("scripts")
    <script src="/js/app.js" type="text/javascript"></script>
@endpush
