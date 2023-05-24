<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
        'pivot',
    ];

    public function getPhotoAttribute($value)
    {
        if (!$value) {
            return env('DEFAULT_IMAGE_USER');
        }
        return asset($value);
    }


    public function cart()
    {
        return $this->hasOne(Cart::class, 'user_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id');
    }

    public function addresses()
    {
        return $this->hasMany(Address::class, 'user_id');
    }

    public function getCreatedAtAttribute($value)
    {
        return date("Y/m/d h:i:s a", strtotime($value));
    }

    public function getUpdatedAtAttribute($value)
    {
        return date("Y/m/d h:i:s a", strtotime($value));
    }
}