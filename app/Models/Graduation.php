<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Graduation extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_profile_id', 'student_profile_id', 'grade_9_info', 'grade_10_info', 'grade_11_info', 'status',
    ];
    
    public function parent()
    {
        return $this->belongsTo('App\Models\ParentProfile');
    }

    public function student()
    {
        return $this->belongsTo('App\Models\StudentProfile');
    }

    public function details()
    {
        return $this->hasOne('App\Models\GraduationDetail');
    }
}
