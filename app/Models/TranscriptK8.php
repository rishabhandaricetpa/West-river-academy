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
}
