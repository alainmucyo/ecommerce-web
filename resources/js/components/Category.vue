<template>
    <div>
        <div class="card">
            <div class="card-header">
                <h5>Categories Management</h5>
                <div class="float-right">
                    <a href="#" class="btn-icon btn-icon-only btn-pill btn btn-outline-success"
                       @click.prevent="showModal"><i
                        class="feather icon-plus" style="font-size: medium"> </i></a>
                </div>

            </div>
            <div class="card-body table-responsive">
                <br>
                <table class="table table-stripped" v-if="categories.length>0" style="width: 100%">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Products</th>
                        <th>Created</th>
                        <th>Modify</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(category,index) in categories" :key="category.id">
                        <td>{{ index + 1 }}</td>
                        <td>{{ category.name}}</td>
                        <td>{{ category.products}}</td>
                        <td>{{ category.created_at }}</td>
                        <td>
                            <a href="#" class="btn-icon btn-icon-only btn-pill btn btn-outline-info"
                               @click="editModal(category)"><i
                                class="feather icon-edit btn-icon-wrapper"> </i></a>
                            <a href="#" class="btn-icon btn-icon-only btn-pill btn btn-outline-danger"
                               @click="deleteCategory(category)"><i
                                class="feather icon-trash btn-icon-wrapper"> </i></a>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <div class="alert alert-info" v-else>
                    No Categories List yet
                </div>
            </div>
        </div>
        <div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog animate-top" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            {{ updateMode ? "Update " : "Create "}} Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="updateMode?updateCategory():storeCategory()">
                        <div class="modal-body">

                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" v-model="form.name" required
                                       :class="{ 'is-invalid': form.errors.has('name') }"/>
                                <has-error :form="form" field="name"></has-error>
                            </div>
                            <div class="form-group">
                                <label>Insurance Fee</label>
                                <input type="number" class="form-control" v-model="form.insurance" required
                                       :class="{ 'is-invalid': form.errors.has('insurance') }"/>
                                <has-error :form="form" field="insurance"></has-error>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" :disabled="form.busy" class="btn btn-primary btn-raised">{{
                                form.busy ? 'Submitting...' : 'Submit'}}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</template>

<script>

    import {Form} from "vform";

    export default {
        name: "Category",
        data() {
            return {
                categories: [],
                updateMode: false,
                form: new Form({
                    id: '',
                    name: '',
                    insurance: 0,
                })
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
            showModal() {
                $("#categoryModal").modal("show");
                this.updateMode = false;
                this.form.reset();
            },
            editModal(category) {
                this.updateMode = true;
                this.form.clear();
                this.form.fill(category);
                $('#categoryModal').modal('show')
            },
            storeCategory() {
                this.$Progress.start();
                this.form.post("/api/category")
                    .then(resp => {
                        this.$Progress.finish();
                        // window.location = "";
                         $('#categoryModal').modal('hide');
                         this.categories.push(resp.data.data);
                         this.toast("Success", "Category Created Successfully!!")

                    })
                    .catch(err => {
                        this.$Progress.fail();
                        console.log(err);
                        this.$swal("Error", "Error while creating category","error");

                    })
            }
            ,
            updateCategory() {
                this.$Progress.start();
                this.form.put("/api/category/" + this.form.id)
                    .then(resp => {
                        // window.location=""
                        const index = this.categories.findIndex(s => s.id === resp.data.data.id);
                        this.categories[index].name = resp.data.data.name;
                        this.categories[index].insurance = resp.data.data.insurance;
                        this.$Progress.finish();
                        this.toast("Success", "Category updated successfully!");
                        $('#categoryModal').modal('hide');
                    })
                    .catch(err => {
                        this.$Progress.fail();
                        this.$swal("Error", "Error while updating category","error");
                    })
            },

            loadCategories() {
                axios.get("/api/category").then(resp => {
                    this.categories = resp.data.data;
                });
            },

            deleteCategory(category) {
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
                        axios.delete("/api/category/" + category.id)
                            .then(resp => {
                                this.$Progress.finish();
                                const index = this.categories.findIndex(s => s.id === category.id);
                                this.categories.splice(index, 1);
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
        },
        created() {
            this.loadCategories();
        },

    }
</script>

<style scoped>

</style>
