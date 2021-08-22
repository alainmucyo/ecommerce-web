<div id="cart_side" class="add_to_cart right">
    <a href="javascript:void(0)" class="overlay" onclick="closeCart()"></a>
    <div class="cart-inner">
        <div class="cart_top">
            <h3>my cart</h3>
            <div class="close-cart">
                <a href="javascript:void(0)" onclick="closeCart()">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </a>
            </div>
        </div>
        @auth
            @if($cart_products->count()>0)
                <div class="cart_media">
                    <ul class="cart_product">
                        @foreach($cart_products as $cart_product)
                            <li>
                                <div class="media">
                                    <a href="/item/{{ $cart_product->product->slug }}">
                                        <img alt="" class="mr-3" style="width: 70px"
                                             src="{{ $cart_product->product->product_image }}">
                                    </a>
                                    <div class="media-body">
                                        <a href="#">
                                            <h4>{{ $cart_product->title }}</h4>
                                        </a>
                                        <h4>
                                            <span>{{ $cart_product->quantity }} x {{ currencyConverter($cart_product->price) }}</span>
                                        </h4>
                                    </div>
                                </div>
                                <div class="close-circle">
                                    <a href="#"
                                       onclick="if(!confirm('Remove This Product From Cart?'))return;event.preventDefault();
                                           document.getElementById('cart{{ $cart_product->id }}').submit();">
                                        <i class="ti-trash" aria-hidden="true"></i>
                                    </a>
                                    <form id="cart{{ $cart_product->id }}"
                                          action="{{ route('cart.destroy',$cart_product->id) }}" method="POST"
                                          style="display: none;">
                                        {{ method_field("DELETE") }}
                                        @csrf
                                    </form>
                                    {{--   <form>
                                           <button type="submit">
                                               <i class="ti-trash" aria-hidden="true"></i>
                                           </button>
                                       </form>--}}
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <ul class="cart_total">
                        <li>
                            <div class="total">
                                <h5>subtotal : <span>{{ $sum }}</span></h5>
                            </div>
                        </li>
                        <li>
                            <div class="buttons">
                                <a href="/cart" class="btn btn-solid btn-block btn-solid-sm view-cart">view cart</a>
                                <a href="/checkout" class="btn btn-solid btn-solid-sm btn-block checkout">checkout</a>
                            </div>
                        </li>
                    </ul>
                </div>
                @else
                <div class="alert alert-info">Your Cart Is Empty</div>
            @endif
        @else
            <div class="alert alert-info">
                Please, Login To See Your Cart.
                <a href="/login">Click Here To Login</a>
            </div>
        @endauth
    </div>
</div>
