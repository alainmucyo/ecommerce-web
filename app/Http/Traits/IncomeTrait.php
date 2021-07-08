<?php


namespace App\Http\Traits;


use App\Order;
use App\OrderProduct;
use App\Product;
use Carbon\Carbon;

trait IncomeTrait
{
    public $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    public $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

    public function weekly()
    {
        $days = array();
        $test = [0, 1, 2, 3, 4, 5, 6];
        if (auth()->user()->hasRole("seller")) {
            foreach ($test as $i) {
                array_push($days,
                    OrderProduct::where("paid", 1)->where("seller_id", auth()->user()->id)->whereBetween("updated_at", [Carbon::now()->startOfWeek(),
                        Carbon::now()->endOfWeek()])->whereRaw('WEEKDAY(order_products.updated_at)=' . $i)->get()->sum(function ($op) {
                        return $op->price * $op->quantity;
                    }));
            }
        }
        else{
            foreach ($test as $i) {
                array_push($days,
                    Order::where("payed", 1)->whereBetween("updated_at", [Carbon::now()->startOfWeek(),
                        Carbon::now()->endOfWeek()])->whereRaw('WEEKDAY(orders.updated_at)=' . $i)->get()->sum(function ($op) {
                        return $op->price;
                    }));
            }
        }

        return $days;
    }

    public function monthly()
    {
        $months = array();
        if (auth()->user()->hasRole("seller")) {
            for ($i = 1; $i <= 12; $i++) {
                array_push($months, OrderProduct::where("paid", 1)->where("seller_id", auth()->user()->id)->whereMonth("updated_at", $i)->whereYear("updated_at", now())->get()->sum(function ($op) {
                    return $op->price * $op->quantity;
                }));
            }
        }
        else{
            for ($i = 1; $i <= 12; $i++) {
                array_push($months, Order::where("payed", 1)->whereMonth("updated_at", $i)->whereYear("updated_at", now())->get()->sum(function ($op) {
                    return $op->price;
                }));
            }
        }
        return $months;
    }
}
