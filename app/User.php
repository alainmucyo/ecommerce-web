<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use jeremykenedy\LaravelRoles\Traits\HasRoleAndPermission;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoleAndPermission;

    protected $guarded = [];


    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($user) {
            if ($user->shop_name && trim($user->shop_name) !="")
                $slug=Str::slug($user->shop_name);
            else
            $slug = Str::slug($user->name);

            $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
            $user->slug = $count ? "{$slug}-{$count}" : $slug;
        });
    }

    public function cartProducts()
    {
        return $this->hasMany(Cart::class);
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

    public function getImageAttribute()
    {
        return $this->avatar ? Storage::url($this->avatar): "/img/user.png";
    }
}
