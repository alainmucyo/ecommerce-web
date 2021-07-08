<?php

namespace App\Http\Controllers;

use App\AdProduct;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class AdProductController extends Controller
{
    public function index()
    {
        $products = AdProduct::get();
        return view("admin.ad_product.index", compact('products'));
    }

    public function create()
    {
        $product = new Product();
        return view("admin.ad_product.create", compact('product'));
    }

    public function store(Request $request)
    {
        $request->validate([
            "title" => "required",
            "image" => "required|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
            "details" => "required|max:120"
        ]);

        if ($request->hasFile('image')) {
            $png_url = "-" . str_random(5);
            $directory = storage_path() . '/app/public/images/';
            if (!file_exists($directory)) {
                File::makeDirectory($directory, $mode = 0777, true, true);
            }
            $path = $directory . $png_url;
            Image::make($request->file("image"))->save($path);
            AdProduct::create([
                "title" => $request['title'],
                "image" => "/storage/images/" . $png_url,
                "details" => $request['details']
            ]);
            return redirect()->back()->with("success", "Ad product created successfully!");
        }
        return redirect()->back()->with("error", "Please provide the image");
    }

    public function edit(AdProduct $adProduct)
    {
        $product = $adProduct;
        return view("admin.ad_product.edit", compact('product'));
    }

    public function update(Request $request, AdProduct $adProduct)
    {
        $request->validate([
            "title" => "required",
            "image" => "image|mimes:jpeg,png,jpg,gif,svg|max:2048",
            "details" => "required|max:120"
        ]);

        if ($request['image'] && $request->hasFile('image')) {
            $png_url = "image-" . str_random(5);
            $directory = storage_path() . '/app/public/images/';
            if (!file_exists($directory)) {
                File::makeDirectory($directory, $mode = 0777, true, true);
            }
            $image = $adProduct->image;
            if ($image != null && file_exists(public_path($image))) {
                unlink(public_path($image));
            }

            $path = $directory . $png_url;
            Image::make($request->file("image"))->save($path);
            $adProduct->update([
                "title" => $request['title'],
                "image" => "/storage/images/" . $png_url,
                "details" => $request['details']
            ]);
        } else
            $adProduct->update(['title' => $request['title'], "details" => $request['details']]);

        return redirect()->route("ad-product.index")->with("success", "Ad product updated successfully!");
    }

    public function destroy(AdProduct $adProduct)
    {
        $image = $adProduct->image;
        if ($image != null && file_exists(public_path($image))) {
            unlink(public_path($image));
        }
        $adProduct->delete();
        return redirect()->back()->with("success", "Product deleted successfully!");
    }
}
