<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecordTransfer extends Model
{
    use HasFactory;
    protected $fillable = [
        'school_name', 'email', 'fax_number', 'phone_number', 'street_address',
        'city', 'state', 'zip_code', 'country', 'status', 'student_profile_id', 'parent_profile_id',
    ];

    public function student()
    {
        return $this->belongsTo('App\Models\StudentProfile', 'student_profile_id', 'id');
    }
}
