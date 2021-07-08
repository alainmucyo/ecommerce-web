<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliveryFee extends Model
{
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
