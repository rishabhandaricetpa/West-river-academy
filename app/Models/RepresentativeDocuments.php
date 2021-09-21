<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Storage;


class RepresentativeDocuments extends Model
{
    use HasFactory;

    protected $fillable = ['representative_group_id', 'original_filename', 'document_type', 'filename'];
    public const uploadDir = 'rep_documents';
    protected $appends = ['rep_document'];
    public function getRepDocumentAttribute()
    {
        return Storage::url(self::uploadDir . '/' . $this->filename);
    }
}
