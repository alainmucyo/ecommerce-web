<?php

namespace App\Http\Controllers;

use App\AdProduct;
use App\Category;
use App\HomeSection;
use App\OrderProduct;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use jeremykenedy\LaravelRoles\Models\Role;

class ProductHomeController extends Controller
{

    public function index()
    {
        $products = Product::latest()->take(8)->get();
        $categories = Category::get();

        return view("welcome", compact('products', 'categories'));
    }

    public function newIndex()
    {
        $sellers = Role::where("slug", "seller")->first()->users->where("status",1)->where("on_homepage",1);
        $homeSections = HomeSection::withCount("products")->where("status", 1)->get()->where("products_count", ">", 0);
        $categories = Category::get();
        $categories_count_half = round($categories->count() / 2);
        $popularProducts = Product::withCount("orderProducts")->where("status", 1)->orderByDesc("order_products_count")->limit(3)->get();
        $paginated_cats = Category::simplePaginate(8);
        $ad_products = AdProduct::latest()->get();
        return view("home.index", compact('categories', 'popularProducts', 'homeSections', 'paginated_cats', 'categories_count_half', 'ad_products','sellers'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
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
