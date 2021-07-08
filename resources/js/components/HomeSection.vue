<template>
    <div>
        <div class="card">
            <div class="card-header">
                <h5>Home Sections Management</h5>
                <div class="float-right">
                    <a href="#" class="btn-icon btn-icon-only btn-pill btn btn-outline-success"
                       @click.prevent="showModal"><i
                        class="feather icon-plus" style="font-size: medium"> </i></a>
                </div>

            </div>
            <div class="card-body table-responsive">
                <br>
                <table class="table table-stripped" v-if="home_sections.length>0" style="width: 100%">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Products</th>
                        <th>Discount</th>
                        <th>Created</th>
                        <th>Modify</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(home_section,index) in home_sections" :key="home_section.id">
                        <td>{{ index + 1 }}</td>
                        <td>{{ home_section.name}}</td>
                        <td>{{ home_section.products}}</td>
                        <td>
                            <label class="badge"
                                   :class="{'badge-primary':home_section.discount, 'badge-danger':!home_section.discount}">
                                {{ home_section.discount?'Yes':'No'}}
                            </label>
                        </td>
                        <td>{{ home_section.created_at }}</td>
                        <td>
                            <a href="#" class="btn-icon btn-icon-only btn-pill btn btn-outline-info"
                               @click="editModal(home_section)"><i
                                class="feather icon-edit btn-icon-wrapper"> </i></a>
                            <a href="#" class="btn-icon btn-icon-only btn-pill btn btn-outline-danger"
                               @click="deleteHomeSection(home_section)"><i
                                class="feather icon-trash btn-icon-wrapper"> </i></a>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="alert alert-info" v-else>
                    No Home Sections List yet
                </div>
            </div>
        </div>
        <div class="modal fade" id="home_sectionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog animate-top" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            {{ updateMode ? "Update " : "Create "}} Home Section</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="updateMode?updateHomeSection():storeHomeSection()">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" v-model="form.name" required
                                       :class="{ 'is-invalid': form.errors.has('name') }"/>
                                <has-error :form="form" field="name"></has-error>
                            </div>
                            <div class="form-group">
                                <label>
                                    <input type="checkbox" v-model="form.discount"
                                           :class="{ 'is-invalid': form.errors.has('discount') }"/>
                                    For products with discount only
                                </label>
                                <has-error :form="form" field="discount"></has-error>
                            </div>
                            <div class="form-row" v-if="form.discount">
                                <div class="form-group col-md-6">
                                    <label for="end_date">End date</label>
                                    <input type="date" class="form-control"
                                           v-model="form.discount_end_date" required id="end_date">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="end_time">End Time ({{ form.discount_end_time}})</label>
                                    <input type="time" id="end_time" required
                                           v-model="form.discount_end_time"
                                           class="form-control">
                                </div>
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

<script type="text/javascript">
    import {Form} from "vform";

    export default {
        name: "HomeSection",
        data() {
            return {
                home_sections: [],
                updateMode: false,
                form: new Form({
                    id: '',
                    name: '',
                    discount: false,
                    discount_end_date: null,
                    discount_end_time: null
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
                $("#home_sectionModal").modal("show");
                this.updateMode = false;
                this.form.reset();
            },
            editModal(home_section) {
                this.updateMode = true;
                this.form.clear();
                this.form.fill(home_section);
                $('#home_sectionModal').modal('show')
            },
            storeHomeSection() {
                this.$Progress.start();
                this.form.post("/api/home-section")
                    .then(resp => {
                        this.$Progress.finish();
                        // window.location = "";
                        $('#home_sectionModal').modal('hide');
                        this.home_sections.push(resp.data.data);
                        this.toast("Success", "Home Section Created Successfully!!")

                    })
                    .catch(err => {
                        this.$Progress.fail();
                        console.log(err);
                        this.$swal("Error", "Error while creating Home Section", "error");

                    })
            }
            ,
            updateHomeSection() {
                this.$Progress.start();
                this.form.put("/api/home-section/" + this.form.id)
                    .then(resp => {
                        // window.location=""
                        const index = this.home_sections.findIndex(s => s.id === resp.data.data.id);
                        this.home_sections[index].name = resp.data.data.name;
                        this.home_sections[index].discount = resp.data.data.discount;
                        this.$Progress.finish();
                        this.toast("Success", "Home Section updated successfully!");
                        $('#home_sectionModal').modal('hide');
                    })
                    .catch(err => {
                        this.$Progress.fail();
                        this.$swal("Error", "Error while updating Home Section", "error");
                    })
            },

            loadHomeSections() {
                axios.get("/api/home-section").then(resp => {
                    this.home_sections = resp.data.data;
                });
            },

            deleteHomeSection(home_section) {
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
                        axios.delete("/api/home-section/" + home_section.id)
                            .then(resp => {
                                this.$Progress.finish();
                                const index = this.home_sections.findIndex(s => s.id === home_section.id);
                                this.home_sections.splice(index, 1);
                                this.$swal(
                                    'Deleted!',
                                    'Home Section has been deleted.',
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
            this.loadHomeSections();

        },

    }
</script>

<style scoped>

</style>
