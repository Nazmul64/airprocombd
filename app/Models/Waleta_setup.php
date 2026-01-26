<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Waleta_setup extends Model
{
  protected $casts = [
    'status' => 'string',
    'bankname' => 'string',
    'accountnumber' => 'string',
    'photo' => 'string',
];
protected $fillable = [
    'status',
    'bankname',
    'accountnumber',
    'photo',
    'new_photo',
];
public function deposits()
{
    return $this->hasMany(Deposite::class,);
}
}
