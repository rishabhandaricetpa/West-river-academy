<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdvancePlacement extends Model
{
    use HasFactory;
    protected $fillable = ['student_profile_id', 'ap_course_name', 'ap_course_grade', 'ap_course_credits', 'transcript_id'];
}
