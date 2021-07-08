<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderProductsResource;
use App\Order;
use App\OrderProduct;
use App\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {

        $orders = Order::where("customer_id", auth()->user()->id);
        if (\request("orders") && \request("orders") == "all")
            $orders = $orders->latest();
         else {
             $orders = $orders->latest()->where(function ($val){
              $val->where("payed", 1)->where("status", 0)->orWhereDate("created_at", now());
            });
            if (!$orders->exists())
                $orders = Order::where("customer_id", auth()->user()->id)->latest();
        }
        $orders = $orders->get();
        return view("home.orders", compact('orders'));
    }


    public function adminOrders()
    {
        $orders = Order::latest()->orderBy("delivered")->get();
        return view("admin.orders.index", compact('orders'));
    }

    public function show($order)
    {

        if (auth()->user()->hasRole("seller"))
            return OrderProductsResource::collection(OrderProduct::where("order_id", $order)->where("seller_id", auth()->user()->id)->get());
        return OrderProductsResource::collection(OrderProduct::where("order_id", $order)->get());
    }

    public function edit(Order $order)
    {
        //
    }


    public function update(Order $order)
    {
        $order->update(["status" => 1, "delivered_at" => now()]);
        return redirect()->back()->with("success", "Order marked as received successfully!");
    }


    public function destroy(Order $order)
    {
        //
    }

    public function customerShow($order)
    {

        $order = Order::where("order_id", $order)->first();
        if (!$order)
            abort(404);
        return view("home.orders.show", compact('order'));
    }

    public function productDeliver(OrderProduct $orderProduct)
    {
        $orderProduct->update(["delivered" => true, "delivered_at" => now()]);
        $allDelivered = OrderProduct::where("order_id", $orderProduct->order_id)->where("delivered", 0)->exists();
        if (!$allDelivered)
            Order::find($orderProduct->order_id)->update(["delivered" => true, "delivered_at" => now()]);

        return redirect()->back()->with("success", "Product Delivered Successfully!");
    }

    public function orderDeliver($order)
    {
        OrderProduct::where("order_id", $order)->where("seller_id", auth()->user()->id)->update(["delivered" => true, "delivered_at" => now()]);
        $allDelivered = OrderProduct::where("order_id", $order)->where("delivered", 0)->exists();

        if (!$allDelivered)
            Order::find($order)->update(["delivered" => true, "delivered_at" => now()]);

        return redirect()->back()->with("success", "Product Delivered Successfully!");
    }

    public function productReceived(OrderProduct $orderProduct)
    {
        $orderProduct->update(["received" => true, "received_at" => now()]);
        $allDelivered = OrderProduct::where("order_id", $orderProduct->order_id)->where("received", 0)->exists();

        if (!$allDelivered)
            Order::find($orderProduct->order_id)->update(["status" => true, "received_at" => now()]);

        Product::find($orderProduct->product_id)->decrement("client_max", $orderProduct->quantity);
        return redirect()->back()->with("success", "Product Received Successfully!");
    }

    public function orderReceived($order)
    {
        $products = OrderProduct::where("order_id", $order)->where("seller_id", auth()->user()->id)->get();
        OrderProduct::where("order_id", $order)->where("seller_id", auth()->user()->id)->update(["received" => true, "received_at" => now()]);
        Order::find($order)->update(["status" => 1, "received_at" => now()]);
        foreach ($products as $product) {
            Product::where("id", $product->product_id)->decrement("client_max", $product->quantity);
        }
        return redirect()->back()->with("success", "Product Received Successfully!");
    }
}
