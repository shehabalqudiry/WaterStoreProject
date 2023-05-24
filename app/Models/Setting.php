<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $guarded = ['id','created_at','updated_at'];

    public function website_logo(){
        if (!$this->website_logo) {
            return env('DEFAULT_IMAGE');
        }
        return asset($this->website_logo);
    }
    public function website_cover(){
        return asset($this->website_cover);
    }
    public function website_wide_logo(){
        return asset($this->website_wide_logo);
    }
    public function website_icon(){
        return asset($this->website_icon);
    }
    public function main_color(){
        if($this->main_color==null)
            return "#2196f3";
        else
            return $this->main_color;
    }
    public function hover_color(){
        if($this->hover_color==null)
            return "#2196f3";
        else
            return $this->hover_color;
    }
    public function phone(){
        if($this->phone==null)
            return "";
        else
            return $this->phone;
    }



}
