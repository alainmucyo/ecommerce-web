<template>
  <form @submit.prevent="submit">
    <div class="form-row">
      <div class="form-group col-md-12">
        <label>Title</label>
        <input type="text" class="form-control" v-model="form.title"
               :class="{ 'is-invalid': form.errors.has('title') }"/>
        <has-error :form="form" field="title"></has-error>
      </div>
      <div class="form-group col-md-6">
        <label>Maximum Quantity For Customer</label>
        <input type="number" class="form-control" v-model="form.client_max"
               :class="{ 'is-invalid': form.errors.has('client_max') }"/>
        <has-error :form="form" field="client_max"></has-error>
      </div>
      <div class="form-group col-md-6">
        <label>Price ({{ form.price | currency('Rwf') }})</label>
        <input type="number" class="form-control" v-model="form.price"
               :class="{ 'is-invalid': form.errors.has('price') }"/>
        <has-error :form="form" field="price"></has-error>
      </div>
      <div class="form-group col-md-6">
        <label>Price USA ({{ form.price_usa | currency('$') }})</label>
        <input type="number" class="form-control" v-model="form.price_usa"
               :class="{ 'is-invalid': form.errors.has('price_usa') }"/>
        <has-error :form="form" field="price_usa"></has-error>
      </div>
      <div class="form-group col-md-6">
        <label>Price Dirham ({{ form.price_dirham | currency('د.إ') }})</label>
        <input type="number" class="form-control" v-model="form.price_dirham"
               :class="{ 'is-invalid': form.errors.has('price_dirham') }"/>
        <has-error :form="form" field="price_dirham"></has-error>
      </div>
      <div class="form-group col-md-6">
        <label>Category</label>
        <multiselect v-model="form.category" track-by="id" :allow-empty="false" placeholder="Select Category"
                     :multiple="false" label="name"
                     :options="categories"></multiselect>
        <has-error :form="form" field="categories"></has-error>
      </div>
      <div class="form-group col-md-6">
        <label>Sizes/Colors (Optional)</label>
        <multiselect v-model="form.size" tag-placeholder="Add this as new size" placeholder="Select Size"
                     :multiple="true" :taggable="true" @tag="addSize"
                     :options="sizes"></multiselect>
      </div>
      <div class="form-group col-md-12" style="height: 350px">
        <label>Product Description</label>
        <!--                <vue-editor v-model="form.description"></vue-editor>-->
        <div class="example">
          <quill-editor v-model="form.description" style="height: 250px" class="editor"
                        :class="{ 'is-invalid': form.errors.has('description') }"
                        ref="myQuillEditor"></quill-editor>

        </div>
        <has-error :form="form" field="description"></has-error>
      </div>
      <div class="form-group col-md-12" v-if=" form.description.trim()!=''">
        <button class="btn btn-primary float-right"
        >Submit
        </button>
      </div>
    </div>
  </form>
</template>

<script>
import Multiselect from 'vue-multiselect'
import {Form} from "vform";
import {VueEditor, Quill} from "vue2-editor";


import {quillEditor} from 'vue-quill-editor'

export default {
  name: "EditProduct",
  components: {Multiselect, VueEditor, quillEditor},
  props: ['product', 'category'],
  data() {
    return {
      categories: [],
      sizes: ["Small", "Medium", "Large", "Black", "Blue", "White"],
      form: new Form({
        title: '',
        price: '',
        client_max: '',
        category: [],
        size: [],
        description: '',
        price_usa: '',
        price_dirham: '',
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
    loadCategories() {
      axios.get("/api/category")
          .then(resp => {
            this.categories = resp.data.data;
          })
          .catch(() => {
            this.toast("Network Error", "Unable To Load Products Categories", "error")
          })
    },
    addSize(newSize) {
      this.sizes.push(newSize);
      this.form.size.push(newSize)
    },
    submit() {
      /*
      To be placed in request body as {categories}
      const categories = this.form.category.map(c => c.id);*/
      this.$Progress.start();
      this.form.put(`/product/${this.product.id}`)
          .then(resp => {
            this.$Progress.finish();
            this.form.clear();
            // this.form.reset();
            this.toast("Congratulations", resp.data)
            window.location.href = "/admin/products"
          })
          .catch(() => {
            this.$Progress.fail();
            this.toast("Unable To Submit", "Error While Submitting Product", "error")
          })

    }
  },
  created() {
    this.loadCategories();
    this.form.fill({...this.product, category: this.category, size: JSON.parse(this.product.sizes)});
  },
  computed: {
    editor() {
      return this.$refs.myQuillEditor.quill
    }
  },
}
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style lang="scss" scoped>
.example {
  display: flex;
  flex-direction: column;

  .output {
    width: 100%;
    height: 20rem;
    margin: 0;
    border: 1px solid #ccc;
    overflow-y: auto;
    resize: vertical;

    &.code {
      padding: 1rem;
      height: 16rem;
    }

    &.ql-snow {
      border-top: none;
      height: 24rem;
    }
  }
}
</style>
