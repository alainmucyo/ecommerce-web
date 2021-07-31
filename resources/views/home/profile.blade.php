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
{{--    <script src="/js/new_app.js" type="text/javascript"></script>--}}
@endpush
