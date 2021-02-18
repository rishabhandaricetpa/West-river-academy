<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TranscriptPdf extends Model
{

    use HasFactory;
    protected $table = 'transcript_pdf';
    protected $fillable = [
        'student_profile_id', 'pdf_link', 'status', 'k8transcript_id',
    ];

    public function TranscriptK8()
    {
        return $this->belongsTo('App\Models\TranscriptK8');
    }
}
