<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Review;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ItemController extends Controller
{

    public function index()
    {
        $products = Product::where("status", 1);
        $seller = null;
        if ($slug = \request("seller")) {
            $seller = User::where("slug", $slug)->first();
            if (!$seller)
                abort(404, "Seller not found");
            $products = $products->where("seller_id",$seller->id);
        }
        if ($category_slug = \request("category")) {
            if ($category_slug != "all") {
                $products_ids = Category::where("slug", $category_slug)->first()->products->pluck("id");
                $products = $products->whereIn("id", $products_ids);
            }
        }
        if ($sort = request("sorting")) {
            switch ($sort) {
                case "a_to_z":
                    $products = $products->orderBy("title");
                    break;
                case "z_to_a":

                    $products = $products->orderByDesc("title");
                    break;
                case "low_to_high":
                    $products = $products->orderBy("price");
                    break;
                case "high_to_low":
                    $products = $products->orderByDesc("price");
                    break;
                default:
                    $products = $products->latest();
            }
        } else
            $products = $products->latest();
        if ($key_word = \request("query")) {
            $products = $products->where(function ($query) use ($key_word) {
                $query->where("title", "LIKE", "%" . $key_word . "%")
                    ->orWhere("price", "LIKE", "%" . $key_word . "%")
                    ->orWhere("sizes", "LIKE", "%" . $key_word . "%")
                    ->orWhere("description", "LIKE", "%" . $key_word . "%");
            });
        }
        $products = $products->paginate(12);
        return view("home.shop", compact('products','seller'));
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }

    public function show($slug)
    {
        $product = Product::where("slug", $slug)->first();
        $reviews = Review::latest()->where("product_id", $product->id)->get();
        $products = Product::latest()->take(6)->get();
        $product_id = [];
        foreach ($product->categories as $category) {
            foreach ($category->products->pluck("id") as $item) {
                $product_id[] = $item;
            }
        }
        $recommended_products = Product::latest()->whereIn("id", $product_id)->where("id", "!=", $product->id)->take(12)->get();
        return view("home.item", compact('product', 'products', 'recommended_products', 'reviews'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
