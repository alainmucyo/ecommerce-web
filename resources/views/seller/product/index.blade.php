@extends('layouts.app')
@section('content')
    <div class="container" id="app">
        <vue-progress-bar></vue-progress-bar>
        <app-product inline-template>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>List Products</h5>
                            <a href="/product/create" class="btn btn-primary float-right">Create product</a>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-stripped" style="width: 100%">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Price</th>
                                    <th>Max Qty</th>
                                    <th>Likes</th>
                                    <th>Created</th>
                                    <th>Modify</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{ $product->id}}</td>
                                        <td>
                                            <a class="image_link" href="{{ $product->product_image}}" target="_blank">
                                                <img src="{{ $product->product_image}}" class="product_image"
                                                     alt="Image">
                                            </a>
                                            <a href="#" class="text-primary"
                                               @click.prevent="showModal({{$product->id}})">{{ $product->title}}</a>
                                        </td>
                                        <td>{{ number_format($product->price)}} Rwf</td>
                                        <td>{{ $product->client_max }}</td>
                                        <td>{{ $product->likes_count }}</td>
                                        <td>{{$product->created_at->toDateString() }}</td>
                                        <td>
                                            <a href="/product/image/{{ $product->slug}}"
                                               data-toggle="tooltip"
                                               data-placement="top" title="Product Images"
                                               class="btn-icon btn-icon-only btn-pill btn btn-outline-success"
                                            ><i
                                                    class="feather icon-image btn-icon-wrapper"> </i></a>
                                            <a href="/product/{{$product->id}}/edit"
                                               data-toggle="tooltip"
                                               data-placement="top" title="Edit Product"
                                               class="btn-icon btn-icon-only btn-pill btn btn-outline-info"
                                            ><i
                                                    class="feather icon-edit btn-icon-wrapper"> </i></a>
                                            <a href="#" class="btn-icon btn-icon-only btn-pill btn btn-outline-danger"
                                               data-toggle="tooltip"
                                               data-placement="top" title="Delete Product"
                                               @click="deleteCategory({{ $product}})"><i
                                                    class="feather icon-trash btn-icon-wrapper"> </i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-end">
                                {!!  $products->appends($_GET)->links() !!}
                            </div>
                            <div class="modal fade" id="productModal" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLabel"
                                 aria-hidden="true">
                                <div class="modal-dialog modal-lg animate-top" role="document">
                                    <div class="modal-content" style="max-height:95vh !important">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">
                                                @{{ product==null?'Product':product.title}}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body" style="overflow: auto !important;">
                                            <center v-if="product==null">
                                                <img src="/img/loader.gif">
                                            </center>
                                            <div v-else class="container">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <p><b>Title:</b> @{{ product.title}} </p>
                                                        <p><b>Price:</b> @{{ product.price | currency("Rwf")}} </p>
                                                        <p><b>Client Maximum Quantity:</b> @{{ product.client_max}} </p>
                                                        <p><b>Likes:</b> @{{ product.likes}}</p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p><b>Category:</b> <span v-for="category in product.categories"
                                                                                  class="badge badge-primary ml-2">@{{ category.name}}</span>
                                                        </p>
                                                        <p v-if="product.sizes && product.sizes.length>0">
                                                            <b>Sizes:</b><span
                                                                v-for="size in product.sizes"
                                                                class="badge badge-success ml-2">{@{ size}}</span>
                                                        </p>
                                                        <p><b>Created At:</b> @{{ product.created_at }} </p>
                                                    </div>

                                                    <div class="col-md-12" style="overflow: auto !important;">
                                                        <b>Description: </b>
                                                        <div v-html="product.description"></div>
                                                    </div>
                                                <!--               <div class="col-md-12" v-if="on_homepage">
                                                   <div class="row justify-content-end">
                                                       &lt;!&ndash;<div class="col-md-12">
                                                           <button class="btn btn-primary btn-sm float-right"
                                                                   style="text-transform: uppercase"
                                                                   @click="add_homepage = true">Add this product on homepage
                                                           </button>
                                                       </div>&ndash;&gt;
                                                    &lt;!&ndash;   <div class="col-md-12 mt-4">
                                                           <form v-if="add_homepage" :action="'/admin/'+product.id+'/homepage'" class="col-md-6 float-right">
                                                               <div class="form-group">
                                                                   <select name="home_section_id" id="home" v-model="home_section_id" class="form-control">
                                                                       <option :value="null">None</option>
                                                                       <option v-for="home_section in home_sections"
                                                                               :key="home_section.id"
                                                                               :value="home_section.id">
 home_section.name
                                                    </option>
                                                </select>
                                            </div>
                                            <button class="btn btn-primary btn-sm float-right mb-2" type="submit">SUBMIT</button>
                                        </form>
                                    </div>&ndash;&gt;
                                                   </div>
                                               </div>-->

                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-12 mb-4" v-if="!product.discount">
                                                                <div class="form-group">
                                                                    <button class="btn btn-primary float-right"
                                                                            @click="showDiscount = !showDiscount">
                                                                        @{{showDiscount?'Hide':'Add'}}
                                                                        discount
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12" v-if="product.discount">
                                                                <h5><span class="badge badge-warning">Discount: </span>
                                                                </h5>
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <b>Price: </b> <span
                                                                            class="badge badge-primary">@{{ product.discount.price | currency("Rwf")}}</span>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <b>End Time: </b> <span
                                                                            class="badge badge-primary">@{{ product.discount.end_time}}</span>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <b>Created At: </b> <span
                                                                            class="badge badge-primary">@{{ product.discount.created_at}}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12" v-else>
                                                                <form action="#" v-if="showDiscount"
                                                                      @submit.prevent="submitDiscount">
                                                                    <div class="form-row">
                                                                        <div class="form-group col-md-3">
                                                                            <label for="end_date">End date</label>
                                                                            <input type="date" class="form-control"
                                                                                   v-model="discount.end_date" required
                                                                                   id="end_date">
                                                                        </div>
                                                                        <div class="form-group col-md-3">
                                                                            <label for="end_time">End Time
                                                                                (@{{ discount.end_time}})</label>
                                                                            <input type="time" id="end_time" required
                                                                                   v-model="discount.end_time"
                                                                                   class="form-control">
                                                                        </div>
                                                                        <div class="form-group col-md-3">
                                                                            <label for="price">New Price (@{{
                                                                                discount.new_price |
                                                                                currency("Rwf")}})</label>
                                                                            <input type="number" id="price" required
                                                                                   v-model="discount.new_price"
                                                                                   class="form-control">
                                                                        </div>
                                                                        <div class="form-group col-md-3">
                                                                            <label>&nbsp;</label>
                                                                            <button type="submit"
                                                                                    class="btn btn-primary btn-sm btn-block">
                                                                                CREATE DISCOUNT
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <a v-if="product" :href="`/review/${product.id}`"
                                               class="btn btn-info btn-sm">Show
                                                Reviews</a>
                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
                                                Close
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </app-product>
    </div>
@endsection
@push("scripts")
    <script type="text/javascript" src="/js/app.js?v=5004"></script>

@endpush
