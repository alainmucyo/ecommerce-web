@extends('layouts.app')
@section('content')
    <div class="container" id="app">
        <vue-progress-bar></vue-progress-bar>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        List All Orders
                        <form action="" method="get">
                            <div class="form-row justify-content-end">
                                <div class="form-group col-md-3">
                                    <label for="sort">Sort By</label>
                                    <select name="sort" id="sort" class="form-control">
                                        <option value="prod_id" {{ request("sort")=="prod_id"?'selected':'' }}>Product
                                            ID
                                        </option>
                                        <option value="seller" {{ request("sort")=="seller"?'selected':'' }}>Seller
                                        </option>
                                        <option value="prod_name" {{ request("sort")=="prod_name"?'selected':'' }}>
                                            Product Name
                                        </option>
                                        <option value="times" {{ request("sort")=="times"?'selected':'' }}>Times Sold
                                        </option>
                                        <option value="likes" {{ request("sort")=="likes"?'selected':'' }}>Likes
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="">Seller</label>
                                    <select name="seller_id" id="sort" class="form-control">
                                        <option value="all" {{ request("seller_id")=="all"?'selected':'' }}>All</option>
                                        @foreach($sellers as $seller)
                                            <option
                                                value="{{$seller->id}}" {{ request("seller_id")==$seller->id?'selected':'' }}>{{ $seller->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label>&nbsp;</label>
                                    <br>
                                    <input type="submit" class="btn btn-primary btn-sm btn-block" value="FILTER"/>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body table-responsive">
                        @if($products->count()>0)
                            <table class="table table-stripped" style="width: 100%">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Price</th>
                                    <th>Seller</th>
                                    <th>Times Sold</th>
                                    <th>Likes</th>
                                    <th>Discount</th>
                                    <th>Homepage</th>
                                    <th>Created At</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{$product->id}}</td>
                                        <td data-toggle="tooltip" data-placement="top" title=" {{ $product->title }}">
                                            <a href="{{ $product->product_image }}" class="image_link" target="_blank">
                                                <img src="{{ $product->product_image }}" alt="" class="product_image">
                                            </a>
                                            {{ str_limit($product->title,30) }}
                                        </td>
                                        <td>{{ number_format($product->price) }}
                                            Rwf
                                        </td>
                                        <td> {{ $product->seller->shop_name?:$product->seller->name }}</td>
                                        <td>{{ $product->orderProducts->count() }}</td>
                                        <td>{{ $product->likes->count() }}</td>
                                        <td>
                                            @if($product->hasDiscount)
                                                <span class="badge badge-success">{{ number_format($product->discount->price)  }} Rwf</span>
                                            @else
                                                <span class="badge badge-info">No discount</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="#" @click.prevent="showHomeModal({{$product}})"
                                               data-toggle="tooltip" data-placement="top"
                                               title="Click To change home section">
                                                @if($product->homeSection)
                                                    <span
                                                        class="badge badge-primary">{{ $product->homeSection->name }}</span>
                                                @else
                                                    <span class="badge badge-warning">Not on home</span>
                                                @endif
                                            </a>
                                        </td>
                                        <td>{{$product->created_at->toDateString()}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-end">
                                {!!  $products->appends($_GET)->links() !!}
                            </div>
                        @else
                            <div class="alert alert-info">No Products Available</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="homepageModal" tabindex="-1" role="dialog" aria-labelledby="homepageModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content" v-if="homepage.product">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Product on home page</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form :action="'/admin/'+homepage.product.id+'/homepage'" method="post">
                        @csrf
                        {{ method_field("PUT") }}
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="home_type">Home Section</label>
                                <select name="home_section_id" id="home_type" class="form-control"
                                        v-model="homepage.home_section_id">
                                    @foreach($home_sections as $home_section)
                                        <option value="{{ $home_section->id }}">{{ $home_section->name }}</option>
                                    @endforeach
                                    <option value="none">None</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer ">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@push("scripts")
    <script type="text/javascript" src="/js/app.js?new=true"></script>
    {{--    @include("includes.datatable")--}}
@endpush
