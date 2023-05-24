<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;
    public $guarded=[];


    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id');
    }


    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }


    // public function getCreatedAtAttribute($value)
    // {
    //     return date("Y/m/d h:i:s a", strtotime($value));
    // }

    // public function getUpdatedAtAttribute($value)
    // {
    //     return date("Y/m/d h:i:s a", strtotime($value));
    // }
}