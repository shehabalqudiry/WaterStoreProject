<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $guarded=['id','created_at','updated_at'];
    public $appends=['image_path', 'quantity'];

    public function getImagePathAttribute()
    {
        return asset($this->main_image);
    }

    public function getPriceAttribute($value)
    {
        return number_format($value, 2);
    }

    public function getQuantityAttribute()
    {
        $value = 0;
        $cart = Cart::where('user_id', auth('user_api')->user()->id ?? 0)->first();
        if ($cart) {
            $item = CartItem::where('cart_id', $cart->id)->where('product_id', $this->id)->first();
            $value = $item->quantity ?? 0;
        }
        return $value;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
    // public function category()
    // {
    //     return $this->belongsTo(Category::class, 'category_id');
    // }
    public function main_image()
    {
        return asset($this->main_image);
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
