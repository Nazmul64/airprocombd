<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $table = 'subcategories';

    protected $fillable = [
        'category_id',
        'subcategory_name',
        'subcategory_slug',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
