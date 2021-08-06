<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function customer()
    {
        return $this->belongsTo(User::class,"customer_id");
    }

    public function order()
    {
        return $this->belongsTo(Order::class,"order_id");
    }

    public function seller()
    {
        return $this->belongsTo(User::class, "seller_id");
    }
}
