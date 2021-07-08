<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderProduct;
use App\Product;
use App\User;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function productReports(Request $request)
    {
        if (auth()->user()->hasRole("seller")) {
            $products = Product::where("seller_id", auth()->user()->id);
            $products = $products->withCount("orders")->orderBy("orders_count", "desc")->get();
        } else {
            $products = Product::withCount("orders")->orderBy("orders_count", "desc")->get();
        }
        return view("reports.products", compact('products'));
    }

    public function customerReports(Request $request)
    {
     if(auth()->user()->hasRole("seller"))
        $customers = OrderProduct::where("seller_id", auth()->user()->id);
     else
         $customers =   OrderProduct::where("seller_id","!=", 0);
          if ($from = request()->from)
              $customers->whereDate("updated_at", ">=", $from);
          if ($to = request()->to)
              $customers->whereDate("updated_at", "<=", $to);

       $customers= $customers->get()
            ->groupBy(function ($op) {
                return $op->customer_id;
            })->sortByDesc(function ($object) {
                return $object->count();
            });

        return view("reports.customers", compact('customers'));
    }

}
