<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = [
        'name',
        'specialization',
        'phone',
        'department_id'
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
