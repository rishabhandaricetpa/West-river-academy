<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TranscriptCourse9_12 extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_profile_id', 'courses_id', 'subject_id', 'score', 'remaining_credits', 'credit_id', 'transcript9_12_id', 'selectedCredit'
    ];
}
