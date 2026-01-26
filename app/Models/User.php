<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name','email','password','phone','address','role','username','referred_by','ref_id','refer_income','generation_income','status','role','ref_code','walate_address',
        'reset_token','reset_token_expires_at',
    ];



public function referrer() {
    return $this->belongsTo(User::class, 'referred_by');
}
public function referrals() {
    return $this->hasMany(User::class, 'referred_by');
}
public function deposits() {
    return $this->hasMany(Deposite::class, 'user_id');
}
public function profits() {
    return $this->hasMany(Profit::class, 'user_id');
}

public function user()
{
    return $this->belongsTo(User::class);
}
public function withdrawals()
    {
        return $this->hasMany(User_widthdraw::class);
    }

 public function lotteryResults()
    {
        return $this->hasMany(Lottery_result::class, 'user_id', 'id');
    }
    public function userWidthdraws()
{
    return $this->hasMany(User_widthdraw::class);
}
    public function userdeposite()
{
    return $this->hasMany(Deposite::class);
}

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
