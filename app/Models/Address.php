<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_profile_id', 'billing_street_address', 'billing_city', 'billing_state', 'billing_zip_code', 'billing_country', 'shipping_street_address',
        'shipping_city', 'shipping_state', 'shipping_zip_code', 'shipping_country', 'email',
       ];
    protected $table = "address";
    
    public function parentProfile()
    {
        return $this->belongsTo('App\Models\ParentProfile');
    }
    
}
