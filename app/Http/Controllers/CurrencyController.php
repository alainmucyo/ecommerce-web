<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function change($currency)
    {
        session()->put("currency", $currency);
        return redirect()->back();
    }
}
