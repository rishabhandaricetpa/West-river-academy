<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnrollmentPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'enrollment_period_id', 'amount', 'status', 'order_id'
    ];

    public function enrollment_period()
    {
        return $this->hasOne(EnrollmentPeriods::class);
    }
}
