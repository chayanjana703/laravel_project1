<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'seller_id',
        'name',
        'slug',
        'description',
        'price',
        'old_price',
        'stock',
        'sku',
        'category_id',
        'status',
        'featured',
    ];
    protected $with=['images'];

    /**
     * Get the images for the product.
     */
    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    /**
     * Get the primary image for the product.
     */
    public function primaryImage()
    {
        return $this->hasOne(ProductImage::class, 'product_id')->where('is_primary', 1);
    }

    /**
     * Get the seller user that owns the product.
     */
    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    /**
     * Get specifications for the product.
     */
    public function specifications()
    {
        return $this->hasMany(ProductSpecification::class, 'product_id');
    }

    /**
     * Get reviews for the product.
     */
    public function reviews()
    {
        return $this->hasMany(ProductReview::class, 'product_id')->latest();
    }

    /**
     * Get FAQs for the product.
     */
    public function faqs()
    {
        return $this->hasMany(ProductFaq::class, 'product_id');
    }

    /**
     * Get the category for the product.
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
