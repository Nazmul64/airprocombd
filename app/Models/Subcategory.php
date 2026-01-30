<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $fillable = [
        'subcategory_name',
        'subcategory_slug',
        'category_id',
    ];

    // Relation to Category
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }


}
