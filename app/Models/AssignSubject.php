<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignSubject extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function get_student_class()
    {
        return $this->belongsTo(StudentClass::class, 'class_id', 'id');
    }
    public function get_subject()
    {
        return $this->belongsTo(SchoolSubject::class, 'subject_id', 'id');
    }
}
