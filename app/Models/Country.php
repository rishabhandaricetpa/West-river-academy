<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $fillable = ['country'];

    public function CountryEnrollment()
    {
        return $this->hasOne(CountryEnrollment::class);
    }
    public function semesters()
    {
        return $this->belongsToMany(Semester::class);
    }
}
