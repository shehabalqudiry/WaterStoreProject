<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Slider extends Model
{
    use HasFactory;
    public $guarded=[];

    public function getImageAttribute($value)
    {
        return asset($value);
    }

    public function OriginalImagePath()
    {
        $img = DB::table('sliders')->where('id', $this->id)->first();
        return $img->image;
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
