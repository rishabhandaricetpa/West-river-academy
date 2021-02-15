<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TranscriptCourse extends Model
{
    use HasFactory;
    protected $table = 'transcript_course';
    protected $fillable = [
        'student_profile_id', 'courses_id', 'subject_id', 'score'
    ];
}
