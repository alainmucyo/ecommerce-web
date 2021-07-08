<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Http\Resources\CheckoutResource;
use App\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function index()
    {
//        $cart_products = auth()->user()->cartProducts;
        return view("home.cart");
    }


    public function create()
    {
        //
    }

    private function guestBuy(Request $request)
    {

        $product = Product::find($request['product_id']);
        $request['price'] = $product->discount ? $product->discount->price : $product->price;
        session()->put("temp_cart", $request->all());
        return redirect("/register")->with("info", "Please, create account to buy or login if already have account!");
    }

    public function store(Request $request)
    {
        $request->validate([
            "quantity" => "required",
            "product_id" => "required"
        ]);
        if (!auth()->check()) {
            return $this->guestBuy($request);
        }
        $request['user_id'] = auth()->user()->id;
        $product = Product::find($request['product_id']);
        $request['price'] = $product->discount ? $product->discount->price : $product->price;
        $request['seller_id'] = $product->seller_id;

        if ($request['buy'] && $request['buy'] == 'buy') {
            unset($request['buy']);

            Cart::create($request->all());
            return redirect("/checkout");
        }
        unset($request['buy']);
        Cart::create($request->all());
        return redirect()->back()->with('success', "Product Added To Cart Successfully!");
    }

    public function show(Cart $cart)
    {
        //
    }


    public function edit(Cart $cart)
    {
        //
    }


    public function update(Request $request)
    {
        $cart_products = auth()->user()->cartProducts;
        $cart_products_ids = $cart_products->pluck("quantity");
        $quantities = [];

        for ($i = 0; $i < count($cart_products_ids); $i++) {
            $quantity_mob = (int)$request->quantity_mob[$i];
            $quantity = (int)$request->quantity[$i];

            if ($quantity == $quantity_mob[$i]) {
                $quantities[] = $quantity;
            } elseif ($quantity != $cart_products_ids[$i]) {
                $quantities[] = $quantity;
            } else {
                $quantities[] = $quantity_mob;
            }
        }
        for ($t = 0; $t < count($cart_products_ids); $t++) {
            $cart_products[$t]->update(["quantity" => $quantities[$t]]);
        }
        return redirect()->back()->with("success", "Cart Updated Successfully!");
    }

    public function checkout()
    {
        return view("home.checkout");
    }

    public function apiCheckout()
    {
        $cart_products = Cart::with("product")->where("user_id",auth()->user()->id)->get();
        return response(CheckoutResource::collection($cart_products));
    }

    public function destroy(Cart $cart)
    {
//        return $cart;
        $cart->delete();
        return redirect()->back()->with("success", "Product Deleted Successfully from cart");
    }
}
