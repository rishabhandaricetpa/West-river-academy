<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TranscriptK8 extends Model
{
    use HasFactory;
    protected $table = 'k8transcript';
    protected $fillable = [
        'student_profile_id', 'country', 'enrollment_year', 'grade', 'school_name'
    ];

    public function transcriptPdf()
    {
        return $this->hasMany('App\Models\TranscriptPdf', 'k8transcript_id', 'id');
    }
    public function transcripts()
    {
        return $this->hasMany('App\Models\TranscriptCourse', 'k8transcript_id', 'id');
    }
    public function TranscriptCourse()
    {
        return $this->hasMany('App\Models\TranscriptCourse', 'k8transcript_id', 'id');
    }
    // public function courses()
    // {
    //     return $this->hasManyThrough(Courses::class, TranscriptCourse::class, 'k8transcript_id');
    // }
}
