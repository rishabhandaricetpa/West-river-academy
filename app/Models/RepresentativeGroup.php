<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepresentativeGroup extends Model
{
    use HasFactory;
    protected $table = 'representative_groups';
    protected $fillable = ['parent_profile_id', 'type', 'country', 'city', 'name', 'email'];


    public function families()
    {
        return  $this->hasMany('App\Models\ParentProfile', 'representative_group_id', 'id');
    }
}
