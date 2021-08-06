@extends("layouts.master")
@section("title","Profile")
@section("content")
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
    <script type="text/javascript" src="/js/app.js?new_one"></script>
@endpush
