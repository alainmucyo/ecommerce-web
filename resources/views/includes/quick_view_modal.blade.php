<!-- Quick-view modal popup start-->
<div class="modal fade bd-example-modal-lg theme-modal" tabindex="-1" role="dialog" id="quick-view" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document"
         style="margin: 0 auto;max-width: 960px;width: 960px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">x</span></button>
            </div>
            <div class="modal-body">
                <div class="row" v-if="modal_product">
                    <div class="col-md-5 col-sm-12 col-xs-12 mb-lm-100px mb-sm-30px">
                        <!-- Swiper -->
                        <div class="swiper-container gallery-top">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <img  class="img-responsive m-auto" :src="modal_product.product_image"
                                         alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7 col-sm-12 col-xs-12">
                        <div class="product-details-content quickview-content">
                            <h2>@{{ modal_product.title }}</h2>
                            <p class="reference">Reference:<span> @{{ modal_product.slug }}</span></p>
                            <div class="pricing-meta">
                                <ul>
                                    <li v-if="modal_product.discount">
                                        <span class="old-price text-danger">@{{ modal_product.discount.price | currency}}</span>
                                        - <span>@{{ modal_product.price | currency }}</span>
                                        &nbsp; <span class="badge badge-warning"
                                                     id="countdown"></span>
                                    </li>
                                    <li class="old-price no-cut" v-else>@{{ modal_product.price | currency }}
                                    </li>
                                                                        <h4 style="display: inline"
                                                                            v-if="modal_product.discount">@{{
                                                                            modal_product.discount.price |
                                                                            currency }}
                                                                        </h4> &nbsp;
                                    <del class="text-warning" v-if="modal_product.discount"
                                         style="display: inline;">@{{ modal_product.price | currency }}
                                    </del>
                                    &nbsp;
                                    <app-countdown v-if="modal_product.discount"
                                                   :time="modal_product.discount.end_time"></app-countdown>
                                </ul>
                            </div>
                            <p class="quickview-para" v-html="modal_product.description"></p>
                            <form method="post" action="{{ route("cart.store") }}">
                                @csrf
                                <div class="product-description border-product">
                                    <input :value="modal_product.id" name="product_id" type="hidden">
                                    <div v-if="modal_product.sizes.length>0" class="form-group">
                                        <label for="size">Size/Color:</label>
                                        <select id="size" class="form-control cursor-pointer" name="size"
                                                v-model="add_to_cart_form.size">
                                            <option v-for="size of modal_product.sizes" class="cursor-pointer">
                                                @{{size}}
                                            </option>
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
                                    @endauth
                                    <a :href="'/item/'+modal_product.slug" class="btn btn-primary">view detail</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Quick-view modal popup end-->
