<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Videosection extends Model
{
    protected $fillable = [
        'video_title',
        'video_link',
        'description',
    ];
}
