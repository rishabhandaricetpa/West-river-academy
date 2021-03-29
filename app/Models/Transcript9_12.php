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

    public function TranscriptCourse9_12()
    {
        return $this->hasMany(TranscriptCourse9_12::class);
    }

    public function transcript()
    {
        return $this->belongsTo(Transcript::class);
    }
    public function transcripts()
    {
        return $this->hasMany('App\Models\TranscriptCourse', 'k8transcript_id', 'id');
    }
}
