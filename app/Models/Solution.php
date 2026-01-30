<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solution extends Model
{
    protected $fillable = [
        'title',
        'description',
        'photo',
        'soluction_category_id',
        'soluctionsub_category_id',
    ];

    public function category()
    {
        return $this->belongsTo(
            SolutionCategory::class,
            'soluction_category_id'
        );
    }

    public function subcategory()
    {
        return $this->belongsTo(
            SolutionsubCategory::class,
            'soluctionsub_category_id'
        );
    }
}
