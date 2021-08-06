@extends('layouts.app')
@section('content')
    <div class="container" id="app">
        <vue-progress-bar></vue-progress-bar>
        <app-image :product="{{ $product }}" :props-product-images="{{ $images }}"></app-image>
    </div>
@endsection
@push("scripts")
    <script type="text/javascript" src="/js/app.js"></script>
@endpush
