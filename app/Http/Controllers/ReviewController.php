<?php

namespace App\Http\Controllers;

use App\Product;
use App\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{

    public function index($product)
    {
        $reviews = Review::where("product_id", $product)->latest()->paginate(12);
        return view("review.index",compact('reviews'));
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
            "email" => "required",
            "title" => "required",
            "content" => "required",
            "product_id" => "required"
        ]);
        Review::create($request->all());
        return redirect()->back()->with("success", "Thank You! We have received your review!");
    }


    public function show(Review $review)
    {
        //
    }


    public function edit(Review $review)
    {
        //
    }

    public function update(Request $request, Review $review)
    {
        //
    }

    public function destroy(Review $review)
    {
        //
    }
}
