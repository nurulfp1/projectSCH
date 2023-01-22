<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassRoom extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'teacher_id',
    ];

    protected $table = 'class';

    public function students()
    {
        // $class = ClassRoom::with('students')->get();
        return $this->hasMany(Student::class, 'class_id', 'id');
    }

    public function homeroomTeacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id', 'id');
    }
}
