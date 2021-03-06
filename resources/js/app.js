import VueProgressBar from 'vue-progressbar'
import {Form, HasError, AlertError} from 'vform'
import VueSweetalert2 from 'vue-sweetalert2'
import 'quill/dist/quill.core.css'
import 'quill/dist/quill.snow.css'
// import 'quill/dist/quill.bubble.css'
import VModal from 'vue-js-modal'

Vue.use(VModal);

require('./bootstrap');
Vue.use(VueSweetalert2);
import VueLazyload from 'vue-lazyload'

Vue.use(VueLazyload)

Vue.use(VueProgressBar, {
    color: '#21cde4',
    failedColor: '#d33',
    height: '10px',
    thickness: '10px',
    transition: {
        speed: '0.2s',
        opacity: '0.6s',
        termination: 300
    },
});

Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);
Vue.component("app-category", Category);
Vue.component("app-user", User);
Vue.component("app-create-product", CreateProduct);
Vue.component("app-edit-product", EditProduct);
Vue.component("app-product", Product);
Vue.component("app-image", Image);
Vue.component("app-product-tabs", ProductTabs);
Vue.component("app-fill-address", FillAddress);
Vue.component("test-chat", TestChat);
Vue.component("app-countdown", Countdown);
Vue.component("app-profile", Profile);
Vue.component("app-delivery-fee", DeliveryFee);
Vue.component("app-checkout", Checkout);
Vue.component("app-home-section", HomeSection);
Vue.filter("currency", (value) => {
    // console.log(window.currency);
    const currency = window.currency
    if(currency && currency.current) {
        switch (currency.current.toLowerCase()) {
            case "rwf":
                return (Number(value)).toLocaleString() + " Rwf"
            case "usd":
                if (Number(value) == 0) return "$0";
                return "$" + (Number(value) / currency.usd).toLocaleString();
            default:
                if (Number(value) == 0) return "0 Dirham";
                return (Number(value) / currency.dirham).toLocaleString() + " Dirham"
        }
    }
});
import Vue from 'vue'
import Category from "./components/Category";
import User from "./components/User";
import CreateProduct from "./components/CreateProduct";
import Product from "./components/Product";
import Image from "./components/Image";
import ProductTabs from "./components/ProductTabs";
import FillAddress from "./components/FillAddress";
import TestChat from "./components/TestChat";
import Countdown from "./components/Countdown";
import Profile from "./components/Profile";
import DeliveryFee from "./components/DeliveryFee";
import EditProduct from "./components/EditProduct";
import Checkout from "./components/Checkout";
import HomeSection from "./components/HomeSection";

const app = new Vue({
    el: '#app',
    data: {
        order_products: null,
        modal_product: null,
        test: "",
        type: 'customer',
        order: null,
        add_to_cart_form: {
            size: '',
            quantity: 1
        },
        cart: {
            quantity: [0]
        },
        homepage: {
            product: null,
            home_section_id: ''
        },
        showDiscount: false,
        product: null,
        discount: {
            end_date: '',
            end_time: '',
            new_price: 0
        },
        form_buy: {}
    },
    methods: {
        quickView(product) {
            $("#quick-view").modal("show");
            const sizes = JSON.parse(product.sizes);
            if (sizes.length > 0) {
                this.add_to_cart_form.size = sizes[0]
            }
            this.modal_product = {
                ...product,
                sizes: JSON.parse(product.sizes)
            }
        },
        changeQuantity(num) {
            if (this.add_to_cart_form.quantity >= this.modal_product.client_max || this.add_to_cart_form.quantity <= 0)
                return;
            this.add_to_cart_form.quantity++
        },
        addToCart() {
            console.log("Added To card")
        },
        showOrderProducts(order) {
            this.$Progress.start();
            this.order = order
            axios.get("/order/" + order.id)
                .then(resp => {
                    this.order_products = resp.data.data;
                    this.$Progress.finish()
                })
                .catch(() => {
                    this.$Progress.fail()
                });
            $("#exampleModal").modal("show");
        },
        showHomeModal(product) {
            this.homepage.product = product;
            this.homepage.home_section_id = product.home_section_id ? product.home_section_id : 'none';
            $("#homepageModal").modal("show")
        },
        toast(title, message, type) {
            this.$swal({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 6000,
                type: type ? type : 'success',
                title: title,
                text: message
            });
        },
        deleteCategory(product) {
            this.$swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    this.$Progress.start();
                    axios.delete("/product/" + product.id)
                        .then(resp => {
                            this.$Progress.finish();
                            const index = this.products.findIndex(s => s.id === product.id);
                            this.products.splice(index, 1);
                            this.$swal(
                                'Deleted!',
                                'Item has been deleted Successfully.',
                                'success'
                            ).then((result) => {
                                if (result.value) {
                                    window.location.reload(true);
                                    return false
                                }
                            })
                        })
                        .catch(err => {
                            this.$Progress.fail();
                            this.$swal(
                                'Deleted!',
                                'Item has been deleted!',
                                'success'
                            ).then((result) => {
                                if (result.value) {
                                    window.location.reload(true);
                                    return false
                                }
                            })
                        })
                }
            })
        },
        changeHomeSlider(product) {
            this.$swal({
                title: 'Are you sure?',
                text: `You want to ${product.home_slider ? "remove" : "add"} this product to home slider!`,
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: `Yes, ${product.home_slider ? "Remove" : "Add"} it!`
            }).then((result) => {
                if (result.value) {
                    this.$Progress.start();
                    axios.put("/change-slider/" + product.id, {'value': product.home_slider ? false : true})
                        .then(resp => {
                            this.$Progress.finish();
                            this.$swal(
                                'Update Slider!',
                                'Product has been Updated Done.',
                                'success'
                            ).then((result) => {
                                if (result.value) {
                                    window.location.reload(true);
                                    return false
                                }
                            })
                        })
                        .catch(err => {
                            this.$Progress.fail();
                            this.$swal(
                                'Update Slider!',
                                'Slider Update has been failed.',
                                'warning'
                            )
                        })
                }
            })
        },
        showModal(product_id) {
            this.clearDiscount();
            this.product = null;
            this.$Progress.start();
            axios.get("/product/" + product_id)
                .then(resp => {
                    this.product = resp.data.data;
                    this.$Progress.finish()
                    console.log(resp.data.data)
                })
                .catch(() => {
                    this.$Progress.fail()
                });
            $("#productModal").modal("show");
        },
        clearDiscount() {
            this.discount.new_price = 0;
            this.discount.end_date = "";
            this.discount.end_time = "";
            this.showDiscount = false
        },
        submitDiscount() {
            this.$Progress.start();
            axios.post("/discount", {
                end_time: this.discount.end_date + " " + this.discount.end_time,
                price: this.discount.new_price,
                product_id: this.product.id
            })
                .then(resp => {
                    this.$Progress.finish();
                    this.clearDiscount();
                    this.product.discount = resp.data
                })
                .catch(err => {
                    this.$Progress.fail();
                    console.log("error")
                })
        },
    },
    created() {
        this.$on("quick-view", product => {
            $("#quick-view").modal("show");
            const sizes = product.sizes;
            if (sizes.length > 0) {
                this.add_to_cart_form.size = sizes[0]
            }
            this.modal_product = {
                ...product,
            }
        });
        // this.$on("fillAddress", address => {
        //     this.form_buy.address = address
        // })
    }
});

