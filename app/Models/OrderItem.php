<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    public $guarded=[];
    public $appends=['total'];



    public function getTotalAttribute()
    {
        $total = $this->product->price * $this->quantity;
        return number_format($total, 2);
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }


    public function mosque()
    {
        return $this->belongsTo(Mosque::class, 'mosque_id');
    }


    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
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
