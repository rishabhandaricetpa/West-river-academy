<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotarizationPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'notarization_id', 'parent_profile_id', 'student_profile_id	', 'order_postages_id', 'amount', 'status', 'transcation_id', 'payment_mode', 'pay_for'
    ];

    public function ParentProfile()
    {
        return $this->belongsTo('App\Models\ParentProfile');
    }
    public function notarization()
    {
        return $this->belongsTo('App\Models\Notarization');
    }
}
