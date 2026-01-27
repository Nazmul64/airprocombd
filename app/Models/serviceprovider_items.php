<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class serviceprovider_items extends Model
{
    protected $fillable = [
        'serviceprovider_id',
        'item_name',
        'order',
    ];

    public function serviceprovider()
    {
        return $this->belongsTo(Serviceprovider::class);
    }
}
