@extends('layouts.app')
@section('content')
    <div class="container" id="app">
        <vue-progress-bar></vue-progress-bar>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h5> Edit Product</h5>
                    </div>
                    <div class="card-body">
                        <app-edit-product :product="{{ $product }}" :category="{{ $category }}"></app-edit-product>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push("scripts")
    <script type="text/javascript" src="/js/app.js"></script>
@endpush
