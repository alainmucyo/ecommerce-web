<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Order;
use App\OrderProduct;
use App\UserInformation;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class BuyController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
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
            "phone" => "required|regex:/^(07[8,2,3,9])[0-9]{7}$/",
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
        if ($cart_products->count() > 0) {
            foreach ($request_products as $request_product) {
                $cart_product = $cart_products->where("id", $request_product['id'])->first();
                $sum += ($cart_product->quantity * $cart_product->price) + ($cart_product->quantity * $request_product['insurance']);
            }
        }
        $delivery_fee_id = $request->all()['delivery_fee']['id'];
        $sum += $request->all()['delivery_fee']['amount'];

        /*   $client = new Client([
               'headers' => ['Content-Type' => 'application/json']
           ]);
           $trans_id = uniqid();*/
        /*    $response = $client->post('
        ',
                ['body' => json_encode(
                    [
                        'token' => '21EOp10VMTfSJUv2tItJS4lSARYN4QPW',
                        'amount' => $sum,
                        'msisdn' => $phonenumber,
                        'external_transaction_id' => $trans_id,
                        'from_msg' => 'E-Commerce Payment ',
                        'to_msg' => 'Thank You for Business with us'
                    ]
                )]
            );*/

//            $data = json_decode($response->getBody()->getContents(), true);
        $data = [];
//            if ($request['mobile_money'] && trim($request['mobile_money'])){
//                auth()->user()->update(["phone"=>$request['mobile_money']]);
//            }
        if (true or array_key_exists('action', $data)) {
            if (true or $data['action'] == 200) {
                $order = Order::create([
                    "order_id" => rand(100000, 999999),
                    "customer_id" => auth()->user()->id,
                    "price" => $sum,
                    "payment_mode" => 1,
                    "payed" => true,
                    "payed_at" => now(),
                    "user_information_id" => $userinfo->id,
                    "delivery_fee_id" => $delivery_fee_id
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
                foreach ($request_products as $request_product) {
                    Cart::where("id", $request_product['id'])->delete();
                }
                return "ok";
            } else {
                return response($data['message'], 400);
            }
        } else {
            return response($data['response'], 400);
        }
    }
}
