<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model
{
    use HasFactory;
    protected $table = 'dashboards';
    protected $fillable = [
        'linked_to', 'notes', 'assigned_to', 'created_date', 'amount', 'updated_date', 'student_profile_id', 'related_to', 'is_completed', 'status', 'is_archieved', 'record_transfer_id', 'parent_profile_id'
    ];
    public function student()
    {
        return $this->belongsTo('App\Models\StudentProfile', 'student_profile_id', 'id');
    }
    public function recordTransfer()
    {
        return $this->belongsTo('App\Models\RecordTransfer', 'record_transfer_id', 'id');
    }
}
