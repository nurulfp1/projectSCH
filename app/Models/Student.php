<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'gender',
        'nis',
        'class_id',
        'image',
    ];

    // protected $fillable = [
    //     'name', 'gender', 'nis', 'class_id'
    // ];

    public function class()
    {
        return $this->belongsTo(ClassRoom::class);  // many2one
    }

    public function extracurriculars()
    {
        return $this->belongsToMany(Extracurricular::class, 'student_extracurricular', 'student_id', 'extracurricular_id'); //many2many
    }
}
