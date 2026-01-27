<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contactinfo extends Model
{
     protected $fillable = [
        'call_now_title',
        'call_now_number',
        'call_photo',
        'new_call_photo',
        'location_title',
        'location_address',
        'location_photo',
        'new_location_photo',
        'email_title',
        'email_address',
        'email_photo',
        'new_email_photo',
        'google_map',
        'main_photo',
        'new_main_photo'
    ];
}
