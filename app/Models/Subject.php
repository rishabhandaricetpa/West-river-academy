<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'courses_id', 'subject_name', 'other_subject', 'transcript_period', 'status',
    ];
    protected $table = 'subjects';

    public function parentProfile()
    {
        return $this->belongsTo('App\Models\Subject');
    }
    // public function transcriptCourse()
    // {
    //     return $this->belongsTo('App\Models\TranscriptCourse');
    // }

}
