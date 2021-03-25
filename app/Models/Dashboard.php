<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model
{
    use HasFactory;
    protected $table = 'dashboards';
    protected $fillable = [
        'linked_to', 'notes', 'assigned_to', 'created_date', 'updated_date', 'student_profile_id', 'related_to'
    ];
    public function student()
    {
        return $this->belongsTo('App\Models\StudentProfile', 'student_profile_id', 'id');
    }
}
