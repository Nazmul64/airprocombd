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
}
