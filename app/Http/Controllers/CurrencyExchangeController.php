<?php

namespace App\Http\Controllers;

use App\CurrencyExchange;
use Illuminate\Http\Request;

class CurrencyExchangeController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        $currency = CurrencyExchange::latest()->first();
        return view("admin.currencies.create", compact("currency"));
    }

    public function store(Request $request)
    {
        $request->validate([
            "rwandan" => "required",
            "american" => "required",
            "dirham" => "required"
        ]);
        CurrencyExchange::create($request->all());
        return redirect()->back()->with("success", "Currency Exchange created successfully!");
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, CurrencyExchange $currency)
    {
        $request->validate([
            "rwandan" => "required",
            "american" => "required",
            "dirham" => "required",
        ]);

        $currency->update($request->all());

        return redirect()->back()->with("success", "Currency Exchange updated successfully!");
    }

    public function destroy(CurrencyExchange $currency)
    {
        //
    }
}
