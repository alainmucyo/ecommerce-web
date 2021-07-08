@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5>Ad Products</h5>
                        <div class="float-right">
                            <a href="{{ route("ad-product.index") }}" class="btn btn-primary">LIST ALL</a>
                        </div>

                    </div>
                    <div class="card-body table-responsive">
                        <form action="{{ route("ad-product.store") }}" method="post" enctype="multipart/form-data">
                            @include("admin.ad_product._form",["btnText"=>"CREATE NEW"])
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
