<!-- Quick-view modal popup start-->
<div class="modal fade bd-example-modal-lg theme-modal" id="quick-view" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content quick-view-modal">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <div class="row" style="padding: 2rem 0" v-if="modal_product">
                    <div class="col-lg-6 col-xs-12">
                        <div class="quick-view-img"><img :src="modal_product.image" alt=""
                                                         class="img-fluid "></div>
                    </div>
                    <div class="col-lg-6 rtl-text">
                        <div class="product-right">
                            <h2>@{{ modal_product.title }}</h2>
                            <h4 style="display: inline" v-if="modal_product.discount">@{{ modal_product.discount.price |
                                currency("Rwf") }}
                            </h4> &nbsp;
                            <del class="text-warning" v-if="modal_product.discount"
                                 style="display: inline;">@{{ modal_product.price | currency("Rwf") }}
                            </del>
                            &nbsp;
                            <app-countdown v-if="modal_product.discount"
                                           :time="modal_product.discount.end_time"></app-countdown>
                            <h3 v-if="!modal_product.discount">@{{ modal_product.price | currency("Rwf") }}</h3>
                            {{--  <h3 style="display: inline">@{{ modal_product.price | currency("Rwf") }}</h3>
                              <app-countdown></app-countdown>--}}
                            <div class="border-product">
                                <h6 class="product-title">product details:</h6>
                                <p class="product-description" v-html="modal_product.description"></p>
                            </div>
                                <form method="post" action="{{ route("cart.store") }}">
                                    @csrf
                                    <div class="product-description border-product">
                                        <input :value="modal_product.id" name="product_id" type="hidden">
                                        <div v-if="modal_product.sizes.length>0" class="form-group">
                                            <label for="size">Size/Color:</label>
                                            <select id="size" class="form-control" name="size"
                                                    v-model="add_to_cart_form.size">
                                                <option v-for="size of modal_product.sizes">@{{size}}</option>
                                            </select>
                                            <input v-model="add_to_cart_form.size" name="size" type="hidden"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="quantity">Quantity:</label>
                                            <input type="number" id="quantity" :max="modal_product.client_max" min="1"
                                                   name="quantity"
                                                   v-model="add_to_cart_form.quantity"
                                                   class="form-control "
                                                   value="1">
                                        </div>


                                    </div>
                                    <div class="product-buttons">
                                        <button type="submit" name="buy" value="buy"
                                                class="btn btn-primary">
                                            Buy
                                        </button>
                                        @auth
                                            <button type="submit" class="btn btn-primary">add to cart</button>
                                        @else
                                            <a href="/login" class="btn btn-primary">Login
                                            </a>
                                            {{--                                    <a href="#" class="btn btn-solid">view detail</a>--}}
                                        @endif
                                    </div>
                                    @auth
                                </form>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Quick-view modal popup end-->
