<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'blogs';

    protected $fillable = [
        'blog_image',
        'blog_title',
        'blog_slug',
        'blog_content',
        'blog_category_id',
        'new_blog_image',
    ];

     // ✅ THIS RELATIONSHIP FIX
    public function category()
    {
        return $this->belongsTo(Blogcategory::class, 'blog_category_id');
    }
}
