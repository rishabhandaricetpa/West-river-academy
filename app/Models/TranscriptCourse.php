<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TranscriptCourse extends Model
{
    use HasFactory;
    protected $table = 'transcript_course';
    protected $fillable = [
        'student_profile_id', 'courses_id', 'subject_id', 'score', 'k8transcript_id', 'other_subject'
    ];

    public function subjects()
    {
        return $this->hasMany('App\Models\Subject', 'id', 'subject_id');
    }
    public function course()
    {
        return $this->hasOne('App\Models\Course', 'id', 'courses_id');
    }
    public function StudentProfile()
    {
        return $this->belongsTo('App\Models\StudentProfile');
    }
    public function TranscriptK8()
    {
        return $this->belongsTo('App\Models\TranscriptK8');
    }
    public function subject()
    {
        return $this->hasOne('App\Models\Subject', 'id', 'subject_id');
    }
}
