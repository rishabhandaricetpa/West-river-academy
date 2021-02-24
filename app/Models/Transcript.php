<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transcript extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_profile_id', 'student_profile_id', 'period', 'status'
    ];
    public function parent()
    {
        return $this->belongsTo('App\Models\ParentProfile','parent_profile_id','id');
    }

    public function student()
    {
        return $this->belongsTo('App\Models\StudentProfile','student_profile_id','id');
    }
}
