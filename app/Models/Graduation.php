<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Graduation extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_profile_id', 'student_profile_id', 'grade_9_info', 'grade_10_info', 'grade_11_info', 'status', 'apostille_country'
    ];
    
    public function parent()
    {
        return $this->belongsTo('App\Models\ParentProfile','parent_profile_id','id');
    }

    public function student()
    {
        return $this->belongsTo('App\Models\StudentProfile','student_profile_id','id');
    }

    public function details()
    {
        return $this->hasOne('App\Models\GraduationDetail');
    }

    public function payment()
    {
        return $this->hasOne('App\Models\GraduationPayment');
    }

    public function address()
    {
        return $this->hasOne('App\Models\GraduationMailingAddress');
    }
}
