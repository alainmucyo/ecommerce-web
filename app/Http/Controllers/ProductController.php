<?php

namespace App\Http\Controllers;

use App\Category;
use App\HomeSection;
use App\Http\Resources\ProductImageResource;
use App\Http\Resources\ProductResource;
use App\Product;
use App\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use jeremykenedy\LaravelRoles\Models\Role;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::where("status", 1)->where("seller_id", auth()->user()->id)->withCount("likes")->paginate(30);
//         $home_sections = HomeSection::get();
        return view("seller.product.index", compact('products'));
    }

    public function create()
    {
        return view("seller.product.create");
    }


    public function store(Request $request)
    {
        $request->validate([
            "title" => "required",
            "price" => "required|numeric",
            "client_max" => "required|numeric",
            "min_price" => "required|numeric",
            "max_price" => "required|numeric",
            "category" => "required",
            "description" => "required"
        ]);
        $product = Product::create([
            "title" => $request['title'],
            "price" => $request['price'],
            "client_max" => $request['client_max'],
            "description" => $request['description'],
            "seller_id" => auth()->user()->id,
            "sizes" => count($request['size']) == 0 ? null : json_encode($request['size']),
            "min_price" => $request['min_price'],
            "max_price" => $request['max_price']
        ]);
        /* foreach ($request['category'] as $category) {
             DB::table("category_product")->insert(["category_id" => $category['id'], "product_id" => $product->id]);
         }*/
        DB::table("category_product")->insert(["category_id" => $request['category']['id'], "product_id" => $product->id]);

        return "Product Created Successfully!";
    }

    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    public function image($product)
    {
        $product = Product::where("slug", $product)->first();
        $images = $product->images;
        return view("seller.product.image", compact('product', 'images'));
    }

    public function storeImages($product, Request $request)
    {
        $images = [];
        foreach ($request->all() as $request) {
            $png_url = "-" . str_random(15);
            $path = storage_path() . '/app/public/img/item' . $png_url;
            Image::make(file_get_contents($request['path']))->save($path);
            $images[] = ProductImage::create(["image" => "/storage/img/item" . $png_url, "product_id" => $product]);
        }
        return $images;
    }

    public function deleteImages(ProductImage $image)
    {
        $path = storage_path() . "/app/public" . substr($image->image, 8);
        if (file_exists($path)) {
            unlink($path);
        }
        $image->delete();
        return "ok";
    }


    public function edit(Product $product)
    {
        $category = $product->categories->first();
        return view("seller.product.edit", compact('product', 'category'));
    }

    public function getByCategories(Category $category)
    {
        return ProductImageResource::collection($category->products->sortByDesc('updated_at')->take(8));
    }


    public function update(Request $request, Product $product)
    {
        $request->validate([
            "title" => "required",
            "price" => "required|numeric",
            "client_max" => "required|numeric",
            "min_price" => "required|numeric",
            "max_price" => "required|numeric",
            "category" => "required",
            "description" => "required"
        ]);
        $product->update([
            "title" => $request['title'],
            "price" => $request['price'],
            "client_max" => $request['client_max'],
            "description" => $request['description'],
            "seller_id" => auth()->user()->id,
            "sizes" => count($request['size']) == 0 ? null : json_encode($request['size']),
            "min_price" => $request['min_price'],
            "max_price" => $request['max_price']
        ]);
        /* foreach ($request['category'] as $category) {
             DB::table("category_product")->insert(["category_id" => $category['id'], "product_id" => $product->id]);
         }*/
        DB::table("category_product")->where("product_id", $product->id)->update(["category_id" => $request['category']['id']]);
        return "Product Updated Successfully!";
    }


    public function destroy(Product $product)
    {
        $product->update(["status" => 0]);
        return "Ok";
    }

    public function adminList(Request $request)
    {
        $sellers = Role::where("slug", "seller")->first()->users;
        if ($seller_id = $request->seller_id) {
            if ($seller_id == "all")
                $products = Product::where("status", 1);
            else
                $products = Product::where("seller_id", $seller_id)->where("status", 1);;
        } else {
            $products = Product::where("status", 1)->where("status", 1);
        }
        if ($sort = $request->sort) {
            switch ($sort) {
                case "prod_id":
                    $products = $products->orderBy("id");
                    break;
                case "seller":
                    $products = $products->orderBy("seller_id");
                    break;
                case  "prod_name":
                    $products = $products->orderBy("title");
                    break;
                case  "likes":
                    $products = $products->withCount("likes")->orderByDesc("likes_count");
                    break;
                default:
                    $products = $products->withCount("orderProducts")->orderByDesc("order_products_count");
            }
        }
        $products = $products->paginate(100);
        $home_sections = HomeSection::where("status", 1)->get();
        return view("admin.products", compact('products', 'sellers', 'home_sections'));
    }

    public function homepage(Product $product, Request $request)
    {
        $request->validate([
            "home_section_id" => "required"
        ]);

        if ($request->home_section_id == "none")
            $product->update(["home_section_id" => null]);
        else {
            $homeSection = HomeSection::find($request->home_section_id);

            if ($homeSection->discount && !$product->discount)
                return redirect()->back()->with("error", "The product must have discount to be on discount section.");

            $product->update(["home_section_id" => $request->home_section_id]);
        }

        return redirect()->back()->with("success", "Product home section updated successfully!");
    }
}
