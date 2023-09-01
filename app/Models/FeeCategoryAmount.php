<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeCategoryAmount extends Model
{
    protected $guarded = [];

    public function get_fee_category()
    {
        return $this->belongsTo(FeeCategory::class, 'fee_category_id', 'id');
    }

    public function get_student_class()
    {
        return $this->belongsTo(StudentClass::class, 'class_id', 'id');
    }
}
