@extends('layouts.app')
@section('content')
    <div class="container" id="app">
        <vue-progress-bar></vue-progress-bar>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>List All Orders</h5>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-stripped" style="width: 100%">
                            <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Price</th>
                                <th>Items</th>
                                <th>Customer</th>
                                <th>Address</th>
                                <th>Created</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order_id=>$order_products)
                                @php($order=\App\Order::find($order_id))
                                <tr>
                                    <td>
                                        <div style="display: none"> {{ $order->customer }}{{ $order->paymentMode }}{{ $order->deliveryFee }}{{ $order->province }}
                                            {{ $order->district }}{{ $order->sector }}{{ $order->cell }}{{ $order->village }}</div>
                                        <a @click.prevent="showOrderProducts({{ $order }})" href="#"
                                           class="text-primary"
                                           data-toggle="tooltip" data-placement="top"
                                           title="Click To View Products">#{{ $order->order_id }}</a>
                                    </td>
                                    <td>{{ number_format($order_products->where("seller_id",auth()->user()->id)->sum(function ($q){return $q->price *$q->quantity;})) }}
                                        Rwf
                                    </td>
                                    <td> {{ $order_products->count() }}</td>
                                    <td><a href="/chatbox/seller?customer={{ $order->customer->id }}" class="text-primary">
                                        {{ $order->customer->name }}</a></td>
                                    <td>{{ $order->province->name }}, {{ $order->district->name }}</td>
                                    <td>{{$order->created_at->toDateString()}}</td>
                                    <td>
                                        @if($order_products->where("delivered",1)->count()!=$order_products->count())
                                            <form method="post" onsubmit="return confirm('Deliver the order?')"
                                                  action="/order/delivered/{{$order->id}}">
                                                {{ method_field("PUT") }}
                                                @csrf
                                                <button type="submit" data-toggle="tooltip" data-placement="top"
                                                        title="Deliver The Order" href="#"
                                                        class="btn-icon btn-icon-only btn-pill btn btn-outline-success"
                                                ><i
                                                        class="feather icon-check btn-icon-wrapper"> </i></button>
                                            </form>
                                        @else
                                            @if($order_products->where("delivered",1)->count()==$order_products->count())
                                                <span
                                                    class="badge badge-primary">Delivered At {{ $order_products->first()->delivered_at }}</span>
                                                <br>
                                            @endif
                                            @if($order_products->where("received",1)->count()==$order_products->count())
                                                <span
                                                    class="badge badge-success">Received At {{ $order_products->first()->received_at }}</span>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade orders" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content ">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Order #@{{ order?order.order_id:'' }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <center v-if="order_products==null">
                            <img src="/img/loader.gif">
                        </center>
                        <div v-else class="row">
                            <div class="col-md-6">
                                <p><strong>Customer Name:</strong> @{{ order.customer.name }}</p>
                                <p><strong>Customer Email:</strong> @{{ order.customer.email }}</p>
                                <p><strong>Customer Phone:</strong> @{{ order.customer.phone }}</p>
                                <p><strong>Payment Mode:</strong> @{{ order.payment_mode.name }}</p>
                                <p><strong>Price:</strong> <span class="badge badge-primary">@{{ order.price | currency("Rwf") }}</span>
                                </p>
                                <p><strong>Done At:</strong> @{{ order.created_at }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Shipping:</strong><span class="badge badge-primary">@{{ order.delivery_fee.title }}</span>
                                </p>
                                <p><strong>Province:</strong> @{{ order.province.name }}</p>
                                <p><strong>District:</strong> @{{ order.district.name }}</p>
                                <p><strong>Sector:</strong> @{{ order.sector.name }}</p>
                                <p><strong>Cell:</strong> @{{ order.cell.name }}</p>
                                <p><strong>Village:</strong> @{{ order.village.name }}</p>
                                <p>
                                    <a :href="'/chatbox/seller?customer='+order.customer.id"> <span class="fa fa-comment"></span> Chat with customer</a>
                                </p>
                            </div>
                            <hr>
                            <div class="col-sm-12 table-responsive">
                                <table class="table cart-table table-responsive-xs">
                                    <thead>
                                    <tr class="table-head">
                                        <th scope="col">product</th>
                                        <th scope="col">price</th>
                                        <th scope="col">Insurance</th>
                                        <th scope="col">description</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody v-for="product in order_products">
                                    <tr>
                                        <td>
                                            <a class="image_link" :href="product.product_image">
                                                <img :src="product.product_image" class="product_image" alt="Image">
                                            </a>
                                            <a :href="'/item/'+product.slug">@{{ product.product }}</a>
                                        </td>
                                        <td>
                                            <h5>@{{ product.price | currency("Rwf") }}</h5>
                                        </td>
                                        <td>
                                            @{{ product.insurance | currency("Rwf") }} / each
                                        </td>
                                        <td>
                                            <span v-if="product.size">Size: @{{product.size}}</span>
                                            <br>
                                            <span>Qty: @{{ product.quantity }}</span>
                                        </td>
                                        <td>
                                            <form v-if="!product.delivered" method="post"
                                                  onsubmit="return confirm('Product Delivered?')"
                                                  :action="'/order/product/delivered/'+product.id">
                                                {{ method_field("PUT") }}
                                                @csrf
                                                <button type="submit" data-toggle="tooltip" data-placement="top"
                                                        title="Deliver A single product" href="#"
                                                        class="btn-icon btn-icon-only btn-pill btn btn-outline-success"
                                                ><i
                                                        class="feather icon-check btn-icon-wrapper"> </i></button>
                                            </form>
                                            <div v-else>
                                                <span v-if="product.delivered" class="badge badge-primary">Delivered At @{{ product.delivered_at }}</span>
                                                <br>
                                                <span v-if="product.received" class="badge badge-success">Received At @{{ product.received_at }}</span>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push("scripts")
    <script src="/js/new_app.js" type="text/javascript"></script>
    <script type="text/javascript" src="/datatable/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="/datatable/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="/datatable/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="/datatable/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="/datatable/buttons.bootstrap4.min.js"></script>
    <script type="text/javascript" src="/datatable/jszip.min.js"></script>
    <script type="text/javascript" src="/datatable/pdfmake.min.js"></script>
    <script type="text/javascript" src="/datatable/vfs_fonts.js"></script>
    <script type="text/javascript" src="/datatable/buttons.html5.min.js"></script>
    <script type="text/javascript" src="/datatable/buttons.print.min.js"></script>
    <script type="text/javascript" src="/datatable/buttons.colVis.min.js"></script>
    <script type="text/javascript" src="/datatable/buttons.print.min.js"></script>
    <script type="text/javascript" src="/datatable/buttons.colVis.min.js"></script>
    <script type="text/javascript" src="/datatable/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="/datatable/responsive.bootstrap.min.js"></script>
    <script !src="">
        var table = $('.table').DataTable({
            dom: 'Bfrtip',
            responsive: true,
            "aaSorting": [],
            "order": [[ 5, "desc" ]],
            lengthChange: true,
            buttons: [{
                extend: 'copy',
                exportOptions: {
                    columns: ':visible'
                }
            }, {
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
            }, {
                extend: 'pdf',
                exportOptions: {
                    columns: ':visible'
                }
            }, {
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
            }, 'colvis']

        });
        table.buttons().container()
            .appendTo('#example_wrapper .col-sm-6:eq(0)');
        $("#data").on("click", "tbody tr", function () {

        })

    </script>
    <style type="text/css">
        .dataTables_filter{
            float: right;
        }
        .dt-buttons > *{
            text-transform: uppercase !important;
        }
    </style>
    <script type="text/javascript">
        $(function(){
            $(".table").css("width","100%")
        })
    </script>

@endpush
