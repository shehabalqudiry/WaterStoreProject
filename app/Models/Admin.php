<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guarded = [];

    protected $hidden = [
        'password',
    ];

    public function scopeWithoutTimestamps()
    {
        $this->timestamps = false;
        return $this;
    }


    public function traffics()
    {
        return $this->hasMany(RateLimit::class);
    }
    public function report_errors()
    {
        return $this->hasMany(ReportError::class);
    }

}
