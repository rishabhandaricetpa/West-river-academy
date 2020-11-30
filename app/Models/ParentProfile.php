<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'p1_first_name','p1_email','p1_cell_phone','street_address','city','state','zip_code','country'
    ];
    protected $table = "parent_profiles";
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
