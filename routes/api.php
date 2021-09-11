<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::post("/payment/callback", function (Request $request) {
    if (
        ($request["event"] != "charge.completed") ||
        $request["data"]["processor_response"] != "Approved" ||
        $request["data"]["status"] != "successful"
    )
        return response(["message" => "Failed"], Response::HTTP_BAD_REQUEST);

    $order = \App\Order::where("order_id", $request["data"]["tx_ref"])->first();
    if ($order) {
        $order->update([
            "payed" => 1,
            "payed_at" => now(),
            "payment_response" => json_encode($request["data"]),
            "payment_mode" => $request["data"]["payment_type"] == 'mobilemoneyrw' ? 1 : 2
        ]);
    }
    return \response(["message" => "okay, thanks!"]);
});
