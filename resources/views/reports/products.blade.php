@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>List Product</h5>
                    </div>
                    <div class="card-body table-responsive">
                        @if($products->count()>0)
                            <form>
                                <div class="form-row">
                                    <div class="offset-md-4 col-md-3">
                                        <div class="form-group">
                                            <label for="from">From: </label>
                                            <input type="date" value="{{ request("from") }}" name="from" id="from"
                                                   class="form-control"/>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="to">To: </label>
                                            <input type="date" name="to" value="{{ request("to") }}" id="to"
                                                   class="form-control"/>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>&nbsp;</label>
                                            <input type="submit" class="btn btn-primary btn-sm btn-block"
                                                   style="display: block" value="FILTER"/>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <table class="table table-stripped" style="width: 100%">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Ordered</th>
                                    <th>Delivered</th>
                                    <th>Received</th>
                                    <th>Sold Quantities</th>
                                    <th>Income</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>
                                            <a href="{{ $product->product_image }}" class="image_link" target="_blank">
                                                <img src="{{ $product->product_image }}" alt="" class="product_image">
                                            </a>
                                            {{ $product->title }}
                                        </td>
                                        <td>{{ number_format($product->price) }}
                                            Rwf
                                        </td>
                                        <td>
                                        <span
                                            class="badge badge-{{$product->orders_count>2?'primary':'warning'}}">{{ $product->orders_count }}</span>
                                        </td>
                                        <td>
                                        <span
                                            class="badge badge-{{$product->orders->where("delivered",1)->count() >1?'primary':'danger'}}">{{ $product->orders->where("delivered",1)->count()  }}</span>
                                        </td>
                                        <td>
                                        <span
                                            class="badge badge-{{$product->orders->where("received",1)->count()>0?'success':'warning'}}">{{ $product->orders->where("received",1)->count() }}</span>
                                        </td>
                                        <td>{{ $product->orders->sum("quantity") }}</td>
                                        <td>{{ number_format($product->orders->where("paid",1)->sum(function ($o){ return $o->quantity*$o->price; })) }}
                                            Rwf
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="alert alert-info">No Products available.</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push("scripts")
    @include("includes.datatable")
@endpush
