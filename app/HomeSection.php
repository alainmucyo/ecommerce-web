<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HomeSection extends Model
{
    protected $guarded = [];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
