<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GraduationPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'graduation_id', 'amount', 'transcation_id', 'payment_mode',
    ];

    public function graduation()
    {
        return $this->belongsTo('App\Models\Graduation');
    }
}
