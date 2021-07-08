<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class AdProduct extends Model
{
    protected $guarded = [];

    public function getProductImageAttribute()
    {
        return $this->image ?: "/img/no-image.png";
    }
}
