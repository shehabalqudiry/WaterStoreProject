<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    public $guarded = [];
    protected $appends = ['total', 'total_without_vat', 'vat'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function items()
    {
        return $this->hasMany(CartItem::class, 'cart_id');
    }

    public function getTotalAttribute()
    {
        $value = 0;
        foreach ($this->items as $item) {
            $value += ($item->product->discount_price ? $item->product->discount_price : $item->product->price) * $item->quantity;
        }
        // $value = ;
        return "$value";
    }

    public function getTotalWithoutVatAttribute()
    {
        $value = (doubleval($this->total) / 1.15);
        return number_format($value, 2);
    }
    public function getVatAttribute()
    {
        $value = doubleval($this->total) - (doubleval($this->total) / 1.15);
        return number_format($value, 2);
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
