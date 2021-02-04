<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeStructure extends Model
{
    use HasFactory;
    protected $fillable = [
        'fee_type', 'period', 'amount',
    ];

    public function EnrollmentPeriods()
    {
        return $this->hasMany('App\Models\EnrollmentPeriods', 'period_id', 'id');
    }
}
