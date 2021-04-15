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
        'student_situation', 'legacy_name'
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

    protected $appends = ['birthdate', 'fullname', 'date_of_birth'];

    public function getBirthdateAttribute()
    {
        return  $this->d_o_b === null ? '' : $this->d_o_b->format('m/d/Y');
    }
    public function getDateOfBirthAttribute()
    {
        return $this->d_o_b === null ? '' : $this->d_o_b->format('m/d/Y');
    }
    public function getFullnameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
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
    public function transcriptCourses9_12()
    {
        return $this->hasMany(TranscriptCourse9_12::class);
    }
    public function TranscriptK8()
    {
        return $this->hasMany('App\Models\TranscriptK8', 'student_profile_id', 'id');
    }
    public function Transcript912()
    {
        return $this->hasMany(Transcript9_12::class);
    }
    public function graduation()
    {
        return $this->hasOne('App\Models\Graduation', 'student_profile_id', 'id');
    }

    public function dashboard()
    {
        return $this->hasOne('App\Models\Dashboard', 'student_profile_id', 'student_profile_id');
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

    public function graduationPayment()
    {
        return $this->hasOneThrough(
            'App\Models\GraduationPayment',
            'App\Models\Graduation',
            'student_profile_id',
            'graduation_id'
        );
    }

    public function transcript()
    {
        return $this->hasMany('App\Models\Transcript', 'student_profile_id', 'id');
    }

    public function transcriptDetails()
    {
        return $this->hasOneThrough(
            'App\Models\TranscriptCourse',
            'App\Models\TranscriptK8',
            'student_profile_id',
            'k8transcript_id'
        );
    }

    public function recordTransfers()
    {
        return $this->hasOne(RecordTransfer::class);
    }
}
