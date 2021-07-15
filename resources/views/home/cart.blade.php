@extends("layouts.master")
@section("title","Cart-List")
@section("content")
    <section class="breadcrumb-section section-b-space">
        <div class="breadcrumb-area">
            <div class="mx-5">
                <div class="row">
                    <div class="col-md-12">
                        <div class="breadcrumb-content">
                            <ul class="nav">
                                <li><a href="/">Home</a></li>
                                <li>Cart</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if (\Session::has('success'))
            <div class="alert alert-success ml-auto mt-2" style="width: fit-content">
                <ul class="list-unstyled" style="width: fit-content">
                    <li>{!! \Session::get('success') !!}</li>
                </ul>
            </div>
        @endif
        @if (\Session::has('danger'))
            <div class="alert alert-danger ml-auto" style="width: fit-content">
                <ul class="list-unstyled" style="width: fit-content">
                    <li>{!! \Session::get('danger') !!}</li>
                </ul>
            </div>
        @endif
        <div class="cart-main-area mb-5">
            <div class="mx-5">
                <h3 class="cart-page-title my-3">Your cart items</h3>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <form method="post" action="/cart/update">
                            {{ method_field("PUT") }}
                            @csrf
                            <div class="table-content table-responsive cart-table-content">
                                <table>
                                    <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Product Name</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                        <th>Action</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($cart_products as $cart_product)
                                        <tr>
                                            <td class="product-thumbnail">
                                                <a href="/item/{{ $cart_product->product->slug }}">
                                                    <img class="img-responsive"
                                                         {{--                                                     src="{{ $cart_product->product->product_image }}"--}}
                                                         src="assets/images/product-image/2-1.jpg" alt=""/></a>
                                            </td>
                                            <td class="product-name"><a
                                                    href="/item/{{ $cart_product->product->slug }}">{{ $cart_product->product->title }}</a>
                                            </td>
                                            <td class="product-price-cart"><span class="amount">{{ number_format($cart_product->price) }} Rwf</span>
                                            </td>
                                            <td class="product-quantity">
                                                <div class="cart-plus-minus">
                                                    <input class="cart-plus-minus-box" type="text"
                                                           max="{{ $cart_product->product->client_max }}"
                                                           min="1" name="quantity_mob[]"
                                                           value="{{ $cart_product->quantity }}">
                                                </div>
                                            </td>
                                            <td class="product-remove">
                                                <a href="#"><i class="icon-close"
                                                               onclick="if(!confirm('Remove This Product From Cart?'))return;event.preventDefault();
                                                                   document.getElementById('cart{{ $cart_product->id }}').submit();"></i></a>
                                            </td>
                                            <td class="product-price-cart">
                                                {{ number_format($cart_product->price*$cart_product->quantity) }}RFW
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6">
                                                <div class="col-md-8">
                                                    <div class="alert alert-info">No Cart For You available.</div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="cart-shiping-update-wrapper">
                                        <div class="cart-shiping-update">
                                            <a href="/shop">Continue Shopping</a>
                                        </div>
                                        @if(count($cart_products)>0)
                                            <div class="cart-clear">
                                                <button type="submit">Update Shopping Cart</button>
                                                <a href="/remove-all/cart">Clear Shopping Cart</a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 mt-md-30px">
                                <div class="grand-totall w-25 ml-auto">
                                    <div class="title-wrap">
                                        <h4 class="cart-bottom-title section-bg-gary-cart">Cart Total</h4>
                                    </div>
                                    <h5>Total Product <span>{{count($cart_products)}}</span></h5>
                                    <h4 class="grand-totall-title">Grand Total <span>{{$sum}}</span></h4>
                                    <a href="/checkout">Proceed to Checkout</a>
                                </div>
                            </div>
                        </div>
                        @foreach($cart_products as $cart_product)
                            <form id="cart{{ $cart_product->id }}"
                                  action="{{ route('cart.destroy',$cart_product->id) }}" method="POST"
                                  style="display: none;">
                                {{ method_field("DELETE") }}
                                @csrf
                            </form>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
