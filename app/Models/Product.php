<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_name',
        'product_slug',
        'product_description',
        'brand',
        'country',
        'origin',
        'category_id',
        'subcategory_id',
        'product_image',
        'multi_image',
        'company_details',
        'button_title',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'multi_image' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Boot method for model events
     */
    protected static function boot()
    {
        parent::boot();

        // Auto-generate slug when creating a new product
        static::creating(function ($product) {
            if (empty($product->product_slug) && !empty($product->product_name)) {
                $product->product_slug = Str::slug($product->product_name);

                // Ensure unique slug
                $originalSlug = $product->product_slug;
                $count = 1;
                while (static::where('product_slug', $product->product_slug)->exists()) {
                    $product->product_slug = $originalSlug . '-' . $count;
                    $count++;
                }
            }
        });

        // Auto-update slug when product name changes
        static::updating(function ($product) {
            if ($product->isDirty('product_name') && !$product->isDirty('product_slug')) {
                $product->product_slug = Str::slug($product->product_name);

                // Ensure unique slug (excluding current product)
                $originalSlug = $product->product_slug;
                $count = 1;
                while (static::where('product_slug', $product->product_slug)
                            ->where('id', '!=', $product->id)
                            ->exists()) {
                    $product->product_slug = $originalSlug . '-' . $count;
                    $count++;
                }
            }
        });
    }

    /**
     * Get the category that owns the product.
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * Get the subcategory that owns the product.
     */
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class, 'subcategory_id');
    }

    /**
     * Get the product image URL
     */
    public function getProductImageUrlAttribute()
    {
        if (!empty($this->product_image)) {
            return asset('uploads/products/' . $this->product_image);
        }
        return asset('images/no-image.png'); // Placeholder image
    }

    /**
     * Get all product images (main + multi images)
     */
    public function getAllImagesAttribute()
    {
        $images = [];

        // Add main image first
        if (!empty($this->product_image)) {
            $images[] = asset('uploads/products/' . $this->product_image);
        }

        // Add multiple images
        if (!empty($this->multi_image) && is_array($this->multi_image)) {
            foreach ($this->multi_image as $image) {
                $images[] = asset('uploads/products/' . $image);
            }
        }

        // Return placeholder if no images
        if (empty($images)) {
            $images[] = asset('images/no-image.png');
        }

        return $images;
    }

    /**
     * Get short description (limited to specific length)
     */
    public function getShortDescriptionAttribute()
    {
        return Str::limit($this->product_description, 100, '...');
    }

    /**
     * Scope for active products (if you add status field later)
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    /**
     * Scope for products by category
     */
    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    /**
     * Scope for products by subcategory
     */
    public function scopeBySubcategory($query, $subcategoryId)
    {
        return $query->where('subcategory_id', $subcategoryId);
    }

    /**
     * Scope for latest products
     */
    public function scopeLatest($query, $limit = 10)
    {
        return $query->orderBy('created_at', 'desc')->limit($limit);
    }

    /**
     * Get related products (same category, excluding current product)
     */
    public function getRelatedProductsAttribute()
    {
        return static::where('category_id', $this->category_id)
                     ->where('id', '!=', $this->id)
                     ->limit(4)
                     ->get();
    }
}
