<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chatbox extends Model
{
    protected $guarded = [];

    public function customer()
    {
        return $this->belongsTo(User::class, "customer_id");
    }

    public function seller()
    {
        return $this->belongsTo(User::class, "seller_id");
    }
}
