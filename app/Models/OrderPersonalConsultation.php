<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPersonalConsultation extends Model
{
    use HasFactory;
    protected $table = 'order_personal_consultations';
    protected $fillable = [
        'parent_profile_id', 'preferred_language', 'en_call_type', 'sp_call_type', 'amount', 'consulting_about', 'paying_for', 'type_of_payment', 'transcation_id', 'payment_mode', 'status', 'order_id'
    ];
    public function parent()
    {
        return $this->belongsTo('App\Models\ParentProfile', 'parent_profile_id', 'id');
    }
}
