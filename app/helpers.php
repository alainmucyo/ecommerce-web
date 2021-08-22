<?php
function currencyConverter($amount): string
{
    if (currentCurrency() == "rwf")
        return number_format($amount) . " RWF";

    if (currentCurrency() == "usd") {
        if ($amount == 0) return "$0";
        return "$" . number_format($amount / 1000);
    }

    return number_format($amount) . " Dirham";
}

function currentCurrency()
{
    $currency = session()->get("currency");
    if ($currency == null) return "rwf";
    return $currency;
}
