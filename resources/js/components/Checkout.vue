<template>
    <section class="section-b-space">
        <div class="mx-5">
            <div class="checkout-page">
                <div class="checkout-form">
                    <form method="post" action="/checkout" @submit.prevent="buySubmit">
                        <div class="row">
                            <div class="col-lg-7">
                                <div class="checkout-title">
                                    <h3>Billing Details</h3></div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="billing-info mb-20px">
                                            <label>Names</label>
                                            <input class="form-control" type="text" name="name"
                                                   :style="{ 'border': errors.name && errors.name[0] ? 'solid #ec167f 2px':'' }"
                                                   v-model="address.name" placeholder="Please enter your name"
                                                   autocomplete="off"/>
                                            <label v-if="errors.name" class="text-danger">{{ errors.name[0] }}</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Email Address</label>
                                        <input type="email" autocomplete="off" v-model="address.email" name="email"
                                               :style="{ 'border': errors.email && errors.email[0] ? 'solid #ec167f 2px':'' }"
                                               class="form-control" placeholder="Please enter your email address"/>
                                        <label v-if="errors.email" class="text-danger">{{ errors.email[0] }}</label>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="billing-info mb-20px">
                                            <label>Phone Number</label>
                                            <input class="form-control" type="number" name="phone"
                                                   :style="{ 'border': errors.phone && errors.phone[0] ? 'solid #ec167f 2px':'' }"
                                                   v-model="address.phone" placeholder="Please enter your phone number"
                                                   autocomplete="off"/>
                                            <label v-if="errors.phone" class="text-danger">{{ errors.phone[0] }}</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="billing-info mb-20px">
                                            <label>Address</label>
                                            <input class="billing-address form-control"
                                                   placeholder="Enter shipping Address"
                                                   :style="{ 'border': errors.address && errors.address[0] ? 'solid #ec167f 2px':'' }"
                                                   type="text" v-model="address.address" autocomplete="off"/>
                                            <label v-if="errors.address"
                                                   class="text-danger">{{ errors.address[0] }}</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            <input type="checkbox" class="ml-2" name="reuse" v-model="address.reuse">
                                            Save these information for
                                            later
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 mt-md-30px mt-lm-30px">
                                <div class="checkout-details">
                                    <div class="your-order-area">
                                        <h3>Your order</h3>
                                        <div class="your-order-wrap gray-bg-4">
                                            <div v-if="cart_products && cart_products.length > 0">
                                                <div class="your-order-product-info">
                                                    <div class="your-order-top">
                                                        <ul>
                                                            <li>Product</li>
                                                            <li>Total</li>
                                                        </ul>
                                                    </div>
                                                    <div class="your-order-middle">
                                                        <ul class="qty">
                                                            <li v-for="(cart_product,i) in cart_products"
                                                                :key="cart_product.id">
                                                                <label class="order-middle-left"><input type="checkbox"
                                                                                                        v-model="buy_list[i]"
                                                                                                        class="mr-2"/>
                                                                    {{ cart_product.product.title }} ×
                                                                    {{ cart_product.quantity }}</label>
                                                                <span class="order-price">{{
                                                                        (cart_product.quantity * cart_product.price) + (insurances[i] ? cart_product.quantity * cart_product.insurance : 0) | currency("Rwf")
                                                                    }} </span>

                                                                <!--                                                        <div class="mt-2" v-if="cart_product.insurance">-->
                                                                <!--                                                            <label class="d-flex align-items-center"> <input-->
                                                                <!--                                                                type="checkbox"-->
                                                                <!--                                                                :disabled="!buy_list[i]"-->
                                                                <!--                                                                v-model="insurances[i]"-->
                                                                <!--                                                                class="mr-2"/>Insurance-->
                                                                <!--                                                                each-->
                                                                <!--                                                                for-->
                                                                <!--                                                                {{ cart_product.insurance | currency("Rwf") }}</label>-->
                                                                <!--                                                        </div>-->
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="your-order-bottom">
                                                        <ul>
                                                            <li v-for="delivery in delivery_fees"
                                                                class="your-order-shipping">
                                                                <div class="radio-option">
                                                                    <input type="radio" v-model="shipping"
                                                                           :value="delivery"
                                                                           :id="`shipping${delivery.id}`"
                                                                    >
                                                                    <label :for="`shipping${delivery.id}`">{{
                                                                            delivery.title
                                                                        }} ({{
                                                                            delivery.amount | currency("Rwf")
                                                                        }})</label>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="your-order-total">
                                                        <ul>
                                                            <li class="order-total">Subtotal</li>
                                                            <li class="text-info">{{ sum | currency("Rwf") }}</li>
                                                        </ul>
                                                        <ul>
                                                            <li class="order-total"> Total</li>
                                                            <li>{{ total | currency("Rwf") }}</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="form-group" v-if="current_currency.current=='rwf'">
                                                    <label>
                                                        <input type="checkbox" class="ml-2" name="reuse"
                                                               v-model="payment">
                                                        Pay with Mobile Money or Card
                                                    </label>
                                                </div>
                                                <div class="form-group" v-if="current_currency.current=='usd'">
                                                    <label>
                                                        <input type="checkbox" class="ml-2" name="reuse"
                                                               v-model="payment">
                                                        Pay with Card Or Bank
                                                    </label>
                                                </div>
                                                <div class="payment-box">
                                                    <div class="Place-order mt-25">

                                                        <a class="btn-hover p-0" href="#">
                                                            <button type="submit" class="text-white py-3 w-100"
                                                                    style="font-size: 1.3rem">
                                                                PLACE ORDER
                                                            </button>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div v-else>
                                                <span class="alert bg-info text-white">No Product Found On Your Cart List</span>
                                                <div class="payment-box">
                                                    <div class="Place-order mt-25">
                                                        <a class="btn-hover" href="/shop">Shop Now</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import {Form} from "vform";
import Multiselect from "vue-multiselect";

export default {
    name: "Checkout",
    components: {Multiselect},
    data() {
        return {
            buy_list: [true, true, true, true, true, true],
            cart_products: [],
            insurances: [],
            delivery_fees: [],
            shipping: null,
            payment: false,
            current_currency: {},
            form_buy: new Form({
                mobile_money: ''
            }),
            information_id: null,
            address: {
                name: "",
                email: "",
                phone: "",
                address: "",
                reuse: 1,
                user_id: ""
            },
            errors: {}
        }
    },
    methods: {
        loadProducts() {
            this.$Progress.start();
            axios.get("/api/checkout")
                .then(resp => {
                    this.$Progress.finish();

                    this.cart_products = resp.data.products
                    this.address.name = resp.data.information.name
                    this.address.email = resp.data.information.email
                    this.address.phone = resp.data.information.phone
                    this.address.address = resp.data.information.address
                    if (resp.data.information.id) {
                        this.information_id = resp.data.information.id
                    }
                })
                .catch(() => {
                    this.$Progress.fail();
                })
        },
        loadDeliveryFees() {
            this.$Progress.start();
            axios.get("/api/delivery-fees")
                .then(resp => {
                    this.$Progress.finish();
                    this.delivery_fees = resp.data;
                    this.shipping = resp.data[0]
                })
                .catch(() => {
                    this.$Progress.fail();
                })
        },
        buySubmit() {
            /*   let loader = this.$loading.show({
                   container: this.$refs.formContainer,
                   canCancel: false,
                   opacity: 0.3
               });*/
            this.$Progress.start();
            /*  if (this.form_buy.payment_mode == 2) {
                  const form = {...this.form_buy};
                  const products = this.cart_products.filter((cp, i) => {
                      return this.buy_list[i]
                  });
                  axios.post('/api/payment/', final)
                      .then(resp => {
                          // loader.hide();
                          // this.$toastr("success", "Redirecting", "Redirecting", 'Redirecting to payment page....');
                          window.location = resp.data.url;
                          this.$Progress.finish()

                      })
                      .catch(err => {
                          // loader.hide();
                          console.log(err.response);
                          this.$Progress.fail()
                      });
                  return
              }*/
            const mappedProducts = this.cart_products.map((cp, i) => {
                return {...cp, product: cp.product.id, insurance: this.insurances[i] ? cp.insurance : 0}
            });
            const products = mappedProducts.filter((cp, i) => {
                return this.buy_list[i]
            });
            const final = {
                ...this.form_buy,
                products,
                payment: this.payment,
                delivery_fee: this.shipping,
                address: this.address,
                id: this.information_id
            };
            axios.post('/api/buy', final)
                .then(({data}) => {/*
                    this.form_buy.clear();
                    this.form_buy.reset();*/
                    this.form_buy.busy = false;
                    // this.$toastr('success', 'Payment Done', 'Payment Done Successfully! Please check your phone for payment!');
                    // loader.hide();
                    this.$Progress.finish();
                    // window.location = "/orders"
                    if (data.link != null) {
                        window.location = data.link
                    } else {
                        // window.location = "/orders"
                    }
                })
                .catch(err => {
                    this.form_buy.busy = false;
                    // loader.hide();
                    if (err.response.status === 422) {
                        this.form_buy.errors.set(err.response.data)
                        this.errors = err.response.data
                    }
                    if (err.response.status === 500) {
                        // this.$toastr("error", "Error", err.response.data)
                        alert("Something went wrong, reload and try again.")
                    }
                    this.$Progress.fail()
                })
        },
        loadUserDetails() {
            this.$Progress.start();
            axios.get("/api/user-details")
                .then(resp => {
                    this.address.user_id = resp.data.id;
                    this.$Progress.finish();
                })
                .catch(() => {
                    this.$Progress.fail();
                    console.log("error")
                })
        }
    },
    computed: {
        sum() {
            let sum = 0;
            for (let i = 0; i < this.cart_products.length; i++) {
                if (this.buy_list[i])
                    sum += (this.cart_products[i].quantity * this.cart_products[i].price) + (this.insurances[i] ? this.cart_products[i].quantity * this.cart_products[i].insurance : 0)
            }
            return sum;
        },
        total() {
            if (this.sum == 0)
                return 0;
            return this.sum + (this.shipping ? this.shipping.amount : 0)
        }
    },
    created() {
        this.loadProducts();
        this.loadDeliveryFees();
        this.loadUserDetails();
        this.current_currency = window.currency
    }
}
</script>

<style scoped>

</style>
