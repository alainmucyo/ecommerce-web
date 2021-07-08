@extends('layouts.app')

@section('content')
    <div class="container" id="app">
        <vue-progress-bar></vue-progress-bar>
        <div class="row justify-content-center">
            <div class="col-md-11">
                <app-delivery-fee></app-delivery-fee>
            </div>
        </div>
    </div>
@endsection
@push("scripts")
    <script type="text/javascript" src="/js/new_app.js"></script>
@endpush
