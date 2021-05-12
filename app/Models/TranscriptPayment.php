<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TranscriptPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'transcript_id', 'amount', 'transcation_id', 'payment_mode','legacy_name','order_id'
    ];

    public function transcriptK8()
    {
        return $this->belongsTo('App\Models\TranscriptK8');
    }
    public function transcript()
    {
        return $this->belongsTo('App\Models\Transcript');
    }
}
