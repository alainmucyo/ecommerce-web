<?php

namespace App\Http\Controllers;

use App\DeliveryFee;
use Illuminate\Http\Request;

class DeliveryFeeController extends Controller
{

    public function index()
    {
        return view("admin.delivery_fee.index");
    }


    public function loadFees()
    {
        $delivery_fees = DeliveryFee::where("status", 1)->get();
        return $delivery_fees;
    }


    public function store(Request $request)
    {
        $request->validate([
            "fees" => "required"
        ]);
        $fees = $request['fees'];
        $delivered_fees = [];
        foreach ($fees as $fee) {
            $new_fee = DeliveryFee::create([
                "title" => $fee['title'],
                "details" => $fee['details'],
                "amount" => $fee['amount']
            ]);
            array_push($delivered_fees, $new_fee);
        }
        return $delivered_fees;
    }


    public function show(DeliveryFee $deliveryFee)
    {
        //
    }


    public function edit(DeliveryFee $deliveryFee)
    {
        //
    }

    public function update(Request $request, DeliveryFee $deliveryFee)
    {
        $request->validate([
            "fee" => "required"
        ]);
         $fee = $request->fee[0];
        $deliveryFee->update([
            "title" => $fee['title'],
            "details" => $fee['details'],
            "amount" => $fee['amount']
        ]);

        return $deliveryFee;
    }

    public function destroy(DeliveryFee $deliveryFee)
    {
        $deliveryFee->update(["status" => false]);
        return "Ok";
    }
}
