<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Storage;

class ConfirmationLetter extends Model
{
    use HasFactory;
    protected $table = 'confirmation_letters';
    public const UPLOAD_DIR_STUDENT = '/StudentConfirmationLetter';
    public const UPLOAD_DIR_ADMIN = '/AdminConfirmationLetter';

    protected $appends = ['student_confirmation'];

    protected $fillable = [
        'student_profile_id', 'parent_profile_id', 'enrollment_period_id', 'pdf_link', 'status',
    ];
    public function getStudentConfirmationAttribute()
    {
        return Storage::url(self::UPLOAD_DIR_STUDENT . '/' . $this->pdf_link);
    }
    public function StudentProfile()
    {
        return $this->belongsTo('App\Models\StudentProfile');
    }
}
