<?php

namespace App\Providers;

use App\AdProduct;
use App\Category;
use App\Chatbox;
use App\OrderProduct;
use App\Product;
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
        view()->composer(["layouts.master", "welcome", "home.cart", "home.checkout", "home.index"], function ($view) {
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
            $sum = currencyConverter($sum);
            $view->with(["cart_products" => $cart_products, "sum" => $sum]);
        });

        view()->composer(["includes.header", "home.shop"], function ($view) {
            $categories = Category::get();
            $view->with(["categories" => $categories]);
        });
        view()->composer(["home.welcome"], function ($view) {
            $ad_products = AdProduct::latest()->take(2)->get();
            $products_slider = Product::where("status", 1)->where("home_slider", 1)->get();
            $view->with(["ad_products" => $ad_products, "products_slider" => $products_slider]);
        });

        view()->composer(["layouts.app"], function ($view) {
            if (auth()->check() && (auth()->user()->hasRole("seller") || auth()->user()->hasRole("admin"))) {
                $undelivered = OrderProduct::where("seller_id", auth()->user()->id)->where("paid", 1)->where("delivered", 0)->count();
                $unread_messages = Chatbox::where("seller_id", auth()->user()->id)->where("status", 0)->where("sender", "!=", auth()->user()->id)->count();
                $view->with(["undelivered" => $undelivered, "unread_messages" => $unread_messages]);
            }
        });
        view()->composer(["home.index", "layouts.master"], function ($view) {
            if (auth()->check() && auth()->user()->hasRole("customer")) {
                $undelivered = OrderProduct::where("customer_id", auth()->user()->id)->where("paid", 1)->where("delivered", 0)->count();
                $unread_messages = Chatbox::where("customer_id", auth()->user()->id)->where("status", 0)->where("sender", "!=", auth()->user()->id)->count();
                $view->with(["undelivered" => $undelivered, "unread_messages" => $unread_messages]);
            }
        });
    }
}
