<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contacform extends Model
{
     protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'message',
        'status',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    // Get full name
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    // Scope for pending contacts
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    // Scope for read contacts
    public function scopeRead($query)
    {
        return $query->where('status', 'read');
    }

    // Scope for replied contacts
    public function scopeReplied($query)
    {
        return $query->where('status', 'replied');
    }
}
