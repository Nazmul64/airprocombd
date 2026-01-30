<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Workreferencec extends Model
{
    protected $fillable = [
        'work_title',
        'work_slug',
        'work_content',
        'work_category_id',
        'work_image',
        'new_work_image',
    ];

    // Each work belongs to a category
    public function category()
    {
        return $this->belongsTo(Workreferencecategory::class, 'work_category_id');
    }
}
