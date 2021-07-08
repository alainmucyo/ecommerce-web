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
Vue.component("app-user-address", UserAddress);
Vue.component("app-checkout", Checkout);
Vue.component("app-home-section", HomeSection);
Vue.filter("currency", (value, arg) => {
    return Number(value).toLocaleString() + " " + arg
})
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
import UserAddress from "./components/UserAddress";
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
        }
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
                sizes: JSON.parse(product.sizes),
                image: product.images[0] ? product.images[0].image : ''
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
        }
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
        /* this.$on("fillAddress", address => {
             this.form_buy.address = address
         }) */
    }
});

