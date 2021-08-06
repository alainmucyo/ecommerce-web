<template>
    <div>
        <div class="card">
            <div class="card-header">
                <h5>Users Management</h5>
            </div>
            <div class="card-body table-responsive">
                <br>
                <table class="table table-stripped" v-if="users.length>0" style="width: 100%">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Email</th>
                        <th>Phone_Number</th>
                        <th>Address</th>
                        <th>Role</th>
                        <th>Created</th>
                        <th>Modify</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(user,index) in users" :key="user.id">
                        <td>{{ index + 1 }}</td>
                        <td>{{ user.id == auth.id ? "Me" : user.email }}</td>
                        <td>{{ user.phone }}</td>
                        <td>{{ user.address }}</td>
                        <td>{{ user.role == "Seller" ? "Admin" : user.role }}</td>
                        <td>{{ user.created_at }}</td>
                        <td>
                            <!--                            <a href="#" class="btn-icon btn-icon-only btn-pill btn btn-outline-info"-->
                            <!--                               @click="editModal(user)"><i-->
                            <!--                                class="feather icon-edit btn-icon-wrapper"> </i></a>-->
                            <a href="#" class="btn-icon btn-icon-only btn-pill btn btn-outline-danger"
                               @click="deleteUser(user)"><i
                                class="feather icon-trash btn-icon-wrapper"> </i></a>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="alert alert-info" v-else>
                    No Users List yet
                </div>
            </div>
        </div>
        <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog animate-top" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            {{ updateMode ? "Update " : "Create " }} User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="updateMode?updateUser():storeUser()">
                        <div class="modal-body">

                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" v-model="form.name" required
                                       :class="{ 'is-invalid': form.errors.has('name') }"/>
                                <has-error :form="form" field="name"></has-error>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" v-model="form.email" required
                                       :class="{ 'is-invalid': form.errors.has('email') }"/>
                                <has-error :form="form" field="email"></has-error>
                            </div>
                            <div class="form-group">
                                <label>Select user type</label>
                                <select class="form-control" v-model="form.role_id" required
                                        :class="{ 'is-invalid': form.errors.has('role_id') }">
                                    <option v-for="role in roles" :key="role.id" :value="role.id">{{ role.name }}
                                    </option>
                                </select>
                                <has-error :form="form" field="role"></has-error>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" :disabled="form.busy" class="btn btn-primary btn-raised">{{form.busy ? 'Submitting...' : 'Submit'}}</button>
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
    name: "User",
    props: ["auth"],
    data() {
        return {
            roles: [{name: 'Admin', id: 1}, {name: "Seller", id: 3}],
            users: [],
            updateMode: false,
            form: new Form({
                id: '',
                name: '',
                email: '',
                role_id: 1
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
        loadUsers() {
            axios.get("/api/users").then(resp => {
                this.users = resp.data;
            });
        },
        deleteUser(user) {
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
                    axios.delete("/api/user/" + user.id)
                        .then(resp => {
                            this.$Progress.finish();
                            const index = this.users.findIndex(s => s.id === user.id);
                            this.users.splice(index, 1);
                            this.$swal(
                                'Deleted!',
                                'User has been deleted.',
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
        },
        showModal() {
            $("#userModal").modal("show");
            this.updateMode = false;
            this.form.reset();


        },
        editModal(user) {
            this.updateMode = true;
            this.form.clear();
            this.form.fill(user);
            $('#userModal').modal('show')
        },
        storeUser() {
            this.$Progress.start();
            this.form.post("/api/user")
                .then(resp => {
                    this.$Progress.finish();
                    this.users.push(resp.data);
                    $('#userModal').modal('hide');
                    this.toast("User Created", "User Created Successfully", "success");
                })
                .catch(err => {
                    this.$Progress.fail();
                    this.$swal("Error", "Error while creating user", "error");
                })
        },
        updateUser() {
            this.$Progress.start();
            this.form.put("/api/user/" + this.form.id)
                .then(resp => {
                    const index = this.users.findIndex(s => s.id === resp.data.id);
                    this.users[index].name = resp.data.name;
                    this.users[index].email = resp.data.email;
                    this.users[index].role = resp.data.role;
                    this.users[index].role_id = resp.data.role_id;
                    this.$Progress.finish();
                    this.toast("User Updated", "User updated successfully!");
                    $('#userModal').modal('hide')
                })
                .catch(err => {
                    this.$Progress.fail()
                })
        },

    },
    created() {
        this.loadUsers();
    }

}
</script>
