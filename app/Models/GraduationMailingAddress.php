<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GraduationMailingAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'graduation_id', 'name', 'street', 'city', 'country', 'postal_code'
    ];

    public function graduation()
    {
        return $this->belongsTo('App\Models\Graduation');
    }
}
