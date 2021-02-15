<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_profile_id', 'first_name', 'middle_name', 'last_name', 'd_o_b', 'email', 'cell_phone', 'gender',
        'student_Id', 'start_date_of_enrollment', 'end_date_of_enrollment', 'grade_level', 'immunized_status',
        'student_situation',
    ];
    protected $table = 'student_profiles';
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'd_o_b',
    ];

    protected $appends = ['birthdate','fullname'];

    public function getBirthdateAttribute()
    {
        return  $this->d_o_b === null ? '' : $this->d_o_b->format('m/d/Y') ;
    }

    public function getFullnameAttribute()
    {
        return $this->first_name .' '. $this->last_name ;
    }

    public function parentProfile()
    {
        return $this->belongsTo('App\Models\ParentProfile');
    }

    public function enrollmentPeriods()
    {
        return $this->hasMany('App\Models\EnrollmentPeriods', 'student_profile_id', 'id');
    }
    public function transcriptCourses()
    {
        return $this->hasMany('App\Models\TranscriptCourse', 'student_profile_id', 'id');
    }
    public function graduation()
    {
        return $this->hasOne('App\Models\Graduation', 'student_profile_id', 'id');
    }

    public function graduationAddress()
    {
        return $this->hasOneThrough(
            'App\Models\GraduationMailingAddress',
            'App\Models\Graduation',
            'student_profile_id',
            'graduation_id'
        );
    }
}
