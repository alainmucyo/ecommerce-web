<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    public function products()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function customer()
    {
        return $this->belongsTo(User::class,"customer_id");
    }

    public function deliveryFee()
    {
        return $this->belongsTo(DeliveryFee::class);
    }

    public function paymentMode()
    {
        return $this->belongsTo(PaymentMode::class, "payment_mode");
    }

    public function getSellersAttribute()
    {
        $orderProductsSellers = $this->products->pluck("seller_id");
        $sellers = User::whereIn("id", $orderProductsSellers)->get(["name"]);
        return $sellers;
    }

    public function getDeliveredDateAttribute()
    {
        return Carbon::parse($this->delivered_at);
    }

    public function getReceivedDateAttribute()
    {
        return Carbon::parse($this->received_at);
    }

    public function information()
    {
        return $this->belongsTo(UserInformation::class, "user_information_id");
    }

    public function user_address()
    {
        return $this->belongsTo(UserInformation::class,"user_information_id");
    }

    public function getPayedDateAttribute()
    {
        return Carbon::parse($this->payed_at);
    }
}
