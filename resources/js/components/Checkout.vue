<template>
    <section class="section-b-space">
        <div class="container">
            <div class="checkout-page">
                <div class="checkout-form">
                    <form method="post" action="/checkout" @submit.prevent="buySubmit">
                        <div class="row">
                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                <div class="checkout-title">
                                    <h3>Billing Details</h3></div>
                                <div class="check-out">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Province</label>
                                            <multiselect v-model="address.form.province_id" track-by="id"
                                                         :allow-empty="false" placeholder="Select Province"
                                                         :multiple="false" label="name" @select="loadDistricts"
                                                         :options="address.provinces"></multiselect>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>District</label>
                                            <multiselect v-model="address.form.district_id" track-by="id"
                                                         :allow-empty="false" placeholder="Select District"
                                                         :multiple="false" label="name" @select="loadSectors"
                                                         :options="address.districts"></multiselect>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Sector</label>
                                            <multiselect v-model="address.form.sector_id" track-by="id"
                                                         :allow-empty="false" placeholder="Select Sector"
                                                         :multiple="false" label="name" @select="loadCells"
                                                         :options="address.sectors"></multiselect>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Cell</label>
                                            <multiselect v-model="address.form.cell_id" track-by="id"
                                                         :allow-empty="false" placeholder="Select Cell"
                                                         :multiple="false" label="name" @select="loadVillages"
                                                         :options="address.cells"></multiselect>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>Village</label>
                                            <multiselect v-model="address.form.village_id" track-by="id"
                                                         :allow-empty="false" placeholder="Select Village"
                                                         :multiple="false" label="name"
                                                         :options="address.villages"></multiselect>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                <div class="checkout-details">
                                    <div class="order-box">
                                        <div class="title-box">
                                            <div>Product <span>Total</span></div>
                                        </div>
                                        <ul class="qty">
                                            <li v-for="(cart_product,i) in cart_products" :key="cart_product.id">
                                                <label><input type="checkbox"
                                                              v-model="buy_list[i]"
                                                              class="mr-2"/> {{ cart_product.product.title }} ×
                                                    {{cart_product.quantity }}</label>
                                                <span>{{(cart_product.quantity*cart_product.price)+(insurances[i]?cart_product.quantity*cart_product.insurance :0) | currency("Rwf")}} </span>
                                                <div class="mt-2" v-if="cart_product.insurance">
                                                    <label class="d-flex align-items-center"> <input type="checkbox"
                                                                                                     :disabled="!buy_list[i]"
                                                                                                     v-model="insurances[i]"
                                                                                                     class="mr-2"/>Insurance
                                                        each
                                                        for {{ cart_product.insurance | currency("Rwf")}}</label>
                                                </div>
                                            </li>
                                        </ul>
                                        <ul class="sub-total">
                                            <li>Subtotal <span class="count">{{ sum | currency("Rwf")}}</span></li>
                                            <!--<li>Shipping
                                                <div class="shipping" style="width: auto">
                                                    <div class="shopping-option" v-for="delivery in delivery_fees">
                                                        <input type="radio" name="shipping" id="free-shipping">
                                                        <label for="free-shipping">{{ delivery.title }} ({{ delivery.price | currency("Rwf")}})</label>
                                                    </div>
                                                </div>
                                            </li>-->
                                        </ul>

                                    </div>
                                    <div class="payment-box">
                                        <div class="upper-box">
                                            <div class="payment-options">
                                                <ul>
                                                    <li v-for="delivery in delivery_fees">
                                                        <div class="radio-option">
                                                            <input type="radio" v-model="shipping" :value="delivery"
                                                                   :id="`shipping${delivery.id}`"
                                                            >
                                                            <label :for="`shipping${delivery.id}`">{{ delivery.title
                                                                }} ({{
                                                                delivery.amount | currency("Rwf")}})</label>
                                                        </div>
                                                    </li>
                                                </ul>

                                            </div>
                                        </div>
                                        <hr>
                                        <ul>
                                            <li style="position: relative;
                                                        display: inline-block;
                                                        font-size: 17px;
                                                        font-weight: 600;
                                                        color: #333333;
                                                        line-height: 20px;
                                                        margin-bottom: 20px;
                                                        width: 100%;">
                                                Total <span class="float-right" style="font-size: 19px;
                                                                                        line-height: 20px;
                                                                                        color: #fa812e;
                                                                                        font-weight: 400;
                                                                                        width: 35%;">{{ total | currency("Rwf") }}</span>
                                            </li>
                                        </ul>
                                        <hr>
                                        <div class="form-group">
                                            <label>Phone Number</label>
                                            <input
                                                :style="{ 'border': form_buy.errors.has('mobile_money')?'solid #ec167f 2px':'' }"
                                                type="tel"
                                                v-model="form_buy.mobile_money"
                                                >
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
                form_buy: new Form({
                    mobile_money: ''
                }),
                address: {
                    provinces: [],
                    districts: [],
                    sectors: [],
                    cells: [],
                    villages: [],
                    form: {
                        province_id: '',
                        district_id: '',
                        sector_id: '',
                        cell_id: '',
                        village_id: '',
                    }
                }
            }
        },
        methods: {
            loadProducts() {
                this.$Progress.start();
                axios.get("/api/checkout")
                    .then(resp => {
                        this.$Progress.finish();
                        this.cart_products = resp.data
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
                const final = {...this.form_buy, products, delivery_fee: this.shipping, address: this.address.form};
                axios.post('/api/buy', final)
                    .then(data => {/*
                    this.form_buy.clear();
                    this.form_buy.reset();*/
                        this.form_buy.busy = false;
                        // this.$toastr('success', 'Payment Done', 'Payment Done Successfully! Please check your phone for payment!');
                        // loader.hide();
                        this.$Progress.finish();
                        window.location = "/orders"
                    })
                    .catch(err => {
                        this.form_buy.busy = false;
                        // loader.hide();
                        if (err.response.status === 422) {
                            this.form_buy.errors.set(err.response.data)
                        }
                        if (err.response.status === 400) {
                            // this.$toastr("error", "Error", err.response.data)
                            window.location = "/orders"
                        }
                        this.$Progress.fail()
                    })
            },
            loadProvinces() {
                this.$Progress.start();
                axios.get("/api/provinces")
                    .then(resp => {
                        this.$Progress.finish();
                        this.address.provinces = resp.data
                    })
                    .catch(() => {
                        this.$Progress.fail();
                        console.log("error")
                    })
            },
            loadDistricts(selected) {
                this.$Progress.start();
                axios.get(`/api/districts/${selected.id}`)
                    .then(resp => {
                        this.$Progress.finish();
                        this.address.districts = resp.data
                    })
                    .catch(() => {
                        this.$Progress.fail();
                        console.log("error")
                    })
            },
            loadSectors(selected) {
                this.$Progress.start();
                axios.get(`/api/sectors/${selected.id}`)
                    .then(resp => {
                        this.$Progress.finish();
                        this.address.sectors = resp.data
                    })
                    .catch(() => {
                        this.$Progress.fail();
                        console.log("error")
                    })
            },
            loadCells(selected) {
                this.$Progress.start();
                axios.get(`/api/cells/${selected.id}`)
                    .then(resp => {
                        this.$Progress.finish();
                        this.address.cells = resp.data
                    })
                    .catch(() => {
                        this.$Progress.fail();
                        console.log("error")
                    })
            },
            loadVillages(selected) {
                this.$Progress.start();
                axios.get(`/api/villages/${selected.id}`)
                    .then(resp => {
                        this.$Progress.finish();
                        this.address.villages = resp.data
                    })
                    .catch(() => {
                        this.$Progress.fail();
                        console.log("error")
                    })
            },
            loadUserDetails() {
                this.$Progress.start();
                axios.get("/api/user-details")
                    .then(resp => {
                        this.address.form.province_id = resp.data.province;
                        this.address.form.district_id = resp.data.district;
                        this.address.form.sector_id = resp.data.sector;
                        this.address.form.cell_id = resp.data.cell;
                        this.address.form.village_id = resp.data.village;

                        this.$Progress.finish();

                        this.loadDistricts(resp.data.province);
                        this.loadSectors(this.address.form.district_id);
                        this.loadCells(this.address.form.sector_id);
                        this.loadVillages(this.address.form.cell_id);
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
            this.loadProvinces();
        }
    }
</script>

<style scoped>

</style>
