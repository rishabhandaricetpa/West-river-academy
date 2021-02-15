<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GraduationDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'graduation_id', 'project', 'diploma', 'transcript', 'situation', 'record_received', 'grad_date', 'apostille_package', 'notes'
    ];

    public function graduation()
    {
        return $this->belongsTo('App\Models\Graduation');
    }
}
