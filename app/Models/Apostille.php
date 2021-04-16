<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apostille extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_profile_id', 'transcript_doc', 'confirmation_doc', 'custom_doc', 'additional_message', 'postage_option', 'apostille_country', 'first_name', 'last_name', 'street', 'city', 'country', 'zip_code', 'status'
    ];
    public function parent()
    {
        return $this->belongsTo('App\Models\ParentProfile', 'parent_profile_id', 'id');
    }
}
