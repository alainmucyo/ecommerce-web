<?php

namespace App\Http\Controllers;

use App\Like;
use App\Product;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function index()
    {
        //
    }

    public function likeProduct($product)
    {
        Like::create(["product_id" => $product]);
        return redirect()->back()->with("success","Like Added!");
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Like $like)
    {
        //
    }

    public function edit(Like $like)
    {
        //
    }

    public function update(Request $request, Like $like)
    {
        //
    }

    public function destroy(Like $like)
    {
        //
    }
}
