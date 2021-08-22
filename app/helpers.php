<?php

use App\CurrencyExchange;

function currencyConverter($amount): string
{
    $currency = CurrencyExchange::latest()->first();
    if (currentCurrency() == "rwf")
        return number_format($amount) . " RWF";

    if (currentCurrency() == "usd") {
        if ($amount == 0) return "$0";
        return "$" . number_format($amount / (int)$currency->american);
    }

    return number_format($amount / (int)$currency->dirham) . " Dirham";
}

function currentCurrency()
{
    $currency = session()->get("currency");
    if ($currency == null) return "rwf";
    return $currency;
}
