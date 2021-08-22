<?php

namespace App;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Str;

class Product extends Model
{
    protected $guarded = [];
    protected $appends = ["product_image"];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($product) {
            $slug = Str::slug($product->title);
            $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
            $product->slug = $count ? "{$slug}-{$count}" : $slug;
        });
    }

    public function seller()
    {
        return $this->belongsTo(User::class, "seller_id");
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }


    public function discount()
    {
        return $this->hasOne(Discount::class)->where("end_time", ">", now())->latest();
    }

    public function getHasDiscountAttribute()
    {
        return $this->discount ? true : false;
    }

    public function getDiscountPercentAttribute()
    {
        try {
            return $this->discount ? (round(($this->price - $this->discount->price) / $this->price, 2)) * 100 : '0';
        } catch (Exception $e) {
            return 0;
        }
    }

    public function orders()
    {
        $orders = $this->hasMany(OrderProduct::class);
        if ($from = request()->from)
            $orders->whereDate("updated_at", ">=", $from);
        if ($to = request()->to)
            $orders->whereDate("updated_at", "<=", $to);
        return $orders;

    }

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function homeSection()
    {
        return $this->belongsTo(HomeSection::class);
    }

    public function getProductImageAttribute()
    {
        if ($this->images) {
            return json_decode($this->images)[0];
        }
        return "/img/no-image.jpg";
    }

    public function getFormattedPriceAttribute()
    {
        if (currentCurrency() == "rwf")
            return number_format($this->price) . " RWF";

        if (currentCurrency() == "usd") {
            if($this->price == 0) return "$0";
            return "$" . number_format($this->price / 1000);
        }

        return number_format($this->price) . " Dirham";
    }

}
