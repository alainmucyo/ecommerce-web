@extends("layouts.master")
@section("content")
    <!-- breadcrumb start -->
    <section class="breadcrumb-section section-b-space">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="page-title">
                        <h2>Check-out</h2>
                    </div>
                </div>
                <div class="col-12">
                    <nav aria-label="breadcrumb" class="theme-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Check-out</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb End -->
    <!-- section start -->
    {{--<section class="section-b-space">
        <div class="container">
            <div class="checkout-page">
                <div class="checkout-form">
                    <form method="post" action="/checkout" @submit.prevent="buySubmit">
                        <div class="row">
                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                <div class="checkout-title">
                                    <h3>Billing Details</h3></div>
                                <app-fill-address address="{{ auth()->user()->address }}"></app-fill-address>
                                <div class="row check-out">
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <div class="field-label">Address</div>
                                        <textarea name="" id="" cols="10" rows="5" v-model="form_buy.address"
                                                  placeholder="Street address"></textarea>
                                    </div>
                                    --}}{{-- <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                         <input type="checkbox" name="shipping-option" id="account-option"> &ensp;
                                         <label for="account-option">Place Order</label>
                                     </div>--}}{{--
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                <div class="checkout-details">
                                    <div class="order-box">
                                        <div class="title-box">
                                            <div>Product <span>Total</span></div>
                                        </div>
                                        <ul class="qty">
                                            @foreach($cart_products as $cart_product)
                                                <li>{{ $cart_product->product->title }} × {{ $cart_product->quantity }}
                                                    <span>{{number_format($cart_product->quantity*$cart_product->price)}} Rwf</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                        --}}{{--      <ul class="sub-total">
                                                  <li>Subtotal <span class="count">$380.10</span></li>
                                                  <li>Shipping
                                                      <div class="shipping">
                                                          <div class="shopping-option">
                                                              <input type="checkbox" name="free-shipping" id="free-shipping">
                                                              <label for="free-shipping">Free Shipping</label>
                                                          </div>
                                                          <div class="shopping-option">
                                                              <input type="checkbox" name="local-pickup" id="local-pickup">
                                                              <label for="local-pickup">Local Pickup</label>
                                                          </div>
                                                      </div>
                                                  </li>
                                              </ul>--}}{{--
                                        <ul class="total">
                                            <li>Total <span class="count">{{ $sum }}</span></li>
                                        </ul>
                                    </div>
                                    <div class="payment-box">
                                        <div class="upper-box">
                                            <div class="payment-options">
                                                <ul>
                                                    --}}{{-- <li>
                                                         <div class="radio-option">
                                                             <input type="radio" name="payment-group" id="payment-1"
                                                                    checked="checked">
                                                             <label for="payment-1">Check Payments<span
                                                                     class="small-text">Please send a check to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</span></label>
                                                         </div>
                                                     </li>
                                                     <li>
                                                         <div class="radio-option">
                                                             <input type="radio" name="payment-group" id="payment-2">
                                                             <label for="payment-2">Cash On Delivery<span
                                                                     class="small-text">Please send a check to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</span></label>
                                                         </div>
                                                     </li>--}}{{--
                                                    --}}{{--  <li>
                                                          <div class="radio-option paypal">
                                                              <input type="radio" name="payment-group" id="payment-3">
                                                              <label for="payment-3">PayPal<span class="image"><img
                                                                          src="/assets/assets/images/paypal.png"
                                                                          alt=""></span></label>
                                                          </div>
                                                      </li>--}}{{--
                                                </ul>
                                            </div>
                                        </div>
                                        <hr>
                                        <h3>Payment Mode</h3>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="momo">Mobile Money</label>
                                                <input
                                                    checked id="momo"
                                                    value="1" name="payment"
                                                    type="radio" v-model="form_buy.payment_mode">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="cc">Credit Card</label>
                                                <input
                                                    id="cc"
                                                    value="2" name="payment"
                                                    type="radio" v-model="form_buy.payment_mode">
                                            </div>
                                        </div>
                                        <div class="form-group" v-if="form_buy.payment_mode==1">
                                            <label>Phone Number(Required MTN)</label>
                                            <input
                                                :style="{ 'border': form_buy.errors.has('mobile_money')?'solid #ec167f 2px':'' }"
                                                type="tel"
                                                v-model="form_buy.mobile_money"
                                                value="+25078">
                                            <small style="color: #ec167f;" v-if="form_buy.errors.has('mobile_money')">Please
                                                Enter
                                                Valid MTN
                                                phone number</small>
                                        </div>
                                        <div class="text-right">
                                            <button type="submit" class="btn-solid btn">Place Order</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>--}}
    <app-checkout></app-checkout>
    <!-- section end -->
@endsection
@push("scripts")
    <script src="/js/app.js" type="text/javascript"></script>
@endpush
