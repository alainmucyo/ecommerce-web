@extends('layouts.app')

@section('content')
    <div class="container">
        @if($soldProducts>0)
        <div class="row justify-content-center">
            <div class="col-xl-4 col-md-6">
                <div class="card prod-p-card card-red">
                    <div class="card-body">
                        <div class="row align-items-center m-b-30">
                            <div class="col">
                                <h6 class="m-b-5 text-white">Total Income</h6>
                                <h3 class="m-b-0 f-w-700 text-white">{{number_format($income)}} Rwf</h3>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-money-bill-alt text-c-red f-18"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="card prod-p-card card-blue">
                    <div class="card-body">
                        <div class="row align-items-center m-b-30">
                            <div class="col">
                                <h6 class="m-b-5 text-white">Total Orders</h6>
                                <h3 class="m-b-0 f-w-700 text-white">{{ number_format($orders) }}</h3>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-database text-c-blue f-18"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="card prod-p-card card-green">
                    <div class="card-body">
                        <div class="row align-items-center m-b-30">
                            <div class="col">
                                <h6 class="m-b-5 text-white">Sold Quantities</h6>
                                <h3 class="m-b-0 f-w-700 text-white">{{ number_format($quantity) }}</h3>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign text-c-green f-18"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="card prod-p-card card-yellow">
                    <div class="card-body">
                        <div class="row align-items-center m-b-30">
                            <div class="col">
                                <h6 class="m-b-5 text-white">Products Sold</h6>
                                <h3 class="m-b-0 f-w-700 text-white">{{ number_format($soldProducts) }}</h3>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-tags text-c-yellow f-18"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="card prod-p-card" style="background-color: #8e44ad!important;">
                    <div class="card-body">
                        <div class="row align-items-center m-b-30">
                            <div class="col">
                                <h6 class="m-b-5 text-white">Most Sold Products</h6>
                                <h5 class="m-b-0 f-w-700 text-white">{{ $most_sold_prod['title'] }}</h5>
                            </div>
                            <div class="col-auto">
                                <i style="color:  #8e44ad!important;" class="fas fa-user f-18"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="card prod-p-card card-info">
                    <div class="card-body">
                        <div class="row align-items-center m-b-30">
                            <div class="col">
                                <h6 class="m-b-5 text-white">Most Income Product</h6>
                                <h4 class="m-b-0 f-w-700 text-white">{{ $most_income_prod['title'] }}</h4>
                            </div>
                            <div class="col-auto">
                                <i style="color: #00bcd4 !important;" class="fas fa-money-bill-alt f-18"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h5>Income Statistics</h5></div>
            <div class="card-body">
                <div class="col-md-12" style="overflow: auto">
                    {!! $dailyChart->container() !!}
                </div>
                <div class="col-md-12" style="overflow: auto">
                    {!! $monthlyChart->container() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@push("scripts")
    <script src="/js/echarts-en.min.js" type="text/javascript"></script>
    {!! $dailyChart->script() !!}
    {!! $monthlyChart->script() !!}
@endpush
