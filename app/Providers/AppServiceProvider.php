<?php
namespace App\Providers;

use App\Category;
use App\Chatbox;
use App\OrderProduct;
use App\User;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register()
    {
        //
    }

    public function boot()
    {
        view()->composer(["layouts.master", "welcome", "home.cart", "home.checkout","home.index"], function ($view) {
            $sum = 0;
            if (auth()->user()) {
                $cart_products = auth()->user()->cartProducts;

                if ($cart_products->count() > 0) {
                    $sum = $cart_products->sum(function ($p) {
                        return $p->quantity * $p->price;
                    });
                }
            } else
                $cart_products = [];
            $sum = number_format($sum) . " Rwf";
            $view->with(["cart_products" => $cart_products, "sum" => $sum]);
        });
        view()->composer(["includes.header", "home.shop"], function ($view) {
            $categories = Category::get();
            $view->with(["categories" => $categories]);
        });

        view()->composer(["layouts.app"], function ($view) {
            if (auth()->check() && auth()->user()->hasRole("admin")) {
                $new_sellers = User::where("status", 0)->count();
                $view->with(["new_sellers" => $new_sellers]);
            }
            if (auth()->check() && auth()->user()->hasRole("seller")) {
                $undelivered = OrderProduct::where("seller_id", auth()->user()->id)->where("paid", 1)->where("delivered", 0)->count();
                $unread_messages = Chatbox::where("seller_id", auth()->user()->id)->where("status", 0)->where("sender", "!=", auth()->user()->id)->count();
                $view->with(["undelivered" => $undelivered, "unread_messages" => $unread_messages]);
            }
        });
    }
}
