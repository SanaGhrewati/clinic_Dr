<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name',
    ];

    // علاقة مع المواعيد
    public function appointments()
    {
        return $this->hasMany(\App\Models\Appointment::class);
    }
}