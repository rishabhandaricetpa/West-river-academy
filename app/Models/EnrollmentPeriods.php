<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnrollmentPeriods extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_profile_id', 'start_date_of_enrollment', 'end_date_of_enrollment', 'grade_level'
    ];
    protected $table = "enrollment_periods";

    public function StudentProfile()
    {
        return $this->belongsTo('App\Models\StudentProfile');
    }
    public function Country()
    {
        return $this->belongsTo(Country::class);
    }
}
