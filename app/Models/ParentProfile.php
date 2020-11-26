<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentProfile extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = "parent_profiles";
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
