<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transcript9_12 extends Model
{
    use HasFactory;
    protected $table = 'transcript9_12';
    protected $fillable = [
        'student_profile_id', 'country', 'enrollment_year', 'grade', 'school_name', 'transcript_id', 'is_carnegie'
    ];
}
