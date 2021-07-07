<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Storage;

class TranscriptPdf extends Model
{
    use HasFactory;
    protected $table = 'transcript_pdf';
    public const UPLOAD_DIR_TRANSCRIPT = 'transcripts';
    protected $appends = ['transcript_file'];
    protected $fillable = [
        'student_profile_id', 'parent_profile_id', 'pdf_link', 'status', 'transcript_id',
    ];

    public function Transcript()
    {
        return $this->belongsTo('App\Models\Transcript');
    }
    public function getTranscriptFileAttribute()
    {
        return Storage::url(self::UPLOAD_DIR_TRANSCRIPT . '/' . $this->pdf_link);
    }
}
