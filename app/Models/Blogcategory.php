<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blogcategory extends Model
{
    protected $table = 'blogcategories';

    protected $fillable = [
        'blog_category_name',
        'blog_category_slug',
    ];
    public function blog_category()
    {
        return $this->hasMany(Blog::class, 'blog_category_id');
    }

    // Alternative method name for convenience
    public function blogs()
    {
        return $this->hasMany(Blog::class, 'blog_category_id');
    }
}
