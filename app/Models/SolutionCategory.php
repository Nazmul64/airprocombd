<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SolutionCategory extends Model
{
    protected $fillable = [
        'category_name',
        'category_slug',
    ];
}
