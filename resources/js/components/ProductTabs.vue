<template>
    <section class="section-b-space vertical-tab vertical-tab2 ratio_square">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 pr-0">
                    <div class="tab-head">
                        <h2 class="title">last chance to buy</h2>
                    </div>
                    <div class="tab-inner">
                        <div class="theme-tab">
                            <span id="mob_tab_cls"></span>
                            <ul class="tabs ">
                                <li v-for="category of categories" :key="category.id"
                                    :class="{'current':selected_category==category.id}">
                                    <a @click.prevent="loadProducts(category.id)" href="#">{{ category.name}}</a>
                                </li>
                            </ul>
                            <div class="tab-content-cls">
                                <div style="width: 80% !important;">
                                    <div class="row">
                                        <div class="col-lg-4 col-6 pr-0" v-for="product of products" :key="product.id">
                                            <!--<div class="product-box full-box" style="border: 1px solid #eeeeee;margin-bottom: 3px;height: 320px" >
                                                <div class="img-block" style="height: 80%">
                                                    <a :href="'/item/'+product.slug"><img style="height: 100%;width: 100%"
                                                        :src="product.image"
                                                        class=" img-fluid bg-img" alt=""></a>
                                                    <div class="cart-details">
                                                        <button tabindex="0" class="addcart-box" title="Quick shop"><i
                                                            class="ti-shopping-cart"></i></button>

                                                        <a href="javascript:void(0)" data-toggle="modal"
                                                           data-target="#quick-view"
                                                           title="Quick View"><i class="ti-search"
                                                                                 aria-hidden="true"></i></a>

                                                    </div>
                                                </div>
                                                <div class="product-info">
                                                    <a :href="'/item/'+product.slug"><h6>{{ product.title}}</h6></a>
                                                    <h5>c</h5>
                                                </div>
                                            </div>-->
<!--                                            style="height: 100%;width: 100%"-->
                                            <div>
                                                <div style="width: 100%; display: inline-block;">
                                                    <div class="product-box" >
                                                        <div class="img-block">
                                                            <a :href="'/item/'+product.slug"><img
                                                                :src="product.image"

                                                                class=" img-fluid bg-img" alt=""
                                                            ></a>
                                                            <div class="cart-details">
                                                                <button tabindex="0" class="addcart-box"
                                                                        title="Quick shop"><i
                                                                    class="ti-shopping-cart"></i></button>
                                                                <a href="#" @click.prevent="quickView(product)"
                                                                   title="Quick View"
                                                                   tabindex="0"><i class="ti-search"
                                                                                   aria-hidden="true"></i></a>
                                                            </div>
                                                        </div>
                                                        <div class="product-info">
                                                            <a :href="'/item/'+product.slug" tabindex="0"><h6>{{
                                                                product.title}}</h6></a>
                                                            <del v-if="product.discount" class="text-warning">{{ product.price | currency("Rwf")}}</del>
                                                            <h5 v-if="product.discount">{{ product.discount.price | currency("Rwf")}}</h5>
                                                            <h5 v-if="!product.discount">{{ product.price | currency("Rwf")}}</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        name: "ProductTabs",
        data() {
            return {
                categories: [],
                products: [],
                selected_category: ''
            }
        },
        methods: {
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
            loadProducts(category_id) {
                this.selected_category = category_id;
                this.$Progress.start();
                axios.get("/product/category/" + category_id)
                    .then(resp => {
                        this.$Progress.finish();
                        this.products = resp.data.data
                    })
                    .catch(() => {
                        this.$Progress.fail();
                        this.toast("Error", "Network Error", "error")
                    })
            },
            loadCategories() {
                this.$Progress.start();
                axios.get("/api/category")
                    .then(resp => {
                        this.$Progress.finish();
                        this.categories = resp.data.data;
                        this.loadProducts(this.categories[0] ? this.categories[0].id : 0)
                    })
                    .catch(() => {
                        this.$Progress.fail();
                        this.toast("Error", "Network Error", "error")
                    })
            },
            quickView(product) {
                this.$root.$emit("quick-view", product)
            }
        },
        created() {
            this.loadCategories()
        }
    }
</script>

<style scoped>

</style>
