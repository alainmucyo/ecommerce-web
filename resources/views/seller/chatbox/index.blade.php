@extends('layouts.app')
@section("content")
    <div class="container" id="app">
        <vue-progress-bar></vue-progress-bar>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <test-chat  :chatter_id="{{ request('customer')?:0 }}"></test-chat>
            </div>
        </div>
    </div>
@endsection
@push("scripts")
    <script type="text/javascript" src="/js/new_app.js?new_one"></script>
@endpush
