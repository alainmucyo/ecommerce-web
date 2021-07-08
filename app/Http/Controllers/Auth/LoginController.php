<?php

namespace App\Http\Controllers\Auth;

use App\Cart;
use App\Http\Controllers\Controller;
use App\Product;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = "/";

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*  public function redirectPath()
      {
          if (!auth()->user()->hasRole("customer")){
              return "/home";
          }

      }*/
    protected function authenticated(Request $request, $user)
    {
        if ($cart = session()->get("temp_cart")) {
            $product = Product::find($cart['product_id']);
            Cart::create([
                "product_id" => $cart['product_id'],
                "user_id" => $user->id,
                "quantity" => $cart['quantity'],
                "price" => $cart['price'],
                "size" => $cart['size'] ? $cart['size'] : null,
                "seller_id" => $product->seller_id
            ]);
            session()->remove("temp_cart");
            return redirect("/checkout")->with("info", 'Welcome '.$user->name.'. We are happy to have you. You Can Now Buy!');
        }
        if (!$user->hasRole("customer")) {
            return redirect("/home");
        }
        return redirect("/")->with("success", 'Welcome back '.$user->name.', You Can Add to cart, buy, chat, check ordering,.... !');
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
