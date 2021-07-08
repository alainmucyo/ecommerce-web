<template>
    <div>
        <div class="card">
            <div class="card-header">
                <h5>Delivery Fees Settings</h5>
                <div class="float-right">
                    <a href="#" class="btn-icon btn-icon-only btn-pill btn btn-outline-success"
                       @click.prevent="addRow"
                    ><i
                        class="feather icon-plus" style="font-size: medium"> </i>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th>Details</th>
                        <th>Amount</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(delivery_fee,i) in delivery_fees" :key="delivery_fee.id">
                        <td>{{ i+1}}</td>
                        <td>{{ delivery_fee.title}}</td>
                        <td>{{ delivery_fee.details}}</td>
                        <td>{{ delivery_fee.amount | currency("Rwf")}}</td>
                        <td>
                            <button @click.prevent="editFee(delivery_fee)"
                                    type="button"
                                    class="btn-icon btn-icon-only btn-pill btn btn-outline-primary"
                            >
                                <i class="feather icon-edit"></i>
                            </button>
                            <button @click.prevent="deleteFee(delivery_fee)"
                                    type="button"
                                    class="btn-icon btn-icon-only btn-pill btn btn-outline-danger"
                            >
                                <i class="feather icon-trash"></i>
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <form method="post" action="#" @submit.prevent="edit_mode?editFeeSubmit():submit()">
                    <table class="table table-borderless">
                        <tbody>

                        <tr v-for="(count,i) in form.fees_count" :key="i">
                            <td>
                                <input type="text" class="form-control" v-model="form.title[i]" placeholder="Title">
                            </td>
                            <td>
                            <textarea class="form-control" placeholder="Details" v-model="form.detail[i]"
                                      style="resize: none"></textarea>
                            </td>
                            <td>
                                <input type="number" class="form-control" v-model="form.amount[i]" placeholder="Amount">
                            </td>
                            <td>
                                <button :disabled="form.fees_count.length<=1 && !edit_mode" @click.prevent="removeFee(i)"
                                        type="submit"
                                        class="btn-icon btn-icon-only btn-pill btn btn-outline-danger"
                                >
                                    <span style="font-size: 1.4rem">&times;</span>
                                </button>
                            </td>
                        </tr>
                        <!--
                          <tr>
                              <th>Title</th>
                              <th>Details</th>
                              <th>Fee amount</th>
                              <th></th>
                          </tr>-->
                        </tbody>
                    </table>
                    <a href="#" class="btn-icon btn-icon-only btn-pill btn btn-outline-success"
                       @click.prevent="addRow"
                    ><i
                        class="feather icon-plus" style="font-size: medium"> </i>
                    </a>
                    <button type="submit" class="btn btn-primary float-right">{{edit_mode?'UPDATE':'SUBMIT'}}</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "DeliveryFee",
        data() {
            return {
                delivery_fees: [],
                edit_mode: false,
                fee_id: null,
                form: {
                    title: [''],
                    detail: [''],
                    amount: [0],
                    fees_count: [1]
                }
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
            loadFees() {
                this.$Progress.start();
                axios.get("/admin/api/delivery-fee")
                    .then(fees => {
                        this.$Progress.finish();
                        this.delivery_fees = fees.data
                    })
                    .catch(() => {
                        this.$Progress.fail();
                        console.log("Error")
                    })
            },
            editFeeSubmit() {
                if (!this.edit_mode) return;
                this.$Progress.start();
                const fee = this.form.title.map((t, i) => {
                    return {
                        title: t,
                        details: this.form.detail[i],
                        amount: this.form.amount[i]
                    }
                });
                axios.put("/admin/api/delivery-fee/" + this.fee_id, {fee})
                    .then(fees => {
                        const index = this.delivery_fees.findIndex(s => s.id === fees.data.id);
                        this.delivery_fees[index].title = fees.data.title;
                        this.delivery_fees[index].details = fees.data.details;
                        this.delivery_fees[index].amount = fees.data.amount;
                        this.resetFeeForm();
                        this.edit_mode = false;
                        this.fee_id = null;
                        this.$Progress.finish();
                        this.toast("Edit Success","Delivery Fee edited successfully!");
                    })
                    .catch(() => {
                        this.$Progress.fail();
                        this.toast("Error","Network Error!","error");
                    })

            },
            submit() {
                const fees = this.form.title.map((t, i) => {
                    return {
                        title: t,
                        details: this.form.detail[i],
                        amount: this.form.amount[i]
                    }
                });
                this.$Progress.start();
                axios.post("/admin/api/delivery-fee", {fees})
                    .then(fees => {
                        this.$Progress.finish();
                        this.delivery_fees.push(...fees.data);
                        this.resetFeeForm();
                        this.toast("Create Success","Delivery Fee created successfully!");
                    })
                    .catch(() => {
                        this.$Progress.fail();
                        this.toast("Error","Network Error!","error");
                    })
            },
            removeFee(index) {
                if (this.edit_mode) {
                    this.edit_mode = false;
                    this.fee_id = null;
                    return;
                }
                this.form.fees_count.splice(index, 1);
                this.form.title.splice(index, 1);
                this.form.detail.splice(index, 1);
                this.form.amount.splice(index, 1)
            },
            resetFeeForm() {
                this.form = {
                    title: [''],
                    detail: [''],
                    amount: [0],
                    fees_count: [1]
                }
            },
            deleteFee(fee) {
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
                        axios.delete("/admin/api/delivery-fee/" + fee.id)
                            .then(resp => {
                                this.$Progress.finish();
                                const index = this.delivery_fees.findIndex(s => s.id === fee.id);
                                this.delivery_fees.splice(index, 1);
                                this.$swal(
                                    'Deleted!',
                                    'Delivery Fee has been deleted.',
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
            editFee(fee) {
                this.form = {
                    title: [fee.title],
                    detail: [fee.details],
                    amount: [fee.amount],
                    fees_count: [1]
                };
                this.edit_mode = true;
                this.fee_id = fee.id
            },
            addRow() {
                this.form.fees_count.push(1);
                this.edit_mode = false;
                this.fee_id = null
            }
        },
        created() {
            this.loadFees()
        }
    }
</script>
