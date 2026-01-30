<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SolutionCategory extends Model
{
    protected $fillable = [
        'category_name',
        'category_slug',
    ];

    public function subcategories()
    {
        return $this->hasMany(SolutionsubCategory::class, 'category_id');
    }
}
