<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Workreferencecategory extends Model
{
    protected $fillable = [
        'category_name',
        'category_slug',
    ];

    // One category has many works
    public function works()
    {
        return $this->hasMany(Workreferencec::class, 'work_category_id');
    }
}
