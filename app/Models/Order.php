<?php

namespace App\Models;

use App\Models\Address;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    public $guarded=[];
    public $appends=['status_string', 'payment_string', 'total_without_vat', 'vat', 'coupon'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function getStatusStringAttribute()
    {
        $status = 'جاري المراجعه';
        if ($this->status == 1) {
            $status = 'تم قبول الطلب وجاري التجهيز';
        }elseif($this->status == 2){
            $status = 'تم رفض الطلب';
        }elseif($this->status == 3){
            $status = 'تم التوصيل';
        }elseif($this->status == 4){
            $status = 'تم إلغاء الطلب';
        }
        return $status;
    }

    public function getPaymentStringAttribute()
    {
        return $this->payment->name ?? "NA";
    }
    public function getCouponAttribute()
    {
        return $this->coupon()->coupon_code ?? "NA";
    }
    public function getCouponIdAttribute($value)
    {
        return $value ?? "";
    }
    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id');
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class, 'coupon_id');
    }

    public function payment()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_id');
    }
    public function getTotalWithoutVatAttribute()
    {
        $value = (doubleval($this->total) / 1.15);
        return "$value";
    }
    public function getVatAttribute()
    {
        $value = doubleval($this->total) - (doubleval($this->total) / 1.15);
        return number_format($value, 2);
    }

    public function getTotalAttribute($value)
    {
        return "$value";
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
