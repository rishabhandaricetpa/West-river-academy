<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepresentativeAmount extends Model
{
    use HasFactory;
    protected $fillable = ['representative_group_id', 'amount', 'notes', 'status'];
}
