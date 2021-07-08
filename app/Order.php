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
        return $this->belongsTo(User::class);
    }

    public function deliveryFee()
    {
        return $this->belongsTo(DeliveryFee::class);
    }

    public function paymentMode()
    {
        return $this->belongsTo(PaymentMode::class, "payment_mode");
    }

    public function province()
    {
        return $this->belongsTo(Province::class, "province_id");
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }

    public function cell()
    {
        return $this->belongsTo(Cell::class);
    }

    public function village()
    {
        return $this->belongsTo(Village::class);
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

    public function getPayedDateAttribute()
    {
        return Carbon::parse($this->payed_at);
    }
}
