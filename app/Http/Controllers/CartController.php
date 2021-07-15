<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Http\Resources\CheckoutResource;
use App\Product;
use App\UserInformation;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function index()
    {
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
        $quantity_mob = $request->quantity_mob;
        foreach ($cart_products as $key => $product) {
            $new_quantity = $quantity_mob[$key];
            if ($product->quantity != $new_quantity) {
                $product->update([
                    "quantity" => $new_quantity
                ]);
            }
        }
        return redirect()->back()->with("success", "Cart Updated Successfully!");
    }

    public function checkout()
    {
        return view("home.checkout");
    }

    public function apiCheckout()
    {
        $information = new UserInformation();

        if (auth()->user()->information && auth()->user()->information->where("reuse")->count() > 0)
            $information = auth()->user()->information[0];
        else {
            $information->name = "";
            $information->email = auth()->user()->email;
            $information->phone = auth()->user()->phone;
            $information->address = auth()->user()->address;
        }
        $cart_products = Cart::with("product")->where("user_id", auth()->user()->id)->get();
        return response(["products" => CheckoutResource::collection($cart_products), "information" => $information]);
    }

    public function destroy(Cart $cart)
    {
        $cart->delete();
        return redirect()->back()->with("success", "Product Deleted Successfully from cart");
    }

    public function removeAllCart()
    {
        $cart_products = auth()->user()->cartProducts;
        foreach ($cart_products as $cart) {
            $cart->delete();
        }
        return redirect()->back()->with("success", "Products Deleted Successfully from cart");
    }
}
