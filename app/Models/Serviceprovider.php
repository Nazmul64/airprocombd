<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Serviceprovider extends Model
{
   protected $fillable = [
        'title',
        'side',
        'order',
    ];

    public function items()
    {
        return $this->hasMany(serviceprovider_items::class)->orderBy('order');
    }
}
