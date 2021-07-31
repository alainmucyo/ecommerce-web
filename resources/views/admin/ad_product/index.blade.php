@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>List Ad Products</h5>
                        <div class="float-right">
                            <a href="{{ route("ad-product.create") }}" class="btn btn-primary">CREATE NEW</a>
                        </div>

                    </div>
                    <div class="card-body table-responsive">

                        <table class="table">
                            <thead>
                            <tr>
                                <th class="text-center">NO</th>
                                <th class="text-center">Title</th>
                                <th class="text-center">Location</th>
                                <th class="text-center">Modify</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">
                                        <a href="{{ $product->product_image }}" target="_blank" class="image_link">
                                            <img src="{{ $product->product_image }}" class="product_image" alt="">
                                        </a>
                                        {{ str_limit($product->title,30) }}
                                    </td>
                                    <td class="text-center">
                                        {{ str_limit($product->details,30) }}
                                    </td>
                                    <td class="text-center">
                                        <form method="post" action="{{ route("ad-product.destroy",$product->id) }}" onsubmit="return comfirm('Delete the product?')">
                                            {{ method_field("DELETE") }}
                                            <a href="{{ route("ad-product.edit",$product->id) }}"
                                               class="btn-icon btn-icon-only btn-pill btn btn-outline-info"><i
                                                    class="feather icon-edit btn-icon-wrapper"> </i></a>
                                            @csrf
                                            <button type="submit"
                                                    class="btn-icon btn-icon-only btn-pill btn btn-outline-danger"><i
                                                    class="feather icon-trash btn-icon-wrapper"> </i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push("scripts")
    <script type="text/javascript" src="/datatable/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="/datatable/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="/datatable/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">
        $(function () {
            $(".table").DataTable();
        })
    </script>
@endpush
