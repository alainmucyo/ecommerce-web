<?php

namespace App\Http\Controllers;

use App\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{

    public function index()
    {
        //
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $request->validate([
            "end_time" => "required",
            "price" => "required|numeric",
            "product_id" => "required"
        ]);

        $discount = Discount::create($request->all());
        return $discount;
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Discount $discount
     * @return \Illuminate\Http\Response
     */
    public function show(Discount $discount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Discount $discount
     * @return \Illuminate\Http\Response
     */
    public function edit(Discount $discount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Discount $discount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Discount $discount)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Discount $discount
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discount $discount)
    {
        //
    }
}
