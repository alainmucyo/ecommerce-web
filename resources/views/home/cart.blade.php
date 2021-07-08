@extends("layouts.master")
@section("content")
    <section class="breadcrumb-section section-b-space">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="page-title">
                        <h2>cart</h2>
                    </div>
                </div>
                <div class="col-12">
                    <nav aria-label="breadcrumb" class="theme-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Cart</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb End -->
    <!--section start-->
    <section class="cart-section section-b-space">
        <div class="container">
            <form method="post" action="/cart/update">
                {{ method_field("PUT") }}
                @csrf
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table cart-table table-responsive-xs striped-table">
                            <thead>
                            <tr class="table-head">
                                <th scope="col">image</th>
                                <th scope="col">product name</th>
                                <th scope="col">price</th>
                                <th scope="col">quantity</th>
                                <th scope="col">action</th>
                                <th scope="col">total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cart_products as $cart_product)
                                <tr>
                                    <td>
                                        <a href="/item/{{ $cart_product->product->slug }}">
                                            <img
                                                src="{{ $cart_product->product->product_image }}"
                                                alt="">
                                        </a>
                                    </td>
                                    <td>
                                        <a href="/item/{{ $cart_product->product->slug }}">{{ $cart_product->product->title }}</a>
                                        <div class="mobile-cart-content row">
                                            <div class="col-xs-3">
                                                <div class="qty-box">
                                                    <div class="input-group">
                                                        <input type="number"
                                                               max="{{ $cart_product->product->client_max }}"
                                                               min="1" name="quantity_mob[]"
                                                               class="form-control input-number"
                                                               value="{{ $cart_product->quantity }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-3">
                                                <h2 class="td-color">{{ number_format($cart_product->price) }} Rwf</h2>
                                            </div>
                                            <div class="col-xs-3">
                                                <h2 class="td-color"><a href="#" class="icon"
                                                                        onclick="if(!confirm('Remove This Product From Cart?'))return;event.preventDefault();
                                                                            document.getElementById('cart{{ $cart_product->id }}').submit();"><i
                                                            class="ti-close"></i></a>
                                                </h2></div>
                                        </div>
                                    </td>
                                    <td>
                                        <h2>{{ number_format($cart_product->price) }} Rwf</h2></td>
                                    <td>
                                        <div class="qty-box">
                                            <div class="input-group">
                                                <input type="number" max="{{ $cart_product->product->client_max }}"
                                                       min="1"
                                                       name="quantity[]" class="form-control input-number"
                                                       value="{{ $cart_product->quantity }}">
                                            </div>
                                        </div>
                                    </td>
                                    <td><a href="#" class="icon"
                                           onclick="if(!confirm('Remove This Product From Cart?'))return;event.preventDefault();
                                               document.getElementById('cart{{ $cart_product->id }}').submit();"><i
                                                class="ti-close"></i></a></td>

                                    <td>
                                        <h2 class="td-color">{{ number_format($cart_product->price*$cart_product->quantity) }}
                                            Rwf</h2></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <table class="table cart-table table-responsive-md">
                            <tfoot>
                            <tr>
                                <td style="text-align: start;width: 50%">total price :</td>
                                <td>
                                    <h2>{{ $sum }}</h2>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="row cart-buttons">
                    <div class="col-6"><a href="/checkout" class="btn btn-solid">check out</a></div>
                    <div class="col-6">
                        <button type="submit" class="btn btn-solid">update cart</button>
                    </div>
                </div>
            </form>
            @foreach($cart_products as $cart_product)
                <form id="cart{{ $cart_product->id }}"
                      action="{{ route('cart.destroy',$cart_product->id) }}" method="POST"
                      style="display: none;">
                    {{ method_field("DELETE") }}
                    @csrf
                </form>
            @endforeach
        </div>
    </section>
@endsection
