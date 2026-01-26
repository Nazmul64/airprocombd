<?php

namespace App\Models;

use App\Http\Controllers\Backend\WaletaSetupController;
use Illuminate\Database\Eloquent\Model;

class Deposite extends Model
{
   protected $fillable=[
     "user_id","amount","payment_method","transaction_id","screenshot","status","new_screenshot",

   ];

  protected $casts = [
    'user_id' => 'string',
    'amount' => 'string',
    'payment_method' => 'string',
    'transaction_id' => 'string',
    'screenshot'=> 'string',
    'status'=> 'string',
    'status'=> 'string',
];



 public function user() {
    return $this->belongsTo(User::class, 'user_id');
}
public function method_type() {
    return $this->belongsTo(Waleta_setup::class, 'payment_method');
}

public function userdeposite()
{
    return $this->hasMany(Deposite::class, 'user_id');
}



}
