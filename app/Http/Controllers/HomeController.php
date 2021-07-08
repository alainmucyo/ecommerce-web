<?php

namespace App\Http\Controllers;

use App\Charts\LineChart;
use App\Http\Traits\IncomeTrait;
use App\Order;
use App\OrderProduct;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use IncomeTrait;


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $dailyChart = new LineChart($this->days, $this->weekly(), "Weekly Income ");
        $monthlyChart = new LineChart($this->months, $this->monthly(), "Monthly Income");
        if (auth()->user()->hasRole("customer"))
            return redirect("/");
        if (auth()->user()->hasRole("seller")) {
            $orderProducts = OrderProduct::where("seller_id", auth()->user()->id);
            $income = $orderProducts->get()->sum(function ($q) {
                return $q->price * $q->quantity;
            });
            $most_income = $orderProducts->orderByRaw("(price * quantity) desc")->get()
                ->groupBy(function ($p) {
                    return $p->product_id;
                })
                ->sortByDesc(function ($object) {
                    return $object->sum(function ($p) {
                        return $p->price * $p->quantity;
                    });
                });
            $most_income_prod = isset($most_income->first()[0]->product) ? $most_income->first()[0]->product : null;
            $most_income_prod = $most_income_prod ? ['title' => $most_income_prod->title] : ['title' => 'No product yet'];
            $orders = OrderProduct::where("seller_id", auth()->user()->id)->groupBy("order_id")->get()->count();
            $quantity = OrderProduct::where("seller_id", auth()->user()->id)->get()->sum("quantity");
            $soldProducts = OrderProduct::where("seller_id", auth()->user()->id)->groupBy("product_id")->get()->count();
            $most_sold = OrderProduct::where("seller_id", auth()->user()->id)->get()
                ->groupBy(function ($p) {
                    return $p->product_id;
                })
                ->sortByDesc(function ($object) {
                    return $object->count();
                });
            $most_sold_prod = isset($most_sold->first()[0]->product) ? $most_sold->first()[0]->product : null;
            $most_sold_prod = $most_sold_prod ? ['title' => $most_sold_prod->title] : ['title' => 'No product yet'];
        } else {
            $income = Order::where("payed", 1)->sum("price");
            $most_income = OrderProduct::orderByRaw("(price * quantity) desc")->get()
                ->groupBy(function ($p) {
                    return $p->product_id;
                })
                ->sortByDesc(function ($object) {
                    return $object->sum(function ($p) {
                        return $p->price * $p->quantity;
                    });
                });
            $most_income_prod = isset($most_income->first()[0]->product) ? $most_income->first()[0]->product : null;
            $orders = OrderProduct::groupBy("order_id")->get()->count();
            $quantity = OrderProduct::get()->sum("quantity");
            /*  $most_quantity_prod = OrderProduct::orderByDesc("quantity")->get()
                  ->groupBy(function ($p) {
                      return $p->product_id;
                  })
                  ->sortByDesc(function ($object) {
                      return $object->sum("quantity");
                  })->first()[0]->product;*/
            $soldProducts = OrderProduct::groupBy("product_id")->get()->count();
            $most_sold = OrderProduct::get()
                ->groupBy(function ($p) {
                    return $p->product_id;
                })
                ->sortByDesc(function ($object) {
                    return $object->count();
                });
            $most_sold_prod = isset($most_sold->first()[0]->product) ? $most_sold->first()[0]->product : null;
        }

        return view('home', compact('orders', 'quantity', 'income', 'soldProducts', 'most_income_prod', 'most_sold_prod', 'monthlyChart', 'dailyChart'));
    }
}
