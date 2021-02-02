<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferwiseDetail extends Model
{
    use HasFactory;
    protected $table = "transfer_wise_deatils";

    protected $fillable = [
        'account_holder', 'account_number', 'wire_transfer_number','swift_code','routing_number','address','state','country','website','status'
    ];
}
