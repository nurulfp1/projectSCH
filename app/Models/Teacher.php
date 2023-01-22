<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{

    protected $fillable = [
        'name',
    ];

    public function class()
    {
        return $this->hasOne(ClassRoom::class);
    }

 
    public function classroomClass()
    {
        return $this->belongsTo(User::class, 'class_id', 'id');
    }
}
