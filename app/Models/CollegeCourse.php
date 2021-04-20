<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollegeCourse extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_profile_id', 'name', 'course_name', 'grade', 'is_college_level', 'course_grade',
        'selectedCredit', 'transcript9_12_id',  'transcript_id'
    ];
}
