<template>
    <div>
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div id="my-strictly-unique-vue-upload-multiple-image" style="text-align: center"
                        >
                            <vue-upload-multiple-image
                                @upload-success="uploadImageSuccess"
                                @before-remove="beforeRemove"
                                @edit-image="editImage"
                                @data-change="dataChange"
                                drag-text="Drag Image Or Click Here"
                                browse-text="Browse Image"
                                primary-text="Default"
                                mark-is-primary-text="Set as default"
                                popup-text="This image will be displayed as default"
                                drop-text="Drop your images here ..."
                                :data-images="images"
                            ></vue-upload-multiple-image>

                        </div>
                        <button class="btn btn-primary btn-sm float-right mt-2" @click="submitImages"
                                v-if="form.images.length>0 || productImages.length >0">
                            <span class="feather icon-check"></span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-3" v-for="(image,index) in productImages" :key="index">
                <div class="card">
                    <div class="card-body">
                        <div class="card-img">
                            <img :src="image" @click="showImage(image,index)" class="product-image"
                                 style="width: 100%;height: 180px">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <modal
            name="dog-profile"
            classes="cute-dog-profile-photo"
            transition="scale"
            width="600"
            height="500"
        >
            <div
                slot="top-right"
                class="ct-top-right"
                @click="$modal.hide('dog-profile')"
            >
                HIDE
            </div>
            <img :src="single_image.image"/>
            <button class="btn btn-danger btn-sm btn-block" @click="deleteImage(single_image)">Delete This Image?
            </button>
        </modal>
    </div>
</template>

<script>
import {Form} from "vform";
import VueUploadMultipleImage from "vue-upload-multiple-image";

export default {
    name: "Image",
    components: {VueUploadMultipleImage},
    props: ['product', 'PropsProductImages'],
    data() {
        return {
            images: [],
            single_image: {
                image:"",
                index:''
            },
            productImages: this.PropsProductImages,
            form: {
                images: []
            },
        }
    },
    methods: {
        showImage(image,index) {
            this.single_image = {image,index};
            this.$modal.show('dog-profile');
        },
        dataChange() {

        },
        submitImages() {
            if (this.productImages && this.productImages.length > 0) {
                this.productImages.map(i => {
                    this.form.images.push({
                        default: 1,
                        highlight: 1,
                        name: i,
                        path: i,
                        old: true
                    })
                })
            }
            this.$Progress.start();
            axios.post("/product/image/" + this.product.id, this.form.images)
                .then(resp => {
                    this.$Progress.finish();
                    this.images = [];
                    this.productImages = [];
                    this.form.images = [];
                    const new_images = resp.data;
                    for (let i = 0; i < new_images.length; i++) {
                        this.productImages.push(new_images[i])
                    }
                    window.location.href = `/product/image/${this.product.slug}`
                })
                .catch(() => {
                    this.$Progress.fail();
                    this.$swal("Error", "Error While Uploading Images", "error")
                })
        },
        uploadImageSuccess(formData, index, fileList) {
            this.form.images = fileList;
        },
        beforeRemove(index, done, fileList) {
            this.$swal({
                title: 'Are you sure?',
                text: "Remove this image from list!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, remove it!'
            }).then((result) => {
                this.$Progress.start();
                if (result.value) {
                    done();
                    this.$Progress.start()
                }
            })
        },
        editImage(formData, index, fileList) {
            this.form.images = fileList;
            this.images[index] = formData;
        },
        deleteImage(image) {
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
                    const index = this.productImages.findIndex(s => s === image.image);
                    this.productImages.splice(index, 1);
                    let images;
                    if (this.productImages && this.productImages.length > 0) {
                      images =  this.productImages.map(i => {
                            return  {
                                default: 1,
                                highlight: 1,
                                name: i,
                                path: i,
                                old: true
                            }
                        })
                    }
                    axios.post("/product/image/" + this.product.id, images)
                        .then(resp => {
                            this.$Progress.finish();
                            this.productImages = [];
                            this.images = [];
                            const new_images = resp.data;
                            for (let i = 0; i < new_images.length; i++) {
                                this.productImages.push(new_images[i])
                            }
                            this.$modal.hide('dog-profile');
                            this.$swal(
                                'Deleted!',
                                'Image has been deleted.',
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
        // if (this.productImages && this.productImages.length > 0) {
        //     this.productImages.map(i => {
        //         this.images.push({
        //             default: 1,
        //             highlight: 1,
        //             name: i,
        //             path: i,
        //             old: true
        //         })
        //     })
        // }
    }
}
</script>
<style type="text/css" scoped>
.product-image:hover {
    opacity: 0.6;
    cursor: pointer;
}
</style>
<style lang="scss">
.cute-dog-profile-photo {
    background-color: transparent;
    /*border-radius: 100%;*/
    box-shadow: 0 2px 20px 0 rgba(0, 0, 0, 0.4);
    border: 1px solid rgba(255, 255, 255, 0.65);

    img {
        width: 600px;
        height: 93.5%;
    }
}

.ct-top-right {
    cursor: pointer;
    padding-top: 20px;
    padding-right: 30px;
    font-weight: 600;
    color: white;
    text-shadow: 0 0px 20px black;
}

.scale-enter-active,
.scale-leave-active {
    transition: all 0.5s;
}

.scale-enter,
.scale-leave-active {
    opacity: 0;
    transform: scale(0.3) translateY(24px);
}
</style>
