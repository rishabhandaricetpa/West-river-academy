<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BanktransferDetail extends Model
{
    use HasFactory;
    protected $table = 'bank_transfer_details';

    protected $fillable = [
        'bank_name', 'swift_code', 'bank_address', 'street', 'phone_number', 'routing_number', 'account_name', 'account_number', 'status',
    ];
}
