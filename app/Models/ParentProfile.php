<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'p1_first_name', 'p1_middle_name', 'p1_last_name', 'p1_email', 'p1_cell_phone', 'p1_home_phone',
        'p2_first_name', 'p2_middle_name', 'p2_email', 'p2_cell_phone', 'p2_home_phone',
        'street_address', 'city', 'state', 'zip_code', 'country', 'reference',
        'immunized'
    ];
    protected $table = "parent_profiles";
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function studentProfile()
    {
        return $this->hasMany('App\Models\StudentProfile','parent_profile_id','id');
    }
}
