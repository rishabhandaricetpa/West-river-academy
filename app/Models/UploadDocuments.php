<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Storage;

class UploadDocuments extends Model
{
    use HasFactory;
    public  const UPLOAD_DIR = 'documents';
    protected $table = 'upload_document';
    protected $fillable = ['student_profile_id', 'original_filename', 'filename', 'parent_profile_id', 'document_type', 'is_upload_to_student'];
    protected $appends = ['document_url'];
    public function parentProfile()
    {
        return $this->hasOne(ParentProfile::class);
    }
    public function student()
    {
        return $this->belongsTo('App\Models\StudentProfile', 'student_profile_id', 'id');
    }
    public function getDocumentUrlAttribute()
    {
        return Storage::url(self::UPLOAD_DIR . '/' . $this->filename);
    }
}
