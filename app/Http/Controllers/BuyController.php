<?php

namespace App\Http\Controllers;

use App\Cart;
use App\CurrencyExchange;
use App\Order;
use App\OrderProduct;
use App\UserInformation;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BuyController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    private function pay($tx_ref, $price, $userinfo, $title)
    {
        $URL = env("FLUTTERWAVE_API_URL");
        $SECRET_KEY = env("FLUTTERWAVE_SECRET_KEY");
        $client = new \GuzzleHttp\Client(["headers" => ["Authorization" => $SECRET_KEY]]);

        $currency = strtoupper(currentCurrency());
        $mainCurrencies = CurrencyExchange::latest()->first();
        if ($currency == "USD")
            $price = $price / $mainCurrencies->american;

        $response = $client->post($URL,
            ["json" => [
                "tx_ref" => $tx_ref,
                "amount" => $price,
                "currency" => $currency,
                "redirect_url" => env("APP_URL") . "orders",
                "payment_options" => "card",
                "customer" => [
                    "email" => $userinfo->email,
                    "phonenumber" => $userinfo->phone,
                    "name" => $userinfo->name
                ],
                "customizations" => [
                    "title" => "David's High Deals",
                    "description" => "Products payments",
                    "logo" => "https://res.cloudinary.com/alainmucyo/image/upload/v1629698896/david-high-deal_qdbet0.png"
                ]
            ]
            ]
        );
        return json_decode($response->getBody(), true);
    }

    public function buyMomo(Request $request)
    {

        $validators = validator()->make($request->all(), [
            "products" => "required",
            "delivery_fee" => "required"
        ]);
        if ($validators->fails()) {
            return response()->json($validators->errors(), 422);
        }
        $validators = validator()->make($request->all()['address'], [
            "name" => "required",
            "email" => "required",
            "phone" => "required",
            "address" => "required",
        ]);
        if ($validators->fails()) {
            return response()->json($validators->errors(), 422);
        }
        if ($request->all()['address']['reuse'] !== 0) {
            $request->all()['address']['reuse'] = true;
        } else {
            $request->all()['address']['reuse'] = false;
        }
        $userinfo = UserInformation::find($request['id']);

        if ($request['id'])
            $userinfo->update($request->all()['address']);
        else
            $userinfo = UserInformation::create($request->all()['address']);
        /*    $validators = validator()->make($request->all(), [
                "mobile_money" => "required|regex:/^(\+25078)[0-9]{7}$/",
            ]);
            if ($validators->fails()) {
                return response()->json($validators->errors(), 422);
            }
            $phonenumber = $request['mobile_money'];*/
        $cart_products = auth()->user()->cartProducts;
        $request_products = $request->all()['products'];
        $sum = 0;
        $transaction_id = uniqid() . '-' . random_int(10000, 99999);
        if ($cart_products->count() > 0) {
            foreach ($request_products as $request_product) {
                $cart_product = $cart_products->where("id", $request_product['id'])->first();
                $sum += ($cart_product->quantity * $cart_product->price) + ($cart_product->quantity * $request_product['insurance']);
            }
        }
        $delivery_fee_id = $request->all()['delivery_fee']['id'];
        $sum += $request->all()['delivery_fee']['amount'];

        $order = Order::create([
            "order_id" => $transaction_id,
            "customer_id" => auth()->user()->id,
            "price" => $sum,
            "payment_mode" => 1,
            "payed" => false,
            "payed_at" => now(),
            "user_information_id" => $userinfo->id,
            "delivery_fee_id" => $delivery_fee_id,
        ]);
        foreach ($request_products as $request_product) {
            $cart_product = $cart_products->where("id", $request_product['id'])->first();
            OrderProduct::create([
                "order_id" => $order->id,
                "quantity" => $cart_product->quantity,
                "price" => $cart_product->price,
                "product_id" => $cart_product->product_id,
                "size" => $cart_product->size,
                "customer_id" => auth()->user()->id,
                "seller_id" => $cart_product->seller_id,
                "paid" => true,
                "insurance" => $request_product['insurance']
            ]);
        }
        $link = null;
        if ($request->payment) {
            $response = $this->pay(
                $transaction_id,
                $sum,
                $userinfo,
                "David's High Deals payments"
            );
            $link = $response["data"]["link"];
        }
        /*  foreach ($request_products as $request_product) {
              Cart::where("id", $request_product['id'])->delete();
          }*/
        return response(["link" => $link, "done" => "yes"], 200);

    }
}
