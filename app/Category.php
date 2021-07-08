<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($event) {
            $slug = \Str::slug($event->name);
            $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
            $event->slug = $count ? "{$slug}-{$count}" : $slug;
        });
    }

    public function products(){
        return $this->belongsToMany(Product::class);
    }
}
