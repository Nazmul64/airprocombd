<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Passionsection extends Model
{
    protected $fillable = [
        'photo',
        'title',
        'description',
        'pdf',
        'new_photo',
    ];
}
