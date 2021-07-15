<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderProduct;
use Illuminate\Http\Request;

class SellerOrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {

        $orders = OrderProduct::where("seller_id", auth()->user()->id)->where("paid",1)->where("delivered", 0)->where("status", 0)->where("received", 0)->where("delivered", 0)->orderByDesc("order_id")->get()
            ->groupBy(function ($val) {
                return $val->order_id;
            });
        return view("seller.orders.index", compact('orders'));
    }

}
