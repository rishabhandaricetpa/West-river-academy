<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoneygramDetail extends Model
{
    use HasFactory;
    protected $table = "money_gram_details";

    protected $fillable = [
        'name', 'address', 'city','state','zip','money_gram_id','status'
    ];
}
