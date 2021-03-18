<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfirmationLetter extends Model
{
    use HasFactory;
    protected $table = 'confirmation_letters';
    protected $fillable = [
        'student_profile_id', 'parent_profile_id', 'enrollment_period_id', 'pdf_link', 'status',
    ];
}
