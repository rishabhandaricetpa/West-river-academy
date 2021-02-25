<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_name', 'other_courses', 'transcript_period',
    ];
    protected $table = 'courses';

    public function subjects()
    {
        return $this->hasMany('App\Models\Subject', 'courses_id', 'id');
    }
    public function transcriptCourse()
    {
        return $this->belongsTo('App\Models\TranscriptCourse');
    }
}
