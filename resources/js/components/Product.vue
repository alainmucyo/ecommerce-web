<script>
    export default {
        name: "Product",
        data() {
            return {
                showDiscount: false,
                product: null,
                discount: {
                    end_date: '',
                    end_time: '',
                    new_price: 0
                },
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
            showModal(product_id) {
                this.clearDiscount();
                this.product = null;
                this.$Progress.start();
                axios.get("/product/" + product_id)
                    .then(resp => {
                        this.product = resp.data.data;
                        this.$Progress.finish()
                    })
                    .catch(() => {
                        this.$Progress.fail()
                    });
                $("#productModal").modal("show");
                console.log(product_id)
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
                                    'Category has been deleted.',
                                    'success'
                                )

                            })
                            .catch(err => {
                                this.$Progress.fail();
                                this.$swal(
                                    'Error!',
                                    'Problem while deleting.',
                                    'error'
                                )
                            })
                    }
                })
            }
        }
    }
</script>
