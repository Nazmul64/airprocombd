<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Whychooseinvestmentplan extends Model
{
    protected $table = 'whychooseinvestmentplans';

    protected $fillable = [
        'title',
        'description',
        'icon',
        'main_title',
        'main_description',
        'status',
    ];
}
