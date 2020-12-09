<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_profile_id', 'first_name', 'middle_name', 'last_name', 'd_o_b', 'email', 'cell_phone',
         'student_Id', 'start_date_of_enrollment', 'end_date_of_enrollment', 'grade_level', 'immunized_status',
        'student_situation'
    ];
    protected $table = "student_profiles";
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'd_o_b',
    ];
    
    public function parentProfile()
    {
        return $this->belongsTo('App\Models\ParentProfile');
    }
    public function EnrollmentPeriods()
    {
        return $this->hasMany('App\Models\EnrollmentPeriods','student_profile_id','id');
    }
  }
