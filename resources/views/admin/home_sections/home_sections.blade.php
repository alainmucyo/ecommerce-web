@extends('layouts.app')

@section('content')
    <div class="container" id="app">
        <vue-progress-bar></vue-progress-bar>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <app-home-section></app-home-section>
            </div>
        </div>
    </div>
@endsection
@push("scripts")
    <script type="text/javascript" src="/js/app.js?new=true12"></script>
@endpush
