@extends("layouts.master")
@section("title","Order-Details")
@section("content")
    <style>
        .card {
            border-radius: 3px;
            border: solid #f6f6f6 1px;
            box-shadow: 0 3px 5px rgba(0, 0, 0, .1);
        }
    </style>
    <!-- breadcrumb start -->
    <section class="breadcrumb-section section-b-space">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="page-title">
                        <h2>order #{{ $order->order_id }}</h2>
                    </div>
                </div>
                <div class="col-12">
                    <nav aria-label="breadcrumb" class="theme-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">order #{{ $order->order_id }}</li>
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
            <div class="row justify-content-center">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header"><h5>Order #{{ $order->order_id }}
                                at {{ $order->created_at->toDateString() }}</h5></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Payment Mode: </strong>{{ $order->paymentMode?$order->paymentMode->name:'None' }}
                                    </p>
                                    <p><strong>Shipping:</strong><span class="badge badge-primary">{{ $order->deliveryFee->title }} For {{ currencyConverter($order->deliveryFee->amount) }}</span>
                                    </p>
                                    <p><strong>Total Price:</strong> <span class="badge badge-primary">{{ currencyConverter($order->price)}}</span>
                                    </p>
                                    <p><strong>Done At:</strong> {{ $order->created_at }}</p>

                                    <p><strong>Ordered: </strong>
                                        @if($order->payed) <span
                                            class="badge badge-primary">Ordered at {{ \Carbon\Carbon::parse($order->paid_at)->toDateString() }}</span> @else
                                            <span
                                                class="badge badge-warning">Not Ordered</span>@endif
                                    </p>
                                    <p><strong>Delivered: </strong>
                                        @if($order->delivered) <span
                                            class="badge badge-primary">Delivered at {{ \Carbon\Carbon::parse($order->delivered_at)->toDateString() }}</span> @else
                                            <span
                                                class="badge badge-warning">Not Yet Delivered</span>@endif
                                    </p>

                                </div>
                                <div class="col-md-6">
                                    @if($order->information)
                                        <p><strong>Name:</strong> {{ $order->information->name }}</p>
                                        <p><strong>Email:</strong> {{ $order->information->email }}</p>
                                        <p><strong>Phone Number:</strong> {{ $order->information->phone }}</p>
                                        <p><strong>Address:</strong> {{ $order->information->address }}</p>
                                    @else
                                        <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
                                        <p><strong>Phone Number:</strong> {{ auth()->user()->phone }}</p>
                                        <p><strong>Address:</strong> {{ auth()->user()->address }}</p>
                                    @endif
                                </div>
                                <div class="col-md-12">
                                    <hr>
                                    <table class="table cart-table table-responsive-xl">
                                        <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Product</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Total Price</th>
                                            <th scope="col">Seller</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Received</th>
                                        </tr>
                                        </thead>
                                        @foreach($order->products as $product)
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <a href="{{ $product->product->product_image }}" class="image_link"
                                                       target="_blank">
                                                        <img src="{{ $product->product->product_image }}" alt=""
                                                             class="product_image" style="width:4em; height: 3.5em">
                                                    </a>
                                                    <a href="/item/{{ $product->product->slug }}"
                                                       class="text-truncate text-primary"
                                                    >{{ $product->product->title }}</a>
                                                </td>
                                                <td><span data-toggle="tooltip" data-placement="top"
                                                          title="Quantity"> {{$product->quantity}} </span>
                                                    &times;
                                                    <span data-toggle="tooltip" data-placement="top"
                                                          title="Product Price"> {{ currencyConverter($product->price) }}</span>
                                                    @if($product->insurance>0)
                                                        <span data-toggle="tooltip" data-placement="top"
                                                              title="Insurance">  &plus; {{ currencyConverter($product->insurance) }}</span>
                                                    @endif
                                                    <div class="mobile-cart-content row">
                                                        <div class="col-xs-12">
                                                            Total: {{ currencyConverter($product->price*$product->quantity) }}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{ currencyConverter(($product->price*$product->quantity)+$product->insurance) }}

                                                </td>
                                                <td>
                                                    <a href="/chatbox/customer?seller={{ $product->seller->id }}"
                                                       data-toggle="tooltip" data-placement="top"
                                                       title="Chat With The Seller"
                                                       class="text-primary">Chat With Seller</a>
                                                </td>
                                                <td>
                                                    @if(!$order->payed)
                                                        <span class="dark-data">Unpaid</span>
                                                        ({{ $order->created_at->toDateString() }})
                                                    @elseif($order->payed && !$product->delivered)
                                                        <span class="dark-data">Ordered</span>
                                                        ({{ \Carbon\Carbon::parse($order->payed_at)->toDateString() }})
                                                    @else
                                                        <span class="dark-data">Delivered</span>
                                                        ({{  Carbon\Carbon::parse($product->delivered_at)->toDateString() }}
                                                        )
                                                    @endif
                                                </td>
                                                <td>
                                                    @if(!$order->payed)
                                                        <span class="badge badge-warning">Unpaid</span>
                                                    @elseif(!$product->delivered)
                                                        <span class="badge badge-warning">Not Delivered</span>
                                                    @elseif($order->payed && $product->delivered && !$product->received)
                                                        <form method="post" action="/order/product/{{ $product->id }}"
                                                              onsubmit="return confirm('Received The Product?')">
                                                            @csrf
                                                            {{ method_field("PUT") }}
                                                            <button type="submit"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Let Us Know You Received Our Order."
                                                                    class="btn btn-sm btn-outline-primary">Received
                                                            </button>
                                                        </form>
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
                        </div>
                    </div>
                </div>
            </div>
            <div class="row cart-buttons">
                <div class="col-12 pull-right">
                    <a href="/orders" class="btn btn-solid btn-sm">show all orders</a>
                </div>
            </div>
        </div>
    </section>
@endsection
