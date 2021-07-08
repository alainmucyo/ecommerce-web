@extends("layouts.master")
@section("content")
    <!-- breadcrumb start -->
    <section class="breadcrumb-section section-b-space">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="page-title">
                        <h2>order history</h2>
                    </div>
                </div>
                <div class="col-12">
                    <nav aria-label="breadcrumb" class="theme-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">order history</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb End -->
    <!--section start-->
    <section class="cart-section order-history section-b-space">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <table class="table cart-table table-responsive-xs">
                        <thead>
                        <tr class="table-head">
                            <th scope="col">description</th>
                            <th scope="col">price</th>
                            <th scope="col">detail</th>
                            <th scope="col">status</th>
                            <th scope="col">received?</th>
                        </tr>
                        </thead>
                        @foreach($orders as $order)
                            <tbody>
                            <tr>
                                <td><a href="/customer/order/{{ $order->order_id }}"
                                       data-toggle="tooltip" data-placement="top"
                                       title="Click To For More Order Details">order no: <span
                                            class="dark-data text-primary">#{{ $order->order_id  }}</span>
                                        <br>{{ $order->product }}</a>
                                    <div class="mobile-cart-content row">
                                        <div class="col-xs-6">
                                            @if(!$order->payed)
                                                <span class="dark-data">Unpaid</span>
                                                ({{ $order->created_at->toDateString() }})
                                            @elseif($order->payed && !$order->status)
                                                <span class="dark-data">Ordered</span>
                                                ({{ $order->updated_at->toDateString() }})
                                            @else
                                                <span class="dark-data">Delivered</span>
                                                ({{ Carbon\Carbon::parse($order->delivered_at)->toDateString() }})
                                            @endif
                                        </div>
                                        <div class="col-xs-3">
                                            <h4 class="td-color">{{ number_format($order->price) }} Rwf</h4></div>
                                    </div>
                                </td>
                                <td>
                                    <h4>{{ number_format($order->price) }} Rwf</h4></td>
                                <td>
                                    <span>Items: {{ $order->products->count() }}</span>
                                </td>
                                <td>
                                    <div class="responsive-data">
                                        <h4 class="price">{{ number_format($order->price) }} Rwf</h4>
                                        <span>Products: {{ $order->products->count() }}</span>
                                    </div>
                                    @if(!$order->payed)
                                        <span class="dark-data">Unpaid</span> ({{ $order->created_at->toDateString() }})
                                    @elseif($order->payed && !$order->status && !$order->delivered)
                                        <span class="dark-data">Ordered</span> ({{ $order->payed_date->toDateString() }})
                                    @elseif($order->payed && !$order->status && $order->delivered)
                                        <span class="dark-data">Delivered</span>
                                        ({{  Carbon\Carbon::parse($order->delivered_date)->toDateString() }})
                                    @else
                                        <span class="dark-data">Received</span>
                                        ({{  Carbon\Carbon::parse($order->received_date)->toDateString() }})
                                    @endif
                                </td>
                                <td>
                                    @if(!$order->payed)
                                        <span class="badge badge-warning">Unpaid</span>
                                    @elseif($order->payed && !$order->delivered)
                                        <span class="badge badge-warning">Not Yet Delivered</span>
                                    @elseif($order->payed && $order->delivered && !$order->status)
                                        <a href="/customer/order/{{ $order->order_id }}"
                                           class="btn btn-sm btn-outline-primary">Received
                                        </a>
                                    @else
                                        <span class="badge badge-success">Received</span>
                                    @endif
                                </td>
                            </tr>
                            </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
            <div class="row cart-buttons">
                <div class="col-12 pull-right">
                    @if(request("orders"))
                        <a href="/orders" class="btn btn-solid btn-sm">Pending orders</a>
                    @else
                        <a href="?orders=all" class="btn btn-solid btn-sm">show all orders</a>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection

@push("scripts")
    <script src="/js/new_app.js" type="text/javascript"></script>
@endpush
