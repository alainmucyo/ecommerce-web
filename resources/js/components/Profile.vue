<template>
    <div class="card">
        <div class="card-body bg-primary text-center text-white card-img-top"
             style="background-size: contain;">
            <div class="card-img-actions d-inline-block mb-3">
                <img class="img-fluid rounded-circle"
                     :src="form.avatar ? form.avatar : '/img/user.png'"
                     style="object-position: center;width: 170px; height: 170px;object-fit: fill;"
                     alt="">
            </div>

            <h6 class="font-weight-semibold mb-0 text-white">{{ form.email }}</h6>
            <span class="d-block opacity-75">{{ user.type }}</span>
        </div>
        <div class="card-body border-top-0">
            <div class="container mt-4">
                <form @submit.prevent="submitForm" enctype="multipart/form-data">
                    <!--                    <div class="form-group">-->
                    <!--                        <label>Name</label>-->
                    <!--                        <input type="text" class="form-control" v-model="form.name" required-->
                    <!--                               :class="{ 'is-invalid': form.errors.has('name') }"/>-->
                    <!--                        <has-error :form="form" field="name"></has-error>-->
                    <!--                    </div>-->
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" required v-model="form.email"
                               :class="{ 'is-invalid': form.errors.has('email') }"/>
                        <has-error :form="form" field="email"></has-error>
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="tel" class="form-control" required v-model="form.phone"
                               :class="{ 'is-invalid': form.errors.has('phone') }"/>
                        <has-error :form="form" field="phone"></has-error>
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <!--                        v-if="user.roles && user.roles[0].slug=='customer'"-->
                        <input type="text" class="form-control" required v-model="form.address"
                               :class="{ 'is-invalid': form.errors.has('address') }"/>
                        <has-error :form="form" field="address"></has-error>
                    </div>
                    <div class="form-group">
                        <label for="customFile">Avatar</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" accept="image/*" @change="updateProfile"
                                   id="customFile">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Old Password</label>
                        <input type="password" class="form-control" v-model="oldPassword"
                               :class="{ 'is-invalid': oldError }"/>
                        <small class="text-danger" v-if="oldError">{{ oldError }} <br></small>
                        <small>* Input old password for changing password</small>
                    </div>
                    <div class="form-group">
                        <label>New Password</label>
                        <input type="password" class="form-control" v-model="form.password"
                               :class="{ 'is-invalid': form.errors.has('password') }"/>
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" class="form-control"
                               v-model="form.password_confirmation"
                               :class="{ 'is-invalid': form.errors.has('password') }"/>
                        <has-error :form="form" field="password"></has-error>
                    </div>
                    <div class="form-group">
                        <button type="submit" :disabled="form.busy" class="btn btn-primary btn-raised">{{
                                form.busy ? 'Submitting...' : 'Submit'
                            }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import {Form} from "vform";

export default {
    name: "Profile",
    data() {
        return {
            user: {},
            oldError: null,
            image: '',
            oldPassword: "",
            form: new Form({
                id: '',
                email: '',
                phone: '',
                address: '',
                password: '',
                avatar: '',
                password_confirmation: ''
            })
        }
    },
    methods: {
        submitForm() {
            this.$Progress.start();
            this.form.busy = true;
            let config = {headers: {'Content-Type': 'multipart/form-data'}};
            let data = new FormData();
            data.append("email", this.form.email);
            data.append("phone", this.form.phone);
            data.append("address", this.form.address);
            data.append("avatar", this.image && this.image);
            if (this.oldPassword !== "")
                data.append("old_password", this.oldPassword);
            data.append("password", this.form.password);
            data.append("password_confirmation", this.form.password_confirmation);
            axios.post("/profile/" + this.form.id, data, config)
                .then(resp => {
                    this.form.busy = false;
                    window.location = ""
                })
                .catch(err => {
                    this.$Progress.fail();
                    this.form.busy = false;
                    if (err.response.status === 422) {
                        this.form.errors.set(err.response.data);
                    }
                    if (err.response.status === 400) {
                        this.oldError = "Wrong Old Password"
                    }
                })
        },
        updateProfile(e) {
            const image = e.target.files[0];
            const reader = new FileReader();
            reader.readAsDataURL(image);
            reader.onload = e => {
                e.target.result;
                this.image = e.target.result
                this.form.avatar = e.target.result
            }
        }
    },
    computed: {
        loadImage() {
            return this.image === '' ? this.form.avatar === null ? '' : '' + this.form.avatar : this.image
        },

    },

    created() {
        axios.get("/api/user")
            .then(resp => {
                this.user = resp.data.user;
                this.form.fill(this.user)
            })
    },
}
</script>

<style scoped>

</style>
