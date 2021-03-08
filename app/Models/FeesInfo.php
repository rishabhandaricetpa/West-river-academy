<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeesInfo extends Model
{
    use HasFactory;

    protected $table = 'fees_info';

    protected $fillable = [
        'type', 'description', 'amount',
    ];

    public static function getFeeAmount($type)
    {
        return self::where('type', $type)->pluck('amount')->first();
    }
}
