<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Storage;

class Video extends Model
{
    use HasFactory;
    protected $fillable = ['heading', 'content', 'filename'];
    public  const  UPLOAD_DIR_VIDEOS = 'videos';
    protected $appends = ['videos_url'];

    public function getVideosUrlAttribute()
    {
        return Storage::url(self::UPLOAD_DIR_VIDEOS . '/' . $this->filename);
    }
}
