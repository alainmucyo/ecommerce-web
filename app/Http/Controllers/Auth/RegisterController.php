<?php

namespace App\Http\Controllers\Auth;

use App\Cart;
use App\Http\Controllers\Controller;
use App\Product;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use jeremykenedy\LaravelRoles\Models\Role;

class RegisterController extends Controller
{


    use RegistersUsers;

    protected $redirectTo = "/";

    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required','regex:/^(07)[0-9]{8}$/'],
            'address' => ['required'],
            'password' => ['required', 'string', 'confirmed',"min:6"],
        ]);
    }

    protected function create(array $data)
    {
        $user = User::create([
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'password' => Hash::make($data['password']),
            'status' => 1,
            'confirmed' => 1,
            "shop_name"=>isset($data['shop_name'])?$data['shop_name']:null
        ]);
        if ($data['type'] == "customer") {
            $role = Role::where("slug", "customer")->first();
            $user->attachRole($role);
        } else {
            $role = Role::where("slug", "seller")->first();
            $user->attachRole($role);
        }
        return $user;
    }

    protected function registered(Request $request, $user)
    {
        if (auth()->user()->hasRole("seller")) {
            Auth::logout();
            return redirect("/")->with("info", 'Your Account Has Been Created Successfully! Please wait for being approved as seller!');
        }
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
            return redirect("/checkout")->with("info", 'Your Account Has Been Created Successfully!');
        }
        return redirect("/")->with("info", 'Your Account Has Been Created Successfully!');
    }
}
