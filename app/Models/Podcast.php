<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Storage;

class Podcast extends Model
{
    use HasFactory;
    protected $fillable = ['heading', 'content', 'filename'];
    public  const UPLOAD_DIR_PODCAST = 'podcasts';
    protected $appends = ['podcast_url'];

    public function getPodcastUrlAttribute()
    {
        return Storage::url(self::UPLOAD_DIR_PODCAST . '/' . $this->filename);
    }
}
