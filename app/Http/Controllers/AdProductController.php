<?php

namespace App\Http\Controllers;

use App\AdProduct;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class AdProductController extends Controller
{
    private function imageUploader($image): string
    {
        $uploadedFileUrl = Cloudinary()->upload($image)->getSecurePath();
        return $uploadedFileUrl;
    }

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
            $path = $request->file('image');
            $data = file_get_contents($path);
            $base64 = 'data:image/' . $path->extension() . ';base64,' . base64_encode($data);
            $image = $this->imageUploader($base64);
            AdProduct::create([
                "title" => $request['title'],
                "image" => $image,
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
            "details" => "required|max:120"
        ]);

        if ($request['image'] && $request->hasFile('image')) {
            $path = $request->file('image');
            $data = file_get_contents($path);
            $base64 = 'data:image/' . $path->extension() . ';base64,' . base64_encode($data);
            $image = $this->imageUploader($base64);
            $adProduct->update([
                "title" => $request['title'],
                "image" => $image,
                "details" => $request['details']
            ]);
        } else
            $adProduct->update(['title' => $request['title'], "details" => $request['details']]);

        return redirect()->route("ad-product.index")->with("success", "Ad product updated successfully!");
    }

    public function destroy(AdProduct $adProduct)
    {
        $adProduct->delete();
        return redirect()->back()->with("success", "Product deleted successfully!");
    }
}
