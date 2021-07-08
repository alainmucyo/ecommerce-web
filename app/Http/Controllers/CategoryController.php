<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function getCategory()
    {
        return view("admin.categories.categories");
    }

    public function index()
    {
        return CategoryResource::collection(Category::where("status", 1)->orderBy("name")->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            "name" => "required"
        ]);

        return new CategoryResource(Category::create($request->all()));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            "name" => "required"
        ]);
        $category->update($request->all());
        return new CategoryResource($category);
    }

    public function destroy(Category $category)
    {

        $category->update(["status" => 0]);
    }

}
