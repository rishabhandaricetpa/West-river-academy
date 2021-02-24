<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TranscriptK8 extends Model
{
    use HasFactory;
    protected $table = 'k8transcript';
    protected $fillable = [
        'student_profile_id', 'country', 'enrollment_year', 'grade', 'school_name','transcript_id',
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
    public function TranscriptDetails()
    {
        return $this->hasMany('App\Models\TranscriptCourse', 'student_profile_id', 'student_profile_id');
    }
    public function payment()
    {
        return $this->hasOne('App\Models\TranscriptPayment');
    }
    public function student()
    {
        return $this->belongsTo('App\Models\StudentProfile','student_profile_id','id');
    }

}
