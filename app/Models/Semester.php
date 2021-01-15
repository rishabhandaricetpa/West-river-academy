<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    use HasFactory;
    protected $table = "semesters";
    protected $fillable = ['start_date', 'end_date'];
    public function countries()
    {
        return $this->belongsToMany(Country::class);
    }
}
