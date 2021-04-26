<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadDocuments extends Model
{
    use HasFactory;
    protected $table = 'upload_document';
    protected $fillable = ['student_profile_id', 'original_filename', 'filename', 'parent_profile_id', 'document_type', 'is_upload_to_student'];
}
