<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use HasFactory, SoftDeletes;
    public $guarded=[];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }



    public function getDeletedAtAttribute($value)
    {
        return date("Y/m/d h:i:s a", strtotime($value));
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